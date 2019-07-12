<?php if ($products) { ?>
<div class="left_product_rec">
    <div class="left_product_rec_title">
        Вы недавно просматривали
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