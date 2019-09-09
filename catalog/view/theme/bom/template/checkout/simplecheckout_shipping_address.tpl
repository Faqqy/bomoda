<div class="simplecheckout-block" id="simplecheckout_shipping_address" <?php echo $hide ? 'data-hide="true"' : '' ?> <?php echo $display_error && $has_error ? 'data-error="true"' : '' ?>>

  <div class="order_block_line">
    <div class="order_block_line_left">
      Город
    </div>
    <div class="order_block_line_right order_block_line_right_city">

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