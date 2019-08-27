<?php 
/**
 * @author    p0v1n0m <p0v1n0m@gmail.com>
 * @license   Commercial
 * @link      https://github.com/p0v1n0m
 */
?>
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $total; ?>" data-toggle="tooltip" title="<?php echo $button_total; ?>" class="btn btn-default"><i class="fa fa-money"></i></a>
        <a href="<?php echo $export; ?>" data-toggle="tooltip" title="<?php echo $button_export; ?>" class="btn btn-default"><i class="fa fa-cogs"></i></a>
        <a href="<?php echo $order; ?>" data-toggle="tooltip" title="<?php echo $button_order; ?>" class="btn btn-default"><i class="fa fa-shopping-cart"></i></a>
        <a onclick="$('#form').attr('action', '<?php echo $action; ?>&back'); $('#form').submit()" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $button_apply; ?></a>
        <a onclick="$('#form').attr('action', '<?php echo $action; ?>'); $('#form').submit()" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if (${$m . '_license'}) { ?>
    <div class="panel panel-primary">
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-setting" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo $tab_setting; ?></a></li>
            <li><a href="#tab-api" data-toggle="tab"><i class="fa fa-exchange"></i> <?php echo $tab_api; ?></a></li>
            <li><a href="#tab-delivery" data-toggle="tab"><i class="fa fa-truck"></i> <?php echo $tab_delivery; ?></a></li>
            <li><a href="#tab-map" data-toggle="tab"><i class="fa fa-map"></i> <?php echo $tab_map; ?></a></li>
            <li><a href="#tab-cap" data-toggle="tab"><i class="fa fa-arrows-alt"></i> <?php echo $tab_cap; ?></a></li>
            <li><a href="#tab-support" data-toggle="tab"><i class="fa fa-opencart"></i> <?php echo $tab_support; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-setting">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="<?php echo $m; ?>_title" value="<?php echo ${$m . '_title'}; ?>" class="form-control" />
                  <small class="form-text text-muted"><?php echo $help_title; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="<?php echo $m; ?>_sort_order" value="<?php echo ${$m . '_sort_order'}; ?>" class="form-control" />
                  <small class="form-text text-muted"><?php echo $help_sort_order; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label text-success bg-success"><?php echo $entry_weight_class; ?></label>
                <div class="col-sm-10">
                  <select name="<?php echo $m; ?>_weight_class_id" class="form-control">
                    <?php foreach ($weight_classes as $weight_class) { ?>
                    <?php if ($weight_class['weight_class_id'] == ${$m . '_weight_class_id'}) { ?>
                    <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                  <small class="form-text text-muted"><?php echo $help_weight_class_id; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_default_weight; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" name="<?php echo $m; ?>_default_weight" value="<?php echo ${$m . '_default_weight'}; ?>" class="form-control" />
                    <div class="input-group-addon"><?php echo $text_kg; ?></div>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_default_weight; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label text-success bg-success"><?php echo $entry_length_class; ?></label>
                <div class="col-sm-10">
                  <select name="<?php echo $m; ?>_length_class_id" class="form-control">
                    <?php foreach ($length_classes as $length_class) { ?>
                    <?php if ($length_class['length_class_id'] == ${$m . '_length_class_id'}) { ?>
                    <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                  <small class="form-text text-muted"><?php echo $help_length_class_id; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_default_dimension; ?></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="input-group">
                        <div class="input-group-addon"><?php echo $entry_default_length; ?></div>
                        <input type="text" name="<?php echo $m; ?>_default_length" value="<?php echo ${$m . '_default_length'}; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $text_sm; ?></div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <div class="input-group-addon"><?php echo $entry_default_width; ?></div>
                        <input type="text" name="<?php echo $m; ?>_default_width" value="<?php echo ${$m . '_default_width'}; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $text_sm; ?></div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <div class="input-group-addon"><?php echo $entry_default_height; ?></div>
                        <input type="text" name="<?php echo $m; ?>_default_height" value="<?php echo ${$m . '_default_height'}; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $text_sm; ?></div>
                      </div>
                    </div>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_default_dimension; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_calc_type; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default <?php if (${$m . '_calc_type'} == 0) { ?>active<?php } ?>"><input type="radio" name="<?php echo $m; ?>_calc_type" value="0" autocomplete="off" <?php if (${$m . '_calc_type'} == 0) { ?>checked="checked"<?php } ?>><?php echo $text_volume; ?></label>
                    <label class="btn btn-default <?php if (${$m . '_calc_type'} == 1) { ?>active<?php } ?>"><input type="radio" name="<?php echo $m; ?>_calc_type" value="1" autocomplete="off" <?php if (${$m . '_calc_type'} == 1) { ?>checked="checked"<?php } ?>><?php echo $text_width; ?></label>
                    <label class="btn btn-default <?php if (${$m . '_calc_type'} == 2) { ?>active<?php } ?>"><input type="radio" name="<?php echo $m; ?>_calc_type" value="2" autocomplete="off" <?php if (${$m . '_calc_type'} == 2) { ?>checked="checked"<?php } ?>><?php echo $text_length; ?></label>
                    <label class="btn btn-default <?php if (${$m . '_calc_type'} == 3) { ?>active<?php } ?>"><input type="radio" name="<?php echo $m; ?>_calc_type" value="3" autocomplete="off" <?php if (${$m . '_calc_type'} == 3) { ?>checked="checked"<?php } ?>><?php echo $text_height; ?></label>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_calc_type; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_weight; ?></label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">Min</div>
                    <input type="text" name="<?php echo $m; ?>_min_weight" value="<?php echo ${$m . '_min_weight'}; ?>" class="form-control" />
                    <div class="input-group-addon"><?php echo $text_kg; ?></div>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_min_weight; ?></small>
                </div>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">Max</div>
                    <input type="text" name="<?php echo $m; ?>_max_weight" value="<?php echo ${$m . '_max_weight'}; ?>" class="form-control" />
                    <div class="input-group-addon"><?php echo $text_kg; ?></div>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_max_weight; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_total; ?></label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">Min</div>
                    <input type="text" name="<?php echo $m; ?>_min_total" value="<?php echo ${$m . '_min_total'}; ?>" class="form-control" />
                    <div class="input-group-addon"><?php echo $text_rub; ?></div>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_min_total; ?></small>
                </div>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">Max</div>
                    <input type="text" name="<?php echo $m; ?>_max_total" value="<?php echo ${$m . '_max_total'}; ?>" class="form-control" />
                    <div class="input-group-addon"><?php echo $text_rub; ?></div>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_max_total; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_tax_class; ?></label>
                <div class="col-sm-10">
                  <select name="<?php echo $m; ?>_tax_class_id" class="form-control">
                    <option value="0" selected="selected"><?php echo $text_none; ?></option>
                    <?php foreach ($tax_classes as $tax_class) { ?>
                    <?php if ($tax_class['tax_class_id'] == ${$m . '_tax_class_id'}) { ?>
                    <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_geo_zone; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto; margin: 0;">
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($geo_zone['geo_zone_id'], ${$m . '_geo_zone_id'})) { ?>
                        <input type="checkbox" name="<?php echo $m; ?>_geo_zone_id[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" checked="checked" />
                        <?php echo $geo_zone['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="<?php echo $m; ?>_geo_zone_id[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />
                        <?php echo $geo_zone['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label text-success bg-success"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if (${$m . '_status'}) { ?>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                    <?php } else { ?>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-api">
              <div class="form-group">
                <label class="col-sm-2 control-label text-success bg-success"><?php echo $entry_api_key; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="<?php echo $m; ?>_api_key" value="<?php echo ${$m . '_api_key'}; ?>" class="form-control" />
                  <small class="form-text text-muted"><?php echo $help_api_key; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_logging; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if (${$m . '_logging'}) { ?>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_logging" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_logging" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                    <?php } else { ?>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_logging" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_logging" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                    <?php } ?>
                  </div>
                  <br><small class="form-text text-muted"><?php echo $help_logging; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_cache; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if (${$m . '_cache'}) { ?>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_cache" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_cache" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                    <?php } else { ?>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_cache" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_cache" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                    <?php } ?>
                  </div>
                  <br><small class="form-text text-muted"><?php echo $help_cache; ?></small>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-delivery">
              <div class="row">
                <div class="col-sm-2">
                  <ul class="nav nav-pills nav-stacked" id="delivery">
                    <?php foreach ($variants as $code) { ?>
                    <li><a href="#tab-delivery-<?php echo $code; ?>" data-toggle="tab"><?php echo ${'text_' . $code}; ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="col-sm-10">
                  <div class="tab-content">
                    <?php foreach ($variants as $code) { ?>
                    <div class="tab-pane active" id="tab-delivery-<?php echo $code; ?>">
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_code; ?></label>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $m; ?>.<?php echo $m; ?>_<?php echo $code; ?>" class="form-control" readonly />
                          <small class="form-text text-muted"><?php echo $help_variant_code; ?></small>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label text-success bg-success"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                          <div class="btn-group" data-toggle="buttons">
                            <?php if (${$m . '_status_' . $code}) { ?>
                            <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_status_<?php echo $code; ?>" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                            <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_status_<?php echo $code; ?>" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                            <?php } else { ?>
                            <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_status_<?php echo $code; ?>" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                            <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_status_<?php echo $code; ?>" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <?php if (in_array($code, $variants_map)) { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_list; ?></label>
                        <div class="col-sm-10">
                          <div class="btn-group" data-toggle="buttons">
                            <?php if (${$m . '_list_' . $code}) { ?>
                            <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_list_<?php echo $code; ?>" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                            <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_list_<?php echo $code; ?>" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                            <?php } else { ?>
                            <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_list_<?php echo $code; ?>" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                            <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_list_<?php echo $code; ?>" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                            <?php } ?>
                          </div>
                          <br><small class="form-text text-muted"><?php echo $help_variant_list; ?></small>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_sort_order; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="<?php echo $m; ?>_sort_order_<?php echo $code; ?>" value="<?php echo ${$m . '_sort_order_' . $code}; ?>" class="form-control" />
                          <small class="form-text text-muted"><?php echo $help_variant_sort_order; ?></small>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_geo_zone; ?></label>
                        <div class="col-sm-10">
                          <div class="well well-sm" style="height: 150px; overflow: auto; margin: 0;">
                            <?php foreach ($geo_zones as $geo_zone) { ?>
                            <div class="checkbox">
                              <label>
                                <?php if (in_array($geo_zone['geo_zone_id'], ${$m . '_geo_zone_id_' . $code})) { ?>
                                <input type="checkbox" name="<?php echo $m; ?>_geo_zone_id_<?php echo $code; ?>[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" checked="checked" />
                                <?php echo $geo_zone['name']; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="<?php echo $m; ?>_geo_zone_id_<?php echo $code; ?>[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />
                                <?php echo $geo_zone['name']; ?>
                                <?php } ?>
                              </label>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label text-success bg-success"><?php echo $entry_quote_title; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="<?php echo $m; ?>_quote_title_<?php echo $code; ?>" value="<?php echo ${$m . '_quote_title_' . $code}; ?>" class="form-control" />
                          <small class="form-text text-muted"><?php echo $help_variant_quote_title; ?>
                            <br><code>{{logo}}</code> - <?php echo $text_logo; ?>
                            <?php if (in_array($code, $variants_map)) { ?>
                            <br><code>{{name}}</code> - <?php echo $text_name; ?>
                            <br><code>{{desc}}</code> - <?php echo $text_desc; ?>
                            <?php } ?>
                            <?php if ($code != 'pickup_post') { ?>
                            <br><code>{{days}}</code> - <?php echo $text_days; ?>
                            <?php } ?>
                          </small>
                        </div>
                      </div>
                      <?php if ($code != 'pickup_post') { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_add_day; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group">
                            <input type="text" name="<?php echo $m; ?>_add_day_<?php echo $code; ?>" value="<?php echo ${$m . '_add_day_' . $code}; ?>" class="form-control" />
                            <div class="input-group-addon"><?php echo $text_dni; ?></div>
                          </div>
                          <small class="form-text text-muted"><?php echo $help_variant_add_day; ?></small>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="form-group">
                        <table id="costs-<?php echo $code; ?>" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <td class="text-center" colspan="8"><?php echo $entry_shipping_cost; ?></td>
                            </tr>
                            <tr>
                              <td class="text-center" colspan="3">
                                <small class="form-text text-muted" style="font-weight: normal;"><?php echo $help_variant_cost_cost; ?></small>
                              </td>
                              <td class="text-left" colspan="3" rowspan="2">
                                <?php echo $entry_value; ?>
                                <br><small class="form-text text-muted" style="font-weight: normal;"><?php echo $help_variant_cost_mod; ?></small>
                              </td>
                              <td class="text-left" rowspan="2" style="width: 220px;">
                                <?php echo $entry_only_total; ?>
                                <br><small class="form-text text-muted" style="font-weight: normal;"><?php echo $help_variant_cost_total; ?></small>
                              </td>
                              <td rowspan="2"></td>
                            </tr>
                            <tr>
                              <td class="text-left">
                                <?php echo $entry_order_cost; ?>
                              </td>
                              <td class="text-left">
                                <?php echo $entry_geo_zone; ?>
                              </td>
                              <td class="text-left">
                                <?php echo $entry_city; ?>
                                <br><small class="form-text text-muted" style="font-weight: normal;"><?php echo $help_variant_cost_city; ?></small>
                              </td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $row = 0; ?>
                            <?php foreach (${$m . '_costs_' . $code} as $cost) { ?>
                            <tr id="cost-<?php echo $code; ?>-row-<?php echo $row; ?>">
                              <td class="text-left">
                                <div class="input-group">
                                  <input type="text" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][cost]" value="<?php echo $cost['cost']; ?>" class="form-control" />
                                  <div class="input-group-addon"><?php echo $text_rub; ?></div>
                                </div>
                              </td>
                              <td class="text-left">
                                <select name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][geo_zone_id]" class="form-control">
                                  <option value="0" selected="selected"><?php echo $text_none; ?></option>
                                  <?php foreach ($geo_zones as $geo_zone) { ?>
                                  <?php if ($geo_zone['geo_zone_id'] == $cost['geo_zone_id']) { ?>
                                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                                  <?php } else { ?>
                                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                                  <?php } ?>
                                  <?php } ?>
                                </select>
                              </td>
                              <td class="text-left">
                                <input type="text" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][city]" value="<?php echo $cost['city']; ?>" class="form-control" />
                              </td>
                              <td class="text-left">
                                <select name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][action]" class="form-control" style="min-width: 70px;">
                                  <option value="+" <?php if ('+' == $cost['action']) { ?>selected="selected"<?php } ?>>+</option>
                                  <option value="-" <?php if ('-' == $cost['action']) { ?>selected="selected"<?php } ?>>-</option>
                                  <option value="=" <?php if ('=' == $cost['action']) { ?>selected="selected"<?php } ?>>=</option>
                                </select>
                              </td>
                              <td class="text-left">
                                <input type="text" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][value]" value="<?php echo $cost['value']; ?>" class="form-control" />
                              </td>
                              <td class="text-left">
                                <select name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][source]" class="form-control">
                                  <option value="0" <?php if (0 == $cost['source']) { ?>selected="selected"<?php } ?>><?php echo $text_rub; ?></option>
                                  <option value="1" <?php if (1 == $cost['source']) { ?>selected="selected"<?php } ?>><?php echo $text_percent_order; ?></option>
                                  <option value="2" <?php if (2 == $cost['source']) { ?>selected="selected"<?php } ?>><?php echo $text_percent_shipping; ?></option>
                                </select>
                              </td>
                              <td class="text-left">
                                <div class="btn-group" data-toggle="buttons">
                                  <?php if ($cost['total']) { ?>
                                  <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][total]" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                                  <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][total]" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                                  <?php } else { ?>
                                  <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][total]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                                  <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_costs_<?php echo $code; ?>[<?php echo $row; ?>][total]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                                  <?php } ?>
                                </div>
                              </td>
                              <td class="text-right">
                                <button type="button" onclick="$('#cost-<?php echo $code; ?>-row-<?php echo $row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                              </td>
                            </tr>
                            <?php $row++; ?>
                            <?php } ?>
                            <?php ${'row_' . $code} = $row; ?>
                          </tbody>
                          <tfoot>
                          <tfoot>
                            <tr>
                              <td colspan="8">
                                <button type="button" onclick="addCost('<?php echo $code; ?>');" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-success btn-block btn-sm"><i class="fa fa-plus-circle"></i></button>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                        <small class="form-text text-muted"><?php echo $help_variant_cost_example; ?></small>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-map">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_map_key; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="<?php echo $m; ?>_map_key" value="<?php echo ${$m . '_map_key'}; ?>" class="form-control" />
                  <small class="form-text text-muted"><?php echo $help_map_key; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_map_type; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if (${$m . '_map_type'}) { ?>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_map_type" value="0" autocomplete="off"><?php echo $text_map_overall; ?></label>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_map_type" value="1" autocomplete="off" checked="checked"><?php echo $text_map_individual; ?></label>
                    <?php } else { ?>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_map_type" value="0" autocomplete="off" checked="checked"><?php echo $text_map_overall; ?></label>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_map_type" value="1" autocomplete="off"><?php echo $text_map_individual; ?></label>
                    <?php } ?>
                  </div>
                  <br><small class="form-text text-muted"><?php echo $help_map_type; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_map_filter; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if (${$m . '_map_filter'}) { ?>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_map_filter" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_map_filter" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                    <?php } else { ?>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_map_filter" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_map_filter" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                    <?php } ?>
                  </div>
                  <br><small class="form-text text-muted"><?php echo $help_map_filter; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_map_controls; ?></label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto; margin: 0;">
                    <?php foreach (${$m . '_map_controls'} as $control) { ?>
                    <div class="checkbox">
                      <label>
                        <?php if (in_array($control['code'], ${$m . '_map_control'})) { ?>
                        <input type="checkbox" name="<?php echo $m; ?>_map_control[]" value="<?php echo $control['code']; ?>" checked="checked" />
                        <?php echo $control['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="<?php echo $m; ?>_map_control[]" value="<?php echo $control['code']; ?>" />
                        <?php echo $control['name']; ?>
                        <?php } ?>
                      </label>
                    </div>
                    <?php } ?>
                  </div>
                  <small class="form-text text-muted"><?php echo $help_map_control; ?></small>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-cap">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <div class="btn-group" data-toggle="buttons">
                    <?php if (${$m . '_cap_status'}) { ?>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_cap_status" value="1" autocomplete="off" checked="checked"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_cap_status" value="0" autocomplete="off"><?php echo $text_disabled; ?></label>
                    <?php } else { ?>
                    <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_cap_status" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>
                    <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_cap_status" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="<?php echo $m; ?>_cap_title" value="<?php echo ${$m . '_cap_title'}; ?>" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_cap_cost; ?></label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" name="<?php echo $m; ?>_cap_cost" value="<?php echo ${$m . '_cap_cost'}; ?>" class="form-control" />
                    <div class="input-group-addon"><?php echo $text_rub; ?></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-support">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_license; ?></label>
                <div class="col-sm-10">
                  <input type="hidden" value="<?php echo $host; ?>" />
                  <input type="text" name="<?php echo $m; ?>_license" value="<?php echo ${$m . '_license'}; ?>" class="form-control" readonly />
                  <small class="form-text text-muted"><?php echo $text_license; ?></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_developer; ?></label>
                <div class="col-sm-10"><a href="mailto:<?php echo $email; ?>" class="btn"><?php echo $email; ?></a></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_site; ?></label>
                <div class="col-sm-10"><a href="<?php echo $site; ?>" target="_blank" class="btn"><?php echo $site; ?></a></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_module_docs; ?></label>
                <div class="col-sm-10"><a href="<?php echo $module_docs; ?>" target="_blank" class="btn"><?php echo $module_docs; ?></a></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_delivery; ?></label>
                <div class="col-sm-10"><a href="<?php echo $delivery; ?>" target="_blank" class="btn"><?php echo $delivery; ?></a></div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $text_api_docs; ?></label>
                <div class="col-sm-10"><a href="<?php echo $api_docs; ?>" target="_blank" class="btn"><?php echo $api_docs; ?></a></div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="panel-footer">
        <img src="../image/catalog/<?php echo $m; ?>/middle/grastin.png" alt="<?php echo $heading_title; ?>" class="pull-right">
        <span class="label label-default"><?php echo $m; ?></span>
        <span class="label label-default"><?php echo $version; ?></span>
      </div>
    </div>
    <?php } else { ?>
    <div class="panel panel-danger">
      <div class="panel-heading"><?php echo $heading_license; ?></div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_license; ?></label>
            <div class="col-sm-10">
              <input type="hidden" value="<?php echo $host; ?>" />
              <input type="text" name="<?php echo $m; ?>_license" value="<?php echo ${$m . '_license'}; ?>" class="form-control" />
              <small class="form-text text-muted"><?php echo $text_license; ?></small>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_developer; ?></label>
            <div class="col-sm-10"><a href="mailto:<?php echo $email; ?>" class="btn"><?php echo $email; ?></a></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_site; ?></label>
            <div class="col-sm-10"><a href="<?php echo $site; ?>" target="_blank" class="btn"><?php echo $site; ?></a></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_module_docs; ?></label>
            <div class="col-sm-10"><a href="<?php echo $module_docs; ?>" target="_blank" class="btn"><?php echo $module_docs; ?></a></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_delivery; ?></label>
            <div class="col-sm-10"><a href="<?php echo $delivery; ?>" target="_blank" class="btn"><?php echo $delivery; ?></a></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $text_api_docs; ?></label>
            <div class="col-sm-10"><a href="<?php echo $api_docs; ?>" target="_blank" class="btn"><?php echo $api_docs; ?></a></div>
          </div>
        </form>
      </div>
      <div class="panel-footer">
        <img src="../image/catalog/<?php echo $m; ?>/middle/grastin.png" alt="<?php echo $heading_title; ?>" class="pull-right">
        <span class="label label-default"><?php echo $m; ?></span>
        <span class="label label-default"><?php echo $version; ?></span>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php if (${$m . '_license'}) { ?>
<script type="text/javascript"><!--
$('#delivery a:first').tab('show');

var row = {};

<?php foreach ($variants as $code) { ?>
row['<?php echo $code; ?>'] = <?php echo ${'row_' . $code}; ?>;
<?php } ?>

function addCost(code) {
  html  = '<tr id="cost-' + code + '-row-' + row[code] + '">';
  html += '  <td class="text-left">';
  html += '    <div class="input-group">';
  html += '      <input type="text" name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][cost]" value="" class="form-control" />';
  html += '      <div class="input-group-addon"><?php echo $text_rub; ?></div>';
  html += '    </div>';
  html += '  </td>';
  html += '  <td class="text-left">';
  html += '    <select name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][geo_zone_id]" class="form-control">';
  html += '      <option value="0" selected="selected"><?php echo $text_none; ?></option>';
  <?php foreach ($geo_zones as $geo_zone) { ?>
  html += '      <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>';
  <?php } ?>
  html += '    </select>';
  html += '  </td>';
  html += '  <td class="text-left">';
  html += '    <input type="text" name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][city]" value="" class="form-control" />';
  html += '  </td>';
  html += '  <td class="text-left">';
  html += '    <select name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][action]" class="form-control" style="min-width: 70px;">';
  html += '      <option value="+">+</option>';
  html += '      <option value="-">-</option>';
  html += '      <option value="=">=</option>';
  html += '    </select>';
  html += '  </td>';
  html += '  <td class="text-left"><input type="text" name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][value]" value="" class="form-control" /></td>';
  html += '  <td class="text-left">';
  html += '    <select name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][source]" class="form-control">';
  html += '      <option value="0" selected="selected"><?php echo $text_rub; ?></option>';
  html += '      <option value="1"><?php echo $text_percent_order; ?></option>';
  html += '      <option value="2"><?php echo $text_percent_shipping; ?></option>';
  html += '    </select>';
  html += '  </td>';
  html += '  <td class="text-left">';
  html += '    <div class="btn-group" data-toggle="buttons">';
  html += '      <label class="btn btn-default"><input type="radio" name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][total]" value="1" autocomplete="off"><?php echo $text_enabled; ?></label>';
  html += '      <label class="btn btn-default active"><input type="radio" name="<?php echo $m; ?>_costs_' + code + '[' + row[code] + '][total]" value="0" autocomplete="off" checked="checked"><?php echo $text_disabled; ?></label>';
  html += '    </div>';
  html += '  </td>';
  html += '  <td class="text-right"><button type="button" onclick="$(\'#cost-' + code + '-row-' + row[code] + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#costs-' + code + ' tbody').append(html);

  row[code]++;
}
//--></script>
<?php } ?>
<?php echo $footer; ?> 
