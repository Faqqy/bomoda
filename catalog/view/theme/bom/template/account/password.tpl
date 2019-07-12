<?if($error_confirm!=''||$error_password!='') { ?>
<?
$answer=array(
'error'=>1,
'error_text'=>$error_confirm.$error_password
);
echo json_encode($answer);
?>
<? } else { ?>
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
  <a href="/"><?php echo $heading_title; ?></a>
</div>
<div class="main_content m_row">
  <div class="account_title">
    Здравствуйте, <?=$user['firstname']?> <?=$user['lastname']?>
  </div>

  <? include 'includes/leftmenu_account.php';?>
  <div class="content" id="content">

    <div class="account_title_content">
      Изменить пароль
    </div>
    <?
      if($change_ok==1) {

    ?>
      <div class="change_ok">
        Изменения сохранены
      </div>
    <? } ?>
    <div class="account_content">
      <div class="password_form_info">
        Пароль должен содержать не менее 6 символов
      </div>

      <div class="password_form">

        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">

          <div class="password_form_line">
            <label for="input-password">Введите новый пароль</label>
            <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
            <?php if ($error_password) { ?>
            <div class="text-danger"><?php echo $error_password; ?></div>
            <div class="pass_error"></div>
            <?php } ?>

          </div>
          <div class="password_form_line">
            <label for="input-confirm">Повторите пароль</label>
            <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
            <?php if ($error_confirm) { ?>
            <div class="text-danger"><?php echo $error_confirm; ?></div>
            <div class="pass_error"></div>
            <?php } ?>

          </div>
          <div class="password_form_line submit">
            <input type="submit" value="Сохранить изменения" class="btn_blue" />
          </div>


        </form>
      </div>
    </div>


  </div>


  <div class="clear"></div>
</div>
<?php echo $footer; ?>









<? } ?>