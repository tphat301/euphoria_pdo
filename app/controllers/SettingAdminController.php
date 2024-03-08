<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class SettingAdminController extends Controllers
{
  public $model;
  public $urlBase;
  public $data = [];
  public $error = [];
  public $table;
  public $settingModel;
  public $moduleName;
  public $success = [];
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->table = Configurations::configurationsBackEnd()['setting']['table'];
    $this->settingModel = "SettingAdmin";
    $this->moduleName = "setting";
  }

  public function index()
  {
    $settingModel = $this->model->models($this->settingModel);
    $setting = Functions::rawOne($settingModel->all('*', $this->table, "`type` = 'setting' LIMIT 0,1"));

    if (Functions::checkData($setting)) {
      $this->data['setting'] = $setting;
    }
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  public function stored()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    $settingModel = $this->model->models($this->settingModel);
    if ($req == 'setting') {
      $type = 'setting';
      $redirect = "admin/setting/index";
      $settingHash = Functions::rawOne($settingModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    }

    if (isset($_POST['save-here'])) {
      /* Save here */
      if (empty($this->error)) {
        $d = array(
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'address' => isset($_POST['address']) ? htmlspecialchars($_POST['address']) : null,
          'copyright' => isset($_POST['copyright']) ? htmlspecialchars($_POST['copyright']) : null,
          'headjs' => isset($_POST['headjs']) ? htmlspecialchars($_POST['headjs']) : null,
          'bodyjs' => isset($_POST['bodyjs']) ? htmlspecialchars($_POST['bodyjs']) : null,
          'options' => isset($_POST['options']) ? json_encode($_POST['options']) : null,
          'type' => $type,
        );
        $haskValue = $settingHash['hash'];
        $settingModel->edit($this->table, $d, "`hash`='{$haskValue}'");
        Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . $redirect);
      }
    } else {
      /* Save */
      $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
      /* Not error */
      if (empty($this->error)) {

        $d = array(
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'address' => isset($_POST['address']) ? htmlspecialchars($_POST['address']) : null,
          'copyright' => isset($_POST['copyright']) ? htmlspecialchars($_POST['copyright']) : null,
          'headjs' => isset($_POST['headjs']) ? htmlspecialchars($_POST['headjs']) : null,
          'bodyjs' => isset($_POST['bodyjs']) ? htmlspecialchars($_POST['bodyjs']) : null,
          'options' => isset($_POST['options']) ? json_encode($_POST['options']) : null,
          'hash' => $hashString,
          'type' => $type,
        );

        $settingModel->create($this->table, $d);

        Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . $redirect);
      } else {
        foreach ($this->error as $k => $v) {
          Flash::set($k, $v, 'danger');
        }
        Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . $redirect);
      }
    }
  }
}
