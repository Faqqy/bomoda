<?php
// Heading
$_['heading_title']      			= 'Доставка Pickpoint <a href="https://prowebber.ru/" target="_blank" title="prowebber.su" style="color:#0362B6;margin-right:5px"><i class="fa fa-cloud-download fa-fw"></i></a> ';

// Text
$_['text_shipping']      			= 'Доставка';
$_['text_success']       			= 'Настройки модуля обновлены!';

// Entry
$_['entry_main_settings']     		= 'Основные настройки';
$_['entry_export_settings']   		= 'Настройка экпорта';

$_['entry_rate']         			= 'Стоимость рейса:';
$_['entry_tax_class']    			= 'Налоговый класс:';
$_['entry_geo_zone']     			= 'Географическая зона:';
$_['entry_status']       			= 'Статус:';
$_['entry_sort_order']   			= 'Порядок сортировки:';

$_['button_export']   				= 'Экпорт заказов';
$_['entry_export']				= 'Экпорт:';

$_['entry_custom_price']   			= 'Изменение стоимости доставки:';
$_['entry_custom_region_price']   		= 'Изменение стоимости доставки по регионам:';
$_['help_custom_region_price']   		= 'Через запятую указываются регионы с измененной стоимостью в формате Регион:Стоимость. Например, Московская обл.:340, Ярославская обл.:-. Для всех регионов стоимость доставки можно изменить так *:500. Для запрета доставки в регион поставьте знак минус.';

$_['entry_custom_city_price']   		= 'Изменение стоимости доставки по городам:';
$_['help_custom_city_price']   		= 'Изменение стоимости доставки по городам:';

$_['entry_min_sum']   				= 'Минимальная сумма заказа:';
$_['entry_min_shipping_sum']   		= 'Минимальная сумма доставки:';
$_['entry_zero_from']   			= 'Бесплатная доставка от:';
$_['entry_orders_status']   			= 'Статусы заказов с предоплатой:';
$_['entry_dont_export_statuses']   		= 'Статусы заказов, которые не нужно экспортировать:';
$_['entry_markup']   				= 'Надбавка:';
$_['entry_mode']   				= 'Режим работы:';
$_['entry_custom_add_sum']   			= 'Увеличить стоимость доставки на:';


$_['entry_mode_normal']				= 'Нормальный';
$_['entry_mode_debug']				= 'Отладка';

$_['entry_postage_type']      		= 'Вид отправления:';
$_['entry_postage_type_10001']		= 'Стандарт';
$_['entry_postage_type_10002']		= 'Приоритет';
$_['entry_postage_type_10003']		= 'Стандарт НП';
$_['entry_postage_type_10004']		= 'Приоритет НП';

$_['entry_getting_type']      		= 'Тип сдачи отправления:';
$_['entry_getting_type_101']			= 'Вызов курьера';
$_['entry_getting_type_102']			= 'В окне приема СЦ';
$_['entry_getting_type_103']			= 'В окне приема ПТ валом';
$_['entry_getting_type_104']			= 'В окне приема ПТ (самостоятельный развоз в нужный ПТ + при создании отправления у ПТ - С2С)';

$_['entry_return_address']			= 'Адрес возврата:';
$_['entry_return_address_city_name'] 	= 'Город';
$_['entry_return_address_region_name'] 	= 'Регион (область)';
$_['entry_return_address_address'] 		= 'Улица';
$_['entry_return_address_fio'] 		= 'Ф.И.О.';
$_['entry_return_address_post_code'] 	= 'Почтовый индекс';
$_['entry_return_address_organisation'] 	= 'Организация';
$_['entry_return_address_phone_number'] 	= 'Телефон';

$_['entry_export_status'] 			= 'Статус после экспорта:';


$_['text_edit']        				= 'Редактирование доставки Pickpoint';

$_['entry_pickpoint_rub_select']    	= 'Рубль:';
$_['entry_pickpoint_kg_select']    		= 'Килограмм:';

$_['entry_login']    				= 'Логин:';
$_['help_login']    				= 'Логин в системе PickPoint (для теста - apitest)';

$_['entry_url']    				= 'URL виджета:';
$_['help_url']    				= 'URL виджета PickPoint';

$_['entry_pwd']    				= 'Пароль:';
$_['help_pwd']    				= 'Пароль в системе PickPoint (для теста - apitest)';

$_['entry_ikn']    				= 'ИКН – номер договора:';
$_['help_ikn']    				= 'ИКН – номер договора в системе PickPoint (для теста - 9990003041)';

$_['entry_from_city']    			= 'Город сдачи отправления:';
$_['help_from_city']    			= 'Город сдачи отправления в системе PickPoint (для теста - Москва)';

$_['entry_from_region']    			= 'Регион сдачи отправления:';
$_['help_from_region']    			= 'Регион города сдачи отправления в системе PickPoint (для теста - Московская область)';

$_['entry_deleted_cities']    		= 'Исключить города:';
$_['help_deleted_cities']     		= 'Список городов через запятую (Например: Москва, Нижний Новгород)';

$_['entry_point_cost']        		= 'Стоимость доставки:';
$_['help_point_cost']        			= ' \'-\'  отключить доставку до пунктов выдачи, пусто - расчет по api, последовательность чисел (например: 3500:250,:0 - при стоимости заказа до 3500, доставка будет стоить 250, больше 3500 - бесплатно )';

$_['entry_point_days']        		= 'Срок доставки:';
$_['help_point_days']        			= 'пусто - расчет по api, 5 - 5дней, +1 - увеличить на 1 день';

$_['entry_courier_cost']     			= 'Стоимость доставки курьером:';
$_['help_courier_cost']     			= ' \'-\' - отключить доставку курьером, пусто - расчет по api(пока не поддерживается) или последовательность чисел  (Например: 3500:500,:250 - при стоимости заказа до 3500, доставка будет стоить 500, больше 3500 - 250 )';

$_['entry_courier_days']      		= 'Срок доставки курьером:';
$_['help_courier_days']       		= 'пусто - расчет по api (пока не поддерживается), 5 - 5дней, +1 - увеличить на 1 день(пока не поддерживается)';

$_['entry_cart_weight']       		= 'Вес посылки (г):';
$_['help_cart_weight']       			= 'Оставить пустым, если вес считается по корзине';

$_['entry_cart_cost']      			= 'Стоимость посылки (руб):';
$_['help_cart_cost']      			= 'Оставить пустым, если стоимость считается по корзине';

$_['entry_cost_round']        		= 'Округлять стоимость доставки до сотни:';

// Error
$_['error_permission']  			= 'У Вас нет прав для управления этим модулем!';
$_['error_pickpoint_login']   		= 'Необходимо заполнить поле!';
$_['error_pickpoint_pwd']   			= 'Необходимо заполнить поле!';
$_['error_pickpoint_ikn']   			= 'Необходимо заполнить поле!';
$_['error_pickpoint_from_city']   		= 'Необходимо заполнить поле!';
$_['error_pickpoint_from_region']   	= 'Необходимо заполнить поле!';
$_['error_pickpoint_url']   		= 'Необходимо заполнить поле!';
