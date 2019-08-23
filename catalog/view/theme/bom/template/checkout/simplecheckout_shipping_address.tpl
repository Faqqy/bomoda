<div class="simplecheckout-block" id="simplecheckout_shipping_address" <?php echo $hide ? 'data-hide="true"' : '' ?> <?php echo $display_error && $has_error ? 'data-error="true"' : '' ?>>

  <div class="order_block_line">
    <div class="order_block_line_left">
      Город
    </div>
    <div class="order_block_line_right order_block_line_right_city">

    </div>
    <div class="clear"></div>
  </div>
<div class="order_block_line">
  <!--<div class="order_block_line_left">
    Адрес
  </div>-->
  <div class="order_block_line_right order_block_line_right_street">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">

  </div>
  <div class="order_block_line_right order_block_line_right_house">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">

  </div>
  <div class="order_block_line_right order_block_line_right_kv">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <div class="order_block_line_left">

  </div>
  <div class="order_block_line_right order_block_line_right_type">

  </div>
  <div class="clear"></div>
</div>
<div class="order_block_line">
  <!-- <div class="order_block_line_left">
    Время доставки
  </div> -->
  <div class="order_block_line_right order_block_line_right_date">
    <div class="order_block_line_right_date1">
    </div>
    <div class="order_block_line_right_date2">
    </div>

  </div>
  <div class="clear"></div>
</div>




  <?php if ($display_header) { ?>
    <div class="checkout-heading panel-heading"><?php echo $text_checkout_shipping_address ?></div>
  <?php } ?>
  <div class="simplecheckout-block-content">
    <?php foreach ($rows as $row) { ?>
      <?php echo $row ?>
    <?php } ?>
    <?php foreach ($hidden_rows as $row) { ?>
      <?php echo $row ?>
    <?php } ?>
  </div>
</div>