<footer class="footer">
  <div class="footer-article">
    <div class="wp-content flex gap-x-4">
      <div class="footer-news w-[33.33%] py-4">
        <p class="mb-3 text-2xl font-semibold">
          <?= $footer['title'] ?>
        </p>
        <div class="footer-content">
          <?= htmlspecialchars_decode($footer['content']) ?>
        </div>
        <?php if (isset($socialFooter) && count($socialFooter) > 0) { ?>
          <ul class="social_footer mt-2 flex gap-x-2">
            <?php foreach ($socialFooter as $k => $v) { ?>
              <li><a href="<?= $v['link'] ?>" target="_blank" class="underline" title="<?= $v['title'] ?>"><img src="<?= isset($v['photo']) ? $this->url . UPLOAD_PHOTO . $v['photo'] : $this->url . 'public/images/noimage.png' ?>" width="30" height="30" alt="<?= $v['title'] ?>" /></a></li>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>
      <div class="footer-news w-[33.33%] py-4">
        <p class="mb-3 text-2xl font-semibold">
          Chính sách
        </p>
        <?php if (isset($policy) && count($policy) > 0) { ?>
          <ul class="footer-list">
            <?php foreach ($policy as $k => $v) { ?>
              <li><a href="<?= $this->url . 'chinh-sach?slug=' . $v['slug'] ?>"><?= $v['title'] ?></a></li>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>
      <div class="footer-news w-[33.33%] py-4">
        <p class="mb-3 text-2xl font-semibold">
          Fanpage
        </p>
        <?php if (!Functions::isGoogleSpeed()) { ?>
          <div id="fb-root"></div>
          <div class="fanpage-fb">
            <div class="fb-page" data-href="<?= $options->fanpage ?>" data-tabs="timeline" data-width="300" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
              <blockquote cite="<?= $options->fanpage ?>" class="fb-xfbml-parse-ignore"><a href="<?= $options->fanpage ?>">Facebook</a></blockquote>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="footer-cp bg-[#121212]">
    <div class="wp-content">
      <div class="w-full mx-auto max-w-screen-xl  p-4 md:flex md:items-center md:justify-center">
        <span class="text-sm text-white sm:text-center dark:text-gray-400">© 2024 <a class="underline capitalize"><?= $setting['copyright'] ?></a>. All Rights Reserved.
        </span>
      </div>
    </div>
</footer>
<a class="btn-zalo btn-frame text-decoration-none" target="_blank" href="https://zalo.me/<?= $options->zalo ?>">
  <div class="animated infinite zoomIn kenit-alo-circle"></div>
  <div class="animated infinite pulse kenit-alo-circle-fill"></div>
  <i>
    <img src="<?= $this->url . 'public/images/zl.png' ?>" alt="">
  </i>
</a>
<a class="btn-phone btn-frame text-decoration-none" href="tel:<?= $options->hotline ?>">
  <div class="animated infinite zoomIn kenit-alo-circle"></div>
  <div class="animated infinite pulse kenit-alo-circle-fill"></div>
  <i><img src="<?= $this->url . 'public/images/hl.png' ?>" alt=""></i>
</a>
<div class="gg-map">
  <?= $options->iframe_ggmap ?>
</div>
<a id="button_back_to_top"></a>