<?php
// Functions::dd($_SESSION);
?>
<?= $share->main('app/views/partials/breadcrumb.php'); ?>
<div class="wp-content mt-8">
  <div class="product-detail flex flex-wrap gap-4">
    <div class="product-detail-left w-[30%]">
      <div class="relative w-[360px] overflow-hidden">
        <div class="pb-[100%] relative w-full">
          <picture class="scale-img">
            <img class="img-main w-full h-full absolute left-0 top-0 object-cover block transition-all" src="<?= isset($productDetail['photo1']) ? $configBase['baseUrl'] . UPLOAD_PRODUCT . $productDetail['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $productDetail['title'] ?>">
          </picture>
        </div>
      </div>
      <div class="slideshow-gallery mt-2 relative overflow-hidden mx-auto">
        <?php foreach ($gallerys as $v) { ?>
          <div class="slide-gallery-item cursor-pointer">
            <img data-src="<?= $configBase['baseUrl'] . UPLOAD_GALLERY . $v['photo'] ?>" src="<?= isset($v['photo']) ? $configBase['baseUrl'] . UPLOAD_GALLERY . $v['photo'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" class="slide-img w-full object-cover" />
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="product-detail-right w-[calc(70%-16px)]">
      <h2 class="text-3xl uppercase">
        <?= $productDetail['title'] ?>
      </h2>
      <div class="product-code">
        <strong>Mã sản phẩm:</strong>
        <?= $productDetail['code'] ?>
      </div>
      <div class="product-qty">
        <strong>Số lượng:</strong>
        <?= $productDetail['quantity'] ?>
      </div>
      <div class="product-price">
        <strong>Giá:</strong>
        <span class="text-red-600 text-[16px] font-bold price-new"><?= Functions::formatMoney($productDetail['sale_price']) ?></span>
        <small class="line-through text-gray-600 price-odd"><?= Functions::formatMoney($productDetail['regular_price']) ?></small>
      </div>
      <div class="product-opt py-1">
        <?php if (isset($sizeByProductSale) && count($sizeByProductSale) > 0) { ?>
          <select class="size-box mr-1 cursor-pointer" name="size">
            <option value="">Chọn size</option>
            <?php foreach ($sizeByProductSale as $ksize => $vsize) { ?>
              <option value="<?= $vsize['id_parent'] ?>" data-size="<?= $vsize['name_size'] ?>" data-ids="<?= $vsize['id_size'] ?>" data-sprice="<?= $vsize['sale_price'] ?>" data-rprice="<?= $vsize['regular_price'] ?>"><?= $vsize['name_size'] ?></option>
            <?php } ?>
          </select>
        <?php } ?>

        <?php if (isset($colorByProductSale) && count($colorByProductSale) > 0) { ?>
          <select class="color-box cursor-pointer">
            <option value="">Chọn màu</option>
            <?php foreach ($colorByProductSale as $kcolor => $vcolor) { ?>
              <option value="<?= $vcolor['id_parent'] ?>" data-color="<?= $vcolor['name_color'] ?>" data-idc="<?= $vcolor['id_color'] ?>" data-photo="<?= 'upload/color/' . $vcolor['photo_color'] ?>" data-sprice="<?= $vcolor['sale_price'] ?>" data-rprice="<?= $vcolor['regular_price'] ?>"><?= $vcolor['name_color'] ?></option>
            <?php } ?>
          </select>
        <?php } ?>
      </div>
      <div class="product-desc">
        <?= htmlspecialchars_decode($productDetail['description']) ?>
      </div>
      <a data-id="<?= $productDetail['id'] ?>" class="cart-buy block" title="Mua hàng">
        Mua hàng
      </a>
    </div>
  </div>
</div>

<div class="wp-content mt-8 mb-8">
  <?= htmlspecialchars_decode($productDetail['content']) ?>
</div>