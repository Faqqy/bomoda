<? //print_R($categories);

//print_R($path);
?>
<div class="cat_left_mobile show_mobile">
    <div class="left_menu_mobile">
        <ul>

            <?foreach($categories as $cat) { ?>
                <?if($cat['id']==$path) { ?>
                        <li class="active"><a href="<?=$cat['href']?>"><?=$cat['name']?></a></li>
                    <? } else { ?>
                    <li><a href="<?=$cat['href']?>"><?=$cat['name']?></a></li>
                    <? } ?>
            <? } ?>
        </ul>
    </div>
</div>
