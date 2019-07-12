<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <base href="<?php echo $base; ?>" />
  <?php if ($description) { ?>
  <meta name="description" content="<?php echo $description; ?>" />
  <?php } ?>
  <?php if ($keywords) { ?>
  <meta name="keywords" content= "<?php echo $keywords; ?>" />
  <?php } ?>
  <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="catalog/view/javascript/jquery.mobile.custom.min.js" type="text/javascript"></script>

  <link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
  <script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
  <link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
  <?php foreach ($styles as $style) { ?>
  <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
  <?php } ?>
  <script src="catalog/view/javascript/common.js" type="text/javascript"></script>
  <?php foreach ($links as $link) { ?>
  <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
  <?php } ?>
  <?php foreach ($scripts as $script) { ?>
  <script src="<?php echo $script; ?>" type="text/javascript"></script>
  <?php } ?>
  <?php foreach ($analytics as $analytic) { ?>
  <?php echo $analytic; ?>
  <?php } ?>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">

  <link href="/catalog/view/theme/bom/stylesheet/jquery.formstyler.css" rel="stylesheet">
  <link href="/catalog/view/theme/bom/stylesheet/style.css" rel="stylesheet">
  <link href="/catalog/view/theme/bom/stylesheet/media.css" rel="stylesheet">


  <script src="catalog/view/javascript/simple.js?v=4.9.7" type="text/javascript"></script>
  <script src="catalog/view/javascript/simplepage.js?v=4.9.7" type="text/javascript"></script>



  <script src="/catalog/view/javascript/jquery.jcarousel-core.min.js"></script>
    <script src="/catalog/view/javascript/jquery.jcarousel-swipe.min.js"></script>
    <script src="/catalog/view/javascript/jquery.touchwipe.min.js"></script>
  <script src="/catalog/view/javascript/jquery.maskedinput.min.js"></script>
  <script src="/catalog/view/javascript/jquery.formstyler.js"></script>
  <script src="/catalog/view/javascript/zoomsl-3.0.min.js"></script>
    <script src="/catalog/view/javascript/zoom.js"></script>
  <script src="/catalog/view/javascript/jquery.jcarousel-autoscroll.min.js"></script>
  <script type="text/javascript" src="https://hammerjs.github.io/dist/hammer.js"></script>
	<script src="https://yastatic.net/share2/share.js" async="async"></script>
	<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
	<script src="https://yastatic.net/share2/share.js" async="async"></script>
	<script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
	<script type="text/javascript">
		window.onload = function () {
				jQuery("#user-city").text(ymaps.geolocation.city);
				jQuery("#user-region").text(ymaps.geolocation.region);
				jQuery("#user-country").text(ymaps.geolocation.country);
		}
	</script>
  <script src="/catalog/view/javascript/scripts.js"></script>

</head>
<body>

<div class="m_main_header">
  <div class="m_main_menu" id="m_main_menu">
    <div class="m_menu m_row">
      <? include 'includes/m_main_menu.php'; ?>
    </div>
  </div>

  <div class="m_header m_row">
    <div class="m_header_menu">
      <div class="m_menu_link">
      </div>
    </div>
    <div class="m_header_search_form">
      <form action="/search" method="get">
        <input type="submit" class="btn_mobile_search" value="Найти">
        <input type="text" name="search" placeholder="Что Вы ищите?">

      </form>
    </div>
    <div class="m_header_search">
      <div class="m_menu_search">
      </div>
    </div>
    <div class="m_header_logo">
      <a href=""><img src="/catalog/view/theme/bom/images/boModa.svg"></a>
    </div>
    <div class="m_header_cart">
      <a href="/checkout/cart">
        <div class="m_link_cart">
          <span><?print_r($cart_count);?></span>
        </div>
      </a>
    </div>
    <div class="m_header_fav">
      <a href="/wishlist">
      <div class="m_link_fav">
      </div>
      </a>
    </div>


    <div class="clear"></div>
  </div>
</div>


<?
if($logged)
{
}
else
{
include 'includes/forms.php';
}
?>
<?
if($_GET['menu']!='company') {
?>
<div class="main_top">
  <div class="top m_row">
    <div class="top_title">
      Магазин одежды больших размеров
    </div>
    <div class="top_city">
			<div><b>Ваш город:</b> <span id="user-city"></span></div>
    </div>
  </div>
</div>
<? } ?>
<div class="clear"></div>
<div class="header m_row">
  <div class="header_top">
    <?if(isset($_GET['menu'])) { ?>
    <div class="logo" style="left:-25px;margin-left:0;">
      <a href=""><img src="/catalog/view/theme/bom/images/logo.png"></a>
    </div>
    <? } else { ?>
    <div class="logo">
      <a href=""><img src="/catalog/view/theme/bom/images/logo.png"></a>
    </div>

    <? } ?>

    <?if(!isset($_GET['menu'])) { ?>
    <div class="search">
      <?php// echo $search; ?>
      <form action="/search" method="get">
        <input type="submit" class="btn_search" value="">
        <input type="text" name="search" placeholder="Что Вы ищите?">

      </form>
    </div>


    <div class="header_links">
      <?if($logged) { ?>
        <div class="btn_user_login">
          <div class="user_login_menu">
            <div class="user_login_menu_top">
              <a href="/order-history">
                Мои заказы
              </a>
              <a href="/index.php?route=account/simpleedit">
                Моя информация
              </a>
              <a href="/index.php?route=account/simpleedit&flag=pod">
                Мои подписки
              </a>

            </div>
            <div class="user_login_menu_sale">
              Ваша накопительная<br/>
              скидка составляет - <span><?=$discount['sale']?>%</span>
            </div>
            <div class="user_login_menu_bottom">
              <a href="/logout">
                Выйти
              </a>

            </div>
          </div>
        </div>
      <? } else { ?>
        <a href="" class="btn_user" onclick="showDialog()"></a>
      <? } ?>
      <?if($logged) { ?>
        <a href="/wishlist" class="btn_fav"></a>
      <? } else{
					?>
					<style type="text/css">.btn_fav{
					display:none;
					}</style>
        <a href="" class="btn_fav"></a>
      <? } ?>
      <a href="/checkout/cart" class="btn_cart"><?print_r($cart);?></a>
      <div class="clear"></div>
    </div>
    <? } ?>
    <div class="clear"></div>
  </div>
</div>
<div class="clear"></div>


<div class="clear"></div>
