<?php if(isset($products)){ ?>
<div>
<h3><?php echo $heading_title; ?></h3>
  <?php foreach ($products as $product) { ?>
  <div class="product-thumb">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" /></a>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
		
		<?php if ($product['rating']) { ?>
        <div class="rating">
          <?php for ($i = 1; $i <= 5; $i++) { ?>
          <?php if ($product['rating'] < $i) { ?>
          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } else { ?>
          <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
          <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
		
		<?php if ($product['price']) { ?>
        <p class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
          <?php } ?>
        </p>
        <?php } ?>
	</div>
  </div>
  <?php } ?>
</div>
<?php } ?>