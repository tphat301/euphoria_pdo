<nav class="nav-mn">
  <div class="wp-content flex items-center justify-between py-[10px]">
    <a href="<?= $this->url ?>" class="logo block w-[93px] h-[45px]" title="<?= $logo['title'] ?>">
      <img src="<?= $this->url . UPLOAD_PHOTO . $logo['photo'] ?>" class="w-full h-full object-contain" alt="<?= $logo['title'] ?>" />
    </a>
    <button class="navbar-toggler"><i class="fa-solid fa-bars"></i></button>
    <ul class="menu flex items-center">
      <li><a href="<?= $this->url ?>" class="<?= $uri === '' ? 'menu_active' : '' ?>" title="Trang chủ">Trang chủ</a></li>
      <li><a class="<?= $uri === 'gioi-thieu' ? 'menu_active' : '' ?>" href="gioi-thieu">Giới thiệu</a></li>
      <li>
        <a href="san-pham" class="<?= $uri === 'san-pham' ? 'menu_active' : '' ?>" title="Sản phẩm">Sản phẩm</a>
        <?= $categoryProduct ?>
      </li>
      <li>
        <a href="tin-tuc" class="<?= $uri === 'tin-tuc' ? 'menu_active' : '' ?>" title="Tin tức">Tin tức</a>
      </li>
      <?php if (isset($_SESSION['login'])) { ?>
        <li><a href="<?= $this->url . 'cart' ?>">Giỏ hàng</a></li>
      <?php } ?>
      <li>
        <div class="menu-search responsive">
          <input type="text" id="keyword" class="search px-[10px] py-[4px] outline-none" placeholder="Search..." value="<?= (!empty($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" onkeypress="doEnter(event,'keyword');" />
          <p class="mb-0 search-icon" onclick="onSearch('keyword');">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.6363 17.697C16.9292 17.9899 17.4041 17.9899 17.697 17.697C17.9899 17.4041 17.9899 16.9292 17.697 16.6363L16.6363 17.697ZM13.9167 8.83334C13.9167 11.6408 11.6408 13.9167 8.83334 13.9167V15.4167C12.4692 15.4167 15.4167 12.4692 15.4167 8.83334H13.9167ZM8.83334 13.9167C6.02589 13.9167 3.75 11.6408 3.75 8.83334H2.25C2.25 12.4692 5.19746 15.4167 8.83334 15.4167V13.9167ZM3.75 8.83334C3.75 6.02589 6.02589 3.75 8.83334 3.75V2.25C5.19746 2.25 2.25 5.19746 2.25 8.83334H3.75ZM8.83334 3.75C11.6408 3.75 13.9167 6.02589 13.9167 8.83334H15.4167C15.4167 5.19746 12.4692 2.25 8.83334 2.25V3.75ZM12.4697 13.5303L16.6363 17.697L17.697 16.6363L13.5303 12.4697L12.4697 13.5303Z" fill="#807D7E" />
            </svg>

          </p>
        </div>
      </li>
    </ul>
    <div class="menu-search">
      <input type="text" id="keyword" class="search px-[10px] py-[4px] outline-none" placeholder="Search..." value="<?= (!empty($_GET['keyword'])) ? $_GET['keyword'] : '' ?>" onkeypress="doEnter(event,'keyword');" />
      <p class="mb-0 search-icon" onclick="onSearch('keyword');">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.6363 17.697C16.9292 17.9899 17.4041 17.9899 17.697 17.697C17.9899 17.4041 17.9899 16.9292 17.697 16.6363L16.6363 17.697ZM13.9167 8.83334C13.9167 11.6408 11.6408 13.9167 8.83334 13.9167V15.4167C12.4692 15.4167 15.4167 12.4692 15.4167 8.83334H13.9167ZM8.83334 13.9167C6.02589 13.9167 3.75 11.6408 3.75 8.83334H2.25C2.25 12.4692 5.19746 15.4167 8.83334 15.4167V13.9167ZM3.75 8.83334C3.75 6.02589 6.02589 3.75 8.83334 3.75V2.25C5.19746 2.25 2.25 5.19746 2.25 8.83334H3.75ZM8.83334 3.75C11.6408 3.75 13.9167 6.02589 13.9167 8.83334H15.4167C15.4167 5.19746 12.4692 2.25 8.83334 2.25V3.75ZM12.4697 13.5303L16.6363 17.697L17.697 16.6363L13.5303 12.4697L12.4697 13.5303Z" fill="#807D7E" />
        </svg>

      </p>
    </div>
  </div>
</nav>