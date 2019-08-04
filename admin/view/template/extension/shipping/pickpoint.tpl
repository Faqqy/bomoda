<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="pickpoint">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">

        <button type="submit" form="form-pickpoint" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">

      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-pickpoint" class="form-horizontal">

<table width="100%">
<tr>
<td valign="top" width="220px;">
<img style="border: 1px solid #EEEEEE;" title="pickpoint" alt="pickpoint" src="view/image/shipping/pickpoint.gif">
</td>
<td>

          <div class="form-group">
            <label class="col-sm-2 control-label" ></label>
            <div class="col-sm-10">
			<b><font color="blue"><?php echo $entry_main_settings; ?></font></b>
            </div>
          </div>


          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_rub_select"><?php echo $entry_pickpoint_rub_select; ?></label>
            <div class="col-sm-10">
              <select name="pickpoint_rub_select" id="pickpoint_rub_select" class="form-control">
              <?php foreach ($currencies as $currency) { ?>
              <?php if ($currency['code'] == $pickpoint_rub_select) { ?>
              <option value="<?php echo $currency['code']; ?>" selected="selected"><?php echo $currency['code']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $currency['code']; ?>"><?php echo $currency['code']; ?></option>
              <?php } ?>
              <?php } ?>
              </select>
            </div>
          </div>


          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_kg_select"><?php echo $entry_pickpoint_kg_select; ?></label>
            <div class="col-sm-10">
              <select name="pickpoint_kg_select" id="pickpoint_kg_select" class="form-control">
                <?php foreach ($weight_classes as $weight_class) { ?>
                <?php if ($weight_class['weight_class_id'] == $pickpoint_kg_select) { ?>
                <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>


          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_url"><span data-toggle="tooltip" title="<?php echo $help_url; ?>"><?php echo $entry_url; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_url" value="<?php echo $pickpoint_url; ?>" placeholder="<?php echo $help_url; ?>" id="pickpoint_url" class="form-control" />
			<?php if ($error_pickpoint_url) { ?>
              		<div class="text-danger"><?php echo $error_pickpoint_url; ?></div>
              	<?php } ?>
            </div>
          </div>


          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_login"><span data-toggle="tooltip" title="<?php echo $help_login; ?>"><?php echo $entry_login; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_login" value="<?php echo $pickpoint_login; ?>" placeholder="<?php echo $help_login; ?>" id="pickpoint_login" class="form-control" />
			<?php if ($error_pickpoint_login) { ?>
              		<div class="text-danger"><?php echo $error_pickpoint_login; ?></div>
              	<?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_pwd"><span data-toggle="tooltip" title="<?php echo $help_pwd; ?>"><?php echo $entry_pwd; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_pwd" value="<?php echo $pickpoint_pwd; ?>" placeholder="<?php echo $help_pwd; ?>" id="pickpoint_pwd" class="form-control" />
			<?php if ($error_pickpoint_pwd) { ?>
              		<div class="text-danger"><?php echo $error_pickpoint_pwd; ?></div>
              	<?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_ikn"><span data-toggle="tooltip" title="<?php echo $help_ikn; ?>"><?php echo $entry_ikn; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_ikn" value="<?php echo $pickpoint_ikn; ?>" placeholder="<?php echo $help_ikn; ?>" id="pickpoint_ikn" class="form-control" />
			<?php if ($error_pickpoint_ikn) { ?>
              		<div class="text-danger"><?php echo $error_pickpoint_ikn; ?></div>
              	<?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_custom_add_sum"><?php echo $entry_custom_add_sum; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_custom_add_sum" value="<?php echo $pickpoint_custom_add_sum; ?>" placeholder="" id="pickpoint_custom_add_sum" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_min_shipping_sum"><?php echo $entry_min_shipping_sum; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_min_shipping_sum" value="<?php echo $pickpoint_min_shipping_sum; ?>" placeholder="" id="pickpoint_min_shipping_sum" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_custom_region_price"><span data-toggle="tooltip" title="<?php echo $help_custom_region_price; ?>"><?php echo $entry_custom_region_price; ?></span></label>
            <div class="col-sm-10">
              <textarea name="pickpoint_custom_region_price" rows="10" cols="45" id="pickpoint_custom_region_price" class="form-control"><?php echo $pickpoint_custom_region_price; ?></textarea>
            </div>
          </div>

<!--
          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_custom_city_price"><span data-toggle="tooltip" title="<?php echo $help_custom_city_price; ?>"><?php echo $entry_custom_city_price; ?></span></label>
            <div class="col-sm-10">
              <textarea name="pickpoint_custom_city_price" rows="10" cols="45" id="pickpoint_custom_city_price" class="form-control"> <?php echo $pickpoint_custom_city_price; ?> </textarea>
            </div>
          </div>
-->

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_cost_round"><?php echo $entry_cost_round; ?></label>
            <div class="col-sm-10">
			<div class="checkbox">
				<label>
		                  <?php if ($pickpoint_cost_round) { ?>
		                  <input type="checkbox" name="pickpoint_cost_round" id="pickpoint_cost_round" value="1" checked="checked" />
		                  <?php } else { ?>
		                  <input type="checkbox" name="pickpoint_cost_round" id="pickpoint_cost_round" value="1" />
		                  <?php } ?>
      		      </label>
			</div>
		</div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_min_sum"><?php echo $entry_min_sum; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_min_sum" value="<?php echo $pickpoint_min_sum; ?>" placeholder="" id="pickpoint_min_sum" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_zero_from"><?php echo $entry_zero_from; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_zero_from" value="<?php echo $pickpoint_zero_from; ?>" placeholder="" id="pickpoint_zero_from" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_sort_order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_sort_order" value="<?php echo $pickpoint_sort_order; ?>" placeholder="" id="pickpoint_sort_order" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_mode"><?php echo $entry_mode; ?></label>
            <div class="col-sm-10">

		<select name="pickpoint_mode" class="form-control">
              <?php foreach ($pickpoint_modes as $mode) { ?>
              <?php if ($mode['code'] == $pickpoint_mode) { ?>
              <option value="<?php echo $mode['code']; ?>" selected="selected"><?php echo $mode['code_text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $mode['code']; ?>"><?php echo $mode['code_text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select>

            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="pickpoint_status" id="pickpoint_status" class="form-control">
                  <?php if ($pickpoint_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>

<!--
          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_markup"><?php echo $entry_markup; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_markup" value="<?php echo $pickpoint_markup; ?>" placeholder="" id="pickpoint_markup" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_min_summ"><?php echo $entry_min_sum; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_min_sum" value="<?php echo $pickpoint_min_sum; ?>" placeholder="" id="pickpoint_min_sum" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_zero_sum"><?php echo $entry_zero_sum; ?></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_zero_sum" value="<?php echo $pickpoint_zero_sum; ?>" placeholder="" id="pickpoint_zero_sum" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_tax_class_id"><?php echo $entry_tax_class; ?></label>
            <div class="col-sm-10">
              <select name="pickpoint_tax_class_id" id="pickpoint_tax_class_id" class="form-control">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $pickpoint_tax_class_id) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
            </div>
          </div>


-->


          <div class="form-group">
            <label class="col-sm-2 control-label" ></label>
            <div class="col-sm-10">
			<b><font color="blue"><?php echo $entry_export_settings; ?></font></b>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_from_region"><span data-toggle="tooltip" title="<?php echo $help_from_region; ?>"><?php echo $entry_from_region; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_from_region" value="<?php echo $pickpoint_from_region; ?>" placeholder="<?php echo $help_from_region; ?>" id="pickpoint_from_region" class="form-control" />
			<?php if ($error_pickpoint_from_region) { ?>
              		<div class="text-danger"><?php echo $error_pickpoint_from_region; ?></div>
              	<?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="pickpoint_from_city"><span data-toggle="tooltip" title="<?php echo $help_from_city; ?>"><?php echo $entry_from_city; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="pickpoint_from_city" value="<?php echo $pickpoint_from_city; ?>" placeholder="<?php echo $help_from_city; ?>" id="pickpoint_from_city" class="form-control" />
			<?php if ($error_pickpoint_from_city) { ?>
              		<div class="text-danger"><?php echo $error_pickpoint_from_city; ?></div>
              	<?php } ?>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_export_status"><?php echo $entry_export_status; ?></label>
            <div class="col-sm-10">
              <select name="pickpoint_export_status" id="pickpoint_export_status" class="form-control">
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $pickpoint_export_status) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_dont_export_statuses"><?php echo $entry_dont_export_statuses; ?></label>
            <div class="col-sm-10">

					<div class="checkbox">
					<?php foreach($order_statuses as $order_status) { ?>
						<div class="form-control">
						<?php   if (in_array($order_status['order_status_id'],  $pickpoint_dont_export_statuses)) { ?>
									<label><input type="checkbox" class="form-control" style="float:left" name="pickpoint_dont_export_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" /><?php echo $order_status['name']; ?></label>
						<?php   } else { ?>
									<label><input type="checkbox" class="form-control" style="float:left" name="pickpoint_dont_export_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" /><?php echo $order_status['name']; ?></label>
						<?php   } ?>
						</div>	
					<?php } ?>
					</div>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_getting_type"><?php echo $entry_getting_type; ?></label>
            <div class="col-sm-10">
              <select name="pickpoint_getting_type" id="pickpoint_getting_type" class="form-control">
                  <?php foreach ($pickpoint_getting_types as $getting_type) { ?>
                  <?php if ($getting_type['code'] == $pickpoint_getting_type) { ?>
                  <option value="<?php echo $getting_type['code']; ?>" selected="selected"><?php echo $getting_type['code_text']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $getting_type['code']; ?>"><?php echo $getting_type['code_text']; ?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_statuses"><?php echo $entry_orders_status; ?></label>
            <div class="col-sm-10">

					<div class="checkbox">
					<?php foreach($order_statuses as $order_status) { ?>
						<div class="form-control">
						<?php   if (in_array($order_status['order_status_id'],  $pickpoint_statuses)) { ?>
									<label><input type="checkbox" class="form-control" style="float:left" name="pickpoint_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" /><?php echo $order_status['name']; ?></label>
						<?php   } else { ?>
									<label><input type="checkbox" class="form-control" style="float:left" name="pickpoint_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" /><?php echo $order_status['name']; ?></label>
						<?php   } ?>
						</div>	
					<?php } ?>
					</div>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_return_address"><?php echo $entry_return_address; ?></label>
            <div class="col-sm-10">
			<table width="100%">
              	<tr>
				<td width="10%">
				<?php echo $entry_return_address_city_name; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_city_name" value="<?php echo $pickpoint_return_address_city_name; ?>" placeholder="" id="pickpoint_return_address_city_name" class="form-control" />
				</td>
			</tr>
              	<tr>
				<td>
				<?php echo $entry_return_address_region_name; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_region_name" value="<?php echo $pickpoint_return_address_region_name; ?>" placeholder="" id="pickpoint_return_address_region_name" class="form-control" />
				</td>
			</tr>
              	<tr>
				<td>
				<?php echo $entry_return_address_address; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_address" value="<?php echo $pickpoint_return_address_address; ?>" placeholder="" id="pickpoint_return_address_address" class="form-control" />
				</td>
			</tr>
              	<tr>
				<td>
				<?php echo $entry_return_address_fio; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_fio" value="<?php echo $pickpoint_return_address_fio; ?>" placeholder="" id="pickpoint_return_address_fio" class="form-control" />
				</td>
			</tr>
              	<tr>
				<td>
				<?php echo $entry_return_address_post_code; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_post_code" value="<?php echo $pickpoint_return_address_post_code; ?>" placeholder="" id="pickpoint_return_address_post_code" class="form-control" />
				</td>
			</tr>
              	<tr>
				<td>
				<?php echo $entry_return_address_organisation; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_organisation" value="<?php echo $pickpoint_return_address_organisation; ?>" placeholder="" id="pickpoint_return_address_organisation" class="form-control" />
				</td>
			</tr>
              	<tr>
				<td>
				<?php echo $entry_return_address_phone_number; ?>
				</td>
				<td>
				<input type="text" name="pickpoint_return_address_phone_number" value="<?php echo $pickpoint_return_address_phone_number; ?>" placeholder="" id="pickpoint_return_address_phone_number" class="form-control" />
				</td>
			</tr>


			</table>

            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="pickpoint_export"><?php echo $entry_export; ?></label>
            <div class="col-sm-10">
              <textarea rows="10" cols="45" name="pickpoint_export" placeholder="" id="pickpoint_export" class="form-control" ></textarea>
			<br>
        	  <button type="button" id="button_export" data-toggle="tooltip" title="<?php echo $button_export; ?>" class="btn btn-primary"><?php echo $button_export; ?></button>
            </div>
          </div>

						

</td>
</tr>
</table>


      </form>


      </div>
    </div>
  </div>

		<div style="text-align:center; color:#555555;"><?php echo $heading_title;?> v<?php echo $pickpoint_version; ?></div>

</div>


<script type="text/javascript"><!--
$('#button_export').on('click', function() {
//alert('123');
			
			$.ajax({
				url: '<?php echo HTTP_CATALOG."index.php?route=extension/shipping/pickpoint/export"; ?>',
				type: 'post',		
				dataType: 'json',
				//data: new FormData($('#form-upload')[0]),
				//cache: false,
				//contentType: false,
				//processData: false,		
				//beforeSend: function() {
				//	$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				//	$('#button-upload').prop('disabled', true);
				//},
				//complete: function() {
				//	$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
				//	$('#button-upload').prop('disabled', false);
				//},

				success: function(json) {
					if (json['text']) {
						$text = $("#pickpoint_export").text();
						$("#pickpoint_export").text($text + json['text']);
					}
					
					//if (json['success']) {
					//	alert(json['success']);
						
					//	$('#button-refresh').trigger('click');
					//}
					

				},			
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});	
});

//--></script>

<?php echo $footer; ?> 