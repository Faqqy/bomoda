<?php echo $header; ?>
<? include 'includes/mainmenu.php';?>
<?

$hist_count=0;
$tek_count=0;
foreach($orders as $order)
{
  if($order['status_id']==2)
  {
    $tek_count++;
  }
  else
  {
    $hist_count++;
  }
}

?>

<div class="mob_bread">
    <a onclick="javascript:history.back(); return false;">Мои скидки</a>
</div>
<div class="main_content m_row">
  <div class="account_title">
    Здравствуйте, <?=$user['firstname']?> <?=$user['lastname']?>
  </div>

  <? include 'includes/leftmenu_account.php';?>
  <div class="content" id="content">
    <div class="account_title_content">
      Мои скидки
    </div>

    <div class="account_content">
      <div class="password_form_info">
        <?if($discount['sale']==0) { ?>
          Размер вашей постоянной скидки составляет 0% от суммы заказа.
        <? } else { ?>
          Размер вашей постоянной скидки составляет <span>-<?=$discount['sale']?>%</span> от суммы заказа.
        <? } ?>
      </div>


      <div class="dis_lines">
        <?foreach($discount['table'] as $k=>$dis) { ?>
        <?if($k!=0) { ?>
        <div class="dis_line dis_line<?=$k?>">
          <?if($discount['summ']>$dis['summ']) { ?>
          <div class="dis_line_value" style="width:100%">
          </div>
          <? } else { ?>
          <div class="dis_line_value" style="width:<?=(($discount['summ']-$discount['table'][$k-1]['summ'])/($dis['summ']-$discount['table'][$k-1]['summ']))*100?>%">
          </div>

          <? } ?>
        </div>
        <div class="dis_line_sep">
          <div class="dis_line_sep_pr">
            <?=$dis['value']?>%
          </div>
          <div class="dis_line_sep_value">
            <?=number_format($dis['summ'],0,' ',' ');?><br/>
            рублей
          </div>

        </div>
        <? } ?>

        <? } ?>
        <div class="dis_line dis_line1">
        </div>
        <div class="clear"></div>
      </div>
      <?if($discount['orders']) { ?>
        <div class="dis_orders">
          <?foreach($discount['orders'] as $k=>$order) {
          $class='';
          if($k+1==count($discount['orders']))
          $class='last';
?>
            <div class="dis_order <?=$class?>">
              <div class="dis_order_price">
                <?=number_format($order['total'],0,' ',' ')?> руб.
              </div>
              <div class="dis_order_number">
                Заказ №<?=$order['order_id']?>
              </div>
              <div class="dis_order_date">
                <?=date('d.m.Y',strtotime($order['date_added']))?>
              </div>
              <div class="clear"></div>
            </div>
          <? } ?>
        </div>
      <? } ?>

    </div>


      <?// print_r($discount);?>




  </div>


  <div class="clear"></div>
</div>
<?php echo $footer; ?>









