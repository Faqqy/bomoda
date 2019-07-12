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


<div class="main_content m_row">
  <div class="account_title">
    Здравствуйте, <?=$user['firstname']?> <?=$user['lastname']?>
  </div>

  <? include 'includes/leftmenu_account.php';?>
  <div class="content" id="content">


  </div>


  <div class="clear"></div>
</div>
<?php echo $footer; ?>









