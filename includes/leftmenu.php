<? //print_R($categories);

//print_R($path);
print_R($child);


?>
<div class="left cat_left">
    <div class="left_menu">

    <ul>

            <?foreach($categories as $category) { ?>
                <?if($category['id']==$path) { ?>

                        <li class="active"><a href="<?=$category['href']?>"><?=$category['name']?></a></li>



                    <? } else { ?>
                    <li><a href="<?=$category['href']?>"><?=$category['name']?></a></li>
                    <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>


                    <? } ?>
            <? } ?>



<!--        <div class="list-group">-->
<!--            --><?php //foreach ($categories as $category) { ?>
<!--                --><?php //if ($category['category_id'] == $category_id) { ?>
<!--                    <a href="--><?php //echo $category['href']; ?><!--" class="list-group-item active">--><?php //echo $category['name']; ?><!--</a>-->
<!--                    --><?php //if ($category['children']) { ?>
<!--                        --><?php //foreach ($category['children'] as $child) { ?>
<!--                            --><?php //if ($child['category_id'] == $child_id) { ?>
<!--                                <a href="--><?php //echo $child['href']; ?><!--" class="list-group-item active">&nbsp;&nbsp;&nbsp;- --><?php //echo $child['name']; ?><!--</a>-->
<!--                            --><?php //} else { ?>
<!--                                <a href="--><?php //echo $child['href']; ?><!--" class="list-group-item">&nbsp;&nbsp;&nbsp;- --><?php //echo $child['name']; ?><!--</a>-->
<!--                            --><?php //} ?>
<!--                            --><?php //if($child['children']) { ?>
<!--                                --><?php //foreach($child['children'] as $child_1){?>
<!--                                    <a href="--><?php //echo $child_1['href']; ?><!--" class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- --><?php //echo $child_1['name']; ?><!--</a>-->
<!--                                --><?php //}?>
<!--                            --><?php //}?>
<!--                        --><?php //} ?>
<!--                    --><?php //} ?>
<!--                --><?php //} else { ?>
<!--                    <a href="--><?php //echo $category['href']; ?><!--" class="list-group-item">--><?php //echo $category['name']; ?><!--</a>-->
<!--                --><?php //} ?>
<!--            --><?php //} ?>
<!--        </div>-->

    </ul>
<!--            <ul> --><?php //foreach ($categories as $category) : echo '<li><a href="'.$category['href'].'">'.$category['name'].'</a>'; if (!empty($category['children'])) : echo '<ul>'; foreach ($category['children'] as $category_level2) : echo '<li><a href="'.$category_level2['href'].'">'.$category_level2['name'].'</a>'; if (!empty($category_level2['children'])) : echo '<ul>'; foreach ($category_level2['children'] as $category_level3) : echo '<li><a href="'.$category_level3['href'].'">'.$category_level3['name'].'</a></li>'; endforeach; echo '</ul>'; endif; echo '</li>'; endforeach; echo '</ul>'; endif; echo '</li>'; endforeach; echo '</ul>'; ?>

<!--        --><?php //foreach ($categories as $category) {  ?>
<!--            <li><a href="--><?php //echo $category['href']; ?><!--">--><?php //echo $category['name']; ?><!--</a>-->
<!--                --><?php //if ($category['children']) { ?>
<!--                    <div>-->
<!--                        --><?php //for ($i = 0; $i < count($category['children']);) { ?>
<!--                            <ul class="level2">-->
<!--                                --><?php //$j = $i + ceil(count($category['children']) / $category['column']); ?>
<!--                                --><?php //for (; $i < $j; $i++) { ?>
<!--                                    --><?php //if (isset($category['children'][$i]))
//                                    {
//                                        ?>
<!--                                        <li><a href="--><?php //echo $category['children'][$i]['href']; ?><!--" class="">--><?php //echo $category['children'][$i]['name']; ?><!--</a>-->
<!--                                            --><?php //if (isset($category['children'][$i]['level3'])) {
//                                                $level3menus = $category['children'][$i]['level3'];
//                                                ?>
<!--                                                <ul class="level3">-->
<!--                                                    --><?php
//                                                    foreach( $level3menus as $level3menu) {
//                                                        ?>
<!--                                                        <li><a href="--><?php //echo $level3menu['href']; ?><!--" class="">--><?php //echo $level3menu['name'];?><!--</a></li>-->
<!--                                                    --><?php //} ?>
<!--                                                </ul>-->
<!--                                            --><?php //} ?>
<!--                                        </li>-->
<!--                                    --><?php //} ?>
<!--                                --><?php //} ?>
<!--                            </ul>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                --><?php //} ?>
<!--            </li>-->
<!--        --><?php //} ?>





    </div>
</div>
