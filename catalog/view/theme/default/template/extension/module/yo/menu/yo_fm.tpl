<div id="yo-<?php echo $module; ?>" class="<?php echo $box_class; ?>">
  <?php if ($title) { ?>
  <div class="<?php echo $title_class ? $title_class : ''; ?> <?php echo $minimized ? 'menu-collapsed' : 'menu-expanded'; ?> toggle-title"><?php echo $title; ?></div>
  <?php } ?>
  <div <?php echo $content_class ? 'class="'.$content_class.'"' : ''; ?> <?php echo $minimized ? 'style="display:none"' : ''; ?>>
    <ul class="yo-<?php echo $menu_design; ?><?php echo $column == '1' ? ' fm-one' : ''; ?>">
      <?php foreach ($items as $item) { ?>
      <li <?php echo $item['active'] ? 'class="active"' : ''; ?>>
        <a <?php echo $item['current'] ? '' : 'href="'.$item['href'].'"'; ?> class="item-wrapper<?php echo $item['children1'] ? ' item-toggle' : ''; ?><?php echo $item['current'] ? ' item-current' : ''; ?>">
          <?php if ($icon && $item['icon']) { ?>
          <div class="item-icon">
            <?php if ($icon_width && $icon_height) { ?>
            <img src="<?php echo $item['icon']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } else { ?>
            <img src="image/<?php echo $item['icon']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } ?>
          </div>
          <?php } ?>
          <div class="item-title"><?php echo $item['name']; ?></div>
          <?php if ($count) { ?>
          <div class="item-count"><span><?php echo $item['count']; ?></span></div>
          <?php } ?>
        </a>
        <?php if ($item['children1']) { ?>
        <?php if ($column == '1') { ?>
        <ul>
          <div>
            <?php if ($image && $item['thumb']) { ?>
            <li class="item-image"><a <?php echo $item['current'] ? '' : 'href="'.$item['href'].'"'; ?> title="<?php echo $item['name']; ?>"><img src="<?php echo $item['thumb']; ?>" alt="<?php echo $item['name']; ?>"></a></li>
            <?php } ?>
            <?php foreach ($item['children1'] as $child1) { ?>
            <li <?php echo $child1['active'] && $child1['children2'] ? 'class="active"' : ''; ?>>
              <a <?php echo $child1['current'] ? '' : 'href="'.$child1['href'].'"'; ?> class="item-wrapper<?php echo $child1['children2'] ? ' item-toggle' : ''; ?><?php echo $child1['current'] ? ' item-current' : ''; ?>">
                <?php if ($icon && $child1['icon']) { ?>
                <div class="item-icon">
                  <?php if ($icon_width && $icon_height) { ?>
                  <img src="<?php echo $child1['icon']; ?>" alt="<?php echo $child1['name']; ?>">
                  <?php } else { ?>
                  <img src="image/<?php echo $child1['icon']; ?>" alt="<?php echo $child1['name']; ?>">
                  <?php } ?>
                </div>
                <?php } ?>
                <div class="item-title<?php echo $icon && $child1['icon'] ? '' : ' item-arrow'; ?>"><?php echo $child1['name']; ?></div>
                <?php if ($count && !$products_by_item) { ?>
                <div class="item-count"><span><?php echo $child1['count']; ?></span></div>
                <?php } ?>
                <?php if ($products_by_item) { ?>
                <div class="item-price">
                  <span>
                    <?php if (!$child1['special']) { ?>
                    <?php echo $child1['price']; ?>
                    <?php } else { ?>
                    <?php echo $child1['special']; ?>
                    <?php } ?>
                  </span>
                </div>
                <?php } ?>
              </a>
              <?php if ($child1['children2']) { ?>
              <ul>
                <div>
                  <?php if ($image && $child1['thumb']) { ?>
                  <li class="item-image"><a <?php echo $child1['current'] ? '' : 'href="'.$child1['href'].'"'; ?> title="<?php echo $child1['name']; ?>"><img src="<?php echo $child1['thumb']; ?>" alt="<?php echo $child1['name']; ?>"></a></li>
                  <?php } ?>
                  <?php foreach ($child1['children2'] as $child2) { ?>
                  <li <?php echo $child2['active'] && $child2['children3'] ? 'class="active"' : ''; ?>>
                    <a <?php echo $child2['current'] ? '' : 'href="'.$child2['href'].'"'; ?> class="item-wrapper<?php echo $child2['children3'] ? ' item-toggle' : ''; ?><?php echo $child2['current'] ? ' item-current' : ''; ?>">
                      <?php if ($icon && $child2['icon']) { ?>
                      <div class="item-icon">
                        <?php if ($icon_width && $icon_height) { ?>
                        <img src="<?php echo $child2['icon']; ?>" alt="<?php echo $child2['name']; ?>">
                        <?php } else { ?>
                        <img src="image/<?php echo $child2['icon']; ?>" alt="<?php echo $child2['name']; ?>">
                        <?php } ?>
                      </div>
                      <?php } ?>
                      <div class="item-title<?php echo $icon && $child2['icon'] ? '' : ' item-arrow'; ?>"><?php echo $child2['name']; ?></div>
                      <?php if ($count) { ?>
                      <div class="item-count"><span><?php echo $child2['count']; ?></span></div>
                      <?php } ?>
                    </a>
                    <?php if ($child2['children3']) { ?>
                    <ul>
                      <div>
                        <?php if ($image && $child2['thumb']) { ?>
                        <li class="item-image"><a <?php echo $child2['current'] ? '' : 'href="'.$child2['href'].'"'; ?> title="<?php echo $child2['name']; ?>"><img src="<?php echo $child2['thumb']; ?>" alt="<?php echo $child2['name']; ?>"></a></li>
                        <?php } ?>
                        <?php foreach ($child2['children3'] as $child3) { ?>
                        <li <?php echo $child3['active'] && $child3['children4'] ? 'class="active"' : ''; ?>>
                          <a <?php echo $child3['current'] ? '' : 'href="'.$child3['href'].'"'; ?> class="item-wrapper<?php echo $child3['children4'] ? ' item-toggle' : ''; ?><?php echo $child3['current'] ? ' item-current' : ''; ?>">
                            <?php if ($icon && $child3['icon']) { ?>
                            <div class="item-icon">
                              <?php if ($icon_width && $icon_height) { ?>
                              <img src="<?php echo $child3['icon']; ?>" alt="<?php echo $child3['name']; ?>">
                              <?php } else { ?>
                              <img src="image/<?php echo $child3['icon']; ?>" alt="<?php echo $child3['name']; ?>">
                              <?php } ?>
                            </div>
                            <?php } ?>
                            <div class="item-title<?php echo $icon && $child3['icon'] ? '' : ' item-arrow'; ?>"><?php echo $child3['name']; ?></div>
                            <?php if ($count) { ?>
                            <div class="item-count"><span><?php echo $child3['count']; ?></span></div>
                            <?php } ?>
                          </a>
                          <?php if ($child3['children4']) { ?>
                          <ul>
                            <div>
                              <?php if ($image && $child3['thumb']) { ?>
                              <li class="item-image"><a <?php echo $child3['current'] ? '' : 'href="'.$child3['href'].'"'; ?> title="<?php echo $child3['name']; ?>"><img src="<?php echo $child3['thumb']; ?>" alt="<?php echo $child3['name']; ?>"></a></li>
                              <?php } ?>
                              <?php foreach ($child3['children4'] as $child4) { ?>
                              <li>
                                <a <?php echo $child4['current'] ? '' : 'href="'.$child4['href'].'"'; ?> class="item-wrapper<?php echo $child4['current'] ? ' item-current' : ''; ?>">
                                  <?php if ($icon && $child4['icon']) { ?>
                                  <div class="item-icon">
                                    <?php if ($icon_width && $icon_height) { ?>
                                    <img src="<?php echo $child4['icon']; ?>" alt="<?php echo $child4['name']; ?>">
                                    <?php } else { ?>
                                    <img src="image/<?php echo $child4['icon']; ?>" alt="<?php echo $child4['name']; ?>">
                                    <?php } ?>
                                  </div>
                                  <?php } ?>
                                  <div class="item-title<?php echo $icon && $child4['icon'] ? '' : ' item-arrow'; ?>"><?php echo $child4['name']; ?></div>
                                  <?php if ($count) { ?>
                                  <div class="item-count"><span><?php echo $child4['count']; ?></span></div>
                                  <?php } ?>
                                </a>
                              </li>
                              <?php } ?>
                            </div>
                          </ul>
                          <?php } ?>
                        </li>
                        <?php } ?>
                      </div>
                    </ul>
                    <?php } ?>
                  </li>
                  <?php } ?>
                </div>
              </ul>
              <?php } ?>
            </li>
            <?php } ?>
          </div>
        </ul>
        <?php } else { ?>
        <div class="fm-container">
          <ul>
            <?php foreach (array_chunk($item['children1'], ceil(count($item['children1']) / $column)) as $children1) { ?>
            <div>
              <?php foreach ($children1 as $child1) { ?>
              <li <?php echo $child1['active'] && $child1['children2'] ? 'class="active"' : ''; ?>>
                <?php if ($image && $child1['thumb']) { ?>
                <div class="item-image img-<?php echo $image_position; ?>"><a <?php echo $child1['current'] ? '' : 'href="'.$child1['href'].'"'; ?> title="<?php echo $child1['name']; ?>"><img src="<?php echo $child1['thumb']; ?>" alt="<?php echo $child1['name']; ?>"></a></div>
                <?php } ?>
                <div>
                  <a <?php echo $child1['current'] ? '' : 'href="'.$child1['href'].'"'; ?> class="item-wrapper<?php echo $child1['current'] ? ' item-current' : ''; ?>">
                    <?php if ($icon && $child1['icon']) { ?>
                    <div class="item-icon">
                      <?php if ($icon_width && $icon_height) { ?>
                      <img src="<?php echo $child1['icon']; ?>" alt="<?php echo $child1['name']; ?>">
                      <?php } else { ?>
                      <img src="image/<?php echo $child1['icon']; ?>" alt="<?php echo $child1['name']; ?>">
                      <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="item-title<?php echo $icon && $child1['icon'] ? '' : ' item-arrow'; ?>"><?php echo $child1['name']; ?>
                    <?php if ($count && !$products_by_item) { ?>
                    <div class="item-count"><span><?php echo $child1['count']; ?></span></div>
                    <?php } ?>
                    <?php if ($products_by_item) { ?>
                    <div class="item-price">
                      <span>
                        <?php if (!$child1['special']) { ?>
                        <?php echo $child1['price']; ?>
                        <?php } else { ?>
                        <?php echo $child1['special']; ?>
                        <?php } ?>
                      </span>
                    </div>
                    <?php } ?>
                    </div>
                  </a>
                  <?php if ($child1['children2']) { ?>
                  <ul>
                    <div>
                      <?php foreach ($child1['children2'] as $child2) { ?>
                      <li>
                        <a <?php echo $child2['current'] ? '' : 'href="'.$child2['href'].'"'; ?> class="list-item-wrapper<?php echo $child2['current'] ? ' item-current' : ''; ?>">
                          <?php echo $child2['name']; ?>
                        </a>
                      </li>
                      <?php } ?>
                    </div>
                  </ul>
                  <?php } ?>
                </div>
              </li>
              <?php } ?>
            </div>
            <?php } ?>
            <?php if ($content_status && $item['content']) { ?>
            <div class="fm-content">
              <div><?php echo $item['content']; ?></div>
            </div>
            <?php } ?>
          </ul>
        </div>
        <?php } ?>
        <?php } ?>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<script type="text/javascript"><!--
$('#yo-<?php echo $module; ?> ul.yo-fm.fm-one li > a.item-wrapper').hover(function() {
  var li = $(this).closest('li');
  li.siblings('.active').removeClass('active');
});

$(window).on('resize', function() {
  var container = $('#yo-<?php echo $module; ?>').closest('.container').width();
  var menu = $('#yo-<?php echo $module; ?>').outerWidth();
  $('#yo-<?php echo $module; ?> .fm-container').outerWidth(container-menu);
}).resize();

$('#yo-<?php echo $module; ?> .yo-fm, #yo-<?php echo $module; ?> .yo-fm.fm-one ul>div').menuAim({
  submenuDirection: $('#yo-<?php echo $module; ?>').parents().is('#column-right') ? 'left' : 'right',
  activate: function(item){
    var height = $(item).parent('ul.yo-fm').height();
    $(item).find('>a.item-toggle').next('.fm-container').find('>ul').css('min-height',height);

    $(item).find('>a.item-toggle').next().show();
    $(item).siblings().find('>a.item-toggle').next().hide();
  },
  deactivate: function(item){
    $(item).find('>a.item-toggle').next().fadeOut(300);
  },
  exitMenu: function(item){
    $(item).find('.fm-container:visible').delay(700).fadeOut(300);
    return true;
  }
});

var toggle = $('#yo-<?php echo $module; ?> .toggle-title');

if (<?php echo $save_view; ?>) {
  if (!localStorage.getItem('yo-<?php echo $module; ?>')) {
    if (<?php echo $minimized; ?>) {
      localStorage.setItem('yo-<?php echo $module; ?>', 'collapsed');
    } else {
      localStorage.setItem('yo-<?php echo $module; ?>', 'expanded');
    }
  }

  $(toggle).click(function() {
    $(this).toggleClass('menu-expanded menu-collapsed').next().slideToggle(300);
    if ($(this).hasClass('menu-expanded')) {
      localStorage.setItem('yo-<?php echo $module; ?>', 'expanded');
    } else {
      localStorage.setItem('yo-<?php echo $module; ?>', 'collapsed');
    }
  });

  if (localStorage.getItem('yo-<?php echo $module; ?>') == 'expanded') {
    toggle.addClass('menu-expanded').removeClass('menu-collapsed').next().show();
  } else {
    toggle.addClass('menu-collapsed').removeClass('menu-expanded').next().hide();
  }
} else {
  localStorage.removeItem('yo-<?php echo $module; ?>');
  $(toggle).click(function() {
    $(this).toggleClass('menu-expanded menu-collapsed').next().slideToggle(300);
  });
}
//--></script>