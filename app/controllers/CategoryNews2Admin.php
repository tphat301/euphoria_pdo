<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class CategoryNews2Admin extends Controllers
{
  public $data = [];
  public $error = [];
  public $success = [];
  public $model;
  public $urlBase;
  public $newsType;
  public $numberPage;
  public $seoModel;
  public $categoryNewsModel;
  public $tableCategoryNews;
  public $tableSeo;
  public $seoTitleIndex;
  public $seoTitleCreate;
  public $seoTitleTrash;
  public $nameModuleSoftDeleteNews;
  public $nameModuleCategoryNews;

  /* The first __construct function */
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->newsType = Configurations::configurationsBackEnd()['news']['type'];
    $this->numberPage = Configurations::configurationsBackEnd()['category_news2']['num_per_page'];
    $this->seoTitleIndex = "Danh sách danh mục cấp 2";
    $this->seoTitleCreate = "Thêm danh mục cấp 2";
    $this->seoTitleTrash = "Thùng rác";
    $this->tableSeo = "seo";
    $this->nameModuleCategoryNews = "category_news2";
    $this->nameModuleSoftDeleteNews = "soft_delete_news";
    $this->categoryNewsModel = "CategoryNewsAdmin";
    $this->seoModel = "SeoAdmin";
    $this->tableCategoryNews = Configurations::configurationsBackEnd()['category_news2']['table'];
  }

  /* UI Category News List */
  public function index()
  {
    @$isCategory = false;
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$idParent = isset($_GET['id_parent1']) ? $_GET['id_parent1'] : "";
    @$type = $this->newsType;
    @$url = $this->urlBase . "admin/category_news2/index";
    @$numberPerPage = $this->numberPage;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);

    $fieldIdParent = "";
    $whereKeyword = "";
    if ($keyword) {
      $whereKeyword .= "`title` LIKE '%{$keyword}%' AND ";
    }
    if ($idParent) {
      $fieldIdParent .= "`id_parent` = '{$idParent}' AND ";
      $url .= "?id_parent1=" . $idParent;
      $isCategory = true;
    }

    $categoryNews1 = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryNews2 = $categoryNewsModel->all('*', $this->tableCategoryNews, $fieldIdParent . "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $softDelete = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NOT NULL");
    $numberRow = count($categoryNews2);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";
    $newsPaginate = $categoryNewsModel->all('*', $this->tableCategoryNews, $whereKeyword . $fieldIdParent . "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL ORDER BY num,id DESC" . $limit);
    if ($newsPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url, $isCategory);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = $this->seoTitleIndex;
    $this->data['categoryNews1'] = $categoryNews1;
    $this->data['news'] = $newsPaginate;
    $this->data['module'] = $this->nameModuleCategoryNews;
    $this->data['paginate'] = $paginate;
    $this->data['softDelete'] = $softDelete;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* UI Category News Create */
  public function create()
  {
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $categoryNews1 = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $this->data['categoryNews1'] = $categoryNews1;
    $this->data['seoTitle'] = $this->seoTitleCreate;
    $this->data['module'] = $this->nameModuleCategoryNews;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* UI Category News Show */
  public function show()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $seoModel = $this->model->models($this->seoModel);
    $catNewsDetail = Functions::rawOne($categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `id` = '{$id}' AND `type` = '{$type}' AND `deleted_at` IS NULL LIMIT 0,1"));
    $categoryNews1 = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $hash = $catNewsDetail['hash'];
    $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`hash_seo` = '{$hash}' AND `type` = '{$type}' ORDER BY ID ASC LIMIT 0,1"));
    $this->data['seo'] = $seo;
    $this->data['seoTitle'] = $catNewsDetail['title'];
    $this->data['schema'] = isset($seo['schema']) ? $seo['schema'] : "";
    $this->data['module'] = $this->nameModuleCategoryNews;
    $this->data['action'] = 'show';
    $this->data['id_parent'] = $catNewsDetail['id_parent'];
    $this->data['categoryNews1'] = $categoryNews1;
    $this->data['catNewsDetail'] = $catNewsDetail;
    $this->views($this->data, 'admin');
  }

  /* Admin Category News AjaxStatus */
  public function ajaxStatus()
  {
    @$id = isset($_POST['id']) ? $_POST['id'] : "";
    @$status = isset($_POST['status']) ? $_POST['status'] : "";
    @$table = isset($_POST['table']) ? $_POST['table'] : "";
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $statusCategoryNews = Functions::rawOne($categoryNewsModel->all('status', $table, "`level` = 2 AND `id` = '{$id}' AND `type` = '{$type}'"))['status'];
    $statusCategoryNewsArray = !empty($statusCategoryNews) ? explode(',', $statusCategoryNews) : [];
    if (array_search($status, $statusCategoryNewsArray) !== false) {
      $key = array_search($status, $statusCategoryNewsArray);
      unset($statusCategoryNewsArray[$key]);
    } else {
      array_push($statusCategoryNewsArray, $status);
    }
    $statusCategoryNewsStr = implode(',', $statusCategoryNewsArray);
    $categoryNewsModel->update($table, array('status' => $statusCategoryNewsStr), "`level` = 2 AND `id`='{$id}' AND `type` = '{$type}'");
  }

  /* Admin Category News Ajax number */
  public function ajaxNumber()
  {
    @$id = isset($_POST['id']) ? $_POST['id'] : "";
    @$num = isset($_POST['value']) ? $_POST['value'] : "";
    @$table = isset($_POST['table']) ? $_POST['table'] : "";
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $categoryNewsModel->update($table, array('num' => $num), "`level` = 2 AND `id`='{$id}' AND `type` = '{$type}'");
  }

  /* Delete all */
  public function deleteAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->newsType;
      $uploadCategoryNews = "upload/category_news2/";
      $categoryNewsModel = $this->model->models($this->categoryNewsModel);
      $seoModel = $this->model->models($this->seoModel);
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $listHash = "'" . implode("','", array_values($_POST['hashes'])) . "'";
      $seo = $seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      if (Functions::checkData($seo)) $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      $categoryNewsByListId = $categoryNewsModel->all("*", $this->tableCategoryNews, "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
      foreach ($categoryNewsByListId as $v) {
        $photo1 = isset($v['photo1']) && !empty($v['photo1']) ? $v['photo1'] : "";
        $photo2 = isset($v['photo2']) && !empty($v['photo2']) ? $v['photo2'] : "";
        $photo3 = isset($v['photo3']) && !empty($v['photo3']) ? $v['photo3'] : "";
        $photo4 = isset($v['photo4']) && !empty($v['photo4']) ? $v['photo4'] : "";
        $filenameCategoryNews1 = $uploadCategoryNews . $photo1;
        $filenameCategoryNews2 = $uploadCategoryNews . $photo2;
        $filenameCategoryNews3 = $uploadCategoryNews . $photo3;
        $filenameCategoryNews4 = $uploadCategoryNews . $photo4;
        if (file_exists($filenameCategoryNews1) && !empty($photo1)) unlink($filenameCategoryNews1);
        if (file_exists($filenameCategoryNews2) && !empty($photo2)) unlink($filenameCategoryNews2);
        if (file_exists($filenameCategoryNews3) && !empty($photo3)) unlink($filenameCategoryNews3);
        if (file_exists($filenameCategoryNews4) && !empty($photo4)) unlink($filenameCategoryNews4);
      }
      $categoryNewsModel->destroy($this->tableCategoryNews, "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
    }
  }

  /* Soft delete UI */
  public function softDeleteIndex()
  {
    @$type = $this->newsType;
    @$numberPerPage = $this->numberPage;
    @$url = $this->urlBase . "admin/category_news2/soft";
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $data = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NOT NULL");
    $numberRow = count($data);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $paginate = Functions::Paginate($page, $totalPage, $url);
    $categoryNewsPaginate = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NOT NULL ORDER BY num,id DESC LIMIT $numberStart,$numberPerPage");
    $this->data['seoTitle'] = $this->seoTitleTrash;
    $this->data['module'] = $this->nameModuleSoftDeleteNews;
    $this->data['action'] = 'category_news2';
    $this->data['paginate'] = $paginate;
    $this->data['data'] = $categoryNewsPaginate;
    $this->views($this->data, 'admin');
  }

  /* Soft delete item */
  public function softDelete()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    if ($id) {
      $deleteAt = Functions::rawOne($categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `id` = '{$id}' AND `deleted_at` IS NULL LIMIT 0,1"));
      if (Functions::checkData($deleteAt)) {
        $categoryNewsModel->edit($this->tableCategoryNews, ['deleted_at' => time()], "`level` = 2 AND `id`='{$id}' AND `type` = '{$type}'");
        Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
      } else {
        Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
      }
    }
  }

  /* Soft delete all */
  public function softDeleteAll()
  {
    if ($_POST['checkitem']) {
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      @$type = $this->newsType;
      $categoryNewsModel = $this->model->models($this->categoryNewsModel);
      $dataDeleted = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `id` IN ($listCheck)  AND `type` = '{$type}' AND  `deleted_at` IS NULL");
      if (Functions::checkData($dataDeleted)) {
        $categoryNewsModel->edit($this->tableCategoryNews, ['deleted_at' => time()], "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
      } else {
        Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
      }
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
    }
  }

  /* Restore item */
  public function restore()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    if ($id) {
      $deleteAt = Functions::rawOne($categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `id` = $id AND `type` = '{$type}' AND `deleted_at` IS NOT NULL LIMIT 0,1"));
      if (Functions::checkData($deleteAt)) {
        $categoryNewsModel->edit($this->tableCategoryNews, ['deleted_at' => null], "`level` = 2 AND `id` = '{$id}' AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
      }
    }
  }

  /* Restore all */
  public function restoreAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->newsType;
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      $categoryNewsModel = $this->model->models($this->categoryNewsModel);
      $dataDeleted = $categoryNewsModel->all("*", $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id` IN ($listCheck) AND `deleted_at` IS NOT NULL");
      if (Functions::checkData($dataDeleted)) {
        $categoryNewsModel->edit($this->tableCategoryNews, ['deleted_at' => null], "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
      }
    } else {
      Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
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
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $uploadCategoryNews = "upload/category_news2/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadCategoryNews . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $categoryNewsModel->edit($this->tableCategoryNews, ["photo1" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_news2/show?id=" . $id);
    } elseif ($photo2 && !empty($id)) {
      $filename = $uploadCategoryNews . $photo2;
      if (file_exists($filename) && !empty($photo2)) unlink($filename);
      $categoryNewsModel->edit($this->tableCategoryNews, ["photo2" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_news2/show?id=" . $id);
    } elseif ($photo3 && !empty($id)) {
      $filename = $uploadCategoryNews . $photo3;
      if (file_exists($filename) && !empty($photo3)) unlink($filename);
      $categoryNewsModel->edit($this->tableCategoryNews, ["photo3" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_news2/show?id=" . $id);
    } elseif ($photo4 && !empty($id)) {
      $filename = $uploadCategoryNews . $photo4;
      if (file_exists($filename) && !empty($photo4)) unlink($filename);
      $categoryNewsModel->edit($this->tableCategoryNews, ["photo4" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_news2/show?id=" . $id);
    } else {
      Functions::redirect($this->urlBase . "admin/category_news2/show?id=" . $id);
    }
  }

  /* Delete by id */
  public function destroy()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$hash = isset($_GET['hash']) ? $_GET['hash'] : "";
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $seoModel = $this->model->models($this->seoModel);
    $uploadCategoryNews = "upload/category_news2/";
    $categoryNewsDetail = Functions::rawOne($categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `hash` = '{$hash}' AND `id` = '{$id}' LIMIT 0,1"));
    $seo = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}' LIMIT 0,1"));
    if (Functions::checkData($seo)) {
      $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}'");
    }
    $photo1 = isset($categoryNewsDetail['photo1']) && !empty($categoryNewsDetail['photo1']) ? $categoryNewsDetail['photo1'] : "";
    $photo2 = isset($categoryNewsDetail['photo2']) && !empty($categoryNewsDetail['photo2']) ? $categoryNewsDetail['photo2'] : "";
    $photo3 = isset($categoryNewsDetail['photo3']) && !empty($categoryNewsDetail['photo3']) ? $categoryNewsDetail['photo3'] : "";
    $photo4 = isset($categoryNewsDetail['photo4']) && !empty($categoryNewsDetail['photo4']) ? $categoryNewsDetail['photo4'] : "";
    $filenameCategoryNews1 = $uploadCategoryNews . $photo1;
    $filenameCategoryNews2 = $uploadCategoryNews . $photo2;
    $filenameCategoryNews3 = $uploadCategoryNews . $photo3;
    $filenameCategoryNews4 = $uploadCategoryNews . $photo4;
    if (file_exists($filenameCategoryNews1) && !empty($photo1)) unlink($filenameCategoryNews1);
    if (file_exists($filenameCategoryNews2) && !empty($photo2)) unlink($filenameCategoryNews2);
    if (file_exists($filenameCategoryNews3) && !empty($photo3)) unlink($filenameCategoryNews3);
    if (file_exists($filenameCategoryNews4) && !empty($photo4)) unlink($filenameCategoryNews4);
    $categoryNewsModel->destroy($this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
  }

  /* Duplicate category row */
  public function duplicate()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
    $duplicateRandom = " $hashString";
    $duplicateTitle = str_repeat($duplicateRandom, 1);
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $categoryNewsDetail = Functions::rawOne($categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}' limit 0,1"));

    $d = array(
      'slug' => $categoryNewsDetail['slug'] . $duplicateTitle,
      'title' => $categoryNewsDetail['title'] . $duplicateTitle,
      'description' => isset($categoryNewsDetail['description']) ? $categoryNewsDetail['description'] : null,
      'content' => isset($categoryNewsDetail['content']) ? $categoryNewsDetail['content'] : null,
      'status' => $categoryNewsDetail['status'],
      'num' => 0,
      'type' => $type,
      'level' => 2,
      'hash' => $hashString,
      'id_parent' => isset($categoryNewsDetail['id_parent']) ? $categoryNewsDetail['id_parent'] : "",
      'created_at' => time(),
    );
    $categoryNewsModel->create($this->tableCategoryNews, $d);
    Functions::transfer("Nhân bản dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
  }

  /* Hanlde save && save here && update product */
  public function stored()
  {
    @$id = !empty($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsType;
    $categoryNewsModel = $this->model->models($this->categoryNewsModel);
    $seoModel = $this->model->models($this->seoModel);
    $hashString = Functions::rawOne($categoryNewsModel->all('`hash`', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}' LIMIT 0,1"));

    if ($id) {
      $categoryNewsDetail = Functions::rawOne($categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}' limit 0,1"));
      /** SAVE HERE **/
      if (isset($_POST['save-here'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo1 = isset($categoryNewsDetail['photo1']) && !empty($categoryNewsDetail['photo1']) ? $categoryNewsDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo2 = isset($categoryNewsDetail['photo2']) && !empty($categoryNewsDetail['photo2']) ? $categoryNewsDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo3 = isset($categoryNewsDetail['photo3']) && !empty($categoryNewsDetail['photo3']) ? $categoryNewsDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo4 = isset($categoryNewsDetail['photo4']) && !empty($categoryNewsDetail['photo4']) ? $categoryNewsDetail['photo4'] : null;
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'photo4' => $photo4,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'id_parent' => isset($_POST['id_category1']) && !empty($_POST['id_category1']) ? $_POST['id_category1'] : null,
            'hash' => $hashString['hash'],
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $categoryNewsModel->edit($this->tableCategoryNews, $d, "`level` = 2 AND `id`='{$id}'");
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
              'id_parent' => $id,
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
            ];
            $seoModel->create($this->tableSeo, $d_seo);
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/category_news2/show?id=" . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/category_news2/show?id=" . $id);
        }
      }

      /** UPDATE **/
      if (isset($_POST['update'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo1 = isset($categoryNewsDetail['photo1']) && !empty($categoryNewsDetail['photo1']) ? $categoryNewsDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo2 = isset($categoryNewsDetail['photo2']) && !empty($categoryNewsDetail['photo2']) ? $categoryNewsDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo3 = isset($categoryNewsDetail['photo3']) && !empty($categoryNewsDetail['photo3']) ? $categoryNewsDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          } else {
            $photo4 = isset($categoryNewsDetail['photo4']) && !empty($categoryNewsDetail['photo4']) ? $categoryNewsDetail['photo4'] : null;
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'photo4' => $photo4,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'id_parent' => isset($_POST['id_category1']) && !empty($_POST['id_category1']) ? $_POST['id_category1'] : null,
            'hash' => $hashString['hash'],
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $categoryNewsModel->edit($this->tableCategoryNews, $d, "`level` = 2 AND `id`='{$id}'");
          $seos = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`hash_seo` = '{$haskValue}' LIMIT 0,1"));
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
              'id_parent' => $id,
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
            ];
            $seoModel->create($this->tableSeo, $d_seo);
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/category_news2/index");
        }
      }
    } else {
      /* SAVE DATA */
      if (isset($_POST['save'])) {
        $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $categoryNewsModel->all('*', $this->tableCategoryNews, "`level` = 2 AND `type` = '{$type}' AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          }
          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          }
          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          }
          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_news2/");
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => htmlspecialchars($_POST['title']),
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => isset($photo1) ? $photo1 : null,
            'photo2' => isset($photo2) ? $photo2 : null,
            'photo3' => isset($photo3) ? $photo3 : null,
            'photo4' => isset($photo4) ? $photo4 : null,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'hash' => $hashString,
            'level' => 2,
            'id_parent' => isset($_POST['id_parent1']) && !empty($_POST['id_parent1']) ? $_POST['id_parent1'] : 0,
            'created_at' => time(),
          );

          if (isset($_POST['title_seo']) && !empty($_POST['title_seo'])) {
            $d_seo = [
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString) ? $hashString : null,
            ];
          }

          if (isset($d_seo) && !empty($d_seo)) $seoModel->create($this->tableSeo, $d_seo);
          $categoryNewsModel->create($this->tableCategoryNews, $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/category_news2/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/category_news2/create");
        }
      }
    }
  }
}
