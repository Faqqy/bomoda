<?php echo $header; ?>
<?
include 'includes/mainmenu.php';
?>

<div class="main_content m_row" id="content">
  <div class="cart_title empty">
    Ваш заказ принят!
  </div>
  <div class="order_info">
    Номер вашего заказа <strong>№<?=$order_number?></strong><br/>
    Сумма заказа <strong><?=number_format($order_price,2,'.','');?> руб.</strong><br/>
    Тип доставки <strong><?=$order_del;?></strong><br/>
  </div>
  <div class="order_info_text">
    Наши менеджеры свяжтуся с Вами в ближайшее время для подтверждения заказа.
  </div>
  <div class="order_info_lk_block">
    <?=$user['firstname']?>, отслеживать статус вашего заказа вы можете в Личном кабинете.<br/>
    С каждой покупки Вам зачисляется скидка. Чтобы посмотреть размер накопительной скидки перейдите в Личный кабинет
    <div class="order_info_lk_block_btn">
      <a href="/order-history" class="btn_add_cart">Перейти в Личный кабинет</a>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php echo $footer; ?>