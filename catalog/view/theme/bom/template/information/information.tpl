<?php echo $header;

?>
<?
if($_GET['menu']=='company')
include 'includes/companymenu.php';
else
include 'includes/mainmenu.php';
?>


<div class="clear"></div>
<div class="mob_bread">
  <a href="/"><?php echo $heading_title; ?></a>
</div>
<? if($_SERVER['REQUEST_URI']=='/sotrudnichestvo?menu=company') { ?>
<?
if($_GET['menu']=='company') {
?>

<div class="main_content m_row" id="content" style="margin-top: 35px;">
  <? } else { ?>
  <div class="main_content m_row" id="content">
    <? } ?>
  <div class="m_row">

    <div class="bread">
      <ul>
        <li><a href="/">< Вернуться на главную</a></li>


      </ul>
      <div class="clear"></div>
    </div>
  </div>





  <?php echo $description; ?>
</div>
<div class="main_sotr_form">
  <div class="sotr_form">
    <div class="s_block2_title">
      Заявка на сотрудничество
    </div>
    <?php echo $content_bottom; ?>
    <div class="clear"></div>
  </div>
</div>
<? } elseif($_SERVER['REQUEST_URI']=='/kontakty?menu=company'||$_SERVER['REQUEST_URI']=='/about_us?menu=company') { ?>
<?
if($_GET['menu']=='company') {
?>

<div class="main_content m_row" id="content" style="margin-top: 35px;">
  <? } else { ?>
  <div class="main_content m_row" id="content">
    <? } ?>
  <div class="m_row">

    <div class="bread">
      <ul>
        <li><a href="/">< Вернуться на главную</a></li>


      </ul>
      <div class="clear"></div>
    </div>



    <div class="clear"></div>
    <?php echo $description; ?>
    <div class="clear"></div>
  </div>






</div>
<div class="main_sotr_form">
  <div class="sotr_form">
    <div class="s_block2_title">
      СВЯЗАТЬСЯ С НАМИ
    </div>
    <?php echo $content_top; ?>
    <div class="clear"></div>
  </div>
</div>
<? } else { ?>

<?
if($_GET['menu']=='company') {
?>

  <div class="main_content m_row" id="content" style="margin-top: 35px;">
<? } else { ?>
    <div class="main_content m_row" id="content">
<? } ?>



  <?php echo $description; ?>
</div>
<? } ?>
<?php echo $footer; ?>
