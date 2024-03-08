<div class="breadCrumbs bg-gray-200 py-2">
  <div class="wp-content">
    <ol class="breadcrumb flex items-center gap-x-2">
      <li>
        <a href="<?= $this->url ?>" class="no-underline" title="Trang chủ">
          Trang chủ
        </a>
      </li>
      <li>/</li>
      <li>
        <a href="<?= $this->url . $uri ?>" class="no-underline text-red-600" title="<?= Functions::get('title') ?>">
          <?= Functions::get('title') ?>
        </a>
      </li>
    </ol>
  </div>
</div>