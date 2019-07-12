<?php echo $header;?>
<?
include 'includes/mainmenu.php';
?>
<div class="clear"></div>
<div class="main_content m_row" id="content">




  <div class="cart_title empty">
    <?php echo $heading_title; ?>
  </div>
  <div class="cart_empty_content">
    <div class="cart_empty_content_text">
      В корзину ничего не добавлено
    </div>
    <div class="cart_empty_content_btn">
      <a class="btn_blue" href="/platjya-sarafany">Перейти в каталог</a>
    </div>
    <div class="cart_empty_content_text1">
      <?if(!$logged) { ?>
      <a class="log_link">Авторизуйтесь</a>, чтобы увидеть сохраненные товары
      <? } ?>
    </div>
  </div>
</div>
<?php echo $footer; ?>