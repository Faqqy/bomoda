<?if($error_warning) { ?>
<?
$answer=array(
'error'=>1,
'error_text'=>$error_warning
);
echo json_encode($answer);
?>
<? } else { ?>
<?php echo $header; ?>
<div class="mob_bread">
  <a  onclick="javascript:history.back(); return false;">Вход</a>
</div>

<div class="main_content m_row">
<div class="login_form_social" style="padding:0;padding-bottom:20px;">
  <div class="login_form_social_title">
    Через соцсети (рекомендуем для новых покупателей)
  </div>
  <div class="login_form_social_btns">
    <a class="login_form_social_btn" href="/socnetauth2/vkontakte.php?first=1"><img src="/img/l_vk.png"></a>
    <a class="login_form_social_btn" href="/socnetauth2/facebook.php?first=1"><img src="/img/l_face.png"></a>
    <a class="login_form_social_btn" href="/socnetauth2/gmail.php?first=1"><img src="/img/l_google.png"></a>
    <a class="login_form_social_btn" href="/socnetauth2/mailru.php?first=1"><img src="/img/l_mail.png"></a>
  </div>

</div>
<div class="login_form_form" style="padding:0;padding-top:20px;">
  <div class="login_form_form_title">
    <div class="login_form_form_title_left">
      С помощью аккаунта boModa
    </div>
    <div class="login_form_form_title_right">
      <a class="login_link">Создать аккаунт</a>
    </div>
    <div class="clear"></div>
  </div>
  <form action="/login" id="login_form1" method="post" enctype="multipart/form-data">
    <div class="error">

    </div>

    <div class="login_form_line">
      <label for="input-email">E-Mail</label>
      <input type="text" name="email" id="input-email">
    </div>
    <div class="login_form_line">
      <label for="input-password">Пароль</label>
      <input type="password" name="password" value="" id="input-password">
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="login_form_line submit">
      <div class="login_form_line_left">
        <input type="submit" value="Войти">
      </div>
      <div class="login_form_line_right">
        <a class="forgot_link">Забыли пароль?</a>
      </div>
      <div class="clear"></div>
    </div>

  </form>
</div>
</div>
<?php echo $footer; ?>
<? } ?>
