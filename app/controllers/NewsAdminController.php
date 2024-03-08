<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class NewsAdminController extends Controllers
{
  public $model;
  public $urlBase;
  public $newsType;
  public $table;
  public $seoTitleIndex;
  public $seoTitleCreate;
  public $seoTitleTrash;
  public $tableCategory;
  public $tableGallery;
  public $numberPage;
  public $tableSeo;
  public $nameModule;
  public $newsModel;
  public $seoModel;
  public $galleryModel;
  public $newsCategoryModel;
  public $softDeleteNewsModule;
  public $data = [];
  public $error = [];
  public $success = [];

  /* The first __construct function */
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->newsType = Configurations::configurationsBackEnd()['news']['type'];
    $this->numberPage = Configurations::configurationsBackEnd()['news']['num_per_page'];
    $this->table = Configurations::configurationsBackEnd()['news']['table'];
    $this->newsModel = "NewsAdmin";
    $this->newsCategoryModel = "CategoryNewsAdmin";
    $this->tableGallery = 'gallery';
    $this->tableCategory = 'category_news';
    $this->tableSeo = 'seo';
    $this->nameModule = "news";
    $this->seoTitleIndex = "Danh sách tin tức";
    $this->seoTitleCreate = "Thêm tin tức";
    $this->seoTitleTrash = "Thùng rác";
    $this->seoModel = "SeoAdmin";
    $this->galleryModel = "GalleryAdmin";
    $this->softDeleteNewsModule = "soft_delete_news";
  }

  /* UI News List */
  public function index()
  {
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$idParent1 = isset($_GET['id_parent1']) ? $_GET['id_parent1'] : '';
    @$idParent2 = isset($_GET['id_parent2']) ? $_GET['id_parent2'] : '';
    $isCategory = false;
    @$idParent3 = isset($_GET['id_parent3']) ? $_GET['id_parent3'] : '';
    @$idParent4 = isset($_GET['id_parent4']) ? $_GET['id_parent4'] : '';
    @$type = $this->newsType;
    @$url = $this->urlBase . "admin/news/index";
    @$numberPerPage = $this->numberPage;
    $newsModel = $this->model->models($this->newsModel);
    $categoryNewsModel = $this->model->models($this->newsCategoryModel);
    $categoryNews1 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews2 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews3 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 3 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews4 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 4 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $where = "";

    if ($keyword) {
      $where .= "`title` LIKE '%{$keyword}%' AND ";
    }

    if ($idParent1) {
      $where .= "`id_parent1` = '{$idParent1}' AND ";
      $url .= "?id_parent1=" . $idParent1;
      $isCategory = true;
    }
    if ($idParent2) {
      $where .= "`id_parent2` = '{$idParent2}' AND ";
      $url .= "?id_parent1=" . "&id_parent2=" . $idParent2;
      $isCategory = true;
    }
    if ($idParent3) {
      $where .= "`id_parent3` = '{$idParent3}' AND ";
      $url .= "?id_parent1=" . "&id_parent2=" . "&id_parent3=" . $idParent3;
      $isCategory = true;
    }
    if ($idParent4) {
      $where .= "`id_parent4` = '{$idParent4}' AND ";
      $url .= "?id_parent1=" . "&id_parent2=" . "&id_parent3=" . "&id_parent4=" . $idParent4;
      $isCategory = true;
    }

    $where .= "`type` = '{$type}' AND `deleted_at` IS NULL ORDER BY num,id DESC";
    $news = $newsModel->all('*', $this->table, $where);
    $softDelete = $newsModel->all(
      '*',
      $this->table,
      "`type` = '{$type}' AND `deleted_at` IS NOT NULL"
    );
    $numberRow = count($news);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";
    $newsPaginate = $newsModel->all('*', $this->table, $where . $limit);
    if ($newsPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url, $isCategory);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = $this->seoTitleIndex;
    $this->data['categoryNews1'] = $categoryNews1;
    $this->data['categoryNews2'] = $categoryNews2;
    $this->data['categoryNews3'] = $categoryNews3;
    $this->data['categoryNews4'] = $categoryNews4;
    $this->data['news'] = $newsPaginate;
    $this->data['module'] = $this->nameModule;
    $this->data['paginate'] = $paginate;
    $this->data['softDelete'] = $softDelete;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* UI News Create */
  public function create()
  {
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->newsCategoryModel);
    $categoryNews1 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews2 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews3 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 3 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews4 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 4 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $this->data['seoTitle'] = $this->seoTitleCreate;
    $this->data['categoryNews1'] = $categoryNews1;
    $this->data['categoryNews2'] = $categoryNews2;
    $this->data['categoryNews3'] = $categoryNews3;
    $this->data['categoryNews4'] = $categoryNews4;
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* UI News Show */
  public function show()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $newsModel = $this->model->models($this->newsModel);
    $galleryModel = $this->model->models($this->galleryModel);
    $seoModel = $this->model->models($this->seoModel);
    $categoryNewsModel = $this->model->models($this->newsCategoryModel);
    $categoryNews1 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews2 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews3 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 3 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews4 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 4 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`id` = $id AND `type` = '{$type}' LIMIT 0,1"));
    $hash = $newsDetail['hash'];
    $seo = Functions::rawOne($seoModel->all('*', 'seo', "`hash_seo` = '{$hash}' AND `type` = '{$type}' ORDER BY ID ASC LIMIT 0,1"));
    $galleryDetail = $galleryModel->all('*', $this->tableGallery, "`type` = '{$type}' ORDER BY NUM,ID ASC");
    $this->data['seo'] = $seo;
    $this->data['seoTitle'] = $newsDetail['title'];
    $this->data['schema'] = isset($seo['schema']) ? $seo['schema'] : "";
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'show';
    $this->data['categoryNews1'] = $categoryNews1;
    $this->data['categoryNews2'] = $categoryNews2;
    $this->data['categoryNews3'] = $categoryNews3;
    $this->data['categoryNews4'] = $categoryNews4;
    $this->data['newsDetail'] = $newsDetail;
    $this->data['gallerys'] = $galleryDetail;
    $this->views($this->data, 'admin');
  }

  /* Admin News AjaxStatus */
  public function ajaxStatus()
  {
    @$id = $_POST['id'];
    @$status = $_POST['status'];
    @$table = $_POST['table'];
    @$type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    $statusNews = Functions::rawOne($newsModel->all('status', $table, "`id` = '{$id}' AND `type` = '{$type}'"))['status'];
    $statusNewsArray = !empty($statusNews) ? explode(',', $statusNews) : [];
    if (array_search($status, $statusNewsArray) !== false) {
      $key = array_search($status, $statusNewsArray);
      unset($statusNewsArray[$key]);
    } else {
      array_push($statusNewsArray, $status);
    }
    $statusNewStr = implode(',', $statusNewsArray);
    $newsModel->update($table, array('status' => $statusNewStr), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Admin News Ajax number */
  public function ajaxNumber()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    $galleryModel = $this->model->models($this->galleryModel);
    $newsModel->update($table, array('num' => $num), "`id`='$id' AND `type` = '{$type}'");
    $galleryModel->update($table, array('num' => $num), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Delete all */
  public function deleteAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->newsType;
      $uploadNews = "upload/news/";
      $newsModel = $this->model->models($this->newsModel);
      $galleryModel = $this->model->models($this->galleryModel);
      $seoModel = $this->model->models($this->seoModel);
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $listHash = "'" . implode("','", array_values($_POST['hashes'])) . "'";
      $gallerys = $galleryModel->all(
        "*",
        $this->tableGallery,
        "`hash` IN ($listHash) AND `type` = '{$type}'"
      );
      $seo = $seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      $newsByListId = $newsModel->all("*", $this->table, "`id` IN ($listCheck) AND `type` = '{$type}'");
      if (Functions::checkData($gallerys)) {
        $galleryModel->destroy($this->tableGallery, "`hash` IN ($listHash) AND `type` = '{$type}'");
      }
      if (Functions::checkData($seo)) {
        $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      }
      foreach ($newsByListId as $v) {
        $photo1 = isset($v['photo1']) && !empty($v['photo1']) ? $v['photo1'] : "";
        $photo2 = isset($v['photo2']) && !empty($v['photo2']) ? $v['photo2'] : "";
        $photo3 = isset($v['photo3']) && !empty($v['photo3']) ? $v['photo3'] : "";
        $photo4 = isset($v['photo4']) && !empty($v['photo4']) ? $v['photo4'] : "";
        $filenameNews1 = $uploadNews . $photo1;
        $filenameNews2 = $uploadNews . $photo2;
        $filenameNews3 = $uploadNews . $photo3;
        $filenameNews4 = $uploadNews . $photo4;
        if (file_exists($filenameNews1) && !empty($photo1)) unlink($filenameNews1);
        if (file_exists($filenameNews2) && !empty($photo2)) unlink($filenameNews2);
        if (file_exists($filenameNews3) && !empty($photo3)) unlink($filenameNews3);
        if (file_exists($filenameNews4) && !empty($photo4)) unlink($filenameNews4);
      }
      $newsModel->destroy($this->table, "`id` IN ($listCheck) AND `type` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/news/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/news/index");
    }
  }

  /* Delete by id */
  public function destroy()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$hash = isset($_GET['hash']) ? $_GET['hash'] : "";
    $newsModel = $this->model->models($this->newsModel);
    $seoModel = $this->model->models($this->seoModel);
    $uploadNews = "upload/news/";
    $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`type` = '{$type}' AND `hash` = '{$hash}' AND `id` = '{$id}' LIMIT 0,1"));
    $seo = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}' LIMIT 0,1"));
    if (Functions::checkData($seo)) $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}'");
    $photo1 = isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $newsDetail['photo1'] : "";
    $photo2 = isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $newsDetail['photo2'] : "";
    $photo3 = isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $newsDetail['photo3'] : "";
    $photo4 = isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $newsDetail['photo4'] : "";
    $filenameNews1 = $uploadNews . $photo1;
    $filenameNews2 = $uploadNews . $photo2;
    $filenameNews3 = $uploadNews . $photo3;
    $filenameNews4 = $uploadNews . $photo4;
    if (file_exists($filenameNews1) && !empty($photo1)) unlink($filenameNews1);
    if (file_exists($filenameNews2) && !empty($photo2)) unlink($filenameNews2);
    if (file_exists($filenameNews3) && !empty($photo3)) unlink($filenameNews3);
    if (file_exists($filenameNews4) && !empty($photo4)) unlink($filenameNews4);
    $newsModel->destroy($this->table, "`type` = '{$type}' AND `id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/news/index");
  }

  /* Soft delete UI */
  public function softDeleteIndex()
  {
    @$type = $this->newsType;
    @$numberPerPage = $this->numberPage;
    @$url = $this->urlBase . "admin/news/soft";
    $newsModel = $this->model->models($this->newsModel);
    $data = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `deleted_at` IS NOT NULL");
    $numberRow = count($data);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $paginate = Functions::Paginate($page, $totalPage, $url);
    $newsPaginate = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `deleted_at` IS NOT NULL ORDER BY num,id DESC LIMIT $numberStart,$numberPerPage");
    $this->data['seoTitle'] = $this->seoTitleTrash;
    $this->data['module'] = $this->softDeleteNewsModule;
    $this->data['action'] = 'news';
    $this->data['paginate'] = $paginate;
    $this->data['data'] = $newsPaginate;
    $this->views($this->data, 'admin');
  }

  /* Soft delete item */
  public function softDelete()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    if ($id) {
      $deleteAt = $newsModel->all(
        '*',
        $this->table,
        "`id` = $id AND `deleted_at` IS NULL LIMIT 0,1"
      );
      if ($deleteAt) {
        $newsModel->edit($this->table, ['deleted_at' => time()], "`id`='{$id}' AND `type` = '{$type}'");
        Functions::transfer(
          "Xóa dữ liệu",
          "success",
          $this->urlBase . "admin/news/index"
        );
      } else {
        Functions::transfer(
          "Xóa dữ liệu",
          "danger",
          $this->urlBase . "admin/news/index"
        );
      }
    }
  }

  /* Soft delete all */
  public function softDeleteAll()
  {
    if ($_POST['checkitem']) {
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      @$type = $this->newsType;
      $newsModel = $this->model->models($this->newsModel);
      $dataDeleted = $newsModel->all('*', $this->table, "`id` IN ($listCheck)  AND `type` = '{$type}' AND  `deleted_at` IS NULL");
      if (Functions::checkData($dataDeleted)) {
        $newsModel->edit($this->table, ['deleted_at' => time()], "`id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer(
          "Xóa dữ liệu",
          "success",
          $this->urlBase . "admin/news/index"
        );
      } else {
        Functions::transfer(
          "Xóa dữ liệu",
          "danger",
          $this->urlBase . "admin/news/index"
        );
      }
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/news/index");
    }
  }

  /* Restore item */
  public function restore()
  {
    @$id = (int)$_GET['id'];
    @$type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    if ($id) {
      $deleteAt = Functions::rawOne($newsModel->all('*', $this->table, "`id` = $id AND `type` = '{$type}' AND `deleted_at` IS NOT NULL LIMIT 0,1"));
      if (Functions::checkData($deleteAt)) {
        $newsModel->edit($this->table, ['deleted_at' => null], "`id` = '{$id}' AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/news/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/news/index");
      }
    }
  }

  /* Restore all */
  public function restoreAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->newsType;
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      $newsModel = $this->model->models($this->newsModel);
      $dataDeleted = $newsModel->all("*", $this->table, "`type` = '{$type}' AND `id` IN ($listCheck) AND `deleted_at` IS NOT NULL");
      if (Functions::checkData($dataDeleted)) {
        $newsModel->edit($this->table, ['deleted_at' => null], "`id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/news/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/news/index");
      }
    } else {
      Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/news/index");
    }
  }

  /* Delete photo */
  public function deletePhoto()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo1 = isset($_GET['photo1']) ? $_GET['photo1'] : "";
    @$photo2 = isset($_GET['photo2']) ? $_GET['photo2'] : "";
    @$photo3 = isset($_GET['photo3']) ? $_GET['photo3'] : "";
    @$photo4 = isset($_GET['photo4']) ? $_GET['photo4'] : "";
    $newsModel = $this->model->models($this->newsModel);
    $uploadNews = "upload/news/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadNews . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $newsModel->edit($this->table, ["photo1" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/news/show?id=" . $id);
    } elseif ($photo2 && !empty($id)) {
      $filename = $uploadNews . $photo2;
      if (file_exists($filename) && !empty($photo2)) unlink($filename);
      $newsModel->edit($this->table, ["photo2" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/news/show?id=" . $id);
    } elseif ($photo3 && !empty($id)) {
      $filename = $uploadNews . $photo3;
      if (file_exists($filename) && !empty($photo3)) unlink($filename);
      $newsModel->edit($this->table, ["photo3" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/news/show?id=" . $id);
    } elseif ($photo4 && !empty($id)) {
      $filename = $uploadNews . $photo4;
      if (file_exists($filename) && !empty($photo4)) unlink($filename);
      $newsModel->edit($this->table, ["photo4" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/news/show?id=" . $id);
    } else {
      Functions::redirect($this->urlBase . "admin/news/show?id=" . $id);
    }
  }

  /* Delete gallery item */
  public function destroyGallery()
  {
    @$type = $this->newsType;
    @$idParent = $_GET['id_parent'];
    @$id = $_GET['id'];
    @$photoGallery = isset($_GET['photo_gallery']) ? $_GET['photo_gallery'] : "";
    $galleryModel = $this->model->models($this->galleryModel);
    $gallery = Functions::rawOne($galleryModel->all("*", $this->tableGallery, "`type` = '{$type}' AND `id` = '{$id}' LIMIT 0,1"));
    if (Functions::checkData($gallery)) {
      $galleryModel->destroy($this->tableGallery, "`id` = '{$id}' AND `type` = '{$type}'");
    }
    $filenameGallery = "upload/gallery/" . $photoGallery;
    if (file_exists($filenameGallery) && !empty($photoGallery)) {
      unlink($filenameGallery);
    }

    Functions::transfer("Xóa", "success", $this->urlBase . "admin/news/show?id=" . $idParent);
  }

  /* Duplicate row */
  public function duplicate()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
    $duplicateRandom = " $hashString";
    $duplicateTitle = str_repeat($duplicateRandom, 1);
    $newsModel = $this->model->models($this->newsModel);
    $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` = $id limit 0,1"));

    $d = array(
      'slug' => $newsDetail['slug'] . $duplicateTitle,
      'title' => $newsDetail['title'] . $duplicateTitle,
      'description' => isset($newsDetail['description']) ? $newsDetail['description'] : null,
      'content' => isset($newsDetail['content']) ? $newsDetail['content'] : null,
      'photo1' => null,
      'photo2' => null,
      'photo3' => null,
      'photo4' => null,
      'status' => $newsDetail['status'],
      'num' => 0,
      'type' => $type,
      'hash' => $hashString,
      'id_parent1' => isset($newsDetail['id_parent1']) ? $newsDetail['id_parent1'] : "",
      'id_parent2' => isset($newsDetail['id_parent2']) ? $newsDetail['id_parent2'] : "",
      'id_parent3' => isset($newsDetail['id_parent3']) ? $newsDetail['id_parent3'] : "",
      'id_parent4' => isset($newsDetail['id_parent4']) ? $newsDetail['id_parent4'] : "",
      'created_at' => time(),
    );
    $newsModel->create($this->table, $d);
    Functions::transfer("Nhân bản dữ liệu", "success", $this->urlBase . "admin/news/index");
  }

  /* Hanlde save && save here && update product */
  public function stored()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    $seoModel = $this->model->models($this->seoModel);
    $hashString = Functions::rawOne($newsModel->all('`hash`', $this->table, "`type` = '{$type}' AND `id` = '{$id}' LIMIT 0,1"));

    if ($id) {
      $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` = $id limit 0,1"));
      /** SAVE HERE **/
      if (isset($_POST['save-here'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
          if (Functions::checkData($slugs)) {
            $this->success['slug'] = htmlspecialchars($_POST['slug']);
            foreach ($this->success as $k => $v) {
              Flash::set($k, $v, 'success');
            }
            Flash::set('slug', 'Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!', 'danger');
            $this->error['slug'] = "Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!";
          } else {
            $slug = htmlspecialchars($_POST['slug']);
          }
        } else {
          $this->error['slug'] = "Đường dẫn không được bỏ trống";
        }

        if (empty($this->error)) {
          /* Photo 1 */
          if (Functions::hasFile("photo1")) {
            $photo1 = Functions::uploadFile(
              "photo1",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo1 = isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $newsDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile(
              "photo2",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo2 = isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $newsDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile(
              "photo3",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo3 = isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $newsDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile(
              "photo4",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo4 = isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $newsDetail['photo4'] : null;
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $file_mp4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          } else {
            $file_mp4 = isset($newsDetail['file_mp4']) && !empty($newsDetail['file_mp4']) ? $newsDetail['file_mp4'] : null;
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $file_attach = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          } else {
            $file_attach = isset($newsDetail['file_attach']) && !empty($newsDetail['file_attach']) ? $newsDetail['file_attach'] : null;
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
            'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'photo4' => $photo4,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : "",
            'file_mp4' => isset($file_mp4) ? $file_mp4 : "",
            'hash' => $hashString['hash'],
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'id_parent3' => isset($_POST['id_parent3']) ? $_POST['id_parent3'] : null,
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $newsModel->edit($this->table, $d, "`id`='{$id}'");
          $seos = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`hash_seo` = '{$haskValue}'"));
          if (Functions::checkData($seos)) {
            $d_seo = [
              'id_parent' => $id,
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
              'schema' => !empty($_POST['schema']) ? htmlspecialchars($_POST['schema']) : null,
            ];
            $seoModel->edit($this->tableSeo, $d_seo, "`type` = '{$type}' AND `hash_seo` = '{$haskValue}'");
          } else {
            $d_seo = [
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'id_parent' => isset($_POST['title_seo']) && !empty($_POST['title_seo']) ? $id : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
            ];
            $seoModel->create(
              $this->tableSeo,
              $d_seo
            );
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/news/show?id=" . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/news/show?id=" . $id);
        }

        /** Build schema **/
        if (isset($_POST['build-schema'])) {
          $hashSeo = $newsDetail['hash'];
          $seoModel->edit($this->tableSeo, ['id_parent' => $id], "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}'");
          $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}' LIMIT 0,1"));
          $photo = isset($newsDetail['photo1']) ? $newsDetail['photo1'] : "";
          $imageDetail = "upload/news/" . $photo;
          $d_schema = Functions::buildSchemaArticle($newsDetail['title'], $imageDetail, time(), time(), "Phat", $newsDetail['slug'], $imageDetail, "");
          if (Functions::checkData($seo)) {
            $seoModel->edit($this->tableSeo, ['schema' => $d_schema], "`type` = '{$type}' AND `hash_seo` = '{$hashSeo}'");
            Functions::transfer("Tiến trình Schema JSON", "success", $this->urlBase . "admin/news/show?id=" . $id);
          } else {
            echo "<script>alert('Bạn cần có SEO để tạo Schema JSON Article')</script>";
            Functions::transfer("Tiến trình Schema JSON", "danger", $this->urlBase . "admin/news/show?id=" . $id);
          }
        }
      }

      /** UPDATE **/
      if (isset($_POST['update'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
          if (Functions::checkData($slugs)) {
            $this->success['slug'] = htmlspecialchars($_POST['slug']);
            foreach ($this->success as $k => $v) {
              Flash::set($k, $v, 'success');
            }
            Flash::set('slug', 'Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!', 'danger');
            $this->error['slug'] = "Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!";
          } else {
            $slug = htmlspecialchars($_POST['slug']);
          }
        } else {
          $this->error['slug'] = "Đường dẫn không được bỏ trống";
        }

        if (empty($this->error)) {
          /* Photo 1 */
          if (Functions::hasFile("photo1")) {
            $photo1 = Functions::uploadFile(
              "photo1",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo1 = isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $newsDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile(
              "photo2",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo2 = isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $newsDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile(
              "photo3",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo3 = isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $newsDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile(
              "photo4",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo4 = isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $newsDetail['photo4'] : null;
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $file_mp4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          } else {
            $file_mp4 = isset($newsDetail['file_mp4']) && !empty($newsDetail['file_mp4']) ? $newsDetail['file_mp4'] : null;
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $file_attach = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          } else {
            $file_attach = isset($newsDetail['file_attach']) && !empty($newsDetail['file_attach']) ? $newsDetail['file_attach'] : null;
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
            'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'photo4' => $photo4,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : "",
            'file_mp4' => isset($file_mp4) ? $file_mp4 : "",
            'hash' => $hashString['hash'],
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'id_parent3' => isset($_POST['id_parent3']) ? $_POST['id_parent3'] : null,
            'id_parent4' => isset($_POST['id_parent4']) ? $_POST['id_parent4'] : null,
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $newsModel->edit($this->table, $d, "`id`='{$id}'");
          $seos = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`hash_seo` = '{$haskValue}' LIMIT 0,1"));
          if (Functions::checkData($seos)) {
            $d_seo = [
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'id_parent' => isset($_POST['title_seo']) && !empty($_POST['title_seo']) ? $id : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
              'schema' => !empty($_POST['schema']) ? htmlspecialchars($_POST['schema']) : null,
            ];
            $seoModel->edit($this->tableSeo, $d_seo, "`type` = '{$type}' AND `hash_seo` = '{$haskValue}'");
          } else {
            $d_seo = [
              'id_parent' => $id,
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
            ];
            $seoModel->create(
              $this->tableSeo,
              $d_seo
            );
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/news/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/news/index");
        }
      }

      /** Build schema **/
      if (isset($_POST['build-schema'])) {
        $hashSeo = $newsDetail['hash'];
        $seoModel->edit(
          $this->tableSeo,
          ['id_parent' => $id],
          "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}'"
        );
        $photo = isset($newsDetail['photo1']) ? $newsDetail['photo1'] : "";
        $imageDetail = "upload/news/" . $photo;
        $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}' LIMIT 0,1"));
        $d_schema = Functions::buildSchemaArticle($newsDetail['title'], $imageDetail, time(), time(), "Phat", $newsDetail['slug'], $imageDetail, "");
        if (Functions::checkData($seo)) {
          $seoModel->edit($this->tableSeo, ['schema' => $d_schema], "`hash_seo` = '{$hashSeo}'");
          Functions::transfer(
            "Tiến trình Schema JSON",
            "success",
            $this->urlBase . "admin/news/show?id=" . $id
          );
        } else {
          echo "<script>alert('Bạn cần có SEO để tạo Schema JSON Article')</script>";
          Functions::transfer(
            "Tiến trình Schema JSON",
            "danger",
            $this->urlBase . "admin/news/show?id=" . $id
          );
        }
      }
    } else {
      /* SAVE DATA */
      if (isset($_POST['save'])) {
        $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `slug` = '{$slugCondition}'");
          if (Functions::checkData($slugs)) {
            $this->success['slug'] = htmlspecialchars($_POST['slug']);
            foreach ($this->success as $k => $v) {
              Flash::set($k, $v, 'success');
            }
            Flash::set('slug', 'Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!', 'danger');
            $this->error['slug'] = "Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!";
          } else {
            $slug = htmlspecialchars($_POST['slug']);
          }
        } else {
          $this->error['slug'] = "Đường dẫn không được bỏ trống";
        }

        if (empty($this->error)) {
          /* Photo 1 */
          if (Functions::hasFile("photo1")) {
            $photo1 = Functions::uploadFile(
              "photo1",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }
          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile(
              "photo2",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }
          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile(
              "photo3",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }
          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile(
              "photo4",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
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
            'slug' => htmlspecialchars($slug),
            'title' => htmlspecialchars($_POST['title']),
            'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => isset($photo1) ? $photo1 : null,
            'photo2' => isset($photo2) ? $photo2 : null,
            'photo3' => isset($photo3) ? $photo3 : null,
            'photo4' => isset($photo4) ? $photo4 : null,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : null,
            'file_mp4' => isset($file_mp4) ? $file_mp4 : null,
            'hash' => $hashString,
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'id_parent3' => isset($_POST['id_parent3']) ? $_POST['id_parent3'] : null,
            'id_parent4' => isset($_POST['id_parent4']) ? $_POST['id_parent4'] : null,
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
          $newsModel->create($this->table, $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/news/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/news/create");
        }
      }
    }
  }

  /* Update ajax title gallery */
  public function updateTitleGallery()
  {
    @$id = $_POST['id'];
    @$type = $this->newsType;
    @$id_parent = isset($_POST['id_parent']) ? $_POST['id_parent'] : "";
    @$hash = isset($_POST['hash']) ? htmlspecialchars($_POST['hash']) : "";
    @$value = isset($_POST['value']) ? htmlspecialchars($_POST['value']) : "";
    @$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : "";
    @$table = $_POST['table'];
    $galleryModel = $this->model->models($this->galleryModel);
    $galleryModel->update($table, array('title' => $value, 'hash' => $hash, 'id_parent' => $id_parent, "status" => $status), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Upload ajax galerry */
  public function uploadGallery()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    $galleryModel = $this->model->models($this->galleryModel);
    $statusDefault = "hienthi";
    $uploadGallery = "upload/gallery/";
    $typeAllow = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

    /* Save gallery */
    if (Functions::hasFile("file")) {
      $fileResult = Functions::uploadFile("file", $typeAllow, $uploadGallery);
      $d_gallery = [
        'photo' => $fileResult,
        'title' => pathinfo($fileResult, PATHINFO_FILENAME),
        'status' => $statusDefault,
        'type' => $type,
        'id_parent' => $id,
        'created_at' => time(),
      ];
      $galleryModel->create($this->tableGallery, $d_gallery);
    }
  }

  public function filterCategory()
  {
    @$type = $this->newsType;
    @$id = isset($_POST['id']) ? $_POST['id'] : "";
    $categoryNewsModel = $this->model->models($this->newsCategoryModel);
    $categoryNews2 = $categoryNewsModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `id_parent` = '{$id}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    if (Functions::checkData($categoryNews2)) {
      $output = '';
      $output .= '<option>Danh mục cấp 2</option>';
      foreach ($categoryNews2 as $v2) {
        $output .= '<option value="' . $v2['id'] . '">
                    ' . $v2['title'] . '
                  </option>';
      }
      echo $output;
    }
  }
}
