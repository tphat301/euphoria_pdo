<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;
use Validate;

class NewsletterController extends Controllers
{
  public $model;
  public $success = [];
  public $error = [];
  public $fullname;
  public $email;
  public $phone;
  public $address;
  public $urlBase;
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
  }

  public function stored()
  {
    $newsletterModel = $this->model->models('Newsletter');
    $type = 'newsletter';
    $table = 'newsletter';
    $status = 'hienthi';
    if (isset($_POST['newsletter'])) {
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

      /* Phone validation */
      if (!empty($_POST['phone'])) {
        $this->success['phone'] = $_POST['phone'];
        foreach ($this->success as $k => $v) {
          Flash::set($k, $v, 'success');
        }
        if (!Validate::isPhone($_POST['phone'])) {
          $this->error['phone'] = "Số điện thoại chưa đúng định dạng";
        } else {
          $this->phone = $_POST['phone'];
        }
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

      if (empty($this->error)) {
        /* Prepare data newsletter */
        @$hash = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
        $newsletterInfo = [
          'fullname' => htmlspecialchars($this->fullname),
          'email' => htmlspecialchars($this->email),
          'phone' => htmlspecialchars($this->phone),
          'address' => $this->address,
          'subject' => isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '',
          'note' => isset($_POST['note']) ? htmlspecialchars($_POST['note']) : '',
          'num' => 0,
          'hash' => $hash,
          'status' => $status,
          'type' => $type,
          'created_at' => time()
        ];
        $newsletterModel->create($table, $newsletterInfo);
        Functions::transfer("Đăng ký nhận tin", "success", $this->urlBase);
        unset($_SESSION['success']);
      } else {
        foreach ($this->error as $k => $v) {
          Flash::set($k, $v, 'danger');
        }
        Functions::transfer("Đăng ký nhận tin", "danger", $this->urlBase);
      }
    }
  }
}
