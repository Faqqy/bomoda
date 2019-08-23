<?php echo $header; ?>
<? include 'includes/mainmenu.php';?>
<?

$hist_count=0;
$tek_count=0;
foreach($orders as $order)
{
  if($order['status_id']==2)
  {
    $tek_count++;
  }
  else
  {
    $hist_count++;
  }
}

?>

<div class="mob_bread">
    <a onclick="javascript:history.back(); return false;">Избранное</a>
</div>

<div class="main_content m_row">
  <div class="account_title">
    Здравствуйте, <?=$user['firstname']?> <?=$user['lastname']?>
  </div>

  <? include 'includes/leftmenu_account.php';?>
  <div class="content" id="content">
    <div class="account_title_content">
      Избранное <?=count($products)?>
    </div>
    <div class="account_content">
      <?if($products) { ?>
      <? //print_r($products)?>
        <div class="wish_list_blocks">
          <?foreach($products as $k=>$product) {
          $class="";
          if($k+1==count($products))
            $class="last";
          ?>
            <div class="wish_list_block <?=$class?>">
              <div class="wish_list_block_img">
                <a href="<?=$product['href']?>" style="background: url(/image/<?=$product['full_image']?>) no-repeat center center;">
                </a>
              </div>
              <div class="wish_list_block_info">
                <div class="wish_list_block_info_title">
                  <?=$product['name']?>
                </div>
                <?if($product['model']) { ?>
                  <div class="wish_list_block_info_model">
                    Артикул: <span><?=$product['model']?></span>
                  </div>

                <? } ?>
              </div>
              <div class="wish_list_block_right">
                <div class="wish_list_block_right_price">
                  <?=number_format(str_replace('руб.','',$product['price']),0,' ',' ');?>  руб.
                </div>
                <div class="wish_list_block_right_btns">
                  <a href="<?=$product['remove']?>" class="btn_red">Удалить</a>
                  <a href="<?=$product['href']?>" class="btn_blue">Перейти к товару</a>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          <? } ?>
        </div>

      <? } else { ?>
        <div class="wish_empty">
          <div class="empty_order_title">
            У вас на данный момент нет товаров в «Избранном»
          </div>
          <div class="empty_order_text">
            Что бы добавить понравившийся товар в «Избранное», отметьте его «сердцем» <span class="wish_hart"></span>! Это можно сделать как со страницы товара, так и из общего каталога.<br/><br/>
            Список избранных товаров сохраняется с вашим аккаунтом, что удобно, когда вы пользуетесь несколькими
            устройствами. Например, если вы переключаетесь между компьютером, планшетом и смартфоном.<br/><br/>
            Добавив товар в Избранное, вы легко сможете вернуться к нему в удобное для вас время. Например, можно
            добавить понравившуюся вам модель в случае отсутствия подходящего размера, что позволит удобнее
            отслеживать пополнения ассортимента.

          </div>

          <div class="empty_order_btn">
            <a href="/platjya-sarafany" class="btn_blue">Перейти в покупкам</a>
          </div>
        </div>
      <? } ?>
    </div>


  </div>


  <div class="clear"></div>
</div>
<?php echo $footer; ?>









