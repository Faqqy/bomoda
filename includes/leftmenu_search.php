<? //print_R($categories);

?>
<div class="left">
    <div class="left_menu" style="padding-top:30px;">
        <ul>

            <?foreach($menu as $m) { ?>
                <?
                if($m['items'])
                {
                ?>
                    <li class="s_m_title"><?=$m['name']?></li>
                    <?foreach($m['items'] as $link) { ?>
                        <li><a href="<?=$link['href']?>"><?=$link['name']?></a></li>
                    <? } ?>

                <? } ?>
            <? } ?>
        </ul>
    </div>
</div>
