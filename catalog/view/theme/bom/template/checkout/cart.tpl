<?php echo $header;?>
<?
include 'includes/mainmenu.php';
?>
<div class="clear"></div>
<div class="mob_bread">
  <a onclick="javascript:history.back(); return false;"><?php echo $heading_title; ?></a>
</div>
<div class="main_content m_row" id="content">




  <div class="cart_title">
    <?php echo $heading_title; ?>
  </div>
  <div class="cart_total_all_mobile show_mobile">
    <span>Итого</span>: <?=count($products)?> товара на сумму <?=str_replace('р.','',$totals[0]['text']);?> руб.
  </div>
  <!--<a href="<?php  echo $checkout; ?>" class="btn_add_cart show_mobile">Перейти к оформлению заказа</a>-->

  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <table class="cart_table">
      <tr>
        <th class="cart_table_img">
        </th>
        <th class="cart_table_info">
          Наименование
        </th>
        <th class="cart_table_q">
          Колличество
        </th>
        <th class="cart_table_price">
          Цена
        </th>
        <th class="cart_table_sale">
          Скидка
        </th>
        <th class="cart_table_total">
          Общая стоимость
        </th>
        <th class="cart_table_del">
        </th>

      </tr>
      <?$summ=0;?>
      <?php foreach ($products as $product) { //print_r($product); ?>
        <tr>
          <td class="cart_table_img">
            <a href="<?php echo $product['href']; ?>"><img src="/image/<?php echo $product['full_image']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"  /></a>
          </td>
          <td class="cart_table_info">
            <div class="cart_product_name">
              <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            </div>
            <div class="cart_product_options">
              <?php if ($product['option']) { ?>
              <?php foreach ($product['option'] as $option) { ?>
              <div class="cart_product_option">
                <?php echo $option['name']; ?>: <?php echo $option['value']; ?>
              </div>
              <?php } ?>
              <?php } ?>
            </div>
          </td>
          <td class="cart_table_q">
            <div class="cart_table_minus"></div>
            <input type="text" name="quantity[<?php echo $product['cart_id']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
            <div class="cart_table_plus"></div>
            <button type="submit" style="display:none;" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i></button>


          </td>
          <td class="cart_table_price <?if(intval($product['full_price'])!=intval($product['price'])) echo 'old'?>">

            <?php echo intval($product['full_price']/**$product['quantity']*/).'р.'; ?>
          </td>
          <td class="cart_table_sale">
              <?if(intval($product['full_price'])!=intval($product['price'])){ ?>
            <?php echo intval((/*$product['full_price']-*/$product['price'])/**$product['quantity']*/).'р.';// intval(intval($pruduct['full_price'])-intval($product['price'])); //round(($product['price']/$product['full_price'])*100).'%'; ?>
              <? } ?>
          </td>
          <td class="cart_table_total">
            <?php  echo $product['total']; ?>
          </td>
          <td class="cart_table_del">
              <a class="btn_del" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"></a>

          </td>

        </tr>
      <?php
      $summ+=$product['full_price']*$product['quantity'];
      //print_r($summ);
      } ?>
    </table>
    <div class="cart_total">
      <div class="cart_total_without">
        <span>Сумма заказа</span> <?=$summ?> руб.
      </div>
      <div class="cart_total_with">
        <span>Скидка</span> <?=$summ-str_replace('р.','',$totals[0]['text']);?> руб.
      </div>

    </div>
    <div class="cart_total_all">
      <span>Итого к оплате</span> <?=str_replace('р.','',$totals[0]['text']);?> руб.
    </div>
    <div class="cart_total_all_link">
      <a href="<?php  echo $checkout; ?>" class="btn_add_cart">Перейти к оформлению заказа</a>
    </div>
    <div class="clear"></div>
      <?//  print_r($totals[0]['text']); ?>


  </form>
</div>
<?php echo $footer; ?>
