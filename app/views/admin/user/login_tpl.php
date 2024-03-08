  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <main style="margin-top: 100px;">
    <div class="container mt-3 p-3 rounded" style="width: 500px; background-color: #f3f3f3;">
      <form action="<?= $configBase['baseUrl'] . 'admin/login/stored' ?>" method="POST">
        <h2>Euphoria Login</h2>
        <span class="text-danger text-sm"><?php echo Flash::get('loginAlert', 'dangerAlert') ?></span>
        <div class="form-group">
          <input type="text" name="username" class="form-control" id="username" value="<?php echo Flash::get('username', 'success') ?>" placeholder="Username" required />
          <span class="text-danger text-sm"><?php echo Flash::get('username', 'danger') ?></span>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
          <span class="text-danger text-sm"><?php echo Flash::get('password', 'danger') ?></span>
        </div>
        <input type="submit" name="login" class="btn btn-primary" value="Login">
      </form>
      <a href="<?= $configBase['baseUrl'] ?>" class="text-decoration-none mt-2 d-block">Quay lại</a>
    </div>
  </main>