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
    <a href="/">Регистрация</a>
</div>

<div class="main_content m_row">
    <script type="text/javascript">

        var startSimpleInterval = window.setInterval(function(){
            if (typeof jQuery !== 'undefined' && typeof Simplepage === "function" && jQuery.isReady) {
                window.clearInterval(startSimpleInterval);

                var simplepage = new Simplepage({
                    additionalParams: "",
                    additionalPath: "",
                    mainUrl: "index.php?route=account/simpleregister",
                    mainContainer: "#simplepage_form",
                    useAutocomplete: 0,
                    useGoogleApi: 0,
                    loginLink: "http://bomoda.ru/login",
                    scrollToError: 1,
                    notificationDefault: 1,
                    notificationToasts: 0,
                    notificationCheckForm: 0,
                    notificationCheckFormText: "",
                    languageCode: "ru-ru",
                    popup: 0,
                    javascriptCallback: function() {$('#cart > ul').load('index.php?route=common/cart/info ul li');
                    /*$('nav#top').load('index.php?route=common/simple_connector/header #top > div');*/}
                });

                if (typeof toastr !== 'undefined') {
                    toastr.options.positionClass = "toast-top-right";
                    toastr.options.timeOut = "5000";
                    toastr.options.progressBar = true;
                }

                simplepage.init();
            }
        },0);
    </script>

    <div class="mob_reg_page">

        <form action="index.php?route=account/simpleregister" method="post" enctype="multipart/form-data" id="simplepage_form">
            <div class="simpleregister" id="simpleregister">

                <div class="simpleregister-block-content">

                    <div class="form-group required row-register_email login_form_line">
                        <label  for="register_email">Введите ваш e-mail</label>

                        <input class="form-control" type="email" name="register[email]" id="register_email" value="" placeholder="info@gmail.com" data-reload-payment-form="true">
                        <div class="simplecheckout-rule-group" data-for="register_email">
                            <div style="display:none;" data-for="register_email" data-rule="api" class="simplecheckout-error-text simplecheckout-rule" data-method="checkEmailForUniqueness" data-filter="register_register" data-filter-value="1" data-required="true">Адрес уже зарегистрирован!</div>
                            <div style="display:none;" data-for="register_email" data-rule="regexp" class="simplecheckout-error-text simplecheckout-rule" data-regexp=".+@.+" data-required="true">Неверно указан e-mail</div>
                        </div>
                    </div>
                    <div class="form-group required row-register_password login_form_line">
                        <label for="register_password">Придумайте пароль (не короче 6 символов)</label>

                        <input class="form-control" type="password" data-validate-on="keyup" name="register[password]" id="register_password" value="" placeholder="Придумайте пароль" data-reload-payment-form="true">
                        <div class="simplecheckout-rule-group" data-for="register_password">
                            <div style="display:none;" data-for="register_password" data-rule="byLength" class="simplecheckout-error-text simplecheckout-rule" data-length-min="6" data-length-max="20" data-required="true">Минимальная длина пароля 6 символов</div>
                        </div>

                    </div>
                    <div class="form-group required row-register_confirm_password login_form_line">
                        <label for="register_confirm_password">Повторите пароль</label>

                        <input class="form-control" type="password" data-validate-on="keyup" name="register[confirm_password]" id="register_confirm_password" value="" placeholder="Повторите пароль" data-reload-payment-form="true">
                        <div class="simplecheckout-rule-group" data-for="register_confirm_password">
                            <div style="display:none;" data-for="register_confirm_password" data-rule="equal" class="simplecheckout-error-text simplecheckout-rule" data-equal="register_password" data-required="true">Пароли не совпадают</div>
                        </div>

                    </div>
                    <div class="form-group  row-register_firstname login_form_line">
                        <label for="register_firstname">Ваше имя</label>

                        <input class="form-control" type="text" name="register[firstname]" id="register_firstname" value="" placeholder="Ваше имя" data-reload-payment-form="true">
                        <div class="simplecheckout-rule-group" data-for="register_firstname">
                            <div style="display:none;" data-for="register_firstname" data-rule="byLength" class="simplecheckout-error-text simplecheckout-rule" data-length-min="1" data-length-max="32">Имя должно быть от 1 до 32 символов!</div>
                        </div>

                    </div>

                    <input type="hidden" name="register[country_id]" id="register_country_id" value="176">
                    <input type="hidden" name="register[zone_id]" id="register_zone_id" value="46">
                    <input type="hidden" name="register[city]" id="register_city" value="">
                    <input type="hidden" name="register[postcode]" id="register_postcode" value="">
                    <input type="hidden" name="register[current_address_id]" id="register_current_address_id" value="0">                            </div>


                <div class="login_form_line submit">

                    <a class="" data-onclick="submit" id="simpleregister_button_confirm"><span>Зарегистрироваться</span></a>

                </div>
            </div>
        </form>
    </div>
</div>
<?php echo $footer; ?>
<? } ?>
