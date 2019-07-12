<?php echo $header; ?>
<?
$t=new ModelCatalogCategory('catalog');
//print_r($t);
?>
<? include 'includes/mainmenu.php';?>


<div class="main_content m_row">
  <? include 'includes/leftmenu_search.php';?>
  <div class="content" id="content">


    <div class="catalog_top">
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
    <div class="cat_sort_filter search_filter">
      <div class="catalog_top_sort_block_title">

        <?php foreach ($sorts as $sorts1) { ?>
        <?php if ($sorts1['value'] == $sort . '-' . $order) { ?>

        <span><?php echo $sorts1['text']; ?></span>
        <?php } else { ?>

        <?php } ?>
        <?php } ?>


        <div class="catalog_top_sort_block">
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
            <a class="catalog_btn_fav" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a>
          </div>
          <div class="catalog_item_title">
            <a href="<?=$product['href'];?>">
              <?=$product['name'];?>
            </a>
          </div>
          <div class="catalog_item_cat">
            Брюки
          </div>
          <div class="catalog_item_prices">

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
          <div class="catalog_item_hidden">
            <div class="catalog_item_sizes">
              Размеры:
              <?foreach($product['options'] as $option) { //print_r($option);?>
              <?if($option['option_id']==13) { ?>
              <?foreach($option['product_option_value'] as $val) { ?>
              <span><?=$val['name']?></span>
              <? } ?>
              <? } ?>
              <? } ?>

            </div>
            <a class="catalog_item_quick" data-id="<?=$product['product_id']?>">
              Быстрый просмотр
            </a>

          </div>
        </div>
      </div>

      <? } ?>





      <div class="clear"></div>

    </div>

    <div class="clear"></div>
  </div>


  <div class="clear"></div>
</div>
<?php echo $footer; ?>
