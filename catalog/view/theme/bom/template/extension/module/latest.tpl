<div class="home_title">
  <span>Распродажа</span>
</div>
<div class="home_slider">
  <div class="jcarousel-wrapper">
    <div class="jcarousel" data-col="5">
      <ul>
        <?php foreach ($products as $product) { ?>
        <li>
          <div class="home_slider_block">
            <div class="home_slider_block_img">
              <a href="<?php echo $product['href']; ?>"><img src="/image/<?php echo $product['full_image']; ?>" /></a>
            </div>
            <div class="home_slider_block_price">
              <?php if (!$product['special']) { ?>
              <span><?=$product['price']?></span>
              <?php } else { ?>
              <span class="old_price" style="font-size: 12px;"><b><?=$product['price']?></b></span> <span class="new_price" style="font-size: 12px;"><b><?=$product['special']?></b></span>
              <? } ?>

            </div>
            <div class="home_slider_block_title">
              <a href="<?php echo $product['href']; ?>" style="font-size:12px;font-weight:normal;"><?php echo $product['name']; ?></a>
              <a href="<?php echo $product['href']; ?>" style="color:#a7a7a7;font-size:12px;font-weight:normal;"> / <?=$product['cat_name']?></a>
            </div>
            <div class="home_slider_block_cat">

            </div>


          </div>
        </li>

        <?php } ?>


      </ul>
    </div>
    <a href="#" class="jcarousel-control-prev"></a>
    <a href="#" class="jcarousel-control-next"></a>
  </div>

  <div class="clear"></div>

</div>
