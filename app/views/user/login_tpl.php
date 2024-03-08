<div class="wp-content mt-8">
  <form action="<?= $configBase['baseUrl'] . 'login/stored' ?>" method="POST">
    <div class="bg-grey-lighter min-h-screen flex flex-col">
      <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
        <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
          <h1 class="mb-8 text-3xl text-center">Đăng nhập</h1>
          <div class="text-green-600"><?php echo Flash::get('alertActiveToken', 'successAlert') ?></div>
          <div class="text-red-600"><?php echo Flash::get('loginAlert', 'dangerAlert') ?></div>
          <div class="text-red-600"><?php echo Flash::get('alertActiveToken', 'dangerAlert') ?></div>
          <input type="text" id="username" class="block border border-grey-light w-full p-3 rounded mb-4" name="username" placeholder="Tài khoản" />
          <div class="password_box relative">
            <input type="password" id="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password" placeholder="Mật khẩu" />
            <i class="fa-solid fa-eye eye1 eye-user cursor-pointer absolute right-3 top-[50%] translate-y-[-50%]"></i>
          </div>
          <input type="submit" name="login" class="w-full text-center py-3 rounded bg-green-600 text-white hover:bg-green-dark focus:outline-none my-1" value="Đăng nhập" />
        </div>

        <div class="text-grey-dark mt-6">
          <a class="no-underline text-blue hover:text-violet-700" href="<?= $configBase['baseUrl'] . 'reset_password' ?>">
            Quên mật khẩu ?
          </a>
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