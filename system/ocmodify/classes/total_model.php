<?php
if (version_compare(VERSION, '2.2', '>=')) {
  class OCMTotalModel extends OCMModel {
    public function getTotal($data) {
      $this->getTotalData($data);
    }
  }
} else {
  class OCMTotalModel extends OCMModel {
    public function getTotal(&$totals, &$total = 0, &$taxes = array()) {
      $this->getTotalData(array('totals' => &$totals, 'total' => &$total, 'taxes' => &$taxes));
    }
  }
}