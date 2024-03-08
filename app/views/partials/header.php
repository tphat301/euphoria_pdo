<header>
  <div class="header-sub bg-[#121212]">
    <div class="wp-content flex justify-between items-center py-2">
      <div class="header-info text-white flex tems-center">
        <p class="mb-0 header-email pr-4">
          <span class="text-white"><i class="fa-solid fa-envelope"></i> Email:</span>
          <span class="text-white">
            <?= $options->email ?>
          </span>
        </p>
        <p class="header-phone mb-0">
          <span class="text-white">
            <i class="fa-solid fa-phone"></i> Hotline:
          </span>
          <span class="text-white">
            <?= Functions::formatPhone($options->hotline) ?>
          </span>
        </p>
      </div>
      <div class="header-sub-auth flex items-center">
        <?php if (isset($_SESSION['login'])) { ?>
          <a class="text-white no-underline block pr-4" title=" <?= $_SESSION['login']['username'] ?>">
            <i class="fa-solid fa-user"></i> <?= $_SESSION['login']['username'] ?>
          </a>
          <a href="<?= $this->url . 'logout' ?>" class="text-white no-underline block pr-4" title="Đăng ký">
            <i class="fas fa-sign-in-alt"></i> Đăng xuất
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="header-slogan bg-[#6c6b6b] py-2">
    <div class="wp-content">
      <marquee class="block m-0 text-white">
        <?= $slogan['title'] ?>
      </marquee>
    </div>
  </div>
</header>