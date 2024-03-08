<?= $share->main('app/views/partials/breadcrumb.php'); ?>
<main class="wp-content">
  <h2 class="title-main uppercase text-center text-3xl mt-3">
    <?= $titleMain ?>
  </h2>
  <?php if (isset($products) && count($products) > 0) { ?>
    <div class="product-page">
      <?php foreach ($products as $k => $v) {
        $href =  $configBase['baseUrl'] . $productType . '?slug=' . $v['slug'];
      ?>
        <div class="product-page-item relative">
          <div class="product-slide-item h-[438px]">
            <div class="product-slide-thumb mb-[8px]">
              <a href="<?= $href ?>" class="product-slide-link rounded-xl overflow-hidden scale-img block w-[282px] h-[370px]" title="<?= $v['title'] ?>">
                <img class="w-full h-full object-cover transition-[0.4s]" src="<?= isset($v['photo1']) ? $configBase['baseUrl'] . UPLOAD_PRODUCT . $v['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>">
              </a>
            </div>
            <h3 class="product-slide-name">
              <a href="<?= $href ?>" class="text-split hover:text-[#f00] transition-all" title="<?= $v['title'] ?>">
                <?= $v['title'] ?>
              </a>
            </h3>
            <div class=" product-slide-action">
              <p class="mb-0 product-slide-box">
                <?php if (!empty($v['sale_price'])) { ?>
                  <span class="product-slide-price-new">
                    <?= Functions::formatMoney($v['sale_price']) ?>
                  </span>
                  <span class="product-slide-price-old line-through">
                    <?= Functions::formatMoney($v['regular_price']) ?>
                  </span>
                  <?php if (!empty($v['regular_price'])) { ?>
                    <span class="product-slide-discount">
                      <?= $v['discount'] . '%' ?>
                    </span>
                  <?php } ?>
                <?php } else { ?>
                  <span class="product-slide-contact text-red-600">
                    Liên hệ
                  </span>
                <?php } ?>
              </p>
              <?php if (!empty($v['sale_price'])) { ?>
                <a data-id="<?= $v['id'] ?>" class="mb-0 cart-buy add-to-cart cursor-pointer">
                  <i class="fa-solid fa-cart-shopping"></i>
                </a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
  <?php if (isset($paginate)) {
    echo $paginate;
  } ?>
</main>