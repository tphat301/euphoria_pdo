<?= $share->main('app/views/partials/breadcrumb.php'); ?>
<div class="wp-content">
  <h2 class="title-main uppercase text-center text-3xl mt-3 mb-3">
    <?= $titleMain ?>
  </h2>
  <div class="flex justify-between">
    <div class="overflow-x-auto <?= isset($_SESSION['login']) ? 'w-[70%]' : 'w-full' ?> ">
      <table class="table-auto table-cart min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-2 py-3">
              STT
            </th>
            <th scope="col" class="px-2 py-3">
              Hình ảnh
            </th>
            <th scope="col" class="px-2 py-3">
              Tên
            </th>
            <th scope="col" class="px-2 py-3">
              Mã sản phẩm
            </th>
            <th scope="col" class="px-6 py-3">
              Size
            </th>
            <th scope="col" class="px-6 py-3">
              Màu
            </th>
            <th scope="col" class="px-2 py-3">
              Số lượng
            </th>
            <th scope="col" class="px-6 py-3">
              Giá
            </th>
            <th scope="col" class="px-6 py-3">
              Thành tiền
            </th>
            <th scope="col" class="px-6 py-3">
              Thao tác
            </th>
          </tr>
        </thead>
        <tbody>
          <?php if ($carts) {
            $stt = 0;
            foreach ($carts as $k => $v) {
              $stt++;
          ?>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 rowCart-<?= $v['id'] ?>">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?= $stt ?>
                </th>
                <td class="px-6 py-4">
                  <div class="w-[100px] h-[100px] scale-img transition-all rounded-md">
                    <img class="w-full h-full object-cover" src="<?= $configBase['baseUrl'] . UPLOAD_PRODUCT . $v['photo'] ?>" alt="<?= $v['title'] ?>" />
                  </div>
                </td>
                <td class="px-6 py-4">
                  <?= $v['title'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $v['code'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= isset($v['options']) && !empty($v['options']['name_size']) ? $v['options']['name_size'] : 'Liên hệ sau' ?>
                </td>
                <td class="px-6 py-4">
                  <?= isset($v['options']) && !empty($v['options']['name_color']) ? $v['options']['name_color'] : 'Liên hệ sau' ?>
                </td>
                <td class="px-6 py-4">
                  <input type="number" data-id="<?= $v['id'] ?>" data-url='cart/update' data-price="<?= $v['price'] ?>" class="qty outline-none" value="<?= $v['qty'] ?>" min="1" max="10" />
                </td>
                <td class="px-6 py-4">
                  <?= number_format($v['price'], 0, ',', '.') . 'đ' ?>
                </td>
                <td class="px-6 py-4 cart_sub_price_<?= $v['id'] ?>">
                  <?= number_format($v['sub_total'], 0, ',', '.') . 'đ' ?>
                </td>
                <td class="px-6 py-4">
                  <a href="<?= $configBase['baseUrl'] . 'cart/delete?id=' . $v['id'] ?>" class="text-red-600 cursor-pointer cart-delete"><i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <th>Không có sản phẩm trong giỏ hàng</th>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php if ($carts) { ?>
        <div class="total block mt-2">
          <strong>Tổng tiền:</strong>
          <span class="text-red-600 cart_total_price"><?= $total ?></span>
        </div>
        <div class="flex items-center">
          <?php if (!isset($_SESSION['login'])) { ?>
            <a href="<?= $configBase['baseUrl'] . 'register' ?>" class="no-underline block pr-4" title="Đăng ký">
              <i class="fas fa-sign-in-alt"></i> Đăng ký đặt hàng
            </a>
          <?php } ?>
        </div>
        <a href="<?= $configBase['baseUrl'] . 'cart/destroy' ?>" class="block text-red-600 mt-2" title="Xóa giỏ hàng">Xóa giỏ hàng</a>
      <?php } else { ?>
        <a href="<?= $configBase['baseUrl'] ?>" class="block mt-2" title="Quay lại trang chủ">Quay lại trang chủ</a>
      <?php }  ?>
    </div>
    <?php if (isset($_SESSION['login']) && $carts) { ?>
      <div class="form-checkout w-[30%] pl-5">
        <div class="title-form-checkout mb-3">
          Chọn phương thức thanh toán
        </div>
        <form action="<?= $configBase['baseUrl'] . 'cart/checkout' ?>" method="POST">
          <div class="form-checkout-group mb-1">
            <input type="radio" id="payment_tienmat" name="payment" value="tienmat" required />
            <label for="payment_tienmat" class="cursor-pointer"><i class="fa-solid fa-bag-shopping"></i> Tiền mặt</label>
          </div>
          <div class="form-checkout-group mb-1">
            <input type="radio" id="payment_chuyenkhoan" name="payment" value="chuyenkhoan" required />
            <label for="payment_chuyenkhoan" class="cursor-pointer"><i class="fa-solid fa-bag-shopping"></i> Chuyển khoản</label>
          </div>
          <?php if (isset(Configurations::configurationsBase()['payments']['vnpay']) && Configurations::configurationsBase()['payments']['vnpay'] === true) { ?>
            <div class="form-checkout-group mb-3">
              <input type="radio" id="payment_vnpay" name="payment" value="vnpay" required />
              <label for="payment_vnpay" class="cursor-pointer"><i class="fa-solid fa-credit-card"></i> VNPay</label>
            </div>
          <?php } ?>
          <input type="submit" name="redirect" class="cursor-pointer p-2 text-white bg-red-600 rounded-sm" value="Thanh toán ngay" />
        </form>
        <?php if (isset(Configurations::configurationsBase()['payments']['momo']) && Configurations::configurationsBase()['payments']['momo'] === true) { ?>
          <form method="POST" class="mt-3" target="_blank" enctype="application/x-www-form-urlencoded" action="<?= $configBase['baseUrl'] . 'cart/momo_atm' ?>">
            <input type="submit" name="momo" class="p-2 bg-green-700 text-white rounded-sm cursor-pointer" value="Payment MOMO" />
          </form>
        <?php } ?>
      </div>
    <?php }  ?>
  </div>
</div>