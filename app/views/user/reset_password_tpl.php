<div class="wp-content mt-8">
  <form id="reset_password_form" action="<?= $configBase['baseUrl'] . 'reset_password/stored' ?>" method="POST">
    <div class="bg-grey-lighter min-h-screen flex flex-col">
      <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
        <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
          <h1 class="mb-8 text-3xl text-center">Lấy lại mật khẩu</h1>
          <div class="text-green-600"><?php echo Flash::get('alertEmail', 'successAlert') ?></div>
          <div class="text-red-600"><?php echo Flash::get('alertEmail', 'dangerAlert') ?></div>
          <div class="text-red-600"><?php echo Flash::get('email', 'danger') ?></div>
          <input type="email" id="email" class="block border border-grey-light w-full p-3 rounded mb-4" name="email" placeholder="Nhập email của bạn" />
          <input type="submit" name="reset-password" class="w-full text-center py-3 rounded bg-green-600 text-white hover:bg-green-dark focus:outline-none my-1" value="Gửi yêu cầu" />
        </div>

        <div class="text-grey-dark mt-6">
          Bạn chưa có tài khoản?
          <a class="no-underline text-blue hover:text-violet-700" href="<?= $configBase['baseUrl'] . 'register' ?>">
            Đăng ký ngay
          </a>.
        </div>
      </div>
    </div>
  </form>
</div>