  

			<!-- pickpoint start -->
			<script type="text/javascript" src="<?php echo $pickpoint_widget_url;?>"></script>

                  <script type="text/javascript">
				$(document).ready(function(){
					var el = '<a style="text-decoration:underline;" href="#" onclick="PickPoint.open(my_function); return false;"> <?php echo $pickpoint_select_postamat;?> </a>';
					$("span[name='pickpoint_shipping_div']").html($("span[name='pickpoint_shipping_div']").html() + el);
				});
				function my_function(result){	

						//for(var p in result) {
						//alert(p + "=" + result[p]);				
						//}      	     

			                   $.ajax({
							url: '<?php echo $pickpoint_url;?>',
							type: 'post',
							data: {pickpoint_terminal_id:result['id']},
							dataType: 'json',
							beforeSend: function() {
							                $("span[name='pickpoint_shipping_div']").after('<span name="pickpoint_shipping_wait">&nbsp;<img src="/image/shipping/loading.gif" alt="" /></span>');
							            },
							complete: function() {
							                $("span[name='pickpoint_shipping_wait']").remove();
							            },
							success: function(data) {
                              		   
								if (data.error == 'no_error')
								{
									var el =  "<label><input type='radio' checked='checked' value='pickpoint.pickpoint' name='shipping_method'>" + data.pre_mes + " <span name='pickpoint_shipping_div'>" + data.mes + "<a style='text-decoration:underline;' href='#' onclick='PickPoint.open(my_function); return false;'> <?php echo $pickpoint_change_postamat;?> </a></span>" + data.post_mes + "</label>";
									$("span[name='pickpoint_shipping_div']").parent().parent().html(el);
	
									
	                                          	if (typeof simplecheckout_reload !== "undefined") {
	                                            		reloadAll(); //simplecheckout_reload("shipping");
	                                          	} else if (typeof reloadAll !== "undefined") {
	                                            		reloadAll();
	                                          	}
	
									$("input[value*=pickpoint]").attr("checked", "checked");

								}
								else
									alert(data.error);

								
							}
 						});
					
                              }
                  </script>
			<!-- pickpoint end -->

			
<?php if ($error_warning) { ?>
<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
<p><?php echo $text_shipping_method; ?></p>
<?php foreach ($shipping_methods as $shipping_method) { ?>
<p><strong><?php echo $shipping_method['title']; ?></strong></p>
<?php if (!$shipping_method['error']) { ?>
<?php foreach ($shipping_method['quote'] as $quote) { ?>
<div class="radio">
  <label>
    <?php if ($quote['code'] == $code || !$code) { ?>
    <?php $code = $quote['code']; ?>
    <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" />
    <?php } else { ?>
    <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" />
    <?php } ?>
    <?php echo $quote['title']; ?> - <?php echo $quote['text']; ?>
            <?php if (isset($quote['bb_html'])) { ?>
                        <br><?php echo $quote['bb_html']; ?>
            <?php } ?>
            </label>
</div>
<?php } ?>
<?php } else { ?>
<div class="alert alert-danger"><?php echo $shipping_method['error']; ?></div>
<?php } ?>
<?php } ?>
<?php } ?>
<p><strong><?php echo $text_comments; ?></strong></p>
<p>
  <textarea name="comment" rows="8" class="form-control"><?php echo $comment; ?></textarea>
</p>
<div class="buttons">
  <div class="pull-right">
    <input type="button" value="<?php echo $button_continue; ?>" id="button-shipping-method" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary" />
  </div>
</div>
