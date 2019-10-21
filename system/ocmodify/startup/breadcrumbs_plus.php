<?php
if ($ocmodify->config->get('breadcrumbs_plus_status')) {
  if (!OCM_IS_ADMIN) {
    //triggers
    $ocmodify->event->register('view/*/product/product/before', new OCMAction('trigger/breadcrumbs_plus/getProduct'));
    $ocmodify->event->register('view/*/product/category/before', new OCMAction('trigger/breadcrumbs_plus/getCategory'));
    $ocmodify->event->register('view/*/*/after', new OCMAction('trigger/breadcrumbs_plus/getHtmlOutput'));
  }
}