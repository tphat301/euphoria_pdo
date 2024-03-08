<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class SeoPageAdminController extends Controllers
{
  public $data = [];
  public $model;
  public $table;
  public $urlBase;
  public $seoPageModel;
  public $moduleName;
  public $error = [];
  public $success = [];
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->table = Configurations::configurationsBackEnd()['seopage']['table'];
    $this->seoPageModel = "SeoPageAdmin";
    $this->moduleName = "seopage";
  }

  public function home()
  {
    @$type = Configurations::configurationsBackEnd()['seopage']['home']['type'];
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seopageHome = Functions::rawOne($seoPageModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($seopageHome)) $this->data['seopageHome'] = $seopageHome;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'home';
    $this->views($this->data, 'admin');
  }

  public function static()
  {
    @$type = Configurations::configurationsBackEnd()['seopage']['static']['type'];
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seopageStatic = Functions::rawOne($seoPageModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($seopageStatic)) $this->data['seopageStatic'] = $seopageStatic;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'static';
    $this->views($this->data, 'admin');
  }

  public function product()
  {
    @$type = Configurations::configurationsBackEnd()['seopage']['product']['type'];
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seopageProduct = Functions::rawOne($seoPageModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($seopageProduct)) $this->data['seopageProduct'] = $seopageProduct;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'product';
    $this->views($this->data, 'admin');
  }

  public function news()
  {
    @$type = Configurations::configurationsBackEnd()['seopage']['news']['type'];
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seopageNews = Functions::rawOne($seoPageModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($seopageNews)) $this->data['seopageNews'] = $seopageNews;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'news';
    $this->views($this->data, 'admin');
  }

  public function contact()
  {
    @$type = Configurations::configurationsBackEnd()['seopage']['contact']['type'];
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seopageContact = Functions::rawOne($seoPageModel->all('*', $this->table, "`type` = '{$type}' LIMIT 0,1"));
    if (Functions::checkData($seopageContact)) $this->data['seopageContact'] = $seopageContact;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'contact';
    $this->views($this->data, 'admin');
  }

  /* Delete photo */
  public function deletePhoto()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    switch ($req) {
      case 'home':
        $type = 'home';
        $redirect = "admin/seopage/home";
        break;

      case 'product':
        $type = 'san-pham';
        $redirect = "admin/seopage/product";
        break;

      case 'news':
        $type = 'tin-tuc';
        $redirect = "admin/seopage/news";
        break;

      case 'static':
        $type = 'gioi-thieu';
        $redirect = "admin/seopage/static";
        break;

      case 'contact':
        $type = 'contact';
        $redirect = "admin/seopage/contact";
        break;

      default:
        break;
    }

    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo1 = isset($_GET['photo1']) ? $_GET['photo1'] : "";
    $seoPageModel = $this->model->models($this->seoPageModel);
    $uploadSeopage = "upload/seopage/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadSeopage . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $seoPageModel->edit($this->table, ["photo1" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . $redirect);
    } else {
      Functions::redirect($this->urlBase . $redirect);
    }
  }

  public function stored()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    $seoPageModel = $this->model->models($this->seoPageModel);

    switch ($req) {
      case 'home':
        $type = 'home';
        $redirect = "admin/seopage/home";
        $seoPageHash = Functions::rawOne($seoPageModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'product':
        $type = 'san-pham';
        $redirect = "admin/seopage/product";
        $seoPageHash = Functions::rawOne($seoPageModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'news':
        $type = 'tin-tuc';
        $redirect = "admin/seopage/news";
        $seoPageHash = Functions::rawOne($seoPageModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'static':
        $type = 'gioi-thieu';
        $redirect = "admin/seopage/static";
        $seoPageHash = Functions::rawOne($seoPageModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'contact':
        $type = 'contact';
        $redirect = "admin/seopage/contact";
        $seoPageHash = Functions::rawOne($seoPageModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      default:
        break;
    }

    if (isset($_POST['save-here'])) {
      /* Save here */
      if (empty($this->error)) {
        /* Photo 1 */
        if (Functions::hasFile("photo1")) {
          $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/seopage/");
        }
        $d = array(
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
          'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
          'photo1' => isset($photo1) ? $photo1 : null,
          'type' => $type,
        );
        $haskValue = $seoPageHash['hash'];
        $seoPageModel->edit($this->table, $d, "`hash`='{$haskValue}'");
        Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . $redirect);
      }
    } else {
      /* Save */
      $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
      /* Not error */
      if (empty($this->error)) {
        /* Photo 1 */
        if (Functions::hasFile("photo1")) {
          $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/seopage/");
        }

        $d = array(
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
          'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
          'photo1' => isset($photo1) ? $photo1 : null,
          'type' => $type,
          'hash' => $hashString
        );

        $seoPageModel->create($this->table, $d);

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
