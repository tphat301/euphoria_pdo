<head>
  <!-- UTF-8 -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <!-- Title, Keywords, Description -->
  <title><?= Functions::get('title') ?></title>
  <meta name="keywords" content="<?= Functions::get('keywords') ?>" />
  <meta name="description" content="<?= Functions::get('description') ?>" />

  <!-- Robots -->
  <meta name="robots" content="index,follow" />

  <!-- Favicon -->
  <link href="<?= $this->url . UPLOAD_PHOTO . $favicon['photo'] ?>" rel="shortcut icon" type="image/x-icon" />

  <!-- GEO -->
  <meta name="geo.region" content="VN" />
  <meta name="geo.placename" content="Hồ Chí Minh" />
  <meta name="geo.position" content="10.823099;106.629664" />
  <meta name="ICBM" content="10.823099, 106.629664" />

  <!-- Author - Copyright -->
  <meta name='revisit-after' content='1 days' />
  <meta name="author" content="<?= $setting['title'] ?>" />
  <meta name="copyright" content="<?= $setting['copyright'] ?>" />

  <!-- Facebook -->
  <meta property="og:type" content="<?= Functions::get('description') ?>" />
  <meta property="og:site_name" content="<?= $setting['title'] ?>" />
  <meta property="og:title" content="<?= Functions::get('title') ?>" />
  <meta property="og:description" content="<?= Functions::get('description') ?>" />
  <meta property="og:url" content="<?= $this->url . $uri ?>" />
  <meta property="og:image" content="<?= Functions::get('photo1') ?>" />
  <meta property="og:image:alt" content="<?= Functions::get('title') ?>" />
  <meta property="og:image:type" content="<?= Functions::get('photo1') ?>" />
  <meta property="og:image:width" content="250" />
  <meta property="og:image:height" content="250" />

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="<?= $options->email ?>" />
  <meta name="twitter:creator" content="<?= $setting['title'] ?>" />
  <meta property="og:url" content="<?= $this->url . $uri ?>" />
  <meta property="og:title" content="<?= Functions::get('title') ?>" />
  <meta property="og:description" content="<?= Functions::get('description') ?>" />
  <meta property="og:image" content="<?= Functions::get('photo1') ?>" />

  <!-- Canonical -->
  <link rel="canonical" href="<?= $this->url ?>" />

  <!-- Chống đổi màu trên IOS -->
  <meta name="format-detection" content="telephone=no">

  <!-- Viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <?php require(dirname(dirname(__FILE__)) . "/partials/css.php") ?>
</head>