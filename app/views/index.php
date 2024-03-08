<?php
define('UPLOAD_PHOTO', 'upload/photo/');
define('UPLOAD_PRODUCT', 'upload/product/');
define('UPLOAD_NEWS', 'upload/news/');
define('UPLOAD_SEOPAGE', 'upload/seopage/');
define('UPLOAD_GALLERY', 'upload/gallery/');
$configBase = Configurations::configurationsBase();
$share = new Share();
?>
<!DOCTYPE html>
<html lang="en">

<?php
$share->main('app/views/partials/head.php');
$share->main('app/views/partials/header.php');
$share->main('app/views/partials/menu.php');
?>

<body>
  <div class="wrapper">
    <?php
    switch ($module) {
      case 'index':
        require("home/index_tpl.php");
        break;

      case 'about':
        require("about/$action" . "_tpl.php");
        break;

      case 'product':
        require("product/$action" . "_tpl.php");
        break;

      case 'news':
        require("news/$action" . "_tpl.php");
        break;
      case 'policy':
        require("policy/$action" . "_tpl.php");
        break;

      case 'cart':
        require("cart/$action" . "_tpl.php");
        break;

      case '404':
        require("404/$action" . "_tpl.php");
        break;

      case 'user':
        require("user/$action" . "_tpl.php");
        break;

      default:
        Functions::notFound();
        break;
    }
    ?>
  </div>
  <?= $share->main('app/views/partials/footer.php'); ?>
  <?php require('partials/js.php'); ?>
</body>

</html>