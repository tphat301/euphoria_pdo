<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
  <!-- Logo -->
  <a class="brand-link" href="">
    <img class="brand-image" src="<?= $configBase['baseUrl'] . 'public/images/Logo.png' ?>" alt="Logo">
  </a>

  <!-- Sidebar admin -->
  <div class="sidebar">
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard nav -->
        <li class="nav-item">
          <a class="nav-link <?= $uri === $module ? 'active' : '' ?>" href="<?= $configBase['baseUrl'] . 'admin/dashboard' ?>" title="Dashboard">
            <i class="nav-icon text-sm fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Product -->
        <?= Functions::renderNav('product', '<i class="nav-icon text-sm fas fa-layer-group"></i>'); ?>
        <!-- News -->
        <?= Functions::renderNav('news', '<i class="nav-icon text-sm fas fa-shopping-bag"></i>'); ?>
        <!-- Policy -->
        <?= Functions::renderNav('policy', '<i class="nav-icon text-sm fas fa-shopping-bag"></i>'); ?>
        <!-- Newsletter -->
        <?php if (isset($configAdmin['newsletter']['sidebar']) && $configAdmin['newsletter']['sidebar'] === true) { ?>
          <li class="nav-item has-treeview <?= $uri === 'admin/newsletter/index' || $uri === 'admin/newsletter/create' ? 'menu-open' : '' ?>">
            <a class="nav-link" href="javascript:void()" title="<?= $configAdmin['newsletter']['name'] ?>">
              <i class="nav-icon text-sm fas fa-envelope"></i>
              <p>
                Quản lý <?= $configAdmin['newsletter']['name'] ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link <?= $uri === 'admin/newsletter/index' || $uri === 'admin/newsletter/create' ? 'active' : '' ?>" href="<?= $configBase['baseUrl'] . 'admin/newsletter/index' ?>" title="<?= $configAdmin['newsletter']['name'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                  <p><?= $configAdmin['newsletter']['name'] ?></p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <!-- Multiple Photo -->
        <?= Functions::renderStaticNav('photo', ['slideshow', 'partner', 'social_footer'], '<i class="nav-icon text-sm fas fa-photo-video"></i>') ?>
        <!-- Static Photo -->
        <?= Functions::renderStaticNav('static_photo', ['logo', 'favicon'], '<i class="nav-icon text-sm fas fa-bookmark"></i>') ?>
        <!-- Static -->
        <?= Functions::renderStaticNav('static', ['slogan', 'about', 'contact', 'footer'], '<i class="nav-icon text-sm fas fa-bookmark"></i>') ?>
        <!-- SeoPage -->
        <?= Functions::renderStaticNav('seopage', ['home', 'product', 'static', 'news' /*'contact'*/], '<i class="nav-icon text-sm fas fa-share-alt"></i>') ?>

        <!-- Order -->
        <?php if (isset($configAdmin['order']['sidebar']) && $configAdmin['order']['sidebar'] === true) { ?>
          <li class="nav-item has-treeview <?= $uri === 'admin/order/index' ? 'menu-open' : '' ?>">
            <a class="nav-link" href="javascript:void()" title="<?= $configAdmin['order']['name'] ?>">
              <i class="nav-icon text-sm fas fa-cogs"></i>
              <p>
                Quản lý <?= $configAdmin['order']['name'] ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link <?= $uri === 'admin/order/index' ? 'active' : '' ?>" href="<?= $configBase['baseUrl'] . 'admin/order/index' ?>" title="<?= $configAdmin['order']['name'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                  <p><?= $configAdmin['order']['name'] ?></p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>

        <!-- Setting -->
        <?php if (isset($configAdmin['setting']['sidebar']) && $configAdmin['setting']['sidebar'] === true) { ?>
          <li class="nav-item has-treeview <?= $uri === 'admin/setting/index' ? 'menu-open' : '' ?>">
            <a class="nav-link" href="javascript:void()" title="<?= $configAdmin['setting']['name'] ?>">
              <i class="nav-icon text-sm fas fa-cogs"></i>
              <p>
                Quản lý <?= $configAdmin['setting']['name'] ?>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link <?= $uri === 'admin/setting/index' ? 'active' : '' ?>" href="<?= $configBase['baseUrl'] . 'admin/setting/index' ?>" title="<?= $configAdmin['setting']['name'] ?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                  <p><?= $configAdmin['setting']['name'] ?></p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>