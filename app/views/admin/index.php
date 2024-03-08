<?php
$configBase = Configurations::configurationsBase();
$configAdmin = Configurations::configurationsBackEnd();
$uri = Functions::URI($configBase['url']);
$d = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<?php require('partials/head.php'); ?>

<body>
  <div class="wrapper">

    <?php
    switch ($module) {
      case 'dashboard':
        require("dashboard/$action" . "_tpl.php");
        break;

      case 'auth':
        require("auth/$action" . "_tpl.php");
        break;

      case 'news':
        require("news/$action" . "_tpl.php");
        break;

      case 'category_news1':
        require("category_news1/$action" . "_tpl.php");
        break;

      case 'category_news2':
        require("category_news2/$action" . "_tpl.php");
        break;

      case 'category_news3':
        require("category_news3/$action" . "_tpl.php");
        break;

      case 'category_news4':
        require("category_news4/$action" . "_tpl.php");
        break;

      case 'soft_delete_news':
        require("soft_delete_news/$action" . "_tpl.php");
        break;

      case 'product':
        require("product/$action" . "_tpl.php");
        break;

      case 'category_product1':
        require("category_product1/$action" . "_tpl.php");
        break;

      case 'category_product2':
        require("category_product2/$action" . "_tpl.php");
        break;

      case 'category_product3':
        require("category_product3/$action" . "_tpl.php");
        break;

      case 'category_product4':
        require("category_product4/$action" . "_tpl.php");
        break;

      case 'soft_delete_product':
        require("soft_delete_product/$action" . "_tpl.php");
        break;

      case 'static':
        require("static/$action" . "_tpl.php");
        break;

      case 'setting':
        require("setting/$action" . "_tpl.php");
        break;

      case 'newsletter':
        require("newsletter/$action" . "_tpl.php");
        break;

      case 'seopage':
        require("seopage/$action" . "_tpl.php");
        break;

      case 'photo':
        require("photo/$action" . "_tpl.php");
        break;

      case 'photo_static':
        require("photo_static/$action" . "_tpl.php");
        break;

      case 'order':
        require("order/$action" . "_tpl.php");
        break;

      case 'policy':
        require("policy/$action" . "_tpl.php");
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
  <?php require('partials/js.php'); ?>
</body>

</html>