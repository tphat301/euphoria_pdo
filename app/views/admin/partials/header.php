<?php
$countNewsletter = $d->select(
  '*',
  'newsletter',
  "`type` = 'newsletter' AND find_in_set('hienthi',status) ORDER BY num,id DESC"
);
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item nav-item-hello d-sm-inline-block">
      <a class="nav-link"><span class="text-split">Xin chào, <?= Flash::get('fullname', 'login_admin') ?>!</span></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto align-items-center">
    <!-- Notifications -->

    <!-- Lang -->
    <?php if (isset($configAdmin['main']['lang']) && $configAdmin['main']['lang'] === true) { ?>
      <li class="nav-item d-sm-inline-block">
        <a href="#" class="mr-1"><img src="<?= $configBase['baseUrl'] . 'public/images/vi.jpg' ?>" alt="Vietnam" title="Vietnam"></a>
        <a href="#"><img src="<?= $configBase['baseUrl'] . 'public/images/en.jpg' ?>" alt="English" title="English"></a>
      </li>
    <?php } ?>

    <li class="nav-item d-sm-inline-block">
      <a href="<?= $configBase['baseUrl'] ?>" target="_blank" class="nav-link"><i class="fas fa-reply"></i></a>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" data-bs-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        <span class="badge badge-danger"><?= isset($countNewsletter) ? count($countNewsletter) : 0 ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow">
        <span class="dropdown-item dropdown-header p-0">Thông báo</span>
        <div class="dropdown-divider"></div>
        <a href="" class="dropdown-item"><i class="fas fa-mail-bulk mr-2"></i><span class="badge badge-danger mr-1"><?= isset($countNewsletter) ? count($countNewsletter) : 0 ?></span>Đăng ký nhận tin</a>
      </div>
    </li>
    <li class="nav-item d-sm-inline-block">
      <a href="<?= $configBase['baseUrl'] . 'admin/logout' ?>" class="nav-link"><i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất</a>
    </li>
  </ul>
</nav>