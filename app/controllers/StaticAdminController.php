<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class StaticAdminController extends Controllers
{
  public $data = [];
  public $model;
  public $table;
  public $tableSeo;
  public $moduleStatic;
  public $urlBase;
  public $error = [];
  public $success = [];
  public $staticModel;
  public $seoModel;

  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->table = Configurations::configurationsBackEnd()['static']['table'];
    $this->staticModel = "StaticAdmin";
    $this->moduleStatic = "static";
    $this->seoModel = "SeoAdmin";
    $this->tableSeo = "seo";
  }

  public function about()
  {
    $staticModel = $this->model->models($this->staticModel);
    $about = Functions::rawOne($staticModel->all('*', $this->table, "`type` = 'gioi-thieu' LIMIT 0,1"));

    if (Functions::checkData($about)) {
      $this->data['about'] = $about;
    }

    $this->data['module'] = $this->moduleStatic;
    $this->data['action'] = 'about';
    $this->views($this->data, 'admin');
  }

  public function footer()
  {
    $staticModel = $this->model->models($this->staticModel);
    $footer = Functions::rawOne($staticModel->all('*', $this->table, "`type` = 'footer' LIMIT 0,1"));

    if (Functions::checkData($footer)) {
      $this->data['footer'] = $footer;
    }

    $this->data['module'] = $this->moduleStatic;
    $this->data['action'] = 'footer';
    $this->views($this->data, 'admin');
  }

  public function contact()
  {
    $staticModel = $this->model->models($this->staticModel);
    $contact = Functions::rawOne($staticModel->all('*', $this->table, "`type` = 'contact' LIMIT 0,1"));

    if (Functions::checkData($contact)) {
      $this->data['contact'] = $contact;
    }

    $this->data['module'] = $this->moduleStatic;
    $this->data['action'] = 'contact';
    $this->views($this->data, 'admin');
  }

  public function slogan()
  {
    $staticModel = $this->model->models($this->staticModel);
    $slogan = Functions::rawOne($staticModel->all('*', $this->table, "`type` = 'slogan' LIMIT 0,1"));

    if (Functions::checkData($slogan)) {
      $this->data['slogan'] = $slogan;
    }

    $this->data['module'] = $this->moduleStatic;
    $this->data['action'] = 'slogan';
    $this->views($this->data, 'admin');
  }

  /* Delete photo */
  public function deletePhoto()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    switch ($req) {
      case 'gioithieu':
        $type = 'gioi-thieu';
        $redirect = "admin/static/about";
        break;

      default:
        break;
    }
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo1 = isset($_GET['photo1']) ? $_GET['photo1'] : "";
    @$photo2 = isset($_GET['photo2']) ? $_GET['photo2'] : "";
    @$photo3 = isset($_GET['photo3']) ? $_GET['photo3'] : "";
    @$photo4 = isset($_GET['photo4']) ? $_GET['photo4'] : "";
    $staticModel = $this->model->models($this->staticModel);
    $uploadStatic = "upload/static/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadStatic . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $staticModel->edit($this->table, ["photo1" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . $redirect);
    } elseif ($photo2 && !empty($id)) {
      $filename = $uploadStatic . $photo2;
      if (file_exists($filename) && !empty($photo2)) unlink($filename);
      $staticModel->edit($this->table, ["photo2" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . $redirect);
    } elseif ($photo3 && !empty($id)) {
      $filename = $uploadStatic . $photo3;
      if (file_exists($filename) && !empty($photo3)) unlink($filename);
      $staticModel->edit($this->table, ["photo3" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . $redirect);
    } elseif ($photo4 && !empty($id)) {
      $filename = $uploadStatic . $photo4;
      if (file_exists($filename) && !empty($photo4)) unlink($filename);
      $staticModel->edit($this->table, ["photo4" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . $redirect);
    } else {
      Functions::redirect($this->urlBase . $redirect);
    }
  }

  public function stored()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : "";
    $seoModel = $this->model->models('SeoAdmin');
    $staticModel = $this->model->models($this->staticModel);

    switch ($req) {
      case 'gioithieu':
        $type = 'gioi-thieu';
        $redirect = "admin/static/about";
        $aboutHash = Functions::rawOne($staticModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'slogan':
        $type = 'slogan';
        $redirect = "admin/static/slogan";
        $aboutHash = Functions::rawOne($staticModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'footer':
        $type = 'footer';
        $redirect = "admin/static/footer";
        $aboutHash = Functions::rawOne($staticModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      case 'contact':
        $type = 'contact';
        $redirect = "admin/static/contact";
        $aboutHash = Functions::rawOne($staticModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      default:
        break;
    }

    if (isset($_POST['save-here'])) {
      /* Save here */
      if (empty($this->error)) {
        /* Photo 1 */
        if (Functions::hasFile("photo1")) {
          $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }
        /* Photo 2 */
        if (Functions::hasFile("photo2")) {
          $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }
        /* Photo 3 */
        if (Functions::hasFile("photo3")) {
          $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }
        /* Photo 4 */
        if (Functions::hasFile("photo4")) {
          $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }

        /* Video mp4 */
        if (Functions::hasFile("file_mp4")) {
          $photo4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
        }

        /* File attach */
        if (Functions::hasFile("file_attach")) {
          $photo4 = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
        }

        $d = array(
          'slogan' => isset($_POST['slogan']) ? htmlspecialchars($_POST['slogan']) : null,
          'slug' => isset($_POST['slug']) ? htmlspecialchars($_POST['slug']) : null,
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
          'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
          'photo1' => isset($photo1) ? $photo1 : null,
          'photo2' => isset($photo2) ? $photo2 : null,
          'photo3' => isset($photo3) ? $photo3 : null,
          'photo4' => isset($photo4) ? $photo4 : null,
          'type' => $type,
          'file_attach' => isset($file_attach) ? $file_attach : null,
          'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
          'file_mp4' => isset($file_mp4) ? $file_mp4 : null,
          'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
          'updated_at' => time(),
        );
        $haskValue = $aboutHash['hash'];
        $staticModel->edit($this->table, $d, "`hash`='{$haskValue}'");
        $seos = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`hash_seo` = '{$haskValue}'"));
        $d_seo = [
          'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
          'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
          'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
          'type' => $type,
          'hash_seo' => isset($haskValue) ? $haskValue : null,
        ];
        if (Functions::checkData($seos)) {
          $seoModel->edit($this->tableSeo, $d_seo, "`type` = '{$type}' AND `hash_seo` = '{$haskValue}'");
        } else {
          $seoModel->create($this->tableSeo, $d_seo);
        }
        Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . $redirect);
      }
    } else {

      /* Save */
      $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
      /* Not error */
      if (empty($this->error)) {
        /* Photo 1 */
        if (Functions::hasFile("photo1")) {
          $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }
        /* Photo 2 */
        if (Functions::hasFile("photo2")) {
          $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }
        /* Photo 3 */
        if (Functions::hasFile("photo3")) {
          $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }
        /* Photo 4 */
        if (Functions::hasFile("photo4")) {
          $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/static/");
        }

        /* Video mp4 */
        if (Functions::hasFile("file_mp4")) {
          $photo4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
        }

        /* File attach */
        if (Functions::hasFile("file_attach")) {
          $photo4 = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
        }

        $d = array(
          'slogan' => isset($_POST['slogan']) ? htmlspecialchars($_POST['slogan']) : null,
          'slug' => isset($_POST['slug']) ? htmlspecialchars($_POST['slug']) : null,
          'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
          'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
          'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
          'photo1' => isset($photo1) ? $photo1 : null,
          'photo2' => isset($photo2) ? $photo2 : null,
          'photo3' => isset($photo3) ? $photo3 : null,
          'photo4' => isset($photo4) ? $photo4 : null,
          'type' => $type,
          'file_attach' => isset($file_attach) ? $file_attach : null,
          'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
          'file_mp4' => isset($file_mp4) ? $file_mp4 : null,
          'hash' => $hashString,
          'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
          'created_at' => time(),
        );

        if (isset($_POST['title_seo']) && !empty($_POST['title_seo'])) {
          $d_seo = [
            'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
            'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
            'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
            'type' => $type,
            'hash_seo' => $hashString,
          ];
        }

        if (isset($d_seo) && !empty($d_seo)) $seoModel->create($this->tableSeo, $d_seo);
        $staticModel->create($this->table, $d);

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
