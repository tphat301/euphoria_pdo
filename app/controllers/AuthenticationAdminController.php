<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;
use Validate;

class AuthenticationAdminController extends Controllers
{
  public $data = [];
  public $model;
  public $error = [];
  public $success = [];
  public $username;
  public $password;
  public $urlBase;

  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
  }

  // Login
  public function login()
  {
    $this->data['module'] = 'user';
    $this->data['action'] = 'login';
    $this->views($this->data, 'admin');
  }

  // Logout
  public function logout()
  {
    unset($_SESSION['login_admin']);
    return Functions::redirect($this->urlBase . 'admin');
  }

  // Permission
  public function permission()
  {
  }

  // Stored
  public function stored()
  {
    if (isset($_POST['login'])) {
      /* Username validation */
      if (!empty($_POST['username'])) {
        $this->success['username'] = $_POST['username'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        if (!Validate::isUsername($_POST['username'])) {
          $this->error['username'] = "Tài khoản chưa đúng định dạng";
        } else {
          $this->username = $_POST['username'];
        }
      } else {
        $this->error['username'] = "Tài khoản không được bỏ trống";
      }

      /* Password validation */
      if (!empty($_POST['password'])) {
        if (!Validate::isPassword($_POST['password'])) {
          $this->error['password'] = "Mật khẩu chưa đúng định dạng";
        } else {
          $this->password = md5($_POST['password']);
        }
      } else {
        $this->error['password'] = "Mật khẩu không được bỏ trống";
      }
      // Functions::dd($this->password, true);
      if (empty($this->error)) {
        $userModel = $this->model->models('UserAdmin');
        $user = Functions::rawOne($userModel->all("id,fullname, email, username, password", 'users', "`username`='{$this->username}' AND `password` = '{$this->password}' AND `is_active` = '1' AND `permision` = 'admin'"));

        if (Functions::checkData($user)) {
          foreach ($user as $k => $v) {
            Flash::set($k, $v, 'login_admin');
          }
          Functions::redirect($this->urlBase . 'admin/dashboard');
        } else {
          Flash::set('loginAlert', 'Tài khoản hoặc mật khẩu chưa chính xác. Xin vui lòng thử lại!', 'dangerAlert');
          Functions::redirect($this->urlBase . 'admin');
        }
      } else {
        foreach ($this->error as $k => $v) {
          Flash::set($k, $v, 'danger');
        }
        Functions::redirect($this->urlBase . 'admin');
      }
    }
  }
}
