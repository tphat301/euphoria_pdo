<div class="wp-content mt-8">
  <form id="reset_password_form" action="<?= $configBase['baseUrl'] . 'reset_password/new_password?reset_token=' . $reset_token ?>" method="POST">
    <div class="bg-grey-lighter min-h-screen flex flex-col">
      <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
        <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
          <h1 class="mb-8 text-3xl text-center">Khôi phục mật khẩu</h1>
          <div class="text-green-600"><?php echo Flash::get('alertUpdatePassword', 'successAlert') ?></div>
          <div class="text-red-600"><?php echo Flash::get('alertUpdatePassword', 'dangerAlert') ?></div>
          <div class="text-red-600"><?php echo Flash::get('email', 'danger') ?></div>
          <span class="text-red-600"><?php echo Flash::get('password', 'danger') ?></span>
          <div class="relative">
            <input type="password" id="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password" placeholder="Nhập mật khẩu mới" />
            <i class="fa-solid eye1 fa-eye eye-user cursor-pointer absolute right-3 top-[50%] translate-y-[-50%]"></i>
          </div>
          <div class="relative">
            <input type="password" id="password_confirm" class="block border border-grey-light w-full p-3 rounded mb-4" name="password_confirm" placeholder="Xác nhận mật khẩu mới" />
            <i class="fa-solid eye2 fa-eye eye-user cursor-pointer absolute right-3 top-[50%] translate-y-[-50%]"></i>
          </div>
          <input type="submit" name="new-password" class="w-full text-center py-3 rounded bg-green-600 text-white hover:bg-green-dark focus:outline-none my-1" value="Mật khẩu mới" />
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