<?php echo $header; ?>
<? include 'includes/mainmenu.php';?>
<div class="clear"></div>
<div class="mob_bread">
    <a onclick="javascript:history.back(); return false;"><?=$breadcrumbs[1]['text']?></a>
</div>
<div class="main_content m_row" id="content">
  <div class="bread">
    <ul class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php } ?>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="product">
      <?if(in_array($product_id,$wish)) { ?>
          <a onclick="wishlist.remove('<?php echo $product_id; ?>');" class="catalog_btn_fav show_mobile active"></a>
      <?} else { ?>
          <a onclick="wishlist.add('<?php echo $product_id; ?>');" class="catalog_btn_fav show_mobile"></a>
      <? } ?>

      <div class="mobile_product_img show_mobile">
          <div class="mob_img_prev"></div>
          <div class="mob_img_next"></div>

          <div class="mobile_product_img_in" id="outside">

              <?php foreach ($images as $image) { ?>
              <img class="" data-large="/image/<?php echo $image['full']; ?>" src="/image/<?php echo $image['full']; ?>"  alt="">
              <? } ?>
              <div class="clear"></div>
          </div>
      </div>
    <div class="left_product hidden_mobile">

      <div class="left_product_images">

        <div class="connected-carousels">
          <div class="stage">
            <div class="my-container"></div>
            <div class="carousel carousel-stage">
              <ul>
                <?php foreach ($images as $image) { ?>

                    <li>
                        <figure class="foto_cart" data-zoom>
                         <img class="my-foto" data-large="/image/<?php echo $image['full']; ?>" src="/image/<?php echo $image['full']; ?>"  alt="" style="cursor: zoom-in;">
                         </figure>
                    </li>

                <? } ?>
              </ul>

              <div class="controls_wrapper">

                <a href="#" class="prev prev-stage_custom"></a>
                <a href="#" class="next next-stage_custom"></a>

              </div>
            </div>


          </div>

          <div class="navigation">
            <div class="carousel carousel-navigation">
              <ul>
                <?php foreach ($images as $image) { ?>
                <li><img src="/image/<?php echo $image['full']; ?>"  alt=""></li>
                <? } ?>

              </ul>
            </div>
          </div>
        </div>




      </div>
      <?php if ($products) { ?>
        <div class="left_product_rec">
          <div class="left_product_rec_title">
            С этим товаром покупают
          </div>
          <div class="home_slider">
            <div class="jcarousel-wrapper">
              <div class="jcarousel" data-col="4">
                <ul>
                  <?php foreach ($products as $product) { ?>
                  <li>
                    <div class="home_slider_block">
                      <div class="home_slider_block_img">
                        <a href="<?php echo $product['href']; ?>"><img src="/image/<?php echo $product['full_image']; ?>" /></a>
                      </div>
                      <div class="home_slider_block_title">
                        <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                      </div>

                      <div class="home_slider_block_price">

                        <?php if (!$product['special']) { ?>
                        <span><?=$product['price']?></span>
                        <?php } else { ?>
                        <span class="old_price"><?=$product['price']?></span> <span class="new_price"><?=$product['special']?></span>
                        <? } ?>

                      </div>
                    </div>
                  </li>
                  <? } ?>


                </ul>
              </div>
              <a href="#" class="jcarousel-control-prev"></a>
              <a href="#" class="jcarousel-control-next"></a>
            </div>
          </div>
        </div>
      <? } ?>
      <?php echo $content_bottom; ?>

    </div>
    <div class="right_product" id="product">
      <div class="right_product_title">
        <?=$heading_title?>
      </div>


      <div class="catalog_title">

        <?php if ($cat_list) { ?>
        <?php foreach ($cat_list as $cat_name) { ?>
          <a href="<?php echo $category_url; ?>"> / <?php echo $cat_name['name']; ?></a>
        <?php } ?>
        <?php } ?>

      </div>
      <div class="right_product_price">

        <div class="home_slider_block_price">

          <?php if (!$special) { ?>
          <span><?=$price?></span>
          <?php } else { ?>
          <span class="old_price"><?=$price?></span> <br/><span class="new_price"><?=$special?></span>
          <? } ?>

        </div>
          <a href="#table_size_form" class="show_form btn_table_size show_mobile">Таблица размеров</a>
          <div class="clear show_mobile"></div>
      </div>
      <div class="right_product_size">
        <?php foreach ($options as $option) { // print_r($option); ?>
          <?php if($option['option_id']==13) { ?>
        <select name="option[<?php echo $option['product_option_id']; ?>]" id="input-option<?php echo $option['product_option_id']; ?>" class="form-control">
          <option style="display: none" value="">Выберите размер</option>
          <?php foreach ($option['product_option_value'] as $option_value) { ?>
          <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </option>
          <?php } ?>
        </select>
          <?}?>
        <?}?>
      </div>
      <div class="right_product_size_link">
        <a href="#table_size_form" class="show_form btn_table_size hidden_mobile">Таблица размеров</a>
      </div>
      <?if($stock=='Есть в наличии') { ?>
        <div class="right_product_stock hidden_mobile">
          Товар находится на складе boModa и может
          быть доставлен вам в кратчайшие сроки.
        </div>
      <?} else { ?>
        <div class="right_product_stock  hidden_mobile">
          Товар отсутствует на складе boModa.
        </div>

      <?}?>
      <div class="right_product_del_link  hidden_mobile">
        <a href="/delivery">Подробнее о доставке в ваш город</a>
      </div>
      <input type="hidden" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
      <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
      <button type="button" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" class="btn_add_cart">Добавить в корзину</button>


      <div class="right_product_wish_link  hidden_mobile">
        <a onclick="wishlist.add('<?php echo $product_id; ?>');" class="btn_wish"></a>
      </div>

      <div class="right_product_attr">
        <div class="right_product_attr_title hidden_mobile">
          О ТОВАРЕ
        </div>
          <div class="right_product_title show_mobile">
              <?=$heading_title?>
          </div>
        <div class="sttribute">
          <?php foreach ($attribute_groups as $attribute_group) { //print_r($attribute_group);?>
          <?php if($attribute_group['attribute_group_id']==7) { ?>
          <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
          <b><?php echo $attribute['name']; ?></b>: <?php echo $attribute['text']; ?><br/>
          <? } ?>
          <? } ?>
          <?php } ?>

        </div>

      </div>
      <div class="line hidden_mobile"></div>
      <div class="right_product_social_title hidden_mobile">
        ПОДЕЛИТЬСЯ
      </div>
      <div class="footer_social hidden_mobile">
				<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
				<script src="https://yastatic.net/share2/share.js"></script>
				<div class="ya-share2" data-services="whatsapp,telegram,viber"></div>
      </div>
      <div class="line hidden_mobile"></div>
      <div class="right_product_priems hidden_mobile">
        <div class="right_product_priems_title">
          Преимущества boModa
        </div>
        <div class="right_product_priem right_product_priem1">
          <div class="right_product_priem_title">
            Только подлинные товары
            известных брендов
          </div>
          <div class="right_product_priem_text">
            Мы гарантируем качество и подлинность
            каждой вещи, которую вы у нас купите.
          </div>
        </div>
        <div class="right_product_priem right_product_priem2">
          <div class="right_product_priem_title">
            Безопасность
          </div>
          <div class="right_product_priem_text">
            Безопасность платежей гарантируется
            использованием SSL протокола. Данные
            вашей банковской карты надежно
            защищены при оплате онлайн.
          </div>
        </div>
        <div class="right_product_priem right_product_priem3">
          <div class="right_product_priem_title">
            Бесплатная доставка по всей России
          </div>
          <div class="right_product_priem_text">
            У вас всегда есть возможность получить
            бесплатную доставку товаров boModa.
          </div>
        </div>
        <div class="right_product_priem right_product_priem4">
          <div class="right_product_priem_title">
            Примерка
          </div>
          <div class="right_product_priem_text">
            Примеряйте и оплачивайте только
            подходящие товары. Вы можете примерить
            вещи перед покупкой и взять лишь те,
            которые вам подошли.
          </div>
        </div>
      </div>

      <!--<a class="get_cart">test </a>-->


    </div>

  </div>


</div>
</div>

  <?php echo $footer; ?>




<script type="text/javascript"><!--
    $('select[name=\'recurring_id\'], input[name="quantity"]').change(function(){
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name=\'product_id\'], input[name=\'quantity\'], select[name=\'recurring_id\']'),
            dataType: 'json',
            beforeSend: function() {
                $('#recurring-description').html('');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();

                if (json['success']) {
                    $('#recurring-description').html(json['success']);
                }
            }
        });
    });
    //--></script>
<script type="text/javascript"><!--
    $('#button-cart').on('click', function() {
        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $('#product input[type=\'text\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
            dataType: 'json',
            beforeSend: function() {
                $('#button-cart').button('loading');
            },
            complete: function() {
                $('#button-cart').button('reset');
            },
            success: function(json) {
                $('.alert, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else {
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }

                    if (json['error']['recurring']) {
                        $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                if (json['success']) {
                    $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                    $('#header_cart').html(json['total']);




                    $('#cart > ul').load('index.php?route=common/cart/info ul li');
                    $.ajax({
                        url: '/index.php?route=checkout/mycart/sendmailCustom',
                        type: 'post',
                        data: '',
                        //dataType: 'json',
                        beforeSend: function() {
                            console.log('отослано');
                        },
                        success: function(json) {
                            //console.log(json);
                            $('#addcart_form').html(json);
                            $('#addcart_form,.over_all').show();
                            $('.over_all,.close,.btn_return').click(function(){
                                $('.m_form').hide();
                                $('.over_all').hide();
                            });
                        }
                    });
                }




            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    //--></script>
<script type="text/javascript"><!--
    $('.date').datetimepicker({
        pickTime: false
    });

    $('.datetime').datetimepicker({
        pickDate: true,
        pickTime: true
    });

    $('.time').datetimepicker({
        pickDate: false
    });

    $('button[id^=\'button-upload\']').on('click', function() {
        var node = this;

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: 'index.php?route=tool/upload',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(node).button('loading');
                    },
                    complete: function() {
                        $(node).button('reset');
                    },
                    success: function(json) {
                        $('.text-danger').remove();

                        if (json['error']) {
                            $(node).parent().find('input').after('<div class="text-danger">' + json['error'] + '</div>');
                        }

                        if (json['success']) {
                            alert(json['success']);

                            $(node).parent().find('input').val(json['code']);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });
    //--></script>
<script type="text/javascript"><!--
    $('#review').delegate('.pagination a', 'click', function(e) {
        e.preventDefault();

        $('#review').fadeOut('slow');

        $('#review').load(this.href);

        $('#review').fadeIn('slow');
    });

    $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

    $('#button-review').on('click', function() {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            data: $("#form-review").serialize(),
            beforeSend: function() {
                $('#button-review').button('loading');
            },
            complete: function() {
                $('#button-review').button('reset');
            },
            success: function(json) {
                $('.alert-success, .alert-danger').remove();

                if (json['error']) {
                    $('#review').after('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '</div>');
                }

                if (json['success']) {
                    $('#review').after('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '</div>');

                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').prop('checked', false);
                }
            }
        });
    });

    $(document).ready(function() {
        $('.thumbnails').magnificPopup({
            type:'image',
            delegate: 'a',
            gallery: {
                enabled:true
            }
        });
    });
    //--></script>

