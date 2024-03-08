<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class CategoryProduct2Admin extends Controllers
{
  public $data = [];
  public $error = [];
  public $success = [];
  public $model;
  public $urlBase;
  public $productType;
  public $numberPage;
  public $seoTitleIndex;
  public $seoTitleTrash;
  public $seoTitleCreate;
  public $tableSeo;
  public $nameModuleCategoryProduct;
  public $nameModuleSoftDeleteProduct;
  public $categoryProductModel;
  public $seoModel;
  public $tableCategoryProduct;

  /* The first __construct function */
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->productType = Configurations::configurationsBackEnd()['product']['type'];
    $this->numberPage = Configurations::configurationsBackEnd()['category_product2']['num_per_page'];
    $this->seoTitleIndex = "Danh sách danh mục cấp 2";
    $this->seoTitleCreate = "Thêm danh mục cấp 2";
    $this->seoTitleTrash = "Thùng rác";
    $this->tableSeo = "seo";
    $this->nameModuleCategoryProduct = "category_product2";
    $this->nameModuleSoftDeleteProduct = "soft_delete_product";
    $this->categoryProductModel = "CategoryProductAdmin";
    $this->seoModel = "SeoAdmin";
    $this->tableCategoryProduct = Configurations::configurationsBackEnd()['category_product2']['table'];
  }

  /* UI Category Product List */
  public function index()
  {
    @$isCategory = false;
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$idParent = isset($_GET['id_parent1']) ? $_GET['id_parent1'] : "";
    @$type = $this->productType;
    @$url = $this->urlBase . "admin/category_product2/index";
    @$numberPerPage = $this->numberPage;
    $categoryProductModel = $this->model->models($this->categoryProductModel);

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

    $categoryProduct1 = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryProduct2 = $categoryProductModel->all('*', $this->tableCategoryProduct, $fieldIdParent . "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");

    $softDelete = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NOT NULL");

    $numberRow = count($categoryProduct2);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";
    $productPaginate = $categoryProductModel->all('*', $this->tableCategoryProduct, $whereKeyword . $fieldIdParent . "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL ORDER BY num,id DESC" . $limit);
    if ($productPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url, $isCategory);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = $this->seoTitleIndex;
    $this->data['categoryProduct1'] = $categoryProduct1;
    $this->data['products'] = $productPaginate;
    $this->data['module'] = $this->nameModuleCategoryProduct;
    $this->data['paginate'] = $paginate;
    $this->data['softDelete'] = $softDelete;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* UI Category Product Create */
  public function create()
  {
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $categoryProduct1 = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $this->data['categoryProduct1'] = $categoryProduct1;
    $this->data['seoTitle'] = $this->seoTitleCreate;
    $this->data['module'] = $this->nameModuleCategoryProduct;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* UI Product Show */
  public function show()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $seoModel = $this->model->models($this->seoModel);
    $catProductDetail = Functions::rawOne($categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `id` = '{$id}' AND `type` = '{$type}' AND `deleted_at` IS NULL LIMIT 0,1"));
    $categoryProduct1 = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $hash = $catProductDetail['hash'];
    $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`hash_seo` = '{$hash}' AND `type` = '{$type}' ORDER BY ID ASC LIMIT 0,1"));
    $this->data['seo'] = $seo;
    $this->data['seoTitle'] = $catProductDetail['title'];
    $this->data['schema'] = isset($seo['schema']) ? $seo['schema'] : "";
    $this->data['module'] = $this->nameModuleCategoryProduct;
    $this->data['action'] = 'show';
    $this->data['id_parent'] = $catProductDetail['id_parent'];
    $this->data['categoryProduct1'] = $categoryProduct1;
    $this->data['catProductDetail'] = $catProductDetail;
    $this->views($this->data, 'admin');
  }

  /* Admin Product AjaxStatus */
  public function ajaxStatus()
  {
    @$id = isset($_POST['id']) ? $_POST['id'] : "";
    @$status = isset($_POST['status']) ? $_POST['status'] : "";
    @$table = isset($_POST['table']) ? $_POST['table'] : "";
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $statusCategoryProduct = Functions::rawOne($categoryProductModel->all('status', $table, "`level` = 2 AND `id` = '{$id}' AND `type` = '{$type}'"))['status'];
    $statusCategoryProductArray = !empty($statusCategoryProduct) ? explode(',', $statusCategoryProduct) : [];
    if (array_search($status, $statusCategoryProductArray) !== false) {
      $key = array_search($status, $statusCategoryProductArray);
      unset($statusCategoryProductArray[$key]);
    } else {
      array_push($statusCategoryProductArray, $status);
    }
    $statusCategoryProductStr = implode(',', $statusCategoryProductArray);
    $categoryProductModel->update($table, array('status' => $statusCategoryProductStr), "`level` = 2 AND `id`='{$id}' AND `type` = '{$type}'");
  }

  /* Admin Product Ajax number */
  public function ajaxNumber()
  {
    @$id = isset($_POST['id']) ? $_POST['id'] : "";
    @$num = isset($_POST['value']) ? $_POST['value'] : "";
    @$table = isset($_POST['table']) ? $_POST['table'] : "";
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $categoryProductModel->update($table, array('num' => $num), "`level` = 2 AND `id`='{$id}' AND `type` = '{$type}'");
  }

  /* Delete all */
  public function deleteAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->productType;
      $uploadCategoryProduct = "upload/category_product2/";
      $categoryProductModel = $this->model->models($this->categoryProductModel);
      $seoModel = $this->model->models($this->seoModel);
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $listHash = "'" . implode("','", array_values($_POST['hashes'])) . "'";
      $seo = $seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      if (Functions::checkData($seo)) $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      $categoryProductByListId = $categoryProductModel->all("*", $this->tableCategoryProduct, "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
      foreach ($categoryProductByListId as $v) {
        $photo1 = isset($v['photo1']) && !empty($v['photo1']) ? $v['photo1'] : "";
        $photo2 = isset($v['photo2']) && !empty($v['photo2']) ? $v['photo2'] : "";
        $photo3 = isset($v['photo3']) && !empty($v['photo3']) ? $v['photo3'] : "";
        $photo4 = isset($v['photo4']) && !empty($v['photo4']) ? $v['photo4'] : "";
        $filenameCategoryProduct1 = $uploadCategoryProduct . $photo1;
        $filenameCategoryProduct2 = $uploadCategoryProduct . $photo2;
        $filenameCategoryProduct3 = $uploadCategoryProduct . $photo3;
        $filenameCategoryProduct4 = $uploadCategoryProduct . $photo4;
        if (file_exists($filenameCategoryProduct1) && !empty($photo1)) unlink($filenameCategoryProduct1);
        if (file_exists($filenameCategoryProduct2) && !empty($photo2)) unlink($filenameCategoryProduct2);
        if (file_exists($filenameCategoryProduct3) && !empty($photo3)) unlink($filenameCategoryProduct3);
        if (file_exists($filenameCategoryProduct4) && !empty($photo4)) unlink($filenameCategoryProduct4);
      }
      $categoryProductModel->destroy($this->tableCategoryProduct, "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
    }
  }

  /* Soft delete UI */
  public function softDeleteIndex()
  {
    @$type = $this->productType;
    @$numberPerPage = $this->numberPage;
    @$url = $this->urlBase . "admin/category_product2/soft";
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $data = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NOT NULL");
    $numberRow = count($data);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $paginate = Functions::Paginate($page, $totalPage, $url);
    $categoryProductPaginate = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NOT NULL ORDER BY num,id DESC LIMIT $numberStart,$numberPerPage");
    $this->data['seoTitle'] = $this->seoTitleTrash;
    $this->data['module'] = $this->nameModuleSoftDeleteProduct;
    $this->data['action'] = 'category_product2';
    $this->data['paginate'] = $paginate;
    $this->data['data'] = $categoryProductPaginate;
    $this->views($this->data, 'admin');
  }

  /* Soft delete item */
  public function softDelete()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    if ($id) {
      $deleteAt = Functions::rawOne($categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `id` = '{$id}' AND `deleted_at` IS NULL LIMIT 0,1"));
      if (Functions::checkData($deleteAt)) {
        $categoryProductModel->edit($this->tableCategoryProduct, ['deleted_at' => time()], "`level` = 2 AND `id`='{$id}' AND `type` = '{$type}'");
        Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
      } else {
        Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
      }
    }
  }

  /* Soft delete all */
  public function softDeleteAll()
  {
    if ($_POST['checkitem']) {
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      @$type = $this->productType;
      $categoryProductModel = $this->model->models($this->categoryProductModel);
      $dataDeleted = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `id` IN ($listCheck)  AND `type` = '{$type}' AND  `deleted_at` IS NULL");
      if (Functions::checkData($dataDeleted)) {
        $categoryProductModel->edit($this->tableCategoryProduct, ['deleted_at' => time()], "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
      } else {
        Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
      }
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
    }
  }

  /* Restore item */
  public function restore()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    if ($id) {
      $deleteAt = Functions::rawOne($categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `id` = $id AND `type` = '{$type}' AND `deleted_at` IS NOT NULL LIMIT 0,1"));
      if (Functions::checkData($deleteAt)) {
        $categoryProductModel->edit($this->tableCategoryProduct, ['deleted_at' => null], "`level` = 2 AND `id` = '{$id}' AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
      }
    }
  }

  /* Restore all */
  public function restoreAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->productType;
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      $categoryProductModel = $this->model->models($this->categoryProductModel);
      $dataDeleted = $categoryProductModel->all("*", $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id` IN ($listCheck) AND `deleted_at` IS NOT NULL");
      if (Functions::checkData($dataDeleted)) {
        $categoryProductModel->edit($this->tableCategoryProduct, ['deleted_at' => null], "`level` = 2 AND `id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
      }
    } else {
      Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
    }
  }

  /* Delete photo */
  public function deletePhoto()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo1 = isset($_GET['photo1']) ? $_GET['photo1'] : "";
    @$photo2 = isset($_GET['photo2']) ? $_GET['photo2'] : "";
    @$photo3 = isset($_GET['photo3']) ? $_GET['photo3'] : "";
    @$photo4 = isset($_GET['photo4']) ? $_GET['photo4'] : "";
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $uploadCategoryProduct = "upload/category_product2/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadCategoryProduct . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $categoryProductModel->edit($this->tableCategoryProduct, ["photo1" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_product2/show?id=" . $id);
    } elseif ($photo2 && !empty($id)) {
      $filename = $uploadCategoryProduct . $photo2;
      if (file_exists($filename) && !empty($photo2)) unlink($filename);
      $categoryProductModel->edit($this->tableCategoryProduct, ["photo2" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_product2/show?id=" . $id);
    } elseif ($photo3 && !empty($id)) {
      $filename = $uploadCategoryProduct . $photo3;
      if (file_exists($filename) && !empty($photo3)) unlink($filename);
      $categoryProductModel->edit($this->tableCategoryProduct, ["photo3" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_product2/show?id=" . $id);
    } elseif ($photo4 && !empty($id)) {
      $filename = $uploadCategoryProduct . $photo4;
      if (file_exists($filename) && !empty($photo4)) unlink($filename);
      $categoryProductModel->edit($this->tableCategoryProduct, ["photo4" => null], "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/category_product2/show?id=" . $id);
    } else {
      Functions::redirect($this->urlBase . "admin/category_product2/show?id=" . $id);
    }
  }

  /* Delete by id */
  public function destroy()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$hash = isset($_GET['hash']) ? $_GET['hash'] : "";
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $seoModel = $this->model->models($this->seoModel);
    $uploadCategoryProduct = "upload/category_product2/";
    $categoryProductDetail = Functions::rawOne($categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `hash` = '{$hash}' AND `id` = '{$id}' LIMIT 0,1"));
    $seo = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}' LIMIT 0,1"));
    if (Functions::checkData($seo)) {
      $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}'");
    }
    $photo1 = isset($categoryProductDetail['photo1']) && !empty($categoryProductDetail['photo1']) ? $categoryProductDetail['photo1'] : "";
    $photo2 = isset($categoryProductDetail['photo2']) && !empty($categoryProductDetail['photo2']) ? $categoryProductDetail['photo2'] : "";
    $photo3 = isset($categoryProductDetail['photo3']) && !empty($categoryProductDetail['photo3']) ? $categoryProductDetail['photo3'] : "";
    $photo4 = isset($categoryProductDetail['photo4']) && !empty($categoryProductDetail['photo4']) ? $categoryProductDetail['photo4'] : "";
    $filenameCategoryProduct1 = $uploadCategoryProduct . $photo1;
    $filenameCategoryProduct2 = $uploadCategoryProduct . $photo2;
    $filenameCategoryProduct3 = $uploadCategoryProduct . $photo3;
    $filenameCategoryProduct4 = $uploadCategoryProduct . $photo4;
    if (file_exists($filenameCategoryProduct1) && !empty($photo1)) unlink($filenameCategoryProduct1);
    if (file_exists($filenameCategoryProduct2) && !empty($photo2)) unlink($filenameCategoryProduct2);
    if (file_exists($filenameCategoryProduct3) && !empty($photo3)) unlink($filenameCategoryProduct3);
    if (file_exists($filenameCategoryProduct4) && !empty($photo4)) unlink($filenameCategoryProduct4);
    $categoryProductModel->destroy($this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
  }

  /* Duplicate category row */
  public function duplicate()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
    $duplicateRandom = " $hashString";
    $duplicateTitle = str_repeat($duplicateRandom, 1);
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $categoryProductDetail = Functions::rawOne($categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}' limit 0,1"));

    $d = array(
      'slug' => $categoryProductDetail['slug'] . $duplicateTitle,
      'title' => $categoryProductDetail['title'] . $duplicateTitle,
      'description' => isset($categoryProductDetail['description']) ? $categoryProductDetail['description'] : null,
      'content' => isset($categoryProductDetail['content']) ? $categoryProductDetail['content'] : null,
      'status' => $categoryProductDetail['status'],
      'num' => 0,
      'type' => $type,
      'level' => 2,
      'hash' => $hashString,
      'id_parent' => isset($categoryProductDetail['id_parent']) ? $categoryProductDetail['id_parent'] : "",
      'created_at' => time(),
    );
    $categoryProductModel->create($this->tableCategoryProduct, $d);
    Functions::transfer("Nhân bản dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
  }

  /* Hanlde save && save here && update product */
  public function stored()
  {
    @$id = !empty($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->categoryProductModel);
    $seoModel = $this->model->models($this->seoModel);
    $hashString = Functions::rawOne($categoryProductModel->all('`hash`', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}' LIMIT 0,1"));

    if ($id) {
      $categoryProductDetail = Functions::rawOne($categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id` = '{$id}' limit 0,1"));
      /** SAVE HERE **/
      if (isset($_POST['save-here'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo1 = isset($categoryProductDetail['photo1']) && !empty($categoryProductDetail['photo1']) ? $categoryProductDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo2 = isset($categoryProductDetail['photo2']) && !empty($categoryProductDetail['photo2']) ? $categoryProductDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo3 = isset($categoryProductDetail['photo3']) && !empty($categoryProductDetail['photo3']) ? $categoryProductDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo4 = isset($categoryProductDetail['photo4']) && !empty($categoryProductDetail['photo4']) ? $categoryProductDetail['photo4'] : null;
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
          $categoryProductModel->edit($this->tableCategoryProduct, $d, "`level` = 2 AND `id`='{$id}'");
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
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/category_product2/show?id=" . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/category_product2/show?id=" . $id);
        }
      }

      /** UPDATE **/
      if (isset($_POST['update'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo1 = isset($categoryProductDetail['photo1']) && !empty($categoryProductDetail['photo1']) ? $categoryProductDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo2 = isset($categoryProductDetail['photo2']) && !empty($categoryProductDetail['photo2']) ? $categoryProductDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo3 = isset($categoryProductDetail['photo3']) && !empty($categoryProductDetail['photo3']) ? $categoryProductDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          } else {
            $photo4 = isset($categoryProductDetail['photo4']) && !empty($categoryProductDetail['photo4']) ? $categoryProductDetail['photo4'] : null;
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
          $categoryProductModel->edit($this->tableCategoryProduct, $d, "`level` = 2 AND `id`='{$id}'");
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
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/category_product2/index");
        }
      }
    } else {
      /* SAVE DATA */
      if (isset($_POST['save'])) {
        $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $categoryProductModel->all('*', $this->tableCategoryProduct, "`level` = 2 AND `type` = '{$type}' AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          }
          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          }
          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
          }
          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', '.webp'), "upload/category_product2/");
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
            'id_parent' => isset($_POST['id_category1']) && !empty($_POST['id_category1']) ? $_POST['id_category1'] : 0,
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
          $categoryProductModel->create($this->tableCategoryProduct, $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/category_product2/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/category_product2/create");
        }
      }
    }
  }
}
