<div class="simplecheckout-block" id="simplecheckout_customer" <?php echo $hide ? 'data-hide="true"' : '' ?> <?php echo $display_error && $has_error ? 'data-error="true"' : '' ?>>

<div class="order_block_line">
  <div class="order_block_line_left">
    Имя
  </div>
  <div class="order_block_line_right order_block_line_right_name">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">
    Фамилия
  </div>
  <div class="order_block_line_right order_block_line_right_famyli">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">
    Электронная почта
  </div>
  <div class="order_block_line_right order_block_line_right_email">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">
    Телефон
  </div>
  <div class="order_block_line_right order_block_line_right_phone">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">

  </div>
  <div class="order_block_line_right order_block_line_right_news">
    fddgdfgdfgdfgdfgdfg
  </div>
  <div class="clear"></div>
</div>


  <?php if ($display_header || $display_login) { ?>
  <div class="checkout-heading panel-heading"><span><?php echo $text_checkout_customer ?></span><?php if ($display_login) { ?><span class="checkout-heading-button"><a href="javascript:void(0)" data-onclick="openLoginBox"><?php echo $text_checkout_customer_login ?></a></span><?php } ?></div>
  <?php } ?>
  <div class="simplecheckout-block-content">
    <?php if ($display_registered) { ?>
      <div class="alert alert-success"><?php echo $text_account_created ?></div>
    <?php } ?>
    <?php if ($display_you_will_registered) { ?>
      <div class="you-will-be-registered"><?php echo $text_you_will_be_registered ?></div>
    <?php } ?>
    <?php foreach ($rows as $row) { ?>
      <?php echo $row ?>
    <?php } ?>
  </div>
</div>