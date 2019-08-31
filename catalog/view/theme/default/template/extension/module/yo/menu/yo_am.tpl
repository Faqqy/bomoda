<div id="yo-<?php echo $module; ?>" class="<?php echo $box_class; ?>">
  <?php if ($title) { ?>
  <div class="<?php echo $title_class ? $title_class : ''; ?> <?php echo $minimized ? 'menu-collapsed' : 'menu-expanded'; ?> toggle-title"><?php echo $title; ?></div>
  <?php } ?>
  <div <?php echo $content_class ? 'class="'.$content_class.'"' : ''; ?> <?php echo $minimized ? 'style="display:none"' : ''; ?>>
    <ul class="yo-<?php echo $menu_design; ?>">
      <?php foreach ($items as $item) { ?>
      <li class="active" <?php echo $item['active'] ?  : ''; ?>>
        <a <?php echo $item['current'] ? '' : 'href="'.$item['href'].'"'; ?> class="item-wrapper<?php echo $item['children1'] && !$toggle ? ' item-toggle' : ''; ?><?php echo $item['current'] ? ' item-current' : ''; ?>">
          <?php if ($icon && $item['icon']) { ?>
          <div class="item-icon">
            <?php if ($icon_width && $icon_height) { ?>
            <img src="<?php echo $item['icon']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } else { ?>
            <img src="image/<?php echo $item['icon']; ?>" alt="<?php echo $item['name']; ?>">
            <?php } ?>
          </div>
          <?php } ?>
          <div style="font-weight: bold;" class="item-title disabled"><?php echo $item['name']; ?></div>
          <?php if ($count) { ?>

          <?php } ?>
        </a>
        <?php if ($item['children1']) { ?>
        <ul>
          <?php if ($image && $item['thumb']) { ?>
          <li class="item-image"><a <?php echo $item['current'] ? '' : 'href="'.$item['href'].'"'; ?> title="<?php echo $item['name']; ?>"><img src="<?php echo $item['thumb']; ?>" alt="<?php echo $item['name']; ?>"></a></li>
          <?php } ?>
          <?php foreach ($item['children1'] as $child1) { ?>
          <li <?php echo $child1['active'] && $child1['children2'] ? 'class="active"' : ''; ?>>
            <a <?php echo $child1['current'] ? '' : 'href="'.$child1['href'].'"'; ?> class="item-wrapper<?php echo $child1['children2'] && !$toggle ? ' item-toggle' : ''; ?><?php echo $child1['current'] ? ' item-current' : ''; ?>">
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
              <div class="item-count<?php echo $toggle ? '-tb' : ''; ?><?php echo $toggle && $child1['children2'] ? '-parent' : ''; ?>"><span><?php echo $child1['count']; ?></span></div>
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
              <?php if ($child1['children2'] && $toggle) { ?>
              <div class="btn-toggle"><span></span></div>
              <?php } ?>
            </a>
            <?php if ($child1['children2']) { ?>
            <ul>
              <?php if ($image && $child1['thumb']) { ?>
              <li class="item-image"><a <?php echo $child1['current'] ? '' : 'href="'.$child1['href'].'"'; ?> title="<?php echo $child1['name']; ?>"><img src="<?php echo $child1['thumb']; ?>" alt="<?php echo $child1['name']; ?>"></a></li>
              <?php } ?>
              <?php foreach ($child1['children2'] as $child2) { ?>
              <li <?php echo $child2['active'] && $child2['children3'] ? 'class="active"' : ''; ?>>
                <a <?php echo $child2['current'] ? '' : 'href="'.$child2['href'].'"'; ?> class="item-wrapper<?php echo $child2['children3'] && !$toggle ? ' item-toggle' : ''; ?><?php echo $child2['current'] ? ' item-current' : ''; ?>">
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
                  <div class="item-count<?php echo $toggle ? '-tb' : ''; ?><?php echo $toggle && $child2['children3'] ? '-parent' : ''; ?>"><span><?php echo $child2['count']; ?></span></div>
                  <?php } ?>
                  <?php if ($child2['children3'] && $toggle) { ?>
                  <div class="btn-toggle"><span></span></div>
                  <?php } ?>
                </a>
                <?php if ($child2['children3']) { ?>
                <ul>
                  <?php if ($image && $child2['thumb']) { ?>
                  <li class="item-image"><a <?php echo $child2['current'] ? '' : 'href="'.$child2['href'].'"'; ?> title="<?php echo $child2['name']; ?>"><img src="<?php echo $child2['thumb']; ?>" alt="<?php echo $child2['name']; ?>"></a></li>
                  <?php } ?>
                  <?php foreach ($child2['children3'] as $child3) { ?>
                  <li <?php echo $child3['active'] && $child3['children4'] ? 'class="active"' : ''; ?>>
                    <a <?php echo $child3['current'] ? '' : 'href="'.$child3['href'].'"'; ?> class="item-wrapper<?php echo $child3['children4'] && !$toggle ? ' item-toggle' : ''; ?><?php echo $child3['current'] ? ' item-current' : ''; ?>">
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
                      <div class="item-count<?php echo $toggle ? '-tb' : ''; ?><?php echo $toggle && $child3['children4'] ? '-parent' : ''; ?>"><span><?php echo $child3['count']; ?></span></div>
                      <?php } ?>
                      <?php if ($child3['children4'] && $toggle) { ?>
                      <div class="btn-toggle"><span></span></div>
                      <?php } ?>
                    </a>
                    <?php if ($child3['children4']) { ?>
                    <ul>
                      <?php if ($image && $child3['thumb']) { ?>
                      <li class="item-image"><a <?php echo $child3['current'] ? '' : 'href="'.$child3['href'].'"'; ?> title="<?php echo $child3['name']; ?>"><img src="<?php echo $child3['thumb']; ?>" alt="<?php echo $child3['name']; ?>"></a></li>
                      <?php } ?>
                      <?php foreach ($child3['children4'] as $child4) { ?>
                      <li class="active">
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
                          <div class="item-count<?php echo $toggle ? '-tb' : ''; ?>"><span><?php echo $child4['count']; ?></span></div>
                          <?php } ?>
                        </a>
                      </li>
                      <?php } ?>
                    </ul>
                    <?php } ?>
                  </li>
                  <?php } ?>
                </ul>
                <?php } ?>
              </li>
              <?php } ?>
            </ul>
            <?php } ?>
          </li>
          <?php } ?>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

