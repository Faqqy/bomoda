<? //print_R($categories);

//print_R($path);
//print_r($_SERVER['REQUEST_URI']);
?>
<div class="left">
    <div class="left_menu_account">
        <ul>
            <li <?if($_SERVER['REQUEST_URI']=='/order-history') echo 'class="active"'?>><a href="/order-history">Мои заказы</a></li>
            <li <?if($_SERVER['REQUEST_URI']=='/wishlist') echo 'class="active"'?>><a href="/wishlist">Избранное</a></li>
            <li <?if($_SERVER['REQUEST_URI']=='/index.php?route=account/simpleedit') echo 'class="active"'?>><a href="/index.php?route=account/simpleedit">Моя информация</a></li>
            <li <?if($_SERVER['REQUEST_URI']=='/change-password') echo 'class="active"'?>><a href="/change-password">Изменить пароль</a></li>
            <li <?if(strpos($_SERVER['REQUEST_URI'],'account/simpleaddress/update')!==false) echo 'class="active"'?>><a href="/address-book">Адрес доставки</a></li>
            <li <?if($_SERVER['REQUEST_URI']=='/reward-points') echo 'class="active"'?>><a href="/reward-points">Мои скидки</a></li>
            <li <?if($_SERVER['REQUEST_URI']=='/index.php?route=account/simpleedit&flag=pod') echo 'class="active"'?>><a href="/index.php?route=account/simpleedit&flag=pod">Подписки</a></li>


        </ul>
    </div>
</div>

