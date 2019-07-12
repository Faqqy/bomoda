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
    <div class="order_list">
      <div class="tabs">

        <ul class="tabs__caption">
          <li class="active">Текущие заказы <?=$tek_count?></li>
          <li>Все заказы <?=$hist_count?></li>
          <div class="clear"></div>
        </ul>

        <div class="tabs__content active">
          <?if($tek_count==0) { ?>
          <div class="empty_order">
            <div class="empty_order_title">
              У вас на данный момент нет заказов
            </div>
            <div class="empty_order_text">
              Что бы сделать заказ на нашем сайте просто выберите товар, положите его в корзину и заполните краткую форму.
              Подробную инструкцию можно прочитать в разделе <a href="/users/of_order">«Как оформить заказ»</a>. Если у вас остались вопросы, просто
              позвоните нам по телефону 8 800 555 25 25.
            </div>
            <div class="empty_order_text_bottom">
              Приступайте к покупкам как можно скорее...
            </div>
            <div class="empty_order_btn">
              <a href="/platjya-sarafany" class="btn_blue">Перейти в покупкам</a>
            </div>

          </div>
          <? } else { ?>
          <div class="order_list_blocks">
            <? $c=1; foreach($orders as $order) { ?>
            <? if($order['status_id']==2) {
                  if($c==$tek_count)
                  $class='last';
                  else
                  $class='';

                  $c++;
                  ?>
            <? //print_r($order);?>
            <div class="order_list_block_mobile <?=$class?>">
              <div class="order_list_block_top_id">
                №<?=$order['order_id']?>
              </div>
              <div class="order_list_block_top_date">
                <?=$order['date_added']?>
              </div>
              <div class="order_list_block_top_status">
                <?=$order['status']?>
              </div>

            </div>
            <div class="order_list_block <?=$class?>">
              <div class="order_list_block_top">
                <div class="order_list_block_top_id">
                  №<?=$order['order_id']?>
                </div>
                <div class="order_list_block_top_price">
                  <?=number_format(str_replace('р.','',$order['total']),0,' ',' ')?> руб.
                </div>
                <div class="order_list_block_top_date">
                  <?=$order['date_added']?>
                </div>
                <div class="order_list_block_top_status">
                  <?=$order['status']?>
                </div>

                <div class="clear"></div>
              </div>
              <div class="order_list_block_bottom">
                <div class="order_list_block_bottom_left">
                  <?foreach($order['products_order'] as $k=>$product) { ?>
                  <?if($k==5) break;?>
                  <a href="<?=$product['href']?>" class="order_list_block_product" style="background:url(/image/<?=$product['image']?>)">
                  </a>


                  <? } ?>
                  <?if(count($order['products_order'])>5) { ?>
                  <div class="order_list_block_product_more">
                    +<?=count($order['products_order'])-5?>
                  </div>
                  <? } ?>
                </div>

                  <div class="order_list_block_bottom_right">
                    <div class="order_list_block_bottom_right_btn">
                      <a href="<?//=$order['view']?>" class="btn_blue">Подробнее о заказе</a>
                    </div>
                  </div>

                  <div class="clear"></div>

              </div>
            </div>
              <? } ?>

            <? } ?>
            <div class="clear"></div>
          </div>

          <? } ?>
        </div>

        <div class="tabs__content">
          <?if($hist_count==0) { ?>
          <div class="empty_order">
            <div class="empty_order_title">
              У вас на данный момент нет заказов
            </div>
            <div class="empty_order_text">
              Что бы сделать заказ на нашем сайте просто выберите товар, положите его в корзину и заполните краткую форму.
              Подробную инструкцию можно прочитать в разделе <a href="/users/of_order">«Как оформить заказ»</a>. Если у вас остались вопросы, просто
              позвоните нам по телефону 8 800 555 25 25.
            </div>
            <div class="empty_order_text_bottom">
              Приступайте к покупкам как можно скорее...
            </div>
            <div class="empty_order_btn">
              <a href="/platjya-sarafany" class="btn_blue">Перейти в покупкам</a>
            </div>

          </div>
          <? } else { ?>
          <div class="order_list_blocks">
            <? $c=1; foreach($orders as $order) { ?>
            <? if($order['status_id']!=2) {
                  if($c==$hist_count)
                  $class='last';
                  else
                  $class='';

                  $c++;

                  $status_class='grey';
                  if($order['status_id']=='3')
                    $status_class='green';
                  if($order['status_id']=='7')
                    $status_class='red';

                  ?>
            <? //print_r($order);?>

            <div class="order_list_block_mobile <?=$class?>">
              <div class="order_list_block_top_id">
                №<?=$order['order_id']?>
              </div>
              <div class="order_list_block_top_date">
                <?=$order['date_added']?>
              </div>
              <div class="order_list_block_top_status">
                <?=$order['status']?>
              </div>
              <div class="clear"></div>
              <a href="<?//=$order['view']?>" class="btn_blue">Подробнее о заказе</a>
              <div class="clear"></div>

            </div>
            <div class="order_list_block <?=$class?>">
              <div class="order_list_block_top">
                <div class="order_list_block_top_id">
                  №<?=$order['order_id']?>
                </div>
                <div class="order_list_block_top_price">
                  <?=number_format(str_replace('р.','',$order['total']),0,' ',' ')?> руб.
                </div>
                <div class="order_list_block_top_date">
                  <?=$order['date_added']?>
                </div>
                <div class="order_list_block_top_status <?=$status_class?>">
                  <?=$order['status']?>
                </div>

                <div class="clear"></div>
              </div>
              <div class="order_list_block_bottom">
                <div class="order_list_block_bottom_left">
                  <?foreach($order['products_order'] as $k=>$product) { ?>
                  <?if($k==5) break;?>
                  <a href="<?=$product['href']?>" class="order_list_block_product" style="background:url(/image/<?=$product['image']?>)">
                  </a>


                  <? } ?>
                  <?if(count($order['products_order'])>5) { ?>
                  <div class="order_list_block_product_more">
                    +<?=count($order['products_order'])-5?>
                  </div>
                  <? } ?>
                </div>

                <div class="order_list_block_bottom_right">
                  <div class="order_list_block_bottom_right_btn">
                    <a href="<?//=$order['view']?>" class="btn_blue">Подробнее о заказе</a>
                  </div>
                </div>

                <div class="clear"></div>

              </div>
            </div>
            <? } ?>

            <? } ?>
            <div class="clear"></div>
          </div>
          <? } ?>

        </div>

      </div><!-- .tabs-->
    </div>

  </div>


  <div class="clear"></div>
</div>


<?if($user['change_pass']!=1) { ?>
<div class="m_form" id="pass_form" style="display:block;">
  <div class="login_form_title">
    Изменить пароль
  </div>

  <div class="login_form_form">

    <form action="/change-password" method="post" enctype="multipart/form-data" class="form-horizontal">
      <div class="error">

      </div>
      <div class="password_form_line">
        <label for="input-password">Введите новый пароль</label>
        <input type="password" name="input-password" value="" placeholder="Пароль" id="input-password" class="form-control">

      </div>
      <div class="password_form_line">
        <label for="input-confirm">Повторите пароль</label>
        <input type="password" name="input-confirm" value="" placeholder="Подтвердите пароль" id="input-confirm" class="form-control">

      </div>
      <div class="password_form_line submit">
        <input type="submit" value="Сохранить изменения" class="btn_blue">
      </div>


    </form>
  </div>
  <div class="close"></div>
</div>
<div class="over_all" style="display:block;"></div>
<?}?>
<?php echo $footer; ?>









