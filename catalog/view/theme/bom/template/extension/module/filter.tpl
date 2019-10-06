<div class="catalog_filter">
  <div class="clear"></div>

  <div class="catalog_filter_values">
  </div>
  <div class="catalog_filters">

    <?php $flag=false; foreach ($filter_groups as $i=>$filter_group) { //print_r($filter_group); ?>
    <div class="catalog_filter_value1" filter-id="<?php echo $filter_group['filter_group_id']; ?>">
    </div>
    <div class="catalog_filters_block" filter-id="<?php echo $filter_group['filter_group_id']; ?>" data-name="<?php echo $filter_group['name']; ?>">
      <span class="hidden_mobile"><?php echo $filter_group['name']; ?></span>
        <div class="title_filter_mob show_mobile"><?php echo $filter_group['name']; ?></div>
      <div class="catalog_filters_block_check">
        <?php foreach ($filter_group['filter'] as $j=>$filter) { ?>
        <label>
          <?php if (in_array($filter['filter_id'], $filter_category)) { $flag=true; ?>
          <input type="checkbox" name="filter[]" filter-id="<?php echo $filter['filter_id']; ?>" value="<?php echo $filter['filter_id']; ?>" checked="checked" />
          <?php echo $filter['name']; ?>
          <?php } else { ?>
          <input type="checkbox" name="filter[]" filter-id="<?php echo $filter['filter_id']; ?>" value="<?php echo $filter['filter_id']; ?>" />
          <?php echo $filter['name']; ?>
          <?php } ?>
        </label>
        <? } ?>
        <hr>
        <a class="send_filter">Применить</a>
      </div>
    </div>

    <? } ?>
    <?if($flag) { ?>
    <?$url=explode('&', $_SERVER['REQUEST_URI'], 2);?>
    <a class="btn_clear_filter" href="<?=$url[0];?>">Очистить фильтр</a>
    <? } ?>

    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>





<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	filter = [];

	$('input[name^=\'filter\']:checked').each(function(element) {
		filter.push(this.value);
	});

	location = '<?php echo $action; ?>&filter=' + filter.join(',');
});

jQuery(document).ready(function(){

    jQuery('.send_filter').click(function(){
        jQuery('.catalog_filters_block_check input').each(function(){

            var s=0;
            var t=jQuery(this);
            console.log(t.parent().parent().parent());
            t.parent().parent().parent().children('label').each(function(){
                console.log(1);
                if(jQuery(this).children().children('input').prop('checked'))
                {

                    s=s+1;
                }
            });
            console.log(t.parent().parent().parent().parent().attr('filter-id'));
            if(s>0)
            {
                //console.log('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]');
                //jQuery('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').append('123456');
                /*jQuery('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').html('' +
                    '<div class="catalog_filter_value" filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'">' +
                    '<div class="catalog_filter_value_title">' +t.parent().parent().parent().parent().attr('data-name')+' ('+s+')'+
                    '</div>' +
                    '<div class="catalog_filter_value_delete" filter-del="'+t.parent().parent().parent().parent().attr('filter-id')+'">' +
                    '</div>' +
                    '</div>' +
                    ''
                );*/
                jQuery(this).parent().parent().addClass('active');
            }
            else
            {
                jQuery('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').html('');
            }

            addDel();
            /*if(jQuery(this).prop('checked'))
            {
                jQuery('.catalog_filter_values').append('' +
                    '<div class="catalog_filter_value" filter-id="'+jQuery(this).attr('filter-id')+'">' +
                    '<div class="catalog_filter_value_title">' +jQuery(this).parent().parent().parent().parent().children('span').text()+' '+jQuery(this).parent().parent().text()+
                    '</div>' +
                    '<div class="catalog_filter_value_delete" filter-del="'+jQuery(this).attr('filter-id')+'">' +
                    '</div>' +
                    '</div>' +
                    ''
                );
                addDel();

            }
            else
            {
                jQuery('.catalog_filter_values [filter-id="'+jQuery(this).attr('filter-id')+'"]').remove();
            }*/
        });

        setTimeout(function(){
            filter = [];

            jQuery('input[name^=\'filter\']:checked').each(function(element) {
                filter.push(this.value);
            });

            location = '<?php echo $action; ?>&filter=' + filter.join(',');

        },300);


    });



    jQuery('.catalog_filters_block_check input').change(function(){
      /*setTimeout(function(){
          filter = [];

          jQuery('input[name^=\'filter\']:checked').each(function(element) {
              filter.push(this.value);
          });

          location = '<?php echo $action; ?>&filter=' + filter.join(',');

      },300);*/
    });
    jQuery('.catalog_filter_value_delete').click(function(){
        setTimeout(function(){
            filter = [];

            jQuery('input[name^=\'filter\']:checked').each(function(element) {
                filter.push(this.value);
            });

            location = '<?php echo $action; ?>&filter=' + filter.join(',');

        },300);
    });
});
//--></script>
