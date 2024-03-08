<?php if (isset($slideshow) && count($slideshow) > 0) { ?>
  <div class="slideshow">
    <?php foreach ($slideshow as $v) { ?>
      <div class="slideshow-slide-item mb-[8px]">
        <a href="<?= $v['link'] ?>" target="_blank" class="slideshow-link overflow-hidden scale-img block" title="<?= $v['title'] ?>">
          <img class="w-[1920px] h-[930px] object-cover transition-[0.4s]" src="<?= isset($v['photo']) ? $configBase['baseUrl'] . UPLOAD_PHOTO . $v['photo'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>">
        </a>
      </div>
    <?php } ?>
  </div>
<?php } ?>

<?php if (isset($productBestSellers) && count($productBestSellers) > 0) { ?>
  <div class="product-best-sellert padd-top-bottom">
    <div class="wp-content">
      <h2 class="capitalize mb-2 text-3xl font-semibold text-center">
        Sản phẩm bán chạy
      </h2>
      <div class="product-slick-slide">
        <?php foreach ($productBestSellers as $v) {
          $href =  $configBase['baseUrl'] . $productType . '?slug=' . $v['slug'];
        ?>
          <div>

            <div class="product-slide-item">
              <?php if (Functions::checkStatus('banchay', $v['status'])) { ?>
                <div class="product__price--percent">
                  <p class="product__price--percent-detail">
                    Bán chạy
                  </p>
                </div>
              <?php } ?>
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
                    <span class="product-slide-contact">
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
    </div>
  </div>
<?php } ?>

<?php if (isset($productHot) && count($productHot) > 0) { ?>
  <div class="product-best-sellert padd-top-bottom">
    <div class="wp-content">
      <h2 class="capitalize mb-2 text-3xl font-semibold text-center">
        Sản phẩm Hot
      </h2>
      <div class="product-slick-slide-hot">
        <?php foreach ($productHot as $v) {
          $href =  $configBase['baseUrl'] . $productType . '?slug=' . $v['slug'];
        ?>
          <div>

            <div class="product-slide-item">
              <?php if (Functions::checkStatus('noibat', $v['status'])) { ?>
                <div class="product__price--percent">
                  <p class="product__price--percent-detail">
                    Hot
                  </p>
                </div>
              <?php } ?>
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
                    <span class="product-slide-contact">
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
    </div>
  </div>
<?php } ?>

<?php if (isset($news) && count($news) > 0) { ?>
  <div class="product-best-sellert padd-top-bottom">
    <div class="wp-content">
      <h2 class="capitalize mb-2 text-3xl font-semibold text-center">
        Tin tức nổi bật
      </h2>
      <div class="news-slick-slide">
        <?php foreach ($news as $v) {
          $href =  $configBase['baseUrl'] . $newsType . '?slug=' . $v['slug'];
        ?>
          <div>
            <div class="product-slide-item">
              <div class="product-slide-thumb mb-[8px]">
                <a href="<?= $href ?>" class="product-slide-link scale-img block w-[282px] h-[370px] rounded-xl" title="<?= $v['title'] ?>">
                  <img class="w-full h-full object-cover transition-[0.4s]" src="<?= isset($v['photo1']) ? $configBase['baseUrl'] . UPLOAD_NEWS . $v['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>">
                </a>
              </div>
              <h3 class="product-slide-name">
                <a href="<?= $href ?>" class="text-split hover:text-[#f00] transition-all" title="<?= $v['title'] ?>">
                  <?= $v['title'] ?>
                </a>
              </h3>
              <div class=" product-slide-action text-split">
                <?= htmlspecialchars_decode($v['description']) ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
<?php } ?>

<?php if (isset($partner) && count($partner) > 0) { ?>
  <section class="wp-partner">
    <div class="wp-content">
      <h2 class="capitalize mb-2 text-3xl font-semibold text-center">Đối tác khách hàng</h2>
      <div class="partner">
        <?php foreach ($partner as $v) { ?>
          <div class="partner-slide-item">
            <a href="<?= $v['link'] ?>" target="_blank" class="partner-link overflow-hidden scale-img block" title="<?= $v['title'] ?>">
              <img class="w-[175px] h-[95px] object-cover transition-[0.4s]" src="<?= isset($v['photo']) ? $configBase['baseUrl'] . UPLOAD_PHOTO . $v['photo'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>">
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
<?php } ?>

<section class="newsletter padd-top-bottom">
  <div class="wp-content">
    <h2 class="capitalize mb-2 text-3xl font-semibold text-center">Đăng ký nhận tin</h2>
    <form action="<?= $configBase['baseUrl'] . 'newsletter/stored' ?>" method="POST">
      <div class="bg-grey-lighter flex flex-col">
        <div class="container w-full">
          <div class="bg-white rounded shadow-md p-4 text-black w-full">
            <div class="form-group flex gap-2 mb-2">
              <div class="group-first w-[50%]">
                <input type="text" class="block border border-grey-light w-full p-3 rounded" name="fullname" placeholder="Họ tên" value="<?php echo Flash::get('fullname', 'success') ?>" />
                <span class="text-red-600"><?php echo Flash::get('fullname', 'danger') ?></span>
              </div>
              <div class="group-second w-[50%]">
                <input type="text" class="block border border-grey-light w-full p-3 rounded" name="email" id="email" placeholder="Email" value="<?php echo Flash::get('email', 'success') ?>" />
                <span class="text-red-600"><?php echo Flash::get('email', 'danger') ?></span>
              </div>
            </div>
            <div class="form-group flex gap-2 mb-2">
              <div class="group-first w-[50%]">
                <input type="number" class="block border border-grey-light w-full p-3 rounded" name="phone" placeholder="Số điện thoại" value="<?php echo Flash::get('phone', 'success') ?>" />
                <span class="text-red-600"><?php echo Flash::get('phone', 'danger') ?></span>
              </div>
              <div class="group-second w-[50%]">
                <input type="text" class="block border border-grey-light w-full p-3 rounded" name="address" id="address" placeholder="Địa chỉ" value="<?php echo Flash::get('address', 'success') ?>" />
                <span class="text-red-600"><?php echo Flash::get('address', 'danger') ?></span>
              </div>
            </div>
            <div class="form-group-static mb-3">
              <textarea name="subject" id="subject" class="block border border-grey-light w-full p-3 rounded" cols="30" rows="4" placeholder="Chủ đề"></textarea>
              <span class="text-red-600"><?php echo Flash::get('subject', 'danger') ?></span>
            </div>
            <div class="form-group-static mb-3">
              <textarea name="note" id="note" class="block border border-grey-light w-full p-3 rounded" cols="30" rows="4" placeholder="Ghi chú"></textarea>
              <span class="text-red-600"><?php echo Flash::get('note', 'danger') ?></span>
            </div>
            <input type="submit" name="newsletter" class="w-full text-center py-3 rounded bg-green-600 text-white hover:bg-green-dark focus:outline-none my-1" value="Đăng ký ngay" />
          </div>
        </div>
      </div>
  </div>
  </form>
  </div>
</section>