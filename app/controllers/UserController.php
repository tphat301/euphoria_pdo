<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Mail;
use Models;
use Validate;

class UserController extends Controllers
{
  public $model;
  public $tableUser;
  public $tableSetting;
  public $mailer;
  public $token;
  public $resetToken;
  public $resetTokenNewPassword;
  public $link;
  public $contentMail;
  public $error = [];
  public $success = [];
  public $data = [];
  public $moduleUser;
  public $userModel;
  public $settingModel;
  public $urlBase;
  public $subjectMail;
  public $fullname;
  public $email;
  public $address;
  public $setting;
  public $options;
  public $gender;
  public $username;
  public $password;
  public $password_confirm;

  public function __construct()
  {
    $this->moduleUser = 'user';
    $this->tableUser = 'users';
    $this->tableSetting = 'setting';
    $this->userModel = 'User';
    $this->settingModel = 'Setting';
    $this->mailer = new Mail();
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->setting = Functions::rawOne($this->model->Models($this->settingModel)->all('*', $this->tableSetting, "`type` = 'setting'"));
    $this->options = json_decode($this->setting['options']);
  }

  public function register()
  {
    $this->data['module'] = $this->moduleUser;
    $this->data['action'] = 'register';
    $this->views($this->data, 'index');
  }

  public function login()
  {
    $this->data['module'] = $this->moduleUser;
    $this->data['action'] = 'login';
    $this->views($this->data, 'index');
  }

  public function loginStored()
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

      if (empty($this->error)) {
        $userModel = $this->model->models($this->userModel);
        $user = Functions::rawOne($userModel->all("id,fullname, email, username, password, address", $this->tableUser, "`username`='{$this->username}' AND `password` ='$this->password' AND `is_active` = '1'"));
        if (Functions::checkData($user)) {
          foreach ($user as $k => $v) {
            Flash::set($k, $v, 'login');
          }
          Functions::redirect($this->urlBase . 'cart');
        } else {
          Flash::set('loginAlert', 'Tài khoản hoặc mật khẩu chưa chính xác. Xin vui lòng thử lại!', 'dangerAlert');
          Functions::redirect($this->urlBase . 'login');
        }
      } else {
        foreach ($this->error as $k => $v) {
          Flash::set($k, $v, 'danger');
        }
        Functions::redirect($this->urlBase . 'login');
      }
    }
  }

  public function registerStored()
  {
    if (isset($_POST['register'])) {
      /* Fullname validation */
      if (!empty($_POST['fullname'])) {
        $this->success['fullname'] = $_POST['fullname'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        $this->fullname = $_POST['fullname'];
      } else {
        $this->error['fullname'] = "Họ và tên không được bỏ trống";
      }

      /* Email validation */
      if (!empty($_POST['email'])) {
        $this->success['email'] = $_POST['email'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        if (!Validate::isEmail($_POST['email'])) {
          $this->error['email'] = "Email chưa đúng định dạng";
        } else {
          $this->email = $_POST['email'];
        }
      } else {
        $this->error['email'] = "Email không được bỏ trống";
      }

      /* Address validation */
      if (!empty($_POST['address'])) {
        $this->success['address'] = $_POST['address'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        $this->address = $_POST['address'];
      } else {
        $this->error['address'] = "Địa chỉ không được bỏ trống";
      }

      /* Gender validation */
      if (!empty($_POST['gender'])) {
        $this->success['gender'] = $_POST['gender'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        $this->gender = $_POST['gender'];
      } else {
        $this->error['gender'] = "Giới tính chưa được chọn";
      }

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

      /* Password confirm validation */
      if (!empty($_POST['password_confirm'])) {
        if (
          md5($_POST['password']) !== md5($_POST['password_confirm'])
        ) {
          $this->error['password'] = "Xác nhận mật khẩu chưa đúng";
        } else {
          $this->password = md5($_POST['password_confirm']);
        }
      } else {
        $this->error['password_confirm'] = "Xác nhận mật khẩu không được bỏ trống";
      }

      if (empty($this->error)) {
        $this->token = md5($this->email . time());
        /* Prepare data user account */
        $userInfo = [
          'fullname' => htmlspecialchars($this->fullname),
          'email' => htmlspecialchars($this->email),
          'address' => $this->address,
          'gender' => $this->gender,
          'username' => htmlspecialchars($this->username),
          'password' => htmlspecialchars($this->password),
          'active_token' => $this->token,
          'permision' => "subcriber",
          'num' => 0,
          'status' => 'hienthi',
          'created_at' => time()
        ];

        /* Handle check email existed */
        $userModel = $this->model->models($this->userModel);
        $emailUserByDb = $userModel->all('*', $this->tableUser, "`email` = '{$this->email}'");
        if (Functions::checkData($emailUserByDb)) {
          Flash::set('email', 'Email đã tồn tại!', 'danger');
          Functions::redirect($this->urlBase . 'register');
        } else {
          $userModel->create($this->tableUser, $userInfo);
          $this->subjectMail = "Thư xác thực đăng ký tài khoản";
          $this->link = $this->urlBase . "register/active_token?active_token={$this->token}";
          $this->contentMail = $this->mailer->contentMailActiveRegister($this->fullname, $this->link, $this->setting['title'], $this->options->email, $this->options->hotline);
          $this->mailer->send($this->email, $this->fullname, $this->subjectMail, $this->contentMail);
          Functions::redirect($this->urlBase . 'cart');
        }
      } else {
        foreach ($this->error as $k => $v) {
          Flash::set($k, $v, 'danger');
        }
        Functions::redirect($this->urlBase . 'register');
      }
    }
  }

  /* Handle active token user account */
  public function activeToken()
  {
    @$activeToken = $_GET['active_token'];
    $userModel = $this->model->models($this->moduleUser);
    $getTokenByDatabase =  $userModel->all('*', $this->tableUser, "`active_token`='{$activeToken}' AND `is_active` = '0'");
    if (Functions::checkData($getTokenByDatabase)) {
      $userModel->edit($this->tableUser, ['is_active' => '1'], "`active_token`='{$activeToken}'");
      Flash::set('alertActiveToken', 'Tài khoản của bạn đã được xác thực thành công. Vui lòng đăng nhập để truy cập vào hệ thống!', 'successAlert');
      Functions::redirect($this->urlBase . 'login');
    } else {
      Flash::set('alertActiveToken', 'Tài khoản của bạn đã được xác thực thành công. Vui lòng đăng nhập để truy cập vào hệ thống!', 'dangerAlert');
      Functions::redirect($this->urlBase . 'register');
    }
  }

  public function logout()
  {
    unset($_SESSION['login']);
    return Functions::redirect($this->urlBase . 'login');
  }

  public function resetPassword()
  {
    $this->data['module'] = $this->moduleUser;
    $this->data['action'] = 'reset_password';
    $this->views($this->data, 'index');
  }

  public function resetPasswordStore()
  {
    if (isset($_POST['reset-password'])) {
      /* Email validation */
      if (!empty($_POST['email'])) {
        $this->success['email'] = $_POST['email'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        if (!Validate::isEmail($_POST['email'])) {
          $this->error['email'] = "Email chưa đúng định dạng";
        } else {
          $this->email = $_POST['email'];
        }
      } else {
        $this->error['email'] = "Email không được bỏ trống";
      }

      if (empty($this->error)) {
        $this->resetToken = md5($this->email . time());
        $userModel = $this->model->models($this->moduleUser);
        $emailByDatabase = $userModel->all('*', $this->tableUser, "`email`='{$this->email}'");
        /* Check email exist by system */
        if (Functions::checkData($emailByDatabase)) {
          $userModel->edit($this->tableUser, ['is_reset_token' => '0', 'reset_token' => $this->resetToken], "`email`='{$this->email}'");
          $this->subjectMail = "Thư yêu cầu thay đổi mật khẩu";
          $this->link = $this->urlBase . "reset_password/reset_token?reset_token={$this->resetToken}";
          $this->contentMail = $this->mailer->contentMailActiveRegister($this->fullname, $this->link, $this->setting['title'], $this->options->email, $this->options->hotline);
          $this->mailer->send($this->email, $this->fullname, $this->subjectMail, $this->contentMail);
          Flash::set('alertEmail', 'Thư yêu cầu thay đổi mật khẩu đã được gửi vài email cá nhân của bạn. Bạn vui lòng kiểm tra email để thực hiện việc thay đổi mật.!', 'successAlert');
          Functions::redirect($this->urlBase . 'reset_password');
        } else {
          Flash::set('alertEmail', 'Email không tồn tại trên hệ thống!', 'dangerAlert');
          Functions::redirect($this->urlBase . 'reset_password');
        }
      } else {
        foreach ($this->error as $k => $v) {
          Flash::set($k, $v, 'danger');
        }
        Functions::redirect($this->urlBase . 'reset_password');
      }
    }
  }

  public function newPassword()
  {
    $this->resetTokenNewPassword = $_GET['reset_token'];
    $userModel = $this->model->models($this->moduleUser);
    $userByDataBase = Functions::rawOne($userModel->all('*', $this->tableUser, "`reset_token`='{$this->resetTokenNewPassword}'"));
    /* Check is existed reset_token by database */
    if (Functions::checkData($userByDataBase) && $userByDataBase['is_reset_token'] == 0) {
      $this->data['module'] = $this->moduleUser;
      $this->data['action'] = 'new_password';
      $this->data['reset_token'] = $this->resetTokenNewPassword;
      $this->views($this->data, 'index');
    } else {
      Functions::redirect($this->urlBase . 'login');
    }
  }

  public function newPasswordStore()
  {
    $tokenNewPassword = $_GET['reset_token'];
    $userModel = $this->model->models($this->moduleUser);
    $userByDataBase = $userModel->all('*', $this->tableUser, "`reset_token`='{$tokenNewPassword}'");
    if (count($userByDataBase)) {
      if (isset($_POST['new-password'])) {
        /* Password validation */
        if (!empty($_POST['password'])) {
          if (!Validate::isPassword($_POST['password'])) {
            $this->error['password'] = "Mật khẩu mới chưa đúng định dạng";
          } else {
            $this->password = md5($_POST['password']);
          }
        } else {
          $this->error['password'] = "Mật khẩu mới không được bỏ trống";
        }

        /* Password confirm validation */
        if (!empty($_POST['password_confirm'])) {
          if (md5($_POST['password']) !== md5($_POST['password_confirm'])) {
            $this->error['password'] = "Xác nhận mật khẩu mới chưa đúng";
          } else {
            $this->password = md5($_POST['password_confirm']);
          }
        } else {
          $this->error['password_confirm'] = "Xác nhận mật khẩu mới không được bỏ trống";
        }

        if (empty($this->error)) {
          $isResetTokenExist = Functions::rawOne($userModel->all('*', $this->tableUser, "`is_reset_token`='0'"));
          if (Functions::checkData($isResetTokenExist)) {
            $userModel->edit($this->tableUser, ['is_reset_token' => '1', 'updated_at' => time()], "`reset_token`='{$tokenNewPassword}'");
            Flash::set('alertUpdatePassword', 'Lấy lại mật khẩu thành công. Vui lòng quay lại đăng nhập vào hệ thống!', 'successAlert');
            $userModel->edit($this->tableUser, ['password' => $this->password], "`reset_token`='{$tokenNewPassword}'");
            Functions::redirect($this->urlBase . "reset_password/reset_token?reset_token={$tokenNewPassword}");
          } else {
            Flash::set('alertUpdatePassword', 'Lấy lại mật khẩu không thành công!', 'dangerAlert');
            Functions::redirect($this->urlBase . "reset_password/reset_token?reset_token={$tokenNewPassword}");
          }
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::redirect($this->urlBase . "reset_password/reset_token?reset_token={$tokenNewPassword}");
        }
      }
    }
  }
}
