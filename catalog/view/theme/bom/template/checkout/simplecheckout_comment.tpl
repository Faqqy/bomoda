<div class="simplecheckout-block" id="simplecheckout_comment">
    <?php if ($display_header) { ?>
      <div class="checkout-heading panel-heading"><?php echo $label ?></div>
    <?php } ?>

    <div class="order_block_line">
        <div class="order_block_line_left">
            Комментарий
        </div>
        <div class="order_block_line_right">
            <div class="simplecheckout-block-content">
                <textarea class="form-control" name="comment" id="comment" placeholder="<?php echo $placeholder ?>" data-reload-payment-form="true"><?php echo $comment ?></textarea>
            </div>
        </div>
        <div class="clear"></div>
    </div>

</div>