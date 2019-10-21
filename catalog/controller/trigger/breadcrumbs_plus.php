<?php
class ControllerTriggerBreadcrumbsPlus extends OCMController {
  public function getProduct(&$trigger, &$data) {
    $data['breadcrumbs'] = array_slice($data['breadcrumbs'], 0, 1);

    $category_id = $this->getProductMainCategoryId($data['product_id']);
    if ($category_id) {
      $paths = $this->getCategoryPath($category_id);
      $this->request->get['path'] = implode('_', $paths);
    }

    if (isset($data['manufacturer_id']) && ($this->config->get('breadcrumbs_plus_product_breadcrumb') == 2 || $this->config->get('breadcrumbs_plus_product_breadcrumb') == 3)) {
      $manufacturer_id = $data['manufacturer_id'];
      $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

      if ($this->config->get('breadcrumbs_plus_product_breadcrumb') == 3) {
        $data['breadcrumbs'][] = array(
          'text' => $this->language->get('text_brand'),
          'href' => $this->url->link('product/manufacturer'),
          'separator' => ($this->language->get('text_separator') != 'text_separator') ? $this->language->get('text_separator') : '',
          );
      }

      if ($manufacturer_info) {
        $data['breadcrumbs'][] = array(
          'text' => $manufacturer_info['name'],
          'href' => $this->url->link('product/manufacturer/product', 'manufacturer_id=' . $manufacturer_id),
          'separator' => ($this->language->get('text_separator') != 'text_separator') ? $this->language->get('text_separator') : '',
          );
      }
    }

    if ($this->config->get('breadcrumbs_plus_product_breadcrumb') == 4 || $this->config->get('breadcrumbs_plus_product_breadcrumb') == 5) {
      if ($this->config->get('breadcrumbs_plus_product_breadcrumb') == 4 && $category_id) {
        $category_info = $this->model_catalog_category->getCategory($category_id);
        $data['breadcrumbs'][] = array(
          'text' => $category_info['name'],
          'href' => $this->url->link('product/category', 'path=' . implode('_', $paths)),
          'separator' => ($this->language->get('text_separator') != 'text_separator') ? $this->language->get('text_separator') : '',
          );
      } elseif (!empty($paths)) {
        foreach ($paths as $i => $path_id) {
          $category_info = $this->model_catalog_category->getCategory($path_id);
          if (!empty($category_info['name'])) {
            $data['breadcrumbs'][] = array(
              'text' => $category_info['name'],
              'href' => $this->url->link('product/category', 'path=' . implode('_', array_slice($paths, 0, $i + 1))),
              'separator' => ($this->language->get('text_separator') != 'text_separator') ? $this->language->get('text_separator') : '',
              );
          }
        }
      }
    }

    $data['breadcrumbs'][] = array(
      'text' => $data['heading_title'],
      'href' => $this->url->link('product/product', 'product_id=' . $data['product_id']),
      'separator' => ($this->language->get('text_separator') != 'text_separator') ? $this->language->get('text_separator') : '',
      );
  }

  public function getCategory(&$trigger, &$data) {
    $data['breadcrumbs'] = array_slice($data['breadcrumbs'], 0, 1);

    $parts = explode('_', (string )$this->request->get['path']);
    $category_id = $parts[count($parts) - 1];
    $paths = $this->getCategoryPath($category_id);
    foreach ($paths as $i => $path_id) {
      if ($path_id == $category_id || ($this->config->get('breadcrumbs_plus_category_breadcrumb') == 2 && $i == count($paths) - 2) || $this->config->get('breadcrumbs_plus_category_breadcrumb') == 3) {
        $category_info = $this->model_catalog_category->getCategory($path_id);
        if ($category_info) {
          $data['breadcrumbs'][] = array(
            'text' => $category_info['name'],
            'href' => $this->url->link('product/category', 'path=' . implode('_', array_slice($paths, 0, $i + 1))),
            'separator' => ($this->language->get('text_separator') != 'text_separator') ? $this->language->get('text_separator') : '',
            );
        }
      }
    }
  }

  public function getHtmlOutput(&$trigger, &$data) {
    preg_match("#<html(.*)>#", $trigger['output'], $html_match);
    if (!ocmIsAjax() && preg_match("#<[^<]+>#", $trigger['output']) && $html_match && $this->config->get('breadcrumbs_plus_nolink') && !preg_match('#ocseo-fixed#', $trigger['output'])) {
      $trigger['output'] = preg_replace_callback('#<(div|ul) +class="(breadcrumb|breadcrumbs)"(.*?)>(.*?)</(?:div|ul)>#s', create_function('$matches', '
      if ($matches && !empty($matches[4])) {
        preg_match_all("#(<a(?:.*?)>(.*?)</a>)#",$matches[4],$submatches);
        if (!empty($submatches[2])) {
          return "<$matches[1] class=\"$matches[2] ocseo-fixed\"$matches[3]>".str_replace(end($submatches[1]),end($submatches[2]),$matches[4])."</$matches[1]>";
        }
      }
      '), $trigger['output']);
    }
  }

  public function getCategoryPath($category_id) {
    $paths = array();

    $query = $this->db->query("SELECT `parent_id` FROM `" . DB_PREFIX . "category` WHERE `category_id` = '" . (int)$category_id . "'");
    if ($query->num_rows) {
      $parent_id = (int)$query->row['parent_id'];
      while ($parent_id > 0) {
        $paths[] = $parent_id;
        $query = $this->db->query("SELECT `parent_id` FROM `" . DB_PREFIX . "category` WHERE `category_id` = '" . (int)$parent_id . "'");
        $parent_id = (int)$query->row['parent_id'];
      }
    }

    $paths = array_reverse($paths);

    $paths[] = $category_id;

    return $paths;
  }

  public function getProductMainCategoryId($product_id) {
    $category_id = 0;
    $query = $this->db->query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . DB_DATABASE . "' AND TABLE_NAME = '" . DB_PREFIX . "product_to_category' AND COLUMN_NAME = 'main_category'");
    if ($query->num_rows) {
      $query = $this->db->query("SELECT `category_id` FROM `" . DB_PREFIX . "product_to_category` WHERE `product_id` = '" . (int)$product_id . "' AND `main_category` = '1' LIMIT 1");
      if ($query->num_rows) {
        $category_id = $query->row['category_id'];
      }
    }
    $this->load->model('catalog/product');
    $categories = $this->model_catalog_product->getCategories($product_id);
    if (empty($category_id) && $categories && !empty($categories[count($categories) - 1]['category_id'])) {
      $category_id = $categories[count($categories) - 1]['category_id'];
    }
    return (int)$category_id;
  }
}