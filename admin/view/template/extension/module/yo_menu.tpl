<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<style type="text/css">
html {overflow-y: scroll;}
input[type="radio"], input[type="checkbox"] {
    margin: 0 5px 3px 0;
}
.form-horizontal input {
    vertical-align: middle;
}
.form-horizontal .checkbox, .form-horizontal .radio {
    padding: 0;
    min-height: 18px;
}
.form-horizontal .well {
    background-color: #f7f7f7;
    min-height: auto;
    overflow: auto;
    margin-bottom: 0;
}
.form-horizontal .well .checkbox, .form-horizontal .well .radio {
    margin-top: 4px;
}
.form-horizontal .well .fa {
    margin-right: 7px;
}
.form-horizontal .checkbox-inline {
  padding-left: 24px;
  margin-bottom: 9px;
  min-height: 18px;
}
.radio label, .checkbox label {
    padding-left: 24px;
}
.control-label {
    font-weight: normal;
}
.input-group+.input-group {
    margin-top: 15px;
}
label.btn-default.active, label.btn-default.active:hover {
    color: #fff;
    background-color: #1e91cf;
    border-color: #1978ab;
}
label.btn-default:hover {
    color: #555;
    background-color: #f7f7f7;
    border-color: #ccc;
}
label.btn-default:active, label.btn-default:active:hover {
    color: #555;
    background-color: #f7f7f7;
    border-color: #ccc;
}
</style>
<div class="page-header">
  <div class="container-fluid">
    <div class="pull-right">
      <?php if ($apply_btn) { ?>
      <a onclick="$('#apply').val('1'); $('#yomenu-form').submit();" class="btn btn-success" data-toggle="tooltip" title="<?php echo $button_apply; ?>" role="button"><i class="fa fa-check"></i> <span class="hidden-sm"> <?php echo $button_apply; ?></span></a>
      <?php } ?>
      <button type="submit" form="yomenu-form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <span class="hidden-sm"> <?php echo $button_save; ?></span></button>
      <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-pencil-square-o"></i>
      <?php echo $text_edit; ?>
      <?php if (!empty($name)) { ?>
      <?php echo '"'. $name .'"'; ?>
      <?php } ?>
      </h3>
      <?php if ($success) { ?>
      <div class="yo-apply text-success pull-right"><i class="fa fa-check"></i> <?php echo $success; ?></div>
      <?php } ?>
      <?php if ($error_name) { ?>
      <div class="text-danger pull-right"><strong><?php echo $error_name; ?></strong></div>
      <?php } ?>
    </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="yomenu-form" class="form-horizontal">
        <ul id="settingTab" class="nav nav-tabs" role="tablist">
          <li><a href="#moduleSetting" role="tab" data-toggle="tab"> <?php echo $tab_module_setting; ?></a></li>
          <li><a href="#menuSetting" role="tab" data-toggle="tab"> <?php echo $tab_menu_setting; ?></a></li>
        </ul>
        <div class="tab-content">
          <div id="moduleSetting" class="tab-pane">
            <p class="lead"><?php echo $tab_module_setting; ?></p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group required">
                  <label class="col-sm-4 control-label"><?php echo $entry_name; ?></label>
                  <div class="col-sm-8">
                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
                    <?php if ($error_name) { ?>
                    <div class="text-danger"><?php echo $error_name; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_status; ?></label>
                  <div class="col-sm-8">
                    <div class="btn-group btn-group-justified" data-toggle="buttons">
                      <label class="btn btn-default">
                        <input type="radio" name="status" value="1" <?php echo isset($status) ? 'checked="checked"' : ''; ?> />
                        <?php echo $text_enabled; ?> </label>
                      <label class="btn btn-default">
                        <input type="radio" name="status" value="0" <?php echo empty($status) ? 'checked="checked"' : ''; ?> />
                        <?php echo $text_disabled; ?> </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_store; ?></label>
                  <div class="col-sm-8">
                    <div class="well well-sm">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="yo_module[store_id][]" value="0" <?php echo isset($yo_module['store_id']) && in_array(0, $yo_module['store_id']) ? 'checked="checked" ' : ''; ?> />
                          <?php echo $default_store; ?>
                        </label>
                      </div>
                      <?php foreach ($stores as $store) { ?>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="yo_module[store_id][]" value="<?php echo $store['store_id']; ?>" <?php echo isset($yo_module['store_id']) && in_array($store['store_id'], $yo_module['store_id']) ? 'checked="checked" ' : ''; ?> />
                          <?php echo $store['name']; ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_customers; ?></label>
                  <div class="col-sm-8">
                    <div class="well well-sm" style="max-height:150px;">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="yo_module[all_customers]" value="1" <?php echo isset($yo_module['all_customers']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_all_customers; ?> </label>
                      </div>
                      <?php foreach ($customer_groups as $customer_group) { ?>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="yo_module[customer_group_id][]" value="<?php echo $customer_group['customer_group_id']; ?>" <?php echo isset($yo_module['customer_group_id']) && in_array($customer_group['customer_group_id'], $yo_module['customer_group_id']) ? 'checked="checked" ' : ''; ?> />
                          <?php echo $customer_group['name']; ?> </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_categories; ?>"><?php echo $entry_show_cat; ?></span></label>
                  <div class="col-sm-8">
                    <input type="text" name="yo_module[fcid]" value="" placeholder="<?php echo $text_select; ?>" class="form-control" />
                    <div id="cat-loc" class="well well-sm" style="max-height:150px;">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="yo_module[allcats]" value="1" <?php echo isset($yo_module['allcats']) ? 'checked="checked"' : ''; ?> />
                          <?php echo $text_allcats; ?> </label>
                      </div>
                      <?php foreach ($catlocs as $category) { ?>
                      <div id="cat-loc-<?php echo $category['category_id']; ?>" style="margin: 2px 6px;"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                        <input type="hidden" name="yo_module[fcid][]" value="<?php echo $category['category_id']; ?>" />
                      </div>
                      <?php } ?>
                    </div>
                    <select name="yo_module[cat_invert]" class="form-control" style="margin-top: -1px">
                      <?php if ($yo_module['cat_invert']) { ?>
                      <option value="1" selected="selected"><?php echo $text_show; ?></option>
                      <option value="0"><?php echo $text_hide; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_show; ?></option>
                      <option value="0" selected="selected"><?php echo $text_hide; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_box_class; ?></label>
                  <div class="col-sm-8">
                    <input type="text" name="yo_module[box_class]" value="<?php echo !empty($yo_module['box_class']) ? $yo_module['box_class'] : 'panel panel-default'; ?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_title_class; ?></label>
                  <div class="col-sm-8">
                    <input type="text" name="yo_module[title_class]" value="<?php echo !empty($yo_module['title_class']) ? $yo_module['title_class'] : 'panel-heading'; ?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_content_class; ?></label>
                  <div class="col-sm-8">
                    <input type="text" name="yo_module[content_class]" value="<?php echo isset($yo_module['content_class']) ? $yo_module['content_class'] : 'menu-body'; ?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_css; ?></label>
                  <div class="col-sm-8">
                    <select name="yo_module[style_status]" class="form-control">
                      <?php if (!empty($yo_module['style_status'])) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                    <textarea name="style" class="form-control" rows="8"><?php echo $style; ?></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="menuSetting" class="tab-pane">
            <p class="lead"><?php echo $tab_menu_setting; ?></p>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_html; ?>"><?php echo $entry_title; ?></span></label>
                    <div class="col-sm-8">
                      <?php foreach ($languages as $language) { ?>
                      <div class="input-group"> <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="yomenu[<?php echo $language['language_id']; ?>][title]" value='<?php echo isset($yomenu[$language['language_id']]['title']) ? $yomenu[$language['language_id']]['title'] : '<h3 class="panel-title">Menu title</h3>'; ?>' class="form-control" />
                        <span class="input-group-btn" data-toggle="buttons">
                          <label class="btn btn-default">
                          <input type="checkbox" name="yomenu[<?php echo $language['language_id']; ?>][title_status]" value="1" <?php echo isset($yomenu[$language['language_id']]['title_status']) ? 'checked="checked"' : ''; ?> onchange="if ($(this).prop('checked')) { $(this).parent().find('span').html('<i class=\'fa fa-check\' aria-hidden=\'true\'></i>');} else { $(this).parent().find('span').html('<i class=\'fa fa-times\' aria-hidden=\'true\'></i>');}" />
                          <span><?php echo isset($yomenu[$language['language_id']]['title_status']) ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>'; ?></span>
                          </label>
                        </span>
                      </div>
                      <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_menu_items; ?></label>
                  <div class="col-sm-8">
                    <select name="yomenu[menu_type]" class="form-control" onchange="if ($(this).val()=='brands') {$('#brands-config').show(); $('#cats-config').hide();} else {$('#cats-config').show(); $('#brands-config').hide(); if ($(this).val()=='cats') {$('#cats-config').find('>div').first().show();} else {$('#cats-config').find('>div').first().hide();} if ($(this).val()=='current') {$('#current-config').show();} else {$('#current-config').hide();}}">
                      <?php if (isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'cats') { ?>
                      <option value="cats" selected="selected"><?php echo $text_cats; ?></option>
                      <?php } else { ?>
                      <option value="cats"><?php echo $text_cats; ?></option>
                      <?php } ?>
                      <?php if (isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'current') { ?>
                      <option value="current" selected="selected"><?php echo $text_current; ?></option>
                      <?php } else { ?>
                      <option value="current"><?php echo $text_current; ?></option>
                      <?php } ?>
                      <?php if (isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'parent') { ?>
                      <option value="parent" selected="selected"><?php echo $text_main; ?></option>
                      <?php } else { ?>
                      <option value="parent"><?php echo $text_main; ?></option>
                      <?php } ?>
                      <?php if (isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'brands') { ?>
                      <option value="brands" selected="selected"><?php echo $text_brands; ?></option>
                      <?php } else { ?>
                      <option value="brands"><?php echo $text_brands; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div id="cats-config" <?php echo isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'brands' ? 'style="display:none;"' : '' ; ?>>
                  <div class="form-group" style="padding-top: 0; <?php echo empty($yomenu['menu_type']) || $yomenu['menu_type'] == 'cats' ? '' : 'display:none;' ; ?>">
                    <div class="col-sm-8 col-sm-offset-4">
                      <input type="text" name="yomenu[featured_category]" value="" placeholder="<?php echo $text_select; ?>" class="form-control" />
                      <div id="yo-fcats" class="well well-sm" style="max-height:150px;">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="yomenu[allcats]" value="1" <?php echo isset($yomenu['allcats']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_allcats; ?> </label>
                        </div>
                        <?php foreach ($categories as $category) { ?>
                        <div id="yo-fcats-<?php echo $category['category_id']; ?>" style="margin: 2px 6px;"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                          <input type="hidden" name="yomenu[featured_category][]" value="<?php echo $category['category_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  <div id="current-config" <?php echo isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'current' ? '' : 'style="display:none;"' ; ?>>
                    <div class="row">
                      <div class="col-sm-8 col-sm-offset-4">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="yomenu[hide_current]" value="1" <?php echo isset($yomenu['hide_current']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_hide_current; ?> </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo $entry_sub_limit; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="yomenu[subcat_limit]" placeholder="<?php echo $text_notlimited; ?>" value="<?php echo !empty($yomenu['subcat_limit']) ? $yomenu['subcat_limit'] : ''; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo $entry_count; ?></label>
                    <div class="col-sm-8">
                      <select name="yomenu[count]" class="form-control">
                        <?php if (!empty($yomenu['count'])) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo $entry_levels; ?></label>
                    <div class="col-sm-8">
                      <label class="checkbox-inline">
                        <input type="checkbox" name="yomenu[level_1]" value="1" checked="checked" disabled />
                        <?php echo $text_level_1; ?> </label>
                      <label class="checkbox-inline">
                        <?php if (!empty($yomenu['level_2'])) { ?>
                        <input type="checkbox" name="yomenu[level_2]" value="1" checked="checked" />
                        <?php echo $text_level_2; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="yomenu[level_2]" value="1" />
                        <?php echo $text_level_2; ?>
                        <?php } ?>
                      </label>
                      <label class="checkbox-inline">
                        <?php if (!empty($yomenu['level_3'])) { ?>
                        <input type="checkbox" name="yomenu[level_3]" value="1" checked="checked" />
                        <?php echo $text_level_3; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="yomenu[level_3]" value="1" />
                        <?php echo $text_level_3; ?>
                        <?php } ?>
                      </label>
                      <label class="checkbox-inline">
                        <?php if (!empty($yomenu['level_4'])) { ?>
                        <input type="checkbox" name="yomenu[level_4]" value="1" checked="checked" />
                        <?php echo $text_level_4; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="yomenu[level_4]" value="1" />
                        <?php echo $text_level_4; ?>
                        <?php } ?>
                      </label>
                      <label class="checkbox-inline">
                        <?php if (!empty($yomenu['level_5'])) { ?>
                        <input type="checkbox" name="yomenu[level_5]" value="1" checked="checked" />
                        <?php echo $text_level_5; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="yomenu[level_5]" value="1" />
                        <?php echo $text_level_5; ?>
                        <?php } ?>
                      </label>
                    </div>
                  </div>
                </div>
                <div id="brands-config" <?php echo isset($yomenu['menu_type']) && $yomenu['menu_type'] == 'brands' ? '' : 'style="display:none;"' ; ?>>
                  <div class="form-group" style="padding-top: 0;">
                    <div class="col-sm-8 col-sm-offset-4">
                      <input type="text" name="yomenu[featured_brands]" value="" placeholder="<?php echo $text_select; ?>" class="form-control" />
                      <div id="yo-fbrands" class="well well-sm" style="max-height:150px;">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="yomenu[allbrands]" value="1" <?php echo isset($yomenu['allbrands']) ? 'checked="checked"' : ''; ?> />
                            <?php echo $text_all_brands; ?> </label>
                        </div>
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                        <div id="yo-fbrands-<?php echo $manufacturer['manufacturer_id']; ?>" style="margin: 2px 6px;"><i class="fa fa-minus-circle"></i> <?php echo $manufacturer['name']; ?>
                          <input type="hidden" name="yomenu[featured_brands][]" value="<?php echo $manufacturer['manufacturer_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group" style="border-top: 1px solid #ededed;">
                  <label class="col-sm-4 control-label"><?php echo $entry_products_byitem; ?></label>
                  <div class="col-sm-8">
                    <select name="yomenu[products_by_item]" class="form-control" onchange="if($(this).val()=='1') {$('#products-config').show();} else {$('#products-config').hide();}">
                      <?php if (!empty($yomenu['products_by_item'])) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div id="products-config" <?php echo !empty($yomenu['products_by_item']) ? '' : 'style="display:none;"' ; ?>>
                  <div class="row">
                    <label class="col-sm-4 control-label"><?php echo $entry_sort_order; ?></label>
                    <div class="col-sm-8">
                      <select name="yomenu[products_sort]" class="form-control">
                        <?php foreach ($sorts as $sort) { ?>
                        <?php if (isset($yomenu['products_sort']) && $sort['value'] == $yomenu['products_sort']) { ?>
                        <option value="<?php echo $sort['value']; ?>" selected="selected"><?php echo $sort['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $sort['value']; ?>"><?php echo $sort['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo $entry_products_limit; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="yomenu[products_limit]" placeholder="<?php echo $text_notlimited; ?>" value="<?php echo isset($yomenu['products_limit']) ? $yomenu['products_limit'] : ''; ?>" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_menu_design; ?></label>
                  <div class="col-sm-8">
                    <select name="yomenu[menu_design]" class="form-control" onchange="if ($(this).val()=='am') {$('#accordion-config').show(); $('#flyout-config').hide();} else if ($(this).val()=='fm') {$('#flyout-config').show(); $('#accordion-config').hide();} else {$('#accordion-config,#flyout-config').hide();}">
                      <?php if (isset($yomenu['menu_design']) && $yomenu['menu_design'] == 'am') { ?>
                      <option value="am" selected="selected"><?php echo $text_am; ?></option>
                      <?php } else { ?>
                      <option value="am"><?php echo $text_am; ?></option>
                      <?php } ?>
                      <?php if (isset($yomenu['menu_design']) && $yomenu['menu_design'] == 'fm') { ?>
                      <option value="fm" selected="selected"><?php echo $text_fm; ?></option>
                      <?php } else { ?>
                      <option value="fm"><?php echo $text_fm; ?></option>
                      <?php } ?>
                      <?php if (isset($yomenu['menu_design']) && $yomenu['menu_design'] == 'pm') { ?>
                      <option value="pm" selected="selected"><?php echo $text_pm; ?></option>
                      <?php } else { ?>
                      <option value="pm"><?php echo $text_pm; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_minimized; ?></label>
                  <div class="col-sm-4">
                    <select name="yomenu[minimized]" class="form-control">
                      <?php if (!empty($yomenu['minimized'])) { ?>
                      <option value="1" selected="selected"><?php echo $text_minimized; ?></option>
                      <option value="0"><?php echo $text_expanded; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_minimized; ?></option>
                      <option value="0" selected="selected"><?php echo $text_expanded; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <div class="checkbox">
                      <label style="margin-top:8px;">
                        <input type="checkbox" name="yomenu[save_view]" value="1" <?php echo isset($yomenu['save_view']) ? 'checked="checked"' : ''; ?> />
                        <?php echo $text_keep; ?> </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_image; ?></label>
                  <div class="col-sm-4">
                    <select name="yomenu[item_image]" class="form-control">
                      <?php if ($yomenu['item_image']) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="yomenu[image_width]" value="<?php echo !empty($yomenu['image_width']) ? $yomenu['image_width'] : '200'; ?>" class="form-control text-center" />
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="yomenu[image_height]" value="<?php echo !empty($yomenu['image_height']) ? $yomenu['image_height'] : '124'; ?>" class="form-control text-center" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><?php echo $entry_icon; ?></label>
                  <div class="col-sm-4">
                    <select name="yomenu[item_icon]" class="form-control">
                      <?php if ($yomenu['item_icon']) { ?>
                      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                      <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                      <option value="1"><?php echo $text_enabled; ?></option>
                      <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="yomenu[icon_width]" value="<?php echo !empty($yomenu['icon_width']) ? $yomenu['icon_width'] : ''; ?>" class="form-control text-center" />
                  </div>
                  <div class="col-sm-2">
                    <input type="text" name="yomenu[icon_height]" value="<?php echo !empty($yomenu['icon_height']) ? $yomenu['icon_height'] : ''; ?>" class="form-control text-center" />
                  </div>
                </div>
                <div id="accordion-config" <?php echo empty($yomenu['menu_design']) || $yomenu['menu_design'] == 'am' ? '' : 'style="display:none;"'; ?>>
                  <div class="form-group" style="border-top: 1px solid #ededed;">
                    <label class="col-sm-4 control-label"><?php echo $entry_toggle; ?></label>
                    <div class="col-sm-8">
                      <select name="yomenu[toggle]" class="form-control">
                        <?php if (!empty($yomenu['toggle'])) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo $entry_effect; ?></label>
                    <div class="col-sm-4">
                      <select name="yomenu[easing]" class="form-control">
                        <?php foreach ($easings as $value) { ?>
                        <?php $value = trim($value); ?>
                        <?php if (isset($yomenu['easing']) && $value == $yomenu['easing']) { ?>
                        <option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <input type="text" name="yomenu[easing_d]" value="<?php echo !empty($yomenu['easing_d']) ? $yomenu['easing_d'] : '200'; ?>" class="form-control text-center" />
                    </div>
                  </div>
                </div>
                <div id="flyout-config" <?php echo isset($yomenu['menu_design']) && $yomenu['menu_design'] == 'fm' ? '' : 'style="display:none;"'; ?>>
                  <div class="form-group" style="border-top: 1px solid #ededed;">
                    <label class="col-sm-4 control-label"><?php echo $entry_column; ?></label>
                    <div class="col-sm-8">
                      <input type="text" name="yomenu[column]" value="<?php echo !empty($yomenu['column']) ? $yomenu['column'] : '1'; ?>" class="form-control" onkeyup="if ($(this).val()>1) {$('.column').show();} else {$('.column').hide();}"/>
                    </div>
                  </div>
                  <div class="form-group column" <?php echo isset($yomenu['column']) && $yomenu['column'] !== '1' ? '' : 'style="display:none;"'; ?>>
                    <label class="col-sm-4 control-label"><?php echo $entry_image_position; ?></label>
                    <div class="col-sm-8">
                      <select name="yomenu[image_position]" class="form-control">
                        <?php if (isset($yomenu['image_position']) && $yomenu['image_position'] == 'center') { ?>
                        <option value="center" selected="selected"><?php echo $text_center; ?></option>
                        <?php } else { ?>
                        <option value="center"><?php echo $text_center; ?></option>
                        <?php } ?>
                        <?php if (isset($yomenu['image_position']) && $yomenu['image_position'] == 'left') { ?>
                        <option value="left" selected="selected"><?php echo $text_left; ?></option>
                        <?php } else { ?>
                        <option value="left"><?php echo $text_left; ?></option>
                        <?php } ?>
                        <?php if (isset($yomenu['image_position']) && $yomenu['image_position'] == 'right') { ?>
                        <option value="right" selected="selected"><?php echo $text_right; ?></option>
                        <?php } else { ?>
                        <option value="right"><?php echo $text_right; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group column"  <?php echo isset($yomenu['column']) && $yomenu['column'] !== '1' ? '' : 'style="display:none;"'; ?>>
                    <label class="col-sm-4 control-label"><?php echo $entry_content; ?></label>
                    <div class="col-sm-8">
                      <select name="yomenu[content_status]" class="form-control">
                        <?php if (!empty($yomenu['content_status'])) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                        <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="apply" id="apply" value="0" />
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('.yo-apply').delay(5000).fadeOut(300);
$('input[name=\'yomenu[featured_category]\']').autocomplete({
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id']
          }
        }));
      }
    });
  },
  select: function(item) {
    $('input[name=\'yomenu[featured_category]\']').val('');

    $('#yo-fcats-' + item['value']).remove();

    $('#yo-fcats').append('<div id="yo-fcats-' + item['value'] + '" style="margin: 2px 6px;"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="yomenu[featured_category][]" value="' + item['value'] + '" /></div>');
  }
});

$('#yo-fcats').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

$('input[name=\'yomenu[featured_brands]\']').autocomplete({
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['manufacturer_id']
          }
        }));
      }
    });
  },
  select: function(item) {
    $('input[name=\'yomenu[featured_brands]\']').val('');

    $('#yo-fbrands-' + item['value']).remove();

    $('#yo-fbrands').append('<div id="yo-fbrands-' + item['value'] + '" style="margin: 2px 6px;"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="yomenu[featured_brands][]" value="' + item['value'] + '" /></div>');
  }
});

$('#yo-fbrands').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

$('input[name=\'yo_module[fcid]\']').autocomplete({
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id']
          }
        }));
      }
    });
  },
  select: function(item) {
    $('input[name=\'yo_module[fcid]\']').val('');
    $('#cat-loc-' + item['value']).remove();
    $('#cat-loc').append('<div id="cat-loc-' + item['value'] + '" style="margin: 2px 6px;"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="yo_module[fcid][]" value="' + item['value'] + '" /></div>');
  }
});

$('#cat-loc').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

$('label.btn input').each(function() {
  if ($(this).prop('checked')) {
    $(this).parent('.btn').addClass('active');
  };
});
//--></script>
<script type="text/javascript"><!--
  <?php if ($module_id) { ?>
  $('#settingTab a').on('click', function(){
    sessionStorage.setItem('activetab<?php echo $module_id; ?>', $(this).attr('href'));
  });
  <?php } ?>
  if (!sessionStorage.getItem('activetab<?php echo $module_id; ?>')) {
    $('#settingTab a:first').tab('show');
  } else {
    $('#settingTab a[href=\'' + sessionStorage.getItem('activetab<?php echo $module_id; ?>') + '\']').tab('show');
  }
 </script> -->
<?php echo $footer; ?>