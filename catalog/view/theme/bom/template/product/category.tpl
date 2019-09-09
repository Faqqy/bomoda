<?php echo $header; ?>
<?
$t=new ModelCatalogCategory('catalog');
//print_r($t);
?>
<? include 'includes/mainmenu.php';?>


<div class="main_content m_row">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>



  <div class="content" id="content">
      <div class="mobile_btns show_mobile">
          <div class="mobile_btn_left">
              <a class="btn_show_cat"><?php echo $heading_title; ?></a>
          </div>
          <div class="mobile_btn_right">
              <a class="btn_show_filter">Фильтр</a>
          </div>
          <div class="clear"></div>
      </div>



        <div class="catalog_top hidden_mobile">
          <div class="catalog_top_title">
            <?php echo $heading_title; ?>
          </div>
          <!--<div class="catalog_top_sort">
            <div class="catalog_top_sort_title">
              Сортировать:
            </div>

          </div>-->
          <div class="clear"></div>

        </div>
    <div class="cat_sort_filter_in"></div>
      <? include 'includes/leftmenu_mobile.php';?>
    <div class="cat_sort_filter ">
    <div class="catalog_top_sort_block_title hidden_mobile">

      <?php foreach ($sorts as $sorts1) { ?>
      <?php if ($sorts1['value'] == $sort . '-' . $order) { ?>

      <span><?php echo $sorts1['text']; ?></span>
      <?php } else { ?>

      <?php } ?>
      <?php } ?>


      <div class="catalog_top_sort_block hidden_mobile">
        <?php foreach ($sorts as $sort) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>

        <?php } else { ?>

        <a href="<?php echo $sort['href']; ?>"><span><?php echo $sort['text']; ?></span></a>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
    <?php echo $content_top; ?>

      <div class="clear"></div>
    </div>

    <div class="clear"></div>
    <div class="catalog_items">
      <?php foreach ($products as $product) { //print_r($product);?>
      <div class="catalog_item">
        <div class="catalog_item_in">
          <div class="catalog_item_img">
            <a href="<?=$product['href'];?>">
              <img src="/image/<?php echo $product['full_image']; ?>" />
            </a>
            <?if(in_array($product['product_id'],$wish)) { ?>
              <a class="catalog_btn_fav active catalog_btn_fav<?php echo $product['product_id']; ?>" onclick="wishlist.remove('<?php echo $product['product_id']; ?>');"></a>
            <? } else { ?>
              <a class="catalog_btn_fav catalog_btn_fav<?php echo $product['product_id']; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a>
            <? } ?>
            <?php if ($product['special']) { ?>
              <div class="block_sale">
                -<?=round(100-($product['special']/$product['price'])*100)?>%
              </div>
            <? } ?>
          </div>
          <div class="catalog_item_prices show_mobile">

            <?php if (!$product['special']) { ?>

            <div class="catalog_item_price">
              <?=$product['price']?>
            </div>
            <div class="catalog_item_old_price">

            </div>
            <?php } else { ?>
            <div class="catalog_item_price have_old_price">


              <?=$product['price']?>
            </div>
            <div class="catalog_item_old_price">
              <?=$product['special']?>
            </div>

            <? } ?>

            <div class="clear"></div>

          </div>
          <div class="catalog_item_prices hidden_mobile">

            <?php if (!$product['special']) { ?>

            <div class="catalog_item_price">
              <?=number_format(str_replace('р.','',$product['price']),0,' ',' ')?> руб.
            </div>
            <div class="catalog_item_old_price">

            </div>
            <?php } else { ?>
            <div class="catalog_item_price have_old_price">

              <?=number_format(str_replace('р.','',$product['price']),0,' ',' ')?> руб.
            </div>
            <div class="catalog_item_old_price">
              <?=number_format(str_replace('р.','',$product['special']),0,' ',' ')?> руб.
            </div>

            <? } ?>

            <div class="clear"></div>

          </div>
          <div class="catalog_item_title">
            <a href="<?=$product['href'];?>" style="font-size: 12px;">
              <?=$product['name'];?>
            </a>
            <a href="<?=$cat['href'];?>" class="catalog_item_cat" style="font-size:11px;color:#a7a7a7;line-height: 1.429;">
             / <?php echo $cat['name']; ?>
            </a>
          </div>

          <div class="catalog_item_sizes show_mobile">
            <?foreach($product['options'] as $option) { //print_r($option);?>
            <?if($option['option_id']==13) { ?>
            <?foreach($option['product_option_value'] as $val) { ?>
            <span><?=$val['name']?></span>
            <? } ?>
            <? } ?>
            <? } ?>

          </div>

            <div class="catalog_item_hidden">
              <div class="catalog_item_sizes">
                Размеры:
                <?foreach($product['options'] as $option) { //print_r($option);?>
                <?if($option['option_id']==13) { ?>
                <?foreach($option['product_option_value'] as $val) { ?>
                  <span><a href="<?=$product['href'];?>"><?= $val['name'];?></a></span>

                <? } ?>
                <? } ?>
                <? } ?>

              </div>
              <a class="catalog_item_quick" data-id="<?=$product['product_id']?>">
                Подробнее
              </a>

            </div>
          </div>
      </div>

      <? } ?>





      <div class="clear"></div>

    </div>
    <?php echo $pagination; ?>

      <div class="clear"></div>
  </div>


  <div class="clear"></div>
</div>
<?php echo $footer; ?>
