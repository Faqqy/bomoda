function ll_grastin_init(collection) {
    ymaps.ready(
        function () {
            if (typeof collection != 'undefined' && collection != '') {
                ll_grastin_create_modal();

                var map = new ymaps.Map('ll_grastin_map', {
                        center: collection.data.features[0].geometry.coordinates,
                        controls: collection.controls,
                        zoom: 10,
                    }),
                    cluster = new ymaps.ObjectManager({
                        clusterize: true,
                        gridSize: 32,
                        margin: 20,
                        preset: 'islands#invertedGrayClusterIcons',
                    });

                cluster.add(collection.data);

                map.geoObjects.add(cluster);

                cluster.clusters.events
                    .add('mouseenter', function (e) {
                        cluster.clusters.setClusterOptions(e.get('objectId'), {
                            preset: 'islands#grayClusterIcons'
                        });
                    })
                    .add('mouseleave', function (e) {
                        cluster.clusters.setClusterOptions(e.get('objectId'), {
                            preset: 'islands#invertedGrayClusterIcons'
                        });
                    });

                for (var i in collection.delivery) {
                    switch (i) {
                        case 'pickup_grastin':
                            var floatIndex = 4;
                            break;
                        case 'pickup_partner':
                            var floatIndex = 3;
                            break;
                        case 'pickup_boxberry':
                            var floatIndex = 2;
                            break;
                        case 'pickup_hermes':
                            var floatIndex = 1;
                            break;
                        default:
                            var floatIndex = 0;
                            break;
                    }

                    var delivery = collection.delivery[i],
                        button = new ymaps.control.Button({
                            data: {
                                content: delivery.content,
                                title: delivery.title,
                                code: delivery.code,
                            },
                            options: {
                                selectOnClick: true,
                                size: 'small',
                                float: 'left',
                                floatIndex: floatIndex,
                                maxWidth: 150,
                            }
                        });

                    map.controls.add(button);

                    button.events
                        .add('press', function(e) {
                            target = e.get('target');
                            code = target.data.get('code');

                            map.controls.each(function(e) {
                                if (e.options.getName() == 'button' && e != target && e.deselect()) {
                                    e.deselect();
                                }
                            });

                            cluster.setFilter("object.params.code == code");
                        })
                        .add('deselect', function(e) {
                            cluster.setFilter(false);
                        });
                }
            }
        }
    );
}

function ll_grastin_create_modal() {
    $('#ll_grastin_modal').remove();

    html  = '<div id="ll_grastin_modal" class="modal">';
    html += '  <div class="modal-dialog modal-lg">';
    html += '    <div class="modal-content">';
    html += '      <div class="modal-header">';
    html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    html += '        <h4 class="modal-title">Выбор ПВЗ</h4>';
    html += '      </div>';
    html += '      <div class="modal-body"></div>';
    html += '    </div';
    html += '  </div>';
    html += '</div>';

    $('body').append(html);

    var width = $('#ll_grastin_modal .modal-dialog').width() - 30,
        height = document.documentElement.clientHeight - 150;

    $('#ll_grastin_modal .modal-body').append('<div id="ll_grastin_map" style="width: ' + width + 'px;height: ' + height + 'px;"></div>');
}

function ll_grastin_show_modal(code) {
    if (typeof code != 'undefined' && code != '') {
        $('#ll_grastin_filter_' + code).click();
    }

    $('#ll_grastin_modal').modal('show');
}

function ll_grastin_hide_modal() {
    $('#ll_grastin_modal').modal('hide');
}

function ll_grastin_set_pickup_id(code, id) {
    $.ajax({
        url: 'index.php?route=extension/shipping/ll_grastin/setPickupId', 
        type: 'post',
        data: 'code=' + code + '&id=' + id,
        dataType: 'json',
        complete: function() {
            ll_grastin_hide_modal();

            // simplecheckout
            $('input[value="ll_grastin.ll_grastin_' + code + '"]').prop('checked', true);

            if (typeof (reloadAll) == 'function') {
                reloadAll();
            }

            // checkout
            setTimeout(function () {
                $('#button-shipping-address,#button-guest-shipping').trigger('click');
            }, 500);

            $('a[href=\'#collapse-shipping-method\']').trigger('click');

            // oct_fastorder
            if ($('.fastorder-panel-default').length) {
                $('.shipping-method').load('index.php?route=checkout/oct_fastorder/shipping_method', $('.checkout_form input[type=\'text\'], .checkout_form input[type=\'date\'], .checkout_form input[type=\'datetime-local\'], .checkout_form input[type=\'time\'], .checkout_form input[type=\'password\'], .checkout_form input[type=\'hidden\'], .checkout_form input[type=\'checkbox\']:checked, .checkout_form input[type=\'radio\']:checked, input[name=\'shipping_method\']:first, .checkout_form textarea, .checkout_form select'), function() {
                    $('#cart-table').load('index.php?route=checkout/oct_fastorder/cart', $('.checkout_form input[type=\'text\'], .checkout_form input[type=\'date\'], .checkout_form input[type=\'datetime-local\'], .checkout_form input[type=\'time\'], .checkout_form input[type=\'password\'], .checkout_form input[type=\'hidden\'], .checkout_form input[type=\'checkbox\']:checked, .checkout_form input[type=\'radio\']:checked, .checkout_form textarea, .checkout_form select'));
                });
            }

            // newstorecheckout
            if (typeof (update_checkout) == 'function') {
                update_checkout();
            }

            // Quick n Easy checkout
            if (typeof (ajax_update_cart) == 'function') {
                ajax_update_cart(true);
            }

            // ll_shipping_widget
            if (typeof (ll_shipping_widget_set_method) == 'function') {
                ll_shipping_widget_set_method('ll_grastin.ll_grastin_' + code);
            }
        }
    });
};
