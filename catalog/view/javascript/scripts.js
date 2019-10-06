jQuery(document).ready(function(){
    setCar();
    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 200) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }

        // if (jQuery(this).scrollTop() > 255) {
        //     /*console.log(jQuery(document).scrollTop());
        //     console.log(jQuery(document).outerHeight());*/
        //     if(jQuery(document).width()>700)
        //     jQuery('.cat_sort_filter').addClass('fixed');
        //     jQuery('.left').addClass('fixed');
        //     jQuery('.cat_sort_filter_in').show();
        //     if(jQuery(document).scrollTop()>jQuery(document).outerHeight()-1000)
        //     {
        //         jQuery('.left.cat_left').addClass('fixed_bottom');
        //     }
        //     else
        //     {
        //         jQuery('.left.cat_left').removeClass('fixed_bottom');
        //     }
        // } else {
        //     jQuery('.cat_sort_filter').removeClass('fixed');
        //     jQuery('.left').removeClass('fixed');
        //     jQuery('.cat_sort_filter_in').hide();
        // }





        // SVG


        $('img.img-svg').each(function(){
            var $img = $(this);
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');
            $.get(imgURL, function(data) {
                var $svg = $(data).find('svg');
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                    $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                }
                $img.replaceWith($svg);
            }, 'xml');
        });
        // END SVG
        });
          
        jQuery('.scrollup').click(function(){
        jQuery("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });


    jQuery('.btn_show_cat').click(function(){
        jQuery('.cat_sort_filter').hide();
        if(jQuery('.left_menu_mobile').css('display')=='none')
        {
            jQuery('.left_menu_mobile').slideDown();
            jQuery(this).addClass('active');
        }
        else
        {
            jQuery('.left_menu_mobile').slideUp();
            jQuery(this).removeClass('active');

        }

    });
    jQuery('.btn_show_filter').click(function(){
        jQuery('.left_menu_mobile').hide();
        if(jQuery('.cat_sort_filter').css('display')=='none')
        {
            jQuery('.cat_sort_filter').slideDown();
            jQuery(this).addClass('active');
        }
        else
        {
            jQuery('.cat_sort_filter').slideUp();
            jQuery(this).removeClass('active');

        }

    });





    jQuery('.s_btn_sot').click(function(e){
        e.preventDefault();
        jQuery("html, body").animate({ scrollTop: jQuery('.main_sotr_form').offset().top }, 600);
    });
    jQuery('.main_menu_left>ul>li').mouseenter(function() {
        timer = setTimeout(function () {
            jQuery(this).children('ul').show();
          }, 300);
    });
    jQuery('.main_menu_left>ul>li').mouseleave(function(){
        timer = setTimeout(function () {
            jQuery(this).children('ul').hide();
         }, 300);
    });


	
	jQuery('.input_phone,input[name="sob_input[4][Телефон]"]').mask('+7(999) 999 99 99');
	jQuery('input[name="sob_input[4][Телефон]"]').attr('placeholder',"+7(___) ___ __ __");
	jQuery('.sotr_form input[type="submit"]').attr('value','Отправить');
	jQuery('.form_form_line select').styler();
	jQuery('.form_form_line input[type="radio"]').styler();

	


    jQuery('.catalog_filters_block_check input[type="checkbox"]').styler();
	
	jQuery('.over_all,.close,.btn_return').click(function(){
		jQuery('.m_form').hide();
		jQuery('.over_all').hide();
            jQuery('body').removeClass('body_modal');

	});


	jQuery('.call_link').click(function(){
				var date = new Date();






		


// час в текущей временной зоне

        var h=date.getHours();
        var m=date.getMinutes();
        jQuery('#time_call,select[name="sob_input[3][Время]"]').children().remove();

        jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="0"></option>');
        if(m<45)
        {
            if(m>0&&m<15)
            {

                jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+h+':15'+'">'+h+':15'+'</option>');
                jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+h+':30'+'">'+h+':30'+'</option>');
                jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+h+':45'+'">'+h+':45'+'</option>');
            }
            else
            {
                if(m>15&&m<30)
                {
                    jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+h+':30'+'">'+h+':30'+'</option>');
                    jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+h+':45'+'">'+h+':45'+'</option>');
                }
                else
                {
                    if(m>30)
                    jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+h+':45'+'">'+h+':45'+'</option>');
                }
            }

        }
        h=h+1;
        for(i=h;i<24;i++)
        {
            jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+i+':00'+'">'+i+':00'+'</option>');
            jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+i+':15'+'">'+i+':15'+'</option>');
            jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+i+':30'+'">'+i+':30'+'</option>');
            jQuery('#time_call,select[name="sob_input[3][Время]"]').append('<option value="'+i+':45'+'">'+i+':45'+'</option>');

        }
        jQuery('.form_form_line select').trigger('refresh');
		jQuery('#call_form').show();
		jQuery('.over_all').show();
		jQuery('html, body').animate({ scrollTop: 0 }, 500); // анимируем скроолинг к элементу scroll_el
	});

	jQuery('.show_form').click(function(e){
	    e.preventDefault();
        jQuery('.over_all, '+jQuery(this).attr('href')).show();

    });
	
	
  jQuery('.go_to').click( function(e){ // ловим клик по ссылке с классом go_to
      e.preventDefault();
	var scroll_el = jQuery(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
        if (jQuery(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
	    jQuery('html, body').animate({ scrollTop: jQuery(scroll_el).offset().top }, 500); // анимируем скроолинг к элементу scroll_el
        }
	    return false; // выключаем стандартное действие
    });	
	
	
	jQuery('.all_city').click(function(e){
		e.preventDefault();
		if(jQuery('.cities.hide1').css('display')=='none')
		{
			jQuery('.cities.hide1').slideDown();

		}
		else
		{
			jQuery('.cities.hide1').slideUp();
		}
	});
	jQuery('.how_block_title').click(function(){
		if(jQuery(this).next().css('display')=='none')
		{
			jQuery(this).next().slideDown();
			jQuery(this).addClass('active');
		}
		else
		{
			jQuery(this).next().slideUp();
			jQuery(this).removeClass('active');
		}
	});


	jQuery('.catalog_top_sort_block span').click(function(){
	    jQuery('.catalog_top_sort_block_title>span').text(jQuery(this).text());
    });

	jQuery('.catalog_filters_block_check input').change(function(){

        /*var s=0;
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
            jQuery('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').html('' +
                '<div class="catalog_filter_value" filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'">' +
                '<div class="catalog_filter_value_title">' +t.parent().parent().parent().parent().attr('data-name')+' ('+s+')'+
                '</div>' +
                '<div class="catalog_filter_value_delete" filter-del="'+t.parent().parent().parent().parent().attr('filter-id')+'">' +
                '</div>' +
                '</div>' +
                ''
            );
        }
        else
        {
            jQuery('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').html('');
        }

        addDel();*/

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



    jQuery('.catalog_filters_block_check input').each(function(){

        var s=0;
        var t=jQuery(this);
        //console.log(t.parent().parent().parent());
        t.parent().parent().parent().children('label').each(function(){
            //console.log(1);
            if(jQuery(this).children().children('input').prop('checked'))
            {

                s=s+1;
            }
        });
        //console.log(t.parent().parent().parent().parent().attr('filter-id'));
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
            jQuery('.catalog_filters_block[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').addClass('active');
            jQuery('.catalog_filters_block[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').children('span').html(t.parent().parent().parent().parent().attr('data-name')+' ('+s+')');
            jQuery('.catalog_filters_block[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').children('.title_filter_mob').html(t.parent().parent().parent().parent().attr('data-name')+' ('+s+')');
            console.log(s);
            if(jQuery('.catalog_filters_block_del[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').length>0)
            {

            }
            else {
                jQuery('.catalog_filters_block[filter-id="' + t.parent().parent().parent().parent().attr('filter-id') + '"]').after('<div class="catalog_filters_block_del" filter-id="' + t.parent().parent().parent().parent().attr('filter-id') + '">Очистить</div>');
            }
        }
        else
        {
            jQuery('.catalog_filter_value1[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').html('');
            //jQuery('.catalog_filters_block[filter-id="'+t.parent().parent().parent().parent().attr('filter-id')+'"]').show();
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

	jQuery('.get_cart').click(function(e){
	    e.preventDefault();
        jQuery.ajax({
            url: '/index.php?route=checkout/mycart/sendmailCustom',
            type: 'post',
            data: '',
            //dataType: 'json',
            beforeSend: function() {
                console.log('отослано');
            },
            success: function(json) {
                //console.log(json);
                jQuery('#addcart_form').html(json);
                jQuery('#addcart_form,.over_all').show();
                //jQuery('#resp').html(json['test1']);
            }
        });	    

    });

    jQuery('ul.tabs__caption1').on('click', 'li:not(.active)', function() {
        jQuery(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.tabs1').find('div.tabs__content1').removeClass('active').eq(jQuery(this).index()).addClass('active');
    });

    jQuery('ul.tabs__caption').on('click', 'li:not(.active)', function() {
        jQuery(this)
            .addClass('active').siblings().removeClass('active')
            .closest('div.tabs').find('div.tabs__content').removeClass('active').eq(jQuery(this).index()).addClass('active');
    });


    jQuery('.catalog_item_quick').click(function(e){
        jQuery('body').addClass('body_modal');
        e.preventDefault();
        jQuery.ajax({
            url: '/index.php?route=checkout/mycart/getProduct',
            type: 'post',
            data: {
                'product_id':jQuery(this).attr('data-id')
            },
            //dataType: 'json',
            beforeSend: function() {
                console.log('отослано');
            },
            success: function(json) {
                //console.log(json);

                jQuery('#view_form').html(json);
                setTimeout(function(){
                    var image_top=jQuery('.view_form_images').offset().top;
                    var desc_top=jQuery('.view_form_desc').offset().top;
                    var slider_top=jQuery('.view_form_desc').offset().top;

                    jQuery('.view_form_in .go_to').click( function(e){ // ловим клик по ссылке с классом go_to

                        e.preventDefault();
                        var scroll_el = jQuery(this).attr('href'); // возьмем содержимое атрибута href, должен быть селектором, т.е. например начинаться с # или .
                        if (jQuery(scroll_el).length != 0) { // проверим существование элемента чтобы избежать ошибки
                            if(scroll_el=='.view_form_images')
                            {
                                jQuery('.view_form_in').animate({ scrollTop: image_top-190 }, 500); // анимируем скроолинг к элементу scroll_el
                            }
                            if(scroll_el=='.view_form_desc')
                            {
                                jQuery('.view_form_in').animate({ scrollTop: desc_top-270 }, 500); // анимируем скроолинг к элементу scroll_el
                            }
                            if(scroll_el=='.view_form_slider')
                            {
                                jQuery('.view_form_in').animate({ scrollTop: slider_top+210 }, 500); // анимируем скроолинг к элементу scroll_el
                            }

                            /*else
                            {
                                jQuery('.view_form_in').animate({ scrollTop: jQuery(scroll_el).offset().top }, 500); // анимируем скроолинг к элементу scroll_el
                            }*/

                        }

                        return false; // выключаем стандартное действие
                    });
                    jQuery('.view_form_in').scroll(function(){
                        /*console.log(jQuery(this).scrollTop());
                        console.log(jQuery(this).prop("scrollHeight"));
                        console.log(jQuery(this).outerHeight());*/
                        //console.log(slider_top);
                        if(jQuery(this).scrollTop()>=jQuery(this).prop("scrollHeight")-jQuery(this).outerHeight())
                        {
                            jQuery('.view_form_bottom_left a').removeClass('active');
                            jQuery('.view_form_bottom_left a[href=".view_form_slider"]').addClass('active');
                        }
                        else
                        {
                            if(jQuery(this).scrollTop()<400)
                            {
                                jQuery('.view_form_bottom_left a').removeClass('active');
                                jQuery('.view_form_bottom_left a[href=".view_form_images"]').addClass('active');

                            }
                            else
                            {
                                jQuery('.view_form_bottom_left a').removeClass('active');
                                jQuery('.view_form_bottom_left a[href=".view_form_desc"]').addClass('active');

                            }

                        }

                    });

                    setCar();
                },100);

                jQuery('.over_all,.close').click(function(){
                    jQuery('.m_form').hide();
                    jQuery('.over_all').hide();
                    jQuery('body').removeClass('body_modal');
                });







                jQuery('#view_form,.over_all').show();
                jQuery('.form_form_line select').styler();

                jQuery('.modal_add_cart').click(function(e){
                    jQuery('body').removeClass('body_modal');
                    e.preventDefault();
                    var data1=new Object();
                    data1['product_id']=jQuery(this).attr('data-id');
                    data1['quantity']=1;
                    jQuery('.modal_options').each(function(){
                        data1[jQuery(this).attr('name')]=jQuery(this).val();
                    });
                    //data1['option[232]']=32;
                    //cart.add(data1);
                    $.ajax({
                        url: 'index.php?route=checkout/cart/add',
                        type: 'post',
                        data: data1,
                        dataType: 'json',

                        success: function(json) {
                            if (json['success']) {


                                $('.breadcrumb').after('<div class="alert alert-success">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                                $('#cart-total').html(json['total']);
                                $('#header_cart').html(json['total']);




                                $('#cart > ul').load('index.php?route=common/cart/info ul li');
                                $.ajax({
                                    url: '/index.php?route=checkout/mycart/sendmailCustom',
                                    type: 'post',
                                    data: '',
                                    //dataType: 'json',
                                    beforeSend: function() {
                                        console.log('отослано');
                                    },
                                    success: function(json) {
                                        //console.log(json);
                                        $('#addcart_form').html(json);
                                        $('.m_form').hide();
                                        $('#addcart_form,.over_all').show();
                                        $('.over_all,.close,.btn_return').click(function(){
                                            $('.m_form').hide();
                                            $('.over_all').hide();
                                        });
                                    }
                                });
                            }
                            else
                            {
                                //console.log(json['error'].option.val());
                                for (var key in json['error'].option) {
                                    console.log(key);
                                    console.log(json['error'].option[key]);
                                    jQuery('select[name="option['+key+']"]').parent().parent().append('<div class="text-danger">Размер обязательно!</div>');
                                }
                            }

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });

                    //console.log(data1);
                });
                /*jQuery('.over_all,.close,.btn_return').click(function(){
                    jQuery('.m_form').hide();
                    jQuery('.over_all').hide();
                });*/
            }
        });        
    });



	jQuery('.cart_table_plus').click(function(){
	    jQuery(this).prev().val(parseInt(jQuery(this).prev().val())+1);
	    var t=jQuery(this);
        setTimeout(function(){
            t.next().click();
        },500);
    });
    jQuery('.cart_table_minus').click(function(){
        if(parseInt(jQuery(this).next().val())>1)
        {
            jQuery(this).next().val(parseInt(jQuery(this).next().val())-1);
            var t=jQuery(this);
            setTimeout(function(){
                t.next().next().next().click();
            },500);

        }


    });
    // jQuery(".my-foto").imagezoomsl({
    //
    //     descarea: ".my-container",
    //     zoomrange: [1, 12],
    //     magnifiereffectanimate: "fadeIn",
    //     cursorshadeborder:'0',
    //     cursorshadecolor:'transparent',
    //     magnifycursor:'default',
    //     magnifierborder: "none"
    // });

    jQuery('[name="sob_input[3][E - mail]"]').parent().after(jQuery('[name="sob_input[5][Текст сообщения]"]').parent());
    jQuery('[name="sob_input[5][Текст сообщения]"]').parent().css({'float':'right'});


    jQuery('#login_form').css({'margin-top':-jQuery('#login_form').outerHeight()/2+"px"});
    jQuery('#forgot_form').css({'margin-top':-jQuery('#forgot_form').outerHeight()/2+"px"});
    jQuery('#reg_form').css({'margin-top':-jQuery('#reg_form').outerHeight()/2+"px"});


    jQuery('#login_form input[type="submit"]').click(function(e){
        e.preventDefault();

        jQuery.ajax({
            url: '/login',
            type: 'post',
            data: {
                'email':jQuery('#login_form input[name="email"]').val(),
                'password':jQuery('#login_form input[name="password"]').val()
            },
            success: function(json) {
                try {

                    var an = jQuery.parseJSON(json);
                    if(an.error==1)
                    {
                        //console.log(an.error_text);
                        jQuery('#login_form .error').text(an.error_text);
                    }

                } catch (err) {

                    window.location.href = "/order-history";

                }
            }
        });

    });


    jQuery('#login_form1 input[type="submit"]').click(function(e){
        e.preventDefault();

        jQuery.ajax({
            url: '/login',
            type: 'post',
            data: {
                'email':jQuery('#login_form1 input[name="email"]').val(),
                'password':jQuery('#login_form1 input[name="password"]').val()
            },
            success: function(json) {
                try {

                    var an = jQuery.parseJSON(json);
                    if(an.error==1)
                    {
                        //console.log(an.error_text);
                        jQuery('#login_form1 .error').text(an.error_text);
                    }

                } catch (err) {

                    window.location.href = "/order-history";

                }
            }
        });

    });

    jQuery('#pass_form input[type="submit"]').click(function(e){

        e.preventDefault();
        jQuery.ajax({
            url: '/change-password',
            type: 'post',
            data: {
                'password':jQuery('#pass_form input[name="input-password"]').val(),
                'confirm':jQuery('#pass_form input[name="input-confirm"]').val()
            },
            success: function(json) {
                console.log(json);
                try {

                    var an = jQuery.parseJSON(json);
                    if(an.error==1)
                    {
                        //console.log(an.error_text);
                        jQuery('#pass_form .error').text(an.error_text);
                    }

                } catch (err) {

                    window.location.href = "/order-history";

                }
            }
        });

    });

    jQuery('#forgot_form input[type="submit"]').click(function(e){
        e.preventDefault();

        jQuery.ajax({
            url: '/forgot-password',
            type: 'post',
            data: {
                'email':jQuery('#forgot_form input[name="email"]').val()
            },
            success: function(json) {
                try {

                    var an = jQuery.parseJSON(json);
                    if(an.error==1)
                    {
                        //console.log(an.error_text);
                        jQuery('#forgot_form .error').text(an.error_text);
                    }

                } catch (err) {

                    jQuery('#forgot_form .login_form_form').html('<div class="forgot_thank">Ссылка для восстановления отправлена на  ваш e-mail. Пожалуйста, проверьте почту.</div>');

                }
            }
        });

    });

    jQuery('.btn_user,.log_link').click(function(e){
        e.preventDefault();
        jQuery('#login_form,.over_all').show();

    });

    jQuery('.forgot_link').click(function(){
        jQuery('.m_form, .over_all').hide();
        jQuery('#forgot_form, .over_all').show();
    });
    jQuery('.login_link').click(function(){
        jQuery('.m_form, .over_all').hide();
        jQuery('#reg_form, .over_all').show();
    });

    jQuery('#simpleregister_button_confirm').click(function(){
        jQuery('#reg_form').hide();
    });

    jQuery('.user_info_form.pod input[type="checkbox"]').styler();


    var vis=0;

    jQuery('select[name="edit[field23]"]').change(function(){
        //alert(jQuery('select[name="edit[field23]"] option:selected').val());
        var year=parseInt(jQuery('select[name="edit[field23]"] option:selected').val());
        if(year % 4==0)
        {
            if(year % 100==0)
            {
                if(year % 400==0)
                {
                    vis=1;
                }
                else
                {
                    vis=0;
                }
            }
            else
            {
                vis=1;
            }
        }
        else
        {
            vis=0;
        }

        //alert(vis);
        jQuery('select[name="edit[field22]"]').change();


    });
    jQuery('select[name="edit[field22]"]').change(function(){
        if(vis==0)
        {
            if(jQuery('select[name="edit[field22]"] option:selected').val()==2)
            {
                if(jQuery('select[name="edit[field21]"] option:selected').val()==31||jQuery('select[name="edit[field21]"] option:selected').val()==30||jQuery('select[name="edit[field21]"] option:selected').val()==29)
                {
                    jQuery('select[name="edit[field21]"]').val(28)
                    jQuery('select[name="edit[field21]"] option').prop('disabled','');
                    jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    jQuery('select[name="edit[field21]"] option[value="30"]').prop('disabled','true');
                    jQuery('select[name="edit[field21]"] option[value="29"]').prop('disabled','true');
                }
                else
                {
                    jQuery('select[name="edit[field21]"] option').prop('disabled','');
                    jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    jQuery('select[name="edit[field21]"] option[value="30"]').prop('disabled','true');
                    jQuery('select[name="edit[field21]"] option[value="29"]').prop('disabled','true');
                }

            }
            else
            {
                if(jQuery('select[name="edit[field22]"] option:selected').val()==4||jQuery('select[name="edit[field22]"] option:selected').val()==6||jQuery('select[name="edit[field22]"] option:selected').val()==9||jQuery('select[name="edit[field22]"] option:selected').val()==11)
                {

                    if(jQuery('select[name="edit[field21]"] option:selected').val()==31)
                    {
                        jQuery('select[name="edit[field21]"]').val(30)
                        jQuery('select[name="edit[field21]"] option').prop('disabled','');
                        jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    }
                    else
                    {
                        jQuery('select[name="edit[field21]"] option').prop('disabled','');
                        jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    }
                }
                else
                {

                    jQuery('select[name="edit[field21]"] option').prop('disabled','');
                }

            }
        }
        else
        {
            if(jQuery('select[name="edit[field22]"] option:selected').val()==2)
            {
                if(jQuery('select[name="edit[field21]"] option:selected').val()==31||jQuery('select[name="edit[field21]"] option:selected').val()==30)
                {
                    jQuery('select[name="edit[field21]"]').val(29)
                    jQuery('select[name="edit[field21]"] option').prop('disabled','');
                    jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    jQuery('select[name="edit[field21]"] option[value="30"]').prop('disabled','true');

                }
                else
                {
                    jQuery('select[name="edit[field21]"] option').prop('disabled','');
                    jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    jQuery('select[name="edit[field21]"] option[value="30"]').prop('disabled','true');

                }

            }
            else
            {
                if(jQuery('select[name="edit[field22]"] option:selected').val()==4||jQuery('select[name="edit[field22]"] option:selected').val()==6||jQuery('select[name="edit[field22]"] option:selected').val()==9||jQuery('select[name="edit[field22]"] option:selected').val()==11)
                {
                    if(jQuery('select[name="edit[field21]"] option:selected').val()==31)
                    {
                        jQuery('select[name="edit[field21]"]').val(30)
                        jQuery('select[name="edit[field21]"] option').prop('disabled','');
                        jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    }
                    else
                    {
                        jQuery('select[name="edit[field21]"] option').prop('disabled','');
                        jQuery('select[name="edit[field21]"] option[value="31"]').prop('disabled','true');
                    }
                }
                else
                {
                    jQuery('select[name="edit[field21]"] option').prop('disabled','');
                }

            }
        }

    });


    var year=parseInt(jQuery('select[name="edit[field23]"] option:selected').val());
    if(year % 4==0)
    {
        if(year % 100==0)
        {
            if(year % 400==0)
            {
                vis=1;
            }
            else
            {
                vis=0;
            }
        }
        else
        {
            vis=1;
        }
    }
    else
    {
        vis=0;
    }
    jQuery('select[name="edit[field22]"]').trigger('change');




    jQuery('input[name="sob_input[1][Ваше имя]"]').attr('class','');
    jQuery('input[name="sob_input[2][Телефон]"]').mask('+7(999)-999-99-99');
    jQuery('.phone_input').mask('+7(999)-999-99-99');


    jQuery('.m_menu_link').click(function(){
        //jQuery('.m_main_menu').toggle();
        if(jQuery('.m_main_menu').css('display')=='none')
        {
            jQuery('.m_main_menu').show();
            jQuery('.m_main_menu').animate({'left':0},900);
            jQuery('.over_m_menu').show();
            jQuery('body,html').css({'overflow':'hidden'});
        }
        else
        {
            jQuery('.m_main_menu').animate({'left':'-100%'},900);
            setTimeout(function(){
                jQuery('.m_main_menu').hide();
                jQuery('.over_m_menu').hide();
            },500);
            jQuery('body,html').css({'overflow':'auto'});
        }
    });
    jQuery('.over_m_menu').click(function(){
        jQuery('.m_main_menu').animate({'left':'-100%'},500);
        setTimeout(function(){
            jQuery('.m_main_menu').hide();
            jQuery('.over_m_menu').hide();
        },500);
        jQuery('body,html').css({'overflow':'auto'});

    });

    jQuery( ".m_main_menu" ).on( "swipeleft", function(){
        jQuery('.m_main_menu').animate({'left':'-100%'},500);
        setTimeout(function(){
            jQuery('.m_main_menu').hide();
            jQuery('.over_m_menu').hide();
        },500);
        jQuery('body,html').css({'overflow':'auto'});

		} );
		


		$(function() {
			$('.button_a').click(function() {
				$('.button_a').addClass("active");
				if ($('.content_footer-menu_a').toggle()) {
                    $( '.home_about' ).height( 450 );
					$('.content_footer-menu_b').hide();
					$('.content_footer-menu_c').hide();
					$('.content_footer-menu_d').hide();
					$('.content_footer-menu_f').hide();
					$('.button_d').removeClass("active");
					$('.button_b').removeClass("active");
					$('.button_c').removeClass("active");
					$('.button_f').removeClass("active");
				}
			});
		});

		$(function() {
			$('.button_b').click(function() {
				$('.button_b').addClass("active");
				if ($('.content_footer-menu_b').toggle()) {
                    $( '.home_about' ).height( 450 );
					$('.content_footer-menu_a').hide();
					$('.content_footer-menu_c').hide();
					$('.content_footer-menu_d').hide();
					$('.content_footer-menu_f').hide();
					$('.button_d').removeClass("active");
					$('.button_a').removeClass("active");
					$('.button_c').removeClass("active");
					$('.button_f').removeClass("active");
				}
			});
		});

		$(function() {
			$('.button_c').click(function() {
				$('.button_c').addClass("active");
				if ($('.content_footer-menu_c').toggle()) {
                    $( '.home_about' ).height( 450 );
					$('.content_footer-menu_a').hide();
					$('.content_footer-menu_b').hide();
					$('.content_footer-menu_d').hide();
					$('.content_footer-menu_f').hide();
					$('.button_d').removeClass("active");
					$('.button_a').removeClass("active");
					$('.button_b').removeClass("active");
					$('.button_f').removeClass("active");
				}
			});
		});

		$(function() {
			$('.button_f').click(function() {
				$('.button_f').addClass("active");
				if ($('.content_footer-menu_f').toggle()) {
                    $( '.home_about' ).height( 250 );
					$('.content_footer-menu_a').hide();
					$('.content_footer-menu_b').hide();
					$('.content_footer-menu_d').hide();
					$('.content_footer-menu_c').hide();
					$('.button_d').removeClass("active");
					$('.button_a').removeClass("active");
					$('.button_b').removeClass("active");
					$('.button_c').removeClass("active");
				}
			});
		});

		$(function() {
			$('.button_d').click(function() {
				$('.button_d').addClass("active");
				if ($('.content_footer-menu_d').toggle()) {
                    $( '.home_about' ).height( 250 );
					$('.content_footer-menu_a').hide();
					$('.content_footer-menu_b').hide();
					$('.content_footer-menu_c').hide();
					$('.content_footer-menu_f').hide();
					$('.button_a').removeClass("active");
					$('.button_b').removeClass("active");
					$('.button_c').removeClass("active");
					$('.button_f').removeClass("active");

				}
			});
		});







    /*jQuery( ".mobile_product_img_in" ).on( "swipeleft",function(){

        jQuery(".show_mobile").scrollLeft(jQuery(".show_mobile").scrollLeft()+jQuery(document).width());


    } , { passive: true });*/
    /*jQuery( ".mobile_product_img" ).on( "swipeleft", function(){
        console.log('left');
        var i=0;
        var swipe=jQuery( ".mobile_product_img" ).scrollLeft();

        for(i=0;i<=jQuery(document).width();i++)
        {
            jQuery( ".mobile_product_img" ).scrollLeft(swipe+i);
            jQuery.delay(100);
            console.log(jQuery( ".mobile_product_img" ).scrollLeft());
            //jQuery(".show_mobile").scrollLeft(jQuery(".show_mobile").scrollLeft()+jQuery(document).width());
            //jQuery( ".mobile_product_img" ).scrollLeft(jQuery( ".mobile_product_img" ).scrollLeft()+i);
        }


    } );*/
    /*var el = document.getElementById("outside");
    el.addEventListener("swipeleft",function(){
        console.log('left');

        jQuery(".show_mobile").scrollLeft(jQuery(".show_mobile").scrollLeft()-jQuery(document).width());

    } , { passive: true });

    el.addEventListener("swiperight",function(){
        console.log('right');

        jQuery(".show_mobile").scrollLeft(jQuery(".show_mobile").scrollLeft()+jQuery(document).width());


    } , { passive: true });*/

    /*jQuery( ".mobile_product_img_in" ).on( "swiperight",  function(){

        jQuery(".show_mobile").scrollLeft(jQuery(".show_mobile").scrollLeft()-jQuery(document).width());


    } , { passive: true });*/


    jQuery('.full_version').click(function(){
        jQuery('meta[name="viewport"]').attr('content','width=1201');
    });

    if(jQuery(window).width()<768)
    {
        jQuery('.catalog_filters_block_check').hide();
        jQuery('.catalog_filters_block').unbind('click');
        jQuery('.title_filter_mob').click(function(e){

            if(jQuery(this).next('.catalog_filters_block_check').css('display')=='none')
            {
                jQuery(this).next('.catalog_filters_block_check').slideDown();
            }
            else
            {
                jQuery(this).next('.catalog_filters_block_check').slideUp();
            }
        });

    }



    setOrderLines();
    jQuery('.mobile_product_img_in img').width(jQuery(window).width());
    var w_img=0;
    jQuery('.mobile_product_img_in img').each(function(){
        w_img=w_img+jQuery(this).width();
    });
    jQuery('.mobile_product_img_in').width(w_img);

    jQuery('.m_menu_search').click(function(){
        jQuery('.m_header_search_form').toggle();
    });
    jQuery('.mobile_product_img').height(jQuery('.mobile_product_img_in img').height());
    jQuery('.mobile_product_img_in img:eq(0)').addClass('active');
    if(jQuery('.mobile_product_img_in img').length==1)
    {
        jQuery('.mob_img_next,.mob_img_prev').hide();
    }
    jQuery('.mob_img_next').click(function(){
        jQuery('.mob_img_prev').show();
        var index=jQuery('.mobile_product_img_in img').index(jQuery('.mobile_product_img_in img.active'));
        if(jQuery('.mobile_product_img_in img').index(jQuery('.mobile_product_img_in img.active'))==jQuery('.mobile_product_img_in img').length-2)
        {
            jQuery('.mob_img_next').hide();
        }
        jQuery('.mobile_product_img_in img').removeClass('active');
        jQuery('.mobile_product_img_in img:eq('+index+')').next().addClass('active');

        jQuery('.mobile_product_img_in').animate({'left':(parseInt(jQuery('.mobile_product_img_in').css('left'))-jQuery(window).width())+'px'},500);
    });
    jQuery('.mob_img_prev').click(function(){
        jQuery('.mob_img_next').show();
        var index=jQuery('.mobile_product_img_in img').index(jQuery('.mobile_product_img_in img.active'));
        if(jQuery('.mobile_product_img_in img').index(jQuery('.mobile_product_img_in img.active'))==1)
        {
            jQuery('.mob_img_prev').hide();
        }
        jQuery('.mobile_product_img_in img').removeClass('active');
        jQuery('.mobile_product_img_in img:eq('+index+')').prev().addClass('active');

        jQuery('.mobile_product_img_in').animate({'left':(parseInt(jQuery('.mobile_product_img_in').css('left'))+jQuery(window).width())+'px'},500);
    });

    if(jQuery(document).width()<766)
    {

        jQuery('.quest_btn').click(function(){
            if(jQuery(this).next().css('display')=='none')
            {
                jQuery(this).next().slideDown();
            }
            else
            {
                jQuery(this).next().slideUp();
            }
        });
    }



$('.btn_user,.call_link,.addcart_form,.btn_table_size').click(function(){
    $('body').css('overflow','hidden');
});

$('.over_all,.close,.btn_return').click(function(){
    $('body').css('overflow','auto');
});


    // var header = jQuery(".m_main_header"); // Меню
    // var scrollPrev = 0 // Предыдущее значение скролла

    // jQuery(window).scroll(function() {
    //     var scrolled = jQuery(window).scrollTop(); // Высота скролла в px
    //     var firstScrollUp = false; // Параметр начала сколла вверх
    //     var firstScrollDown = false; // Параметр начала сколла вниз

    //     // Если скроллим
    //     if ( scrolled > 0 ) {
    //         // Если текущее значение скролла > предыдущего, т.е. скроллим вниз
    //         if ( scrolled > scrollPrev ) {
    //             firstScrollUp = false; // Обнуляем параметр начала скролла вверх
    //             // Если меню видно
    //             if ( scrolled < header.outerHeight() + header.offset().top ) {
    //                 // Если только начали скроллить вниз
    //                 if ( firstScrollDown === false ) {
    //                     var topPosition = header.offset().top; // Фиксируем текущую позицию меню
    //                     header.css({
    //                         "top": topPosition + "px"
    //                     });
    //                     firstScrollDown = true;
    //                 }
    //                 // Позиционируем меню абсолютно
    //                 header.css({
    //                     "position": "absolute"
    //                 });
    //                 // Если меню НЕ видно
    //             } else {
    //                 // Позиционируем меню фиксированно вне экрана
    //                 header.css({
    //                     "position": "fixed",
    //                     "top": "-" + header.outerHeight() + "px"
    //                 });
    //             }

    //             // Если текущее значение скролла < предыдущего, т.е. скроллим вверх
    //         } else {
    //             firstScrollDown = false; // Обнуляем параметр начала скролла вниз
    //             // Если меню не видно
    //             if ( scrolled > header.offset().top ) {
    //                 // Если только начали скроллить вверх
    //                 if ( firstScrollUp === false ) {
    //                     var topPosition = header.offset().top; // Фиксируем текущую позицию меню
    //                     header.css({
    //                         "top": topPosition + "px"
    //                     });
    //                     firstScrollUp = true;
    //                 }
    //                 // Позиционируем меню абсолютно
    //                 header.css({
    //                     "position": "absolute"
    //                 });
    //             } else {
    //                 // Убираем все стили
    //                 header.removeAttr("style");
    //             }
    //         }
    //         // Присваеваем текущее значение скролла предыдущему
    //         scrollPrev = scrolled;
    //     }
    // });

    if(jQuery(window).width()<760)
    {
        jQuery('.home_cats_block_in:eq(0),.home_cats_block_in:eq(1)').height(jQuery('.home_cats_block_in:eq(0)').width()*1.3);
        jQuery('.catalog_item_img').height(jQuery('.catalog_item_img').width()*1.4);
        jQuery('.catalog_item').height(jQuery('.catalog_item_img').width()*1.4+100);
    }





    jQuery('.get_status_btn').click(function(e){
        e.preventDefault();
        var data={
            number:jQuery('input[name="get_status_number"]').val(),
            phone:jQuery('input[name="get_status_phone"]').val()
        };
        jQuery.ajax({
            url: 'index.php?route=ajax/index/ajaxGetStatus',
            type:'POST',
            data:data,
            dataType:'json',
            success: function(data) {
                jQuery('.get_status_form_success,.get_status_form_error').html('');
                console.log(data);
                if(data.error==0)
                {
                    jQuery('.get_status_form_success').html(data.status);
                }
                else
                {
                    jQuery('.get_status_form_error').html(data.error_message);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
            }
        });

    });

});
jQuery(window).resize(function(){
    if(jQuery(window).width()<760)
    {
        jQuery('.home_cats_block_in:eq(0),.home_cats_block_in:eq(1)').height(jQuery('.home_cats_block_in:eq(0)').width()*1.3);
        jQuery('.catalog_item_img').height(jQuery('.catalog_item_img').width()*1.4);
        jQuery('.catalog_item').height(jQuery('.catalog_item_img').width()*1.4+100);
    }
});

function setOrderLines()
{
    jQuery('.order_block_line select').styler();

    jQuery('.order_block_line_right_city').append(jQuery('.row-shipping_address_city'));
    jQuery('.order_block_line_right_street').append(jQuery('.row-shipping_address_field27'));
    jQuery('.order_block_line_right_house').append(jQuery('.row-shipping_address_field28'));
    jQuery('.order_block_line_right_kv').append(jQuery('.row-shipping_address_field29'));
    jQuery('.order_block_line_right_type').append(jQuery('.row-shipping_address_field31'));
    jQuery('.order_block_line_right_type .radio:eq(0)').append('<div class="order_type_desc"><div class="order_type_desc_title">В течение выбранного часа.</div><div class="order_type_desc_text">Примерка перед покупкой и частичный выкуп. Стоимость доставки вне зависимости от суммы выкупа 350 рублей.</div></div>');
    jQuery('.order_block_line_right_type .radio:eq(1)').append('<div class="order_type_desc"><div class="order_type_desc_title">При выкупе на сумму более 2500 рублей или предоплате доставка бесплатная, иначе стоимость доставки каждого заказа – 250 рублей.</div><div class="order_type_desc_text">Примерка перед покупкой и частичный выкуп.</div></div>');
    jQuery('.order_block_line_right_type .radio:eq(2)').append('<div class="order_type_desc"><div class="order_type_desc_title">Без примерки и возможности частичного выкупа.</div><div class="order_type_desc_text">Доставка бесплатная.</div></div>');
    jQuery('.order_block_line_right_date1').append(jQuery('.row-shipping_address_field32'));
    jQuery('.order_block_line_right_date2').append(jQuery('.row-shipping_address_field33'));
    jQuery('.order_block_line_right_name').append(jQuery('.row-customer_firstname'));
    jQuery('.order_block_line_right_famyli').append(jQuery('.row-customer_lastname'));
    jQuery('.order_block_line_right_email').append(jQuery('.row-customer_email'));
    jQuery('.order_block_line_right_phone').append(jQuery('.row-customer_telephone'));
    jQuery('.order_block_line_right_news').append(jQuery('.row-customer_newsletter'));
    jQuery('.order_block_line input[type="radio"]').styler();
    jQuery('.order_block_line input[type="checkbox"]').styler();
    jQuery('.order_summ_top_left_cupon').append(jQuery('#simplecheckout_cart input[name="coupon"]'));
    jQuery('.order_summ_top_left_pay_right').append(jQuery('#simplecheckout_payment'));
    jQuery('.order_summ_top_right').append(jQuery('#simplecheckout_summary'));
    jQuery('.order_summ_bottom_right').append(jQuery('#buttons'));
    jQuery('.order_summ_top_price').html('Итого: товаров на сумму '+jQuery('#total_sub_total .simplecheckout-cart-total-value').html());
    jQuery('#total_shipping b').html('Доставка: ');
    jQuery('.check_content_left').css({'padding-bottom':(jQuery('.order_summ').outerHeight()+30)+'px'});
    jQuery('.order_summ_top_left_pay_right input[type="radio"]').styler();
    jQuery('#button-confirm').attr('class','btn_add_cart');


}
function setCupon()
{
    jQuery('#simplecheckout_cart input[name="coupon"]').trigger('change');

}

function addDel()
{
    jQuery('.catalog_filter_value_delete,.catalog_filters_block_del').click(function(){
        //alert('123');
        //jQuery('.catalog_filters_block[filter-id="'+jQuery(this).attr('filter-del')+'"] input').prop('checked',false);
        jQuery('.catalog_filters_block[filter-id="'+jQuery(this).attr('filter-id')+'"] input').prop('checked',false);

        jQuery('.catalog_filters_block_check input[type="checkbox"]').trigger('refresh');
        jQuery('.catalog_filters_block[filter-id="'+jQuery(this).attr('filter-id')+'"] .send_filter').trigger('click');
        //jQuery(this).parent().remove();
    });
}





function setCar()
{
    $(function() {
        var jcarousel = $('.jcarousel');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 600) {
                    width = width / $(this).attr('data-col');
                } else if (width >= 350) {
                    width = width;
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            })
            .jcarouselAutoscroll({
                interval: 3000,
                target: '+=1',
                autostart: false
            })

        ;


        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=6'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=6'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });
}
(function($) {
    // This is the connector function.
    // It connects one item from the navigation carousel to one item from the
    // stage carousel.
    // The default behaviour is, to connect items with the same index from both
    // carousels. This might _not_ work with circular carousels!
    var connector = function(itemNavigation, carouselStage) {
        return carouselStage.jcarousel('items').eq(itemNavigation.index());
    };

    $(function() {
        // Setup the carousels. Adjust the options for both carousels here.
        var carouselStage      = $('.carousel-stage').jcarousel(function(){
        // jQuery('.connected-carousels .carousel li').width(jQuery('.connected-carousels .carousel li').parent().parent().width());

        });
        var carouselNavigation = $('.carousel-navigation').jcarousel();

        // We loop through the items of the navigation carousel and set it up
        // as a control for an item from the stage carousel.
        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);

            // This is where we actually connect to items.
            var target = connector(item, carouselStage);

            item
                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });

        // Setup controls for the stage carousel
        $('.prev-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-stage')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        $('.prev-stage_custom')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-stage_custom')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        // Setup controls for the navigation carousel
        $('.prev-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });
		});







})(jQuery);

jQuery(document).ready(function(){
    //jQuery('.connected-carousels .carousel li').width(jQuery('.connected-carousels .carousel li').parent().parent().width());
});