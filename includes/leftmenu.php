<? //print_R($categories);

//print_R($path);
?>
<div class="left cat_left">
    <div class="left_menu">
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
