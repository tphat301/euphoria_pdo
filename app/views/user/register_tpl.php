<div class="wp-content mt-8">
  <form id="registrationForm" action="<?= $configBase['baseUrl'] . 'register/stored' ?>" method="POST">
    <div class="bg-grey-lighter min-h-screen flex flex-col">
      <div class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2">
        <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
          <h1 class="mb-8 text-3xl text-center">Đăng ký</h1>
          <span class="text-red-600"><?php echo Flash::get('fullname', 'danger') ?></span>
          <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="fullname" placeholder="Họ tên" value="<?php echo Flash::get('fullname', 'success') ?>" />
          <span class="text-red-600"><?php echo Flash::get('email', 'danger') ?></span>
          <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="email" id="email" placeholder="Email" value="<?php echo Flash::get('email', 'success') ?>" />
          <span class="text-red-600"><?php echo Flash::get('username', 'danger') ?></span>
          <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="address" id="address" placeholder="Địa chỉ" value="<?php echo Flash::get('address', 'success') ?>" />
          <span class="text-red-600"><?php echo Flash::get('address', 'danger') ?></span>
          <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="username" placeholder="Tài khoản" value="<?php echo Flash::get('username', 'success') ?>" />
          <span class="text-red-600"><?php echo Flash::get('password', 'danger') ?></span>
          <div class="relative">
            <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password" placeholder="Mật khẩu" />
            <i class="fa-solid fa-eye eye-user eye1 cursor-pointer absolute right-3 top-[50%] translate-y-[-50%]"></i>
          </div>
          <span class="text-red-600"><?php echo Flash::get('password_confirm', 'danger') ?></span>
          <div class="relative">
            <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password_confirm" placeholder="Xác nhận mật khẩu" />
            <i class="fa-solid fa-eye eye-user eye2 cursor-pointer absolute right-3 top-[50%] translate-y-[-50%]"></i>
          </div>
          <span class="text-red-600"><?php echo Flash::get('gender', 'danger') ?></span>
          <select id="gender" name="gender" class="bg-gray-50 border border-grey-light text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4">
            <option value="">Giới tính</option>
            <option value="male" <?php if (Flash::get('gender', 'success') === 'male') echo "selected='selected'" ?>>Nam</option>
            <option value="female" <?php if (Flash::get('gender', 'success') === 'female') echo "selected='selected'" ?>>Nữ</option>
            <option value="other" <?php if (Flash::get('gender', 'success') === 'other') echo "selected='selected'" ?>>Khác</option>
          </select>
          <input type="submit" name="register" class="w-full text-center py-3 rounded bg-green-600 text-white hover:bg-green-dark focus:outline-none my-1" value="Tạo tài khoản" />
        </div>

        <div class="text-grey-dark mt-6">
          Bạn đã có tài khoản?
          <a class="no-underline text-blue hover:text-violet-700" href="<?= $configBase['baseUrl'] . 'login' ?>">
            Đăng nhập ngay
          </a>.
        </div>
      </div>
    </div>
  </form>
</div>