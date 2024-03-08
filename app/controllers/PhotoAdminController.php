<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class PhotoAdminController extends Controllers
{
  public $model;
  public $table;
  public $photoModel;
  public $urlBase;
  public $createNumber;
  public $moduleName;
  public $seoSlideshowTitleIndex;
  public $seoSlideshowTitleCreate;
  public $seoPartnerTitleCreate;
  public $seoPartnerTitleIndex;
  public $seoSocialHeaderTitleCreate;
  public $seoSocialHeaderTitleIndex;
  public $seoSocialFooterTitleCreate;
  public $seoSocialFooterTitleIndex;
  public $data = [];
  public $error = [];
  public $success = [];

  public function __construct()
  {
    $this->model = new Models();
    $this->moduleName = "photo";
    $this->photoModel = "PhotoAdmin";
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->seoSlideshowTitleCreate = "Thêm slideshow";
    $this->seoSlideshowTitleIndex = "Danh sách slideshow";
    $this->seoPartnerTitleCreate = "Thêm đối tác";
    $this->seoPartnerTitleIndex = "Danh sách đối tác";
    $this->seoSocialHeaderTitleCreate = "Thêm mạng xã hội header";
    $this->seoSocialHeaderTitleIndex = "Danh sách mạng xã hội header";
    $this->seoSocialFooterTitleCreate = "Thêm mạng xã hội footer";
    $this->seoSocialFooterTitleIndex = "Danh sách mạng xã hội footer";
    $this->table = Configurations::configurationsBackEnd()['photo']['table'];
  }

  /* Slideshow index UI */
  public function slideshowIndex()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['slideshow']['type'];
    @$url = $this->urlBase . 'admin/photo/slideshow_index';
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$numberPerPage = Configurations::configurationsBackEnd()['photo']['slideshow']['num_per_page'];
    $photoModel = $this->model->models($this->photoModel);

    $where = "`type` = '{$type}' AND `action` = '{$action}' ORDER BY num,id DESC";
    $items = $photoModel->all('*', $this->table, $where);
    $numberRow = count($items);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $dataPaginate = $photoModel->all('*', $this->table, $where . $limit);
    if ($dataPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['type'] = $type;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->data['items'] = $dataPaginate;
    $this->data['paginate'] = $paginate;
    $this->data['seoTitle'] = $this->seoSlideshowTitleIndex;
    $this->views($this->data, 'admin');
  }

  /* Partner index UI */
  public function partnerIndex()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['partner']['type'];
    @$url = $this->urlBase . 'admin/photo/partner_index';
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$numberPerPage = Configurations::configurationsBackEnd()['photo']['partner']['num_per_page'];
    $photoModel = $this->model->models($this->photoModel);

    $where = "`type` = '{$type}' AND `action` = '{$action}' ORDER BY num,id DESC";
    $items = $photoModel->all('*', $this->table, $where);
    $numberRow = count($items);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $dataPaginate = $photoModel->all('*', $this->table, $where . $limit);
    if ($dataPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['type'] = $type;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->data['items'] = $dataPaginate;
    $this->data['paginate'] = $paginate;
    $this->data['seoTitle'] = $this->seoPartnerTitleIndex;
    $this->views($this->data, 'admin');
  }

  /* Social header index UI */
  public function socialHeaderIndex()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['social_header']['type'];
    @$url = $this->urlBase . 'admin/photo/social_header_index';
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$numberPerPage = Configurations::configurationsBackEnd()['photo']['social_header']['num_per_page'];
    $photoModel = $this->model->models($this->photoModel);

    $where = "`type` = '{$type}' AND `action` = '{$action}' ORDER BY num,id DESC";
    $items = $photoModel->all('*', $this->table, $where);
    $numberRow = count($items);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $dataPaginate = $photoModel->all('*', $this->table, $where . $limit);
    if ($dataPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['type'] = $type;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->data['items'] = $dataPaginate;
    $this->data['paginate'] = $paginate;
    $this->data['seoTitle'] = $this->seoSocialHeaderTitleIndex;
    $this->views($this->data, 'admin');
  }

  /* Social footer index UI */
  public function socialFooterIndex()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['social_footer']['type'];
    @$url = $this->urlBase . 'admin/photo/social_footer_index';
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$numberPerPage = Configurations::configurationsBackEnd()['photo']['social_footer']['num_per_page'];
    $photoModel = $this->model->models($this->photoModel);

    $where = "`type` = '{$type}' AND `action` = '{$action}' ORDER BY num,id DESC";
    $items = $photoModel->all('*', $this->table, $where);
    $numberRow = count($items);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $dataPaginate = $photoModel->all('*', $this->table, $where . $limit);
    if ($dataPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['type'] = $type;
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'index';
    $this->data['items'] = $dataPaginate;
    $this->data['paginate'] = $paginate;
    $this->data['seoTitle'] = $this->seoSocialFooterTitleIndex;
    $this->views($this->data, 'admin');
  }

  /* Slideshow create UI */
  public function slideshowCreate()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['slideshow']['type'];
    @$createNumber = Configurations::configurationsBackEnd()['photo']['slideshow']['create_number'];
    $this->data['type'] = $type;
    $this->data['seoTitle'] = $this->seoSlideshowTitleCreate;
    $this->data['module'] = $this->moduleName;
    $this->data['createNumber'] = $createNumber;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* Partner create UI */
  public function partnerCreate()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['partner']['type'];
    @$createNumber = Configurations::configurationsBackEnd()['photo']['partner']['create_number'];
    $this->data['type'] = $type;
    $this->data['seoTitle'] = $this->seoPartnerTitleCreate;
    $this->data['module'] = $this->moduleName;
    $this->data['createNumber'] = $createNumber;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* Social header create UI */
  public function socialHeaderCreate()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['social_header']['type'];
    @$createNumber = Configurations::configurationsBackEnd()['photo']['social_header']['create_number'];
    $this->data['type'] = $type;
    $this->data['seoTitle'] = $this->seoSocialHeaderTitleCreate;
    $this->data['module'] = $this->moduleName;
    $this->data['createNumber'] = $createNumber;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* Social footer create UI */
  public function socialFooterCreate()
  {
    @$type = Configurations::configurationsBackEnd()['photo']['social_footer']['type'];
    @$createNumber = Configurations::configurationsBackEnd()['photo']['social_footer']['create_number'];
    $this->data['type'] = $type;
    $this->data['seoTitle'] = $this->seoSocialFooterTitleCreate;
    $this->data['module'] = $this->moduleName;
    $this->data['createNumber'] = $createNumber;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* Slideshow show UI */
  public function slideshowShow()
  {
    $photoModel = $this->model->models($this->photoModel);
    @$type = Configurations::configurationsBackEnd()['photo']['slideshow']['type'];
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    @$item = Functions::rawOne($photoModel->all('*', $this->table, "`id` = '{$id}' AND `action` = '{$action}' AND `type` = '{$type}' LIMIT 0,1"));
    $this->data['type'] = $type;
    $this->data['item'] = $item;
    $this->data['seoTitle'] = $item['title'];
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'show';
    $this->views($this->data, 'admin');
  }

  /* Partner show UI */
  public function partnerShow()
  {
    $photoModel = $this->model->models($this->photoModel);
    @$type = Configurations::configurationsBackEnd()['photo']['partner']['type'];
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    @$item = Functions::rawOne($photoModel->all('*', $this->table, "`id` = '{$id}' AND `action` = '{$action}' AND `type` = '{$type}' LIMIT 0,1"));
    $this->data['type'] = $type;
    $this->data['item'] = $item;
    $this->data['seoTitle'] = $item['title'];
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'show';
    $this->views($this->data, 'admin');
  }

  /* Social header show UI */
  public function socialHeaderShow()
  {
    $photoModel = $this->model->models($this->photoModel);
    @$type = Configurations::configurationsBackEnd()['photo']['social_header']['type'];
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    @$item = Functions::rawOne($photoModel->all('*', $this->table, "`id` = '{$id}' AND `action` = '{$action}' AND `type` = '{$type}' LIMIT 0,1"));
    $this->data['type'] = $type;
    $this->data['item'] = $item;
    $this->data['seoTitle'] = $item['title'];
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'show';
    $this->views($this->data, 'admin');
  }

  /* Social footer show UI */
  public function socialFooterShow()
  {
    $photoModel = $this->model->models($this->photoModel);
    @$type = Configurations::configurationsBackEnd()['photo']['social_footer']['type'];
    @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    @$item = Functions::rawOne($photoModel->all('*', $this->table, "`id` = '{$id}' AND `action` = '{$action}' AND `type` = '{$type}' LIMIT 0,1"));
    $this->data['type'] = $type;
    $this->data['item'] = $item;
    $this->data['seoTitle'] = $item['title'];
    $this->data['module'] = $this->moduleName;
    $this->data['action'] = 'show';
    $this->views($this->data, 'admin');
  }

  /* Delete photo */
  public function deletePhoto()
  {
    $photoModel = $this->model->models($this->photoModel);
    @$req = isset($_GET['req']) ? $_GET['req'] : '';
    @$type = Configurations::configurationsBackEnd()['photo'][$req]['type'];
    @$action = Configurations::configurationsBackEnd()['photo'][$req]['action'];
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo = isset($_GET['photo']) ? $_GET['photo'] : "";
    @$uploadPhoto = "upload/photo/";
    if ($photo && !empty($id)) {
      $filename = $uploadPhoto . $photo;
      if (file_exists($filename) && !empty($photo)) unlink($filename);
      $photoModel->edit($this->table, ['photo' => null], "`type` = '{$type}' AND `action` = '{$action}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . 'admin/photo/' . $req . '_show?id=' . $id);
    } else {
      Functions::redirect($this->urlBase . 'admin/photo/' . $req . '_show?id=' . $id);
    }
  }

  public function deleteAll()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : '';
    switch ($req) {
      case 'slideshow':
        $redirect = $this->urlBase . "admin/photo/slideshow_index";
        break;
      case 'partner':
        $redirect = $this->urlBase . "admin/photo/partner_index";
        break;
      case 'social_header':
        $redirect = $this->urlBase . "admin/photo/social_header_index";
        break;
      case 'social_footer':
        $redirect = $this->urlBase . "admin/photo/social_footer_index";
        break;

      default:
        break;
    }
    if ($_POST['checkitem']) {
      $uploadPhoto = "upload/photo/";
      $photoModel = $this->model->models($this->photoModel);
      $listId = implode(',', array_values($_POST['checkitem']));
      $photoByListId = $photoModel->all("*", $this->table, "`id` IN ($listId)");
      foreach ($photoByListId as $v) {
        $photo = isset($v['photo']) && !empty($v['photo']) ? $v['photo'] : "";
        $filenamePhoto = $uploadPhoto . $photo;
        if (file_exists($filenamePhoto) && !empty($photo)) unlink($filenamePhoto);
      }
      $photoModel->destroy($this->table, "`id` IN ($listId)");
      Functions::transfer("Xóa dữ liệu", "success", $redirect);
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $redirect);
    }
  }

  public function destroy()
  {
    @$req = isset($_GET['req']) ? $_GET['req'] : '';
    switch ($req) {
      case 'slideshow':
        $redirect = $this->urlBase . "admin/photo/slideshow_index";
        break;
      case 'partner':
        $redirect = $this->urlBase . "admin/photo/partner_index";
        break;
      case 'social_header':
        $redirect = $this->urlBase . "admin/photo/social_header_index";
        break;
      case 'social_footer':
        $redirect = $this->urlBase . "admin/photo/social_footer_index";
        break;

      default:
        break;
    }
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$hash = isset($_GET['hash']) ? $_GET['hash'] : "";
    $photoModel = $this->model->models($this->photoModel);

    $uploadPhoto = "upload/photo/";
    $photoDetail = Functions::rawOne($photoModel->all('*', $this->table, "`hash` = '{$hash}' AND `id` = '{$id}' LIMIT 0,1"));
    $photo = isset($photoDetail['photo']) && !empty($photoDetail['photo']) ? $photoDetail['photo'] : "";
    $filenamePhoto = $uploadPhoto . $photo;
    if (file_exists($filenamePhoto) && !empty($photo)) unlink($filenamePhoto);
    $photoModel->destroy($this->table, "`id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $redirect);
  }

  public function ajaxStatus()
  {
    @$id = isset($_POST['id']) ? $_POST['id'] : '';
    @$status = isset($_POST['status']) ? $_POST['status'] : '';
    @$table = isset($_POST['table']) ? $_POST['table'] : '';
    $photoModel = $this->model->models($this->photoModel);
    $statusPhoto = Functions::rawOne($photoModel->all('status', $table, "`id` = '{$id}'"))['status'];
    $statusPhotoArray = !empty($statusPhoto) ? explode(',', $statusPhoto) : [];
    if (array_search($status, $statusPhotoArray) !== false) {
      $key = array_search($status, $statusPhotoArray);
      unset($statusPhotoArray[$key]);
    } else {
      array_push($statusPhotoArray, $status);
    }
    $statusPhotoStr = implode(',', $statusPhotoArray);
    $photoModel->update($table, array('status' => $statusPhotoStr), "`id`='{$id}'");
  }

  public function ajaxNumber()
  {
    $photoModel = $this->model->models($this->photoModel);
    @$id = isset($_POST['id']) ? $_POST['id'] : '';
    @$num = isset($_POST['value']) ? $_POST['value'] : '';
    @$table = isset($_POST['table']) ? $_POST['table'] : '';
    $photoModel->update($table, array('num' => $num), "`id`='$id'");
  }

  public function stored()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    @$req = isset($_GET['req']) ? $_GET['req'] : '';
    $photoModel = $this->model->models($this->photoModel);
    switch ($req) {
      case 'slideshow':
        @$type = Configurations::configurationsBackEnd()['photo']['slideshow']['type'];
        @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
        @$redirect = 'admin/photo/' . $type . '_index';
        @$hashByDb = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;
      case 'partner':
        @$type = Configurations::configurationsBackEnd()['photo']['partner']['type'];
        @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
        @$redirect = 'admin/photo/' . $type . '_index';
        @$hashByDb = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;
      case 'social_header':
        @$type = Configurations::configurationsBackEnd()['photo']['social_header']['type'];
        @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
        @$redirect = 'admin/photo/' . $type . '_index';
        @$hashByDb = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;
      case 'social_footer':
        @$type = Configurations::configurationsBackEnd()['photo']['social_footer']['type'];
        @$action = Configurations::configurationsBackEnd()['photo'][$type]['action'];
        @$redirect = 'admin/photo/' . $type . '_index';
        @$hashByDb = Functions::rawOne($photoModel->all('`hash`', $this->table, "`type` = '{$type}' LIMIT 0,1"));
        break;

      default:
        break;
    }

    if ($id) {
      @$hash = $hashByDb['hash'];
      $photoDetail = Functions::rawOne($photoModel->all('*', $this->table, "`type` = '{$type}' AND `id` = $id AND `hash` = '{$hash}' limit 0,1"));
      /* SAVE HERE */
      if (isset($_POST['save-here'])) {
        if (empty($this->error)) {
          if (Functions::hasFile("photo")) {
            $photo = Functions::uploadFile("photo", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/photo/");
          } else {
            $photo = isset($photoDetail['photo']) && !empty($photoDetail['photo']) ? $photoDetail['photo'] : null;
          }
          $d = [
            'title' => isset($_POST['title']) ? $_POST['title'] : null,
            'link' => isset($_POST['link']) ? $_POST['link'] : null,
            'num' => isset($_POST['num']) ? $_POST['num'] : null,
            'photo' => isset($photo) ? $photo : null,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'updated_at' => time()
          ];
          $photoModel->edit($this->table, $d, "`id`='{$id}'");
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . 'admin/photo/' . $type . '_show?id=' . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . 'admin/photo/' . $type . '_show?id=' . $id);
        }
      }

      /* UPDATE */
      if (isset($_POST['update'])) {
        if (empty($this->error)) {
          if (Functions::hasFile("photo")) {
            $photo = Functions::uploadFile("photo", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/photo/");
          } else {
            $photo = isset($photoDetail['photo']) && !empty($photoDetail['photo']) ? $photoDetail['photo'] : null;
          }
          $d = [
            'title' => isset($_POST['title']) ? $_POST['title'] : null,
            'link' => isset($_POST['link']) ? $_POST['link'] : null,
            'num' => isset($_POST['num']) ? $_POST['num'] : null,
            'photo' => isset($photo) ? $photo : null,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'updated_at' => time()
          ];
          $photoModel->edit($this->table, $d, "`id`='{$id}'");
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . $redirect);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . $redirect);
        }
      }
    } else {
      /* SAVE */
      if (isset($_POST['save'])) {
        $hashString = !empty(Functions::stringRandom(3)) ? strtolower(Functions::stringRandom(3)) : null;
        if (empty($this->error)) {
          $dataPostSave = isset($_POST['dataMultiple']) ? $_POST['dataMultiple'] : null;
          for ($i = 1; $i <= count($dataPostSave); $i++) {
            $link = isset($dataPostSave[$i]['link']) ? $dataPostSave[$i]['link'] : null;
            $num = isset($dataPostSave[$i]['num']) ? $dataPostSave[$i]['num'] : null;
            $title = isset($dataPostSave[$i]['title']) ? $dataPostSave[$i]['title'] : null;
            $status = isset($dataPostSave[$i]['status']) ? implode(',', $dataPostSave[$i]['status']) : null;
            $d = [
              'title' => $title,
              'link' => $link,
              'photo' => Functions::hasFile("photo" . $i) ? Functions::uploadFile("photo" . $i, array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/photo/") : null,
              'num' => $num,
              'status' => $status,
              'type' => $type,
              'hash' => $hashString . $i,
              'action' => isset($action) ? $action : null,
              'created_at' => time()
            ];
            $photoModel->create($this->table, $d);
          }
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
}
