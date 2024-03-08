<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class PhotoStaticAdminController extends Controllers
{
  public $data = [];
  public $model;
  public $table;
  public $urlBase;
  public $moduleName;
  public $photoModel;
  public $action;
  public $error = [];
  public $success = [];
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->table = Configurations::configurationsBackEnd()['static_photo']['table'];
    $this->moduleName = "photo_static";
    $this->photoModel = "PhotoAdmin";
    $this->action = "photo_static";
  }

  public function logo()
  {
    @$type = Configurations::configurationsBackEnd()['static_photo']['logo']['type'];
    $photoModel = $this->model->models($this->photoModel);
    $item = Functions::rawOne($photoModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($item)) $this->data['item'] = $item;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->data['type'] = $type;
    $this->views($this->data, 'admin');
  }

  public function banner()
  {
    @$type = Configurations::configurationsBackEnd()['static_photo']['banner']['type'];
    $photoModel = $this->model->models($this->photoModel);
    $item = Functions::rawOne($photoModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($item)) $this->data['item'] = $item;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->data['type'] = $type;
    $this->views($this->data, 'admin');
  }

  public function favicon()
  {
    @$type = Configurations::configurationsBackEnd()['static_photo']['favicon']['type'];
    $photoModel = $this->model->models($this->photoModel);
    $item = Functions::rawOne($photoModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($item)) $this->data['item'] = $item;
    $this->data['type'] = $type;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* Delete photo */
  public function deletePhoto()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    switch ($req) {
      case 'logo':
        @$type = 'logo';
        @$redirect = "admin/static_photo/logo";
        break;

      case 'banner':
        @$type = 'banner';
        @$redirect = "admin/static_photo/banner";
        break;

      case 'favicon':
        @$type = 'favicon';
        @$redirect = "admin/static_photo/favicon";
        break;

      default:
        break;
    }

    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo = isset($_GET['photo']) ? $_GET['photo'] : "";
    $photoModel = $this->model->models($this->photoModel);
    $uploadPhoto = "upload/photo/";
    if ($photo && !empty($id)) {
      $filename = $uploadPhoto . $photo;
      if (file_exists($filename) && !empty($photo)) unlink($filename);
      $photoModel->edit($this->table, ["photo" => null], "`type` = '{$type}' AND `action` = '{$this->action}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . $redirect);
    } else {
      Functions::redirect($this->urlBase . $redirect);
    }
  }

  public function stored()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    $photoModel = $this->model->models($this->photoModel);


    switch ($req) {
      case 'logo':
        @$type = 'logo';
        @$redirect = "admin/static_photo/logo";
        @$staticPhotoHash = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' AND `action` = '{$this->action}' LIMIT 0,1"));
        break;

      case 'banner':
        @$type = 'banner';
        @$redirect = "admin/static_photo/banner";
        @$staticPhotoHash = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' AND `action` = '{$this->action}' LIMIT 0,1"));
        break;

      case 'favicon':
        @$type = 'favicon';
        @$redirect = "admin/static_photo/favicon";
        @$staticPhotoHash = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' AND `action` = '{$this->action}' LIMIT 0,1"));
        break;

      default:
        break;
    }

    if (isset($_POST['save-here'])) {
      /* Save here */
      if (empty($this->error)) {
        /* Photo */
        if (Functions::hasFile("photo")) {
          $photo = Functions::uploadFile("photo", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/photo/");
        }
        $d = array(
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'photo' => isset($photo) ? $photo : null,
          'type' => $type,
          'updated_at' => time()
        );
        $haskValue = $staticPhotoHash['hash'];
        $photoModel->edit($this->table, $d, "`hash`='{$haskValue}'");
        Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . $redirect);
      }
    } else {
      /* Save */
      $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
      /* Not error */
      if (empty($this->error)) {
        /* Photo */
        if (Functions::hasFile("photo")) {
          $photo = Functions::uploadFile("photo", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/photo/");
        }

        $d = array(
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'photo' => isset($photo) ? $photo : null,
          'type' => $type,
          'action' => $this->action,
          'hash' => $hashString,
          'created_at' => time()
        );

        $photoModel->create($this->table, $d);

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
