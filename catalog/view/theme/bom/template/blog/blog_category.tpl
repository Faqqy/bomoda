<?php echo $header; ?>

<?
if($category_id==50)
{
    include 'includes/mainmenu.php';
    ?>
    <div class="mob_bread">
        <a onclick="javascript:history.back(); return false;"><?php echo $heading_title; ?></a>
    </div>

<div class="main_content m_row">
    <div class="main_title hidden_mobile">
        <?php echo $heading_title; ?>
    </div>
    <!--<div class="quest_search">
        <div class="form_form_line">
            <input type="text" placeholder="Ваш вопрос относительно …" />
        </div>
    </div>-->
    <div class="quest_blocks">
        <?php foreach($cats as $cat) { ?>
        <div class="quest_block">
            <div class="quest_block_in">
                <div class="quest_block_show">
                    <div class="quest_block_show_img">
                        <img src="img/<?=$cat['id']?>.png" />
                    </div>
                    <div class="quest_block_show_title">
                        <?=$cat['name']?>
                    </div>
                </div>
                <div class="quest_block_hidden">
                    <div class="quest_block_show_title">
                        <?=$cat['name']?>
                    </div>
                    <ul>
                        <? if($blogs) { ?>
                            <?php foreach ($blogs as $blog) { ?>
                                <?if($blog['category_id']==$cat['id']) { ?>
                                <li><a href="<?=$blog['href']?>"><?=$blog['title']?></a></li>
                        <? } ?>
                            <?}?>
                        <?}?>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>

        <? } ?>



        <div class="clear"></div>
    </div>
    <div class="line"></div>
    <div class="quest_btns">
        <div class="quest_btn quest_btn_mail">
            Остались вопросы ?<br/>
            - Напишите нам
            <div class="quest_btn_hidden">
                <div class="quest_btn_hidden_title">
                    Хотите задать вопрос?
                </div>
                <div class="quest_btn_hidden_text">
                    Воспользуйтесь формой обратной связи
                    на сайте или напишите нам в мессенджер
                    (звонки не поддерживаются)
                </div>
                <div class="line_small"></div>
                <a class="quest_btn_hidden_btn_call call_link">Форма обратной связи</a>
                <div class="line_small"></div>
                <div class="quest_btn_hidden_msgs">
                    <!--<div class="quest_btn_hidden_msg tele">
                        <div class="quest_btn_hidden_msg_left">
                            Telegram
                        </div>
                        <div class="quest_btn_hidden_msg_right">
                            <a href="">Связаться</a>
                        </div>
                    </div>-->
                    <div class="quest_btn_hidden_msg viber">
                        <div class="quest_btn_hidden_msg_left">
                            Viber
                        </div>
                        <div class="quest_btn_hidden_msg_right">
                            +7 (916) 682-66-00
                        </div>
                    </div>
                    <div class="quest_btn_hidden_msg what">
                        <div class="quest_btn_hidden_msg_left">
                            WhatsApp
                        </div>
                        <div class="quest_btn_hidden_msg_right">
                            +7 (916) 682-66-00
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="quest_mob_contact">
            <div class="quest_btn_hidden_title">
                Хотите задать вопрос?
            </div>
            <div class="quest_btn_hidden_text">
                Воспользуйтесь формой обратной связи
                на сайте или напишите нам в мессенджер
                (звонки не поддерживаются)
            </div>
            <div class="line_small"></div>
            <a class="quest_btn_hidden_btn_call call_link">Форма обратной связи</a>
            <div class="line_small"></div>
            <div class="quest_btn_hidden_msgs">
                <!--<div class="quest_btn_hidden_msg tele">
                    <div class="quest_btn_hidden_msg_left">
                        Telegram
                    </div>
                    <div class="quest_btn_hidden_msg_right">
                        <a href="">Связаться</a>
                    </div>
                </div>-->
                <div class="quest_btn_hidden_msg viber">
                    <div class="quest_btn_hidden_msg_left">
                        Viber
                    </div>
                    <div class="quest_btn_hidden_msg_right">
                        +7 (916) 682-66-00
                    </div>
                </div>
                <div class="quest_btn_hidden_msg what">
                    <div class="quest_btn_hidden_msg_left">
                        WhatsApp
                    </div>
                    <div class="quest_btn_hidden_msg_right">
                        +7 (916) 682-66-00
                    </div>
                </div>

            </div>

        </div>
        <div class="quest_btn quest_btn_phone">
            - Позвоните нам
            <div class="quest_btn_hidden">
                <div class="quest_btn_hidden_phone_title">
                    Круглосуточная поддержка
                </div>
                <div class="quest_btn_hidden_phone_block">
                    <div class="quest_btn_hidden_phone_block_phone">
                        +7 (499) 750-14-50
                    </div>
                    <div class="quest_btn_hidden_phone_block_desc">
                        Для звонков из Москвы
                    </div>

                </div>
                <div class="quest_btn_hidden_phone_block">
                    <div class="quest_btn_hidden_phone_block_phone">
                        8 800 333-14-48
                    </div>
                    <div class="quest_btn_hidden_phone_block_desc">
                        Бесплатные звонки из регионов
                    </div>

                </div>

            </div>
        </div>
        <div class="quest_mob_contact">
            <div class="quest_btn_hidden_phone_title">
                Круглосуточная поддержка
            </div>
            <div class="quest_btn_hidden_phone_block">
                <div class="quest_btn_hidden_phone_block_phone">
                    +7 (499) 750-14-50
                </div>
                <div class="quest_btn_hidden_phone_block_desc">
                    Для звонков из Москвы
                </div>

            </div>
            <div class="quest_btn_hidden_phone_block">
                <div class="quest_btn_hidden_phone_block_phone">
                    8 800 333-14-48
                </div>
                <div class="quest_btn_hidden_phone_block_desc">
                    Бесплатные звонки из регионов
                </div>

            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>

<? }
else
{
?>

<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <div class="blog">
		<h1><?php echo $heading_title; ?></h1>
  		
        <?php if ($blog_category_description) { ?>
		<div class="main_description">
		<?php echo $blog_category_description; ?>
		</div>
		<?php }
print_r($cats);
?>
        
  	<?php if($blogs){ ?>
		<div class="blog_grid_holder column-<?php echo $list_columns; ?>">
            
            <?php foreach ($blogs as $blog) { ?>
				<div class="blog_item">
                
                <div class="summary">
                <h2 class="blog_title"><a href="<?php echo $blog['href']; ?>"><?php echo $blog['category_name']; ?></a></h2>
                <div class="blog_stats">
                <?php if($author_status){ ?><span><i class="fa fa-user"></i><b class="text"><?php echo $text_posted_by; ?></b> <b class="hl"><?php echo $blog['author']; ?></b></span><?php } ?>
                <?php if($date_added_status){ ?><span><i class="fa fa-clock-o"></i><b class="text"><?php echo $text_posted_on; ?></b> <b class="hl"><?php echo $blog['date_added_full']; ?></b></span><?php } ?>
				<?php if($page_view_status){ ?><span><i class="fa fa-eye"></i><b class="text"><?php echo $text_read; ?></b> <b class="hl"><?php echo $blog['count_read']; ?></b></span><?php } ?>
				<?php if($comments_count_status){ ?><span><i class="fa fa-comments"></i><b class="text"><?php echo $text_comments; ?></b> <b class="hl"><?php echo $blog['comment_total']; ?></b></span><?php } ?>
                </div>
                <?php if($blog['image']){ ?>
                <div class="image">
				<a href="<?php echo $blog['href']; ?>"><img src="<?php echo $blog['image']; ?>" alt="<?php echo $blog['title']; ?>" title="<?php echo $blog['title']; ?>" /></a>
                </div>
				<?php } ?>
				<p><?php echo $blog['short_description']; ?></p>
                <p><a href="<?php echo $blog['href']; ?>"><?php echo $text_read_more; ?> <i class="fa fa-long-arrow-right"></i></a></p>
                </div>
               </div>
			<?php } ?>
            
          </div>
		<div class="row">
        <div class="col-sm-6 text-left"><?php echo $results; ?></div>
        <div class="col-sm-6 text-right"><?php echo $pagination; ?></div>
      </div>
	<?php }else{ ?>
		<?php echo $text_no_results; ?>
	<?php } ?>
    </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>

<? } ?>
<?php echo $footer; ?> 