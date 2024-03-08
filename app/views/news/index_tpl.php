<?= $share->main('app/views/partials/breadcrumb.php'); ?>
<main class="wp-content mb-8">
  <h2 class="title-main uppercase text-center text-3xl mt-3">
    <?= $titleMain ?>
  </h2>
  <?php if (isset($news) && count($news) > 0) { ?>
    <div class="product-page">
      <?php foreach ($news as $k => $v) {
        $href =  $configBase['baseUrl'] . $newsType . '?slug=' . $v['slug'];
      ?>
        <div class="product-page-item relative">
          <div class="product-slide-item">
            <div class="product-slide-thumb mb-[8px]">
              <a href="<?= $href ?>" class="product-slide-link rounded-xl scale-img block w-[282px] h-[370px]" title="<?= $v['title'] ?>">
                <img class="w-full h-full object-cover transition-[0.4s]" src="<?= isset($v['photo1']) ? $configBase['baseUrl'] . UPLOAD_NEWS . $v['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>">
              </a>
            </div>
            <h3 class="product-slide-name">
              <a href="<?= $href ?>" class="text-split hover:text-[#f00] transition-all" title="<?= $v['title'] ?>">
                <?= $v['title'] ?>
              </a>
            </h3>
            <div class="news-desc text-split">
              <?= htmlspecialchars_decode($v['description']) ?>
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