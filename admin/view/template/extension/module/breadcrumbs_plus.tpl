<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="bootstrap-ocm">
  <div class="page-header">
    <div class="container-fluid">
      <div id="ocm-buttons" class="pull-right">
        <button form="form-setting" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <?php echo ocmGetBreadcrumbs($breadcrumbs, $stores); ?>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($messages) { foreach ($messages as $message) { ?>
    <div class="alert <?php echo $message['class']; ?>"><i class="fa <?php echo $message['icon']; ?>"></i><?php echo $message['text']; ?> <button type="button" class="close" data-dismiss="alert">×</button></div>
    <?php }} ?>
    <div class="panel panel-default">
      <div id="panel-body" class="panel-body">
        <form id="form-setting" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal superform superform-ajax">
          <div class="form-group">
            <label class="control-label col-sm-3" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-3">
              <select name="breadcrumbs_plus[status]" id="input-status" class="form-control radio radio-full">
                <option value="0"<?php if (!$status) { ?> selected="selected"<?php } ?>><?php echo $text_disabled; ?></option>
                <option value="1"<?php if ($status) { ?> selected="selected"<?php } ?>><?php echo $text_enabled; ?></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="input-nolink"><?php echo $entry_nolink; ?></label>
            <div class="col-sm-3">
              <select name="breadcrumbs_plus[nolink]" id="input-nolink" class="form-control radio radio-full">
                <option value="0"<?php if (!$nolink) { ?> selected="selected"<?php } ?>><?php echo $text_disabled; ?></option>
                <option value="1"<?php if ($nolink) { ?> selected="selected"<?php } ?>><?php echo $text_enabled; ?></option>
              </select>
            </div>
            <div class="col-sm-6">
              <span class="help"><?php echo $help_nolink; ?></span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="input-product_breadcrumb"><?php echo $entry_product_breadcrumb; ?></label>
            <div class="col-sm-9">
              <select name="breadcrumbs_plus[product_breadcrumb]" id="input-product_breadcrumb" class="form-control">
                <option value="0"><?php echo $text_default; ?></option>
                <option value="1"<?php if ($product_breadcrumb == 1) { ?> selected="selected"<?php } ?>>http://site.com/product</option>
                <option value="2"<?php if ($product_breadcrumb == 2) { ?> selected="selected"<?php } ?>>http://site.com/brand/product</option>
                <option value="3"<?php if ($product_breadcrumb == 3) { ?> selected="selected"<?php } ?>>http://site.com/brands/brand/product</option>
                <option value="4"<?php if ($product_breadcrumb == 4) { ?> selected="selected"<?php } ?>>http://site.com/parent-category/product</option>
                <option value="5"<?php if ($product_breadcrumb == 5) { ?> selected="selected"<?php } ?>>http://site.com/category-1/category-2/.../category-n/product</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="input-category_breadcrumb"><?php echo $entry_category_breadcrumb; ?></label>
            <div class="col-sm-9">
              <select name="breadcrumbs_plus[category_breadcrumb]" id="input-category_breadcrumb" class="form-control">
                <option value="0"><?php echo $text_default; ?></option>
                <option value="1"<?php if ($category_breadcrumb == 1) { ?> selected="selected"<?php } ?>>http://site.com/category</option>
                <option value="2"<?php if ($category_breadcrumb == 2) { ?> selected="selected"<?php } ?>>http://site.com/parent-category/category</option>
                <option value="3"<?php if ($category_breadcrumb == 3) { ?> selected="selected"<?php } ?>>http://site.com/category-1/category-2/.../category-n/category</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>