<?php
class OCMDatabase extends OCMOverride {
  public static $code = 'db';
  public static $sort = 0;

  private $modifiers = array(), $cached = array(), $columns = array(), $filters = array();

  public function status() {
    return true;
  }

  public function init() {}

  final public function query($sql, $params = array(), $direct = false) {
    if ($direct) {
      return $this->instance->query($sql, $params);
    } else {
      return $this->instance->query($this->prepareSQL($sql), $params);
    }
  }

  final protected function prepareSQL($sql) {
    // Patch SQL query
    if ($this->modifiers) {
      foreach ($this->modifiers as $table => &$actions) {
        // Patch SELECT queries
        if (preg_match('#(FROM|JOIN)\s+`?' . $table . '`?#i', $sql)) {
          // Cache tables
          if (!isset($this->cached[$table])) {
            $this->columns[$table] = $this->getColumns($table);

            // Apply modifiers
            foreach ($actions as $action => &$modifiers) {
              if ($action == 'patch') {
                foreach ($modifiers as $modifier) {
                  list($column, $value) = explode('/', $modifier['data']);
                  $column = trim($column, '`');
                  $this->columns[$table]['`' . $column . '`'] = preg_replace('#`' . $column . '`#', $this->columns[$table]['`' . $column . '`'], '(' . $value . ')');
                }
              } elseif ($action == 'append') {
                foreach ($modifiers as $modifier) {
                  list($column, $value) = explode('/', $modifier['data']);
                  $column = trim($column, '`');
                  $this->columns[$table]['`' . $column . '`'] = $value;
                }
              } elseif ($action == 'filter') {
                foreach ($modifiers as $modifier) {
                  $this->filters[$table][] = $modifier['data'];
                }
              }
            }

            // Build sub-SQL
            $_sql = '(';
            if (isset($this->columns[$table])) {
              $_sql .= 'SELECT ' . ocmBuildQuery(array_flip($this->columns[$table]), ', ', ' AS ') . ' FROM `' . $table . '`';
            }
            if (isset($this->filters[$table])) {
              $_sql .= ' WHERE ' . implode(' AND ', $this->filters[$table]) . '';
            }
            $_sql .= ')';

            // Cache generated SQL
            $this->cached[$table] = $_sql;
          }

          // Patch SQL query
          if ($this->cached[$table]) {
            // Generate unique alias
            $alias = uniqid('ocmodify_');

            // Replace direct table names
            $sql = preg_replace('#\s+`?' . $table . '`?\.(\w+)#i', ' `' . $alias . '`.${1}', $sql);

            // Replace table with subquery
            $sql = preg_replace('#(FROM|JOIN)\s+`?' . $table . '`?(\)|\s+(WHERE|LEFT|RIGHT|UNION|GROUP|HAVING|ORDER|LIMIT|ON|OFFSET|FROM|INNER))#i', '${1} ' . $this->cached[$table] . ' ' . $alias . '${2}', $sql);
            $sql = preg_replace('#(FROM|JOIN)\s+`?' . $table . '`?\s+((?!WHERE|LEFT|RIGHT|UNION|GROUP|HAVING|ORDER|LIMIT|ON|OFFSET|FROM|INNER)\w+)#i', '${1} ' . $this->cached[$table] . ' ${2}', $sql);
          }
        }
      }
    }

    return $sql;
  }

  final protected function getColumns($table) {
    // If not cachedd column names
    if (!isset($this->columns[$table])) {
      $query = $this->instance->query("SELECT COLUMN_NAME AS column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME = '$table'");
      if ($query->num_rows) {
        foreach ($query->rows as $row) {
          $this->columns[$table]['`' . $row['column_name'] . '`'] = '`' . $row['column_name'] . '`';
        }
      }
    }

    // Return cached values
    return $this->columns[$table];
  }

  final public function addModifier($id, $query) {
    $parts = explode('/', $query, 4);

    // Check args for error
    if (count($parts) < 4) {
      trigger_error('Error: The modifier ' . $id . ' does not have correct syntax!');
    }

    // Parse params
    list($path, $type, $order, $modifier) = $parts;
    $tables = explode(',', trim($path, '{}'));

    // Register modifiers for each table
    foreach ($tables as $table) {
      // Register modifier
      $this->modifiers[$table][$type][] = array('order' => $order, 'data' => $modifier);

      // Sort modifiers by order
      usort($this->modifiers[$table][$type], function($a, $b) {
        return $a >= $b;
      });

      // Cleanup cached
      unset($this->cached[$table]);
    }
  }
}