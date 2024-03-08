<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class ProductAdminController extends Controllers
{
  public $data = [];
  public $error = [];
  public $success = [];
  public $model;
  public $urlBase;
  public $table;
  public $tableGallery;
  public $tableCategory;
  public $nameModule;
  public $seoTitleIndex;
  public $seoTitleCreate;
  public $seoTitleTrash;
  public $tableSeo;
  public $seoModel;
  public $productModel;
  public $galleryModel;
  public $softDeleteProductModule;
  public $productCategoryModel;
  public $productType;
  public $numberPage;

  /* The first __construct function */
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->productType = Configurations::configurationsBackEnd()['product']['type'];
    $this->numberPage = Configurations::configurationsBackEnd()['product']['num_per_page'];
    $this->table = Configurations::configurationsBackEnd()['product']['table'];
    $this->seoModel = "SeoAdmin";
    $this->galleryModel = "GalleryAdmin";
    $this->productModel = "ProductAdmin";
    $this->productCategoryModel = "CategoryProductAdmin";
    $this->tableGallery = 'gallery';
    $this->tableCategory = 'category_products';
    $this->tableSeo = 'seo';
    $this->nameModule = "product";
    $this->seoTitleIndex = "Danh sách sản phẩm";
    $this->seoTitleCreate = "Thêm sản phẩm";
    $this->seoTitleTrash = "Thùng rác";
    $this->softDeleteProductModule = "soft_delete_product";
  }

  /* Page Product List */
  public function index()
  {
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$idParent1 = isset($_GET['id_parent1']) ? $_GET['id_parent1'] : '';
    @$idParent2 = isset($_GET['id_parent2']) ? $_GET['id_parent2'] : '';
    @$idParent3 = isset($_GET['id_parent3']) ? $_GET['id_parent3'] : '';
    @$idParent4 = isset($_GET['id_parent4']) ? $_GET['id_parent4'] : '';
    $isCategory = false;
    @$type = $this->productType;
    @$url = $this->urlBase . "admin/product/index";
    @$numberPerPage = $this->numberPage;
    $productModel = $this->model->models($this->productModel);
    $categoryProductModel = $this->model->models($this->productCategoryModel);
    $categoryProduct1 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryProduct2 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryProduct3 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 3 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryProduct4 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 4 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
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
    $products = $productModel->all('*', $this->table, $where);
    $softDelete = $productModel->all('*', $this->table, "`type` = '{$type}' AND `deleted_at` IS NOT NULL");
    $numberRow = count($products);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $productPaginate = $productModel->all('*', $this->table, $where . $limit);
    if ($productPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url, $isCategory);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = $this->seoTitleIndex;
    $this->data['categoryProduct1'] = $categoryProduct1;
    $this->data['categoryProduct2'] = $categoryProduct2;
    $this->data['categoryProduct3'] = $categoryProduct3;
    $this->data['categoryProduct4'] = $categoryProduct4;
    $this->data['products'] = $productPaginate;
    $this->data['paginate'] = $paginate;
    $this->data['module'] = $this->nameModule;
    $this->data['softDelete'] = $softDelete;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* Page product create */
  public function create()
  {
    @$type = $this->productType;
    $categoryProductModel = $this->model->models($this->productCategoryModel);
    $categoryProduct1 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryProduct2 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $this->data['seoTitle'] = $this->seoTitleCreate;
    $this->data['categoryProduct1'] = $categoryProduct1;
    $this->data['categoryProduct2'] = $categoryProduct2;
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* Page product show */
  public function show()
  {
    $sizeModel = $this->model->models('SizeAdmin');
    $colorModel = $this->model->models('ColorAdmin');
    $productSaleModel = $this->model->models('ProductSaleAdmin');
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $options = $productSaleModel->all('*', 'product_sale', "`id_parent` = '{$id}' AND `type` = '{$this->productType}' ORDER BY id DESC");
    $sizes = $sizeModel->all('*', 'size', "`type_size` = '{$this->productType}' ORDER BY num_size, id_size DESC");
    $colors = $colorModel->all('*', 'color', "`type_color` = '{$this->productType}' ORDER BY num_color, id_color DESC");
    $productModel = $this->model->models($this->productModel);
    $galleryModel = $this->model->models($this->galleryModel);
    $seoModel = $this->model->models($this->seoModel);
    $categoryProductModel = $this->model->models($this->productCategoryModel);
    $categoryProduct1 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 1 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $categoryProduct2 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    $productDetail = Functions::rawOne($productModel->all('*', $this->table, "`id` = $id AND `type` = '{$type}' LIMIT 0,1"));
    $hash = isset($productDetail['hash']) ? $productDetail['hash'] : '';
    $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`hash_seo` = '{$hash}' AND `type` = '{$type}' ORDER BY ID ASC LIMIT 0,1"));
    $galleryDetail = $galleryModel->all('*', $this->tableGallery, "`type` = '{$type}' AND `id_parent` = '{$id}' ORDER BY NUM,ID ASC");
    $this->data['seo'] = $seo;
    $this->data['seoTitle'] = isset($productDetail['title']) ? $productDetail['title'] : '';
    $this->data['schema'] = isset($seo['schema']) ? $seo['schema'] : '';
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'show';
    $this->data['categoryProduct1'] = $categoryProduct1;
    $this->data['categoryProduct2'] = $categoryProduct2;
    $this->data['productDetail'] = $productDetail;
    $this->data['options'] = $options;
    $this->data['sizes'] = $sizes;
    $this->data['colors'] = $colors;
    $this->data['gallerys'] = $galleryDetail;
    $this->views($this->data, 'admin');
  }

  /* Admin Product AjaxStatus */
  public function ajaxStatus()
  {
    @$id = $_POST['id'];
    @$status = $_POST['status'];
    @$table = $_POST['table'];
    @$type = $this->productType;
    $productModel = $this->model->models($this->productModel);
    $statusProduct = Functions::rawOne($productModel->all('status', $table, "`id` = '{$id}' AND `type` = '{$type}'"))['status'];
    $statusProductArray = !empty($statusProduct) ? explode(',', $statusProduct) : [];
    if (array_search($status, $statusProductArray) !== false) {
      $key = array_search($status, $statusProductArray);
      unset($statusProductArray[$key]);
    } else {
      array_push($statusProductArray, $status);
    }
    $statusProductStr = implode(',', $statusProductArray);
    $productModel->update($table, array('status' => $statusProductStr), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Admin Product Ajax number */
  public function ajaxNumber()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $type = $this->productType;
    $productModel = $this->model->models($this->productModel);
    $galleryModel = $this->model->models($this->galleryModel);
    $productModel->update($table, array('num' => $num), "`id`='$id' AND `type` = '{$type}'");
    $galleryModel->update($table, array('num' => $num), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Admin Product Size Ajax number */
  public function ajaxNumberSize()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $type = $this->productType;
    $sizeModel = $this->model->models('SizeAdmin');
    $sizeModel->update($table, array('num_size' => $num), "`id_size`='$id' AND `type_size` = '{$type}'");
  }

  /* Admin Product Color Ajax number */
  public function ajaxNumberColor()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $type = $this->productType;
    $colorModel = $this->model->models('ColorAdmin');
    $colorModel->update($table, array('num_color' => $num), "`id_color`='$id' AND `type_color` = '{$type}'");
  }

  /* Delete all */
  public function deleteAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->productType;
      $uploadProduct = "upload/product/";
      $productModel = $this->model->models($this->productModel);
      $galleryModel = $this->model->models($this->galleryModel);
      $seoModel = $this->model->models($this->seoModel);
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $listHash = "'" . implode("','", array_values($_POST['hashes'])) . "'";
      $gallerys = $galleryModel->all("*", $this->tableGallery, "`hash` IN ($listHash) AND `type` = '{$type}'");
      $seo = $seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      $productByListId = $productModel->all("*", $this->table, "`id` IN ($listCheck) AND `type` = '{$type}'");
      if (Functions::checkData($gallerys)) {
        $galleryModel->destroy($this->tableGallery, "`hash` IN ($listHash) AND `type` = '{$type}'");
      }
      if (Functions::checkData($seo)) {
        $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      }
      foreach ($productByListId as $v) {
        $photo1 = isset($v['photo1']) && !empty($v['photo1']) ? $v['photo1'] : "";
        $photo2 = isset($v['photo2']) && !empty($v['photo2']) ? $v['photo2'] : "";
        $photo3 = isset($v['photo3']) && !empty($v['photo3']) ? $v['photo3'] : "";
        $photo4 = isset($v['photo4']) && !empty($v['photo4']) ? $v['photo4'] : "";
        $filenameProduct1 = $uploadProduct . $photo1;
        $filenameProduct2 = $uploadProduct . $photo2;
        $filenameProduct3 = $uploadProduct . $photo3;
        $filenameProduct4 = $uploadProduct . $photo4;
        if (file_exists($filenameProduct1) && !empty($photo1)) unlink($filenameProduct1);
        if (file_exists($filenameProduct2) && !empty($photo2)) unlink($filenameProduct2);
        if (file_exists($filenameProduct3) && !empty($photo3)) unlink($filenameProduct3);
        if (file_exists($filenameProduct4) && !empty($photo4)) unlink($filenameProduct4);
      }
      $productModel->destroy($this->table, "`id` IN ($listCheck) AND `type` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/product/index");
    }
  }

  /* Delete all size */
  public function deleteAllSize()
  {
    if ($_POST['checkitem']) {
      @$type = $this->productType;
      $sizeModel = $this->model->models('SizeAdmin');
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $sizeModel->destroy('size', "`id_size` IN ($listCheck) AND `type_size` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/size/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/product/size/index");
    }
  }

  /* Delete all color */
  public function deleteAllColor()
  {
    if ($_POST['checkitem']) {
      @$type = $this->productType;
      $colorModel = $this->model->models('ColorAdmin');
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $colorModel->destroy('color', "`id_color` IN ($listCheck) AND `type_color` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/color/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/product/color/index");
    }
  }

  /* Delete by id */
  public function destroy()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$hash = isset($_GET['hash']) ? $_GET['hash'] : "";
    $galleryModel = $this->model->models($this->galleryModel);
    $gallerys = $galleryModel->all("*", $this->tableGallery, "`id_parent` = '{$id}' AND `type` = '{$type}'");
    $productModel = $this->model->models($this->productModel);
    $seoModel = $this->model->models($this->seoModel);
    $uploadProduct = "upload/product/";
    $uploadGallery = "upload/gallery/";
    $productDetail = Functions::rawOne($productModel->all('*', $this->table, "`type` = '{$type}' AND `hash` = '{$hash}' AND `id` = '{$id}' LIMIT 0,1"));
    $seo = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}' LIMIT 0,1"));
    if (Functions::checkData($seo)) {
      $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}'");
    }
    if (Functions::checkData($gallerys)) {
      $galleryModel->destroy($this->tableGallery, "`type` = '{$type}' AND `id_parent` = '{$id}'");
      foreach ($gallerys as $k => $v) {
        $galleryPhoto = isset($v['photo']) && !empty($v['photo']) ? $v['photo'] : "";
        $filenameGallery = $uploadGallery . $galleryPhoto;
        if (file_exists($filenameGallery) && !empty($galleryPhoto)) unlink($filenameGallery);
      }
    }
    $photo1 = isset($productDetail['photo1']) && !empty($productDetail['photo1']) ? $productDetail['photo1'] : "";
    $photo2 = isset($productDetail['photo2']) && !empty($productDetail['photo2']) ? $productDetail['photo2'] : "";
    $photo3 = isset($productDetail['photo3']) && !empty($productDetail['photo3']) ? $productDetail['photo3'] : "";
    $photo4 = isset($productDetail['photo4']) && !empty($productDetail['photo4']) ? $productDetail['photo4'] : "";
    $filenameProduct1 = $uploadProduct . $photo1;
    $filenameProduct2 = $uploadProduct . $photo2;
    $filenameProduct3 = $uploadProduct . $photo3;
    $filenameProduct4 = $uploadProduct . $photo4;
    if (file_exists($filenameProduct1) && !empty($photo1)) unlink($filenameProduct1);
    if (file_exists($filenameProduct2) && !empty($photo2)) unlink($filenameProduct2);
    if (file_exists($filenameProduct3) && !empty($photo3)) unlink($filenameProduct3);
    if (file_exists($filenameProduct4) && !empty($photo4)) unlink($filenameProduct4);
    $productModel->destroy($this->table, "`type` = '{$type}' AND `id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/index");
  }

  /* Delete size by id */
  public function destroySize()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $sizeModel = $this->model->models('SizeAdmin');
    $sizeModel->destroy('size', "`type_size` = '{$this->productType}' AND `id_size`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/size/index");
  }

  /* Delete color by id */
  public function destroyColor()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $colorModel = $this->model->models('ColorAdmin');

    $colorModel->destroy('color', "`type_color` = '{$this->productType}' AND `id_color`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/color/index");
  }

  /* Delete option */
  public function deleteOption()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $uploadColor = "upload/color/";
    $productSaleModel = $this->model->models('ProductSaleAdmin');
    $productSaleById = Functions::rawOne($productSaleModel->all('*', 'product_sale', "`type` = '{$this->productType}' AND `id` = '{$id}'"));
    $photoColor = isset($productSaleById['photo_color']) && !empty($productSaleById['photo_color']) ? $productSaleById['photo_color'] : "";
    $filenameColor = $uploadColor . $photoColor;
    $productSaleModel->destroy('product_sale', "`type` = '{$this->productType}' AND `id`='{$id}'");
    if (file_exists($filenameColor) && !empty($photoColor)) {
      unlink($filenameColor);
    }
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/index");
  }

  /* Soft delete UI */
  public function softDeleteIndex()
  {
    @$type = $this->productType;
    @$numberPerPage = $this->numberPage;
    @$url = $this->urlBase . "admin/product/soft";
    $productModel = $this->model->models($this->productModel);
    $data = $productModel->all('*', $this->table, "`type` = '{$type}' AND `deleted_at` IS NOT NULL");
    $numberRow = count($data);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $paginate = Functions::Paginate($page, $totalPage, $url);
    $productPaginate = $productModel->all('*', $this->table, "`type` = '{$type}' AND `deleted_at` IS NOT NULL ORDER BY num,id DESC LIMIT $numberStart,$numberPerPage");
    $this->data['seoTitle'] = $this->seoTitleTrash;
    $this->data['module'] = $this->softDeleteProductModule;
    $this->data['action'] = 'product';
    $this->data['paginate'] = $paginate;
    $this->data['data'] = $productPaginate;
    $this->views($this->data, 'admin');
  }

  /* Soft delete item */
  public function softDelete()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->productType;
    $productModel = $this->model->models($this->productModel);
    if ($id) {
      $deleteAt = $productModel->all('*', $this->table, "`id` = $id AND `deleted_at` IS NULL LIMIT 0,1");
      if ($deleteAt) {
        $productModel->edit($this->table, ['deleted_at' => time()], "`id`='{$id}' AND `type` = '{$type}'");
        Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/index");
      } else {
        Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/product/index");
      }
    }
  }

  /* Soft delete all */
  public function softDeleteAll()
  {
    if ($_POST['checkitem']) {
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      @$type = $this->productType;
      $productModel = $this->model->models($this->productModel);
      $dataDeleted = $productModel->all('*', $this->table, "`id` IN ($listCheck)  AND `type` = '{$type}' AND  `deleted_at` IS NULL");
      if (Functions::checkData($dataDeleted)) {
        $productModel->edit($this->table, ['deleted_at' => time()], "`id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/product/index");
      } else {
        Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/product/index");
      }
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/product/index");
    }
  }

  /* Xử lý khôi phục từng row */
  public function restore()
  {
    @$id = (int)$_GET['id'];
    @$type = $this->productType;
    $productModel = $this->model->models($this->productModel);
    if ($id) {
      $deleteAt = Functions::rawOne($productModel->all('*', $this->table, "`id` = $id AND `type` = '{$type}' AND `deleted_at` IS NOT NULL LIMIT 0,1"));
      if (Functions::checkData($deleteAt)) {
        $productModel->edit($this->table, ['deleted_at' => null], "`id` = '{$id}' AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/product/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/product/index");
      }
    }
  }

  /* Xử lý khôi phục tất cả */
  public function restoreAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->productType;
      @$listCheck = implode(',', array_values($_POST['checkitem']));
      $productModel = $this->model->models($this->productModel);
      $dataDeleted = $productModel->all("*", $this->table, "`type` = '{$type}' AND `id` IN ($listCheck) AND `deleted_at` IS NOT NULL");
      if (Functions::checkData($dataDeleted)) {
        $productModel->edit($this->table, ['deleted_at' => null], "`id` IN ($listCheck) AND `type` = '{$type}'");
        Functions::transfer("Khôi phục dữ liệu", "success", $this->urlBase . "admin/product/index");
      } else {
        Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/product/index");
      }
    } else {
      Functions::transfer("Khôi phục dữ liệu", "danger", $this->urlBase . "admin/product/index");
    }
  }

  /* Xử lý xóa ảnh */
  public function deletePhoto()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo1 = isset($_GET['photo1']) ? $_GET['photo1'] : "";
    @$photo2 = isset($_GET['photo2']) ? $_GET['photo2'] : "";
    @$photo3 = isset($_GET['photo3']) ? $_GET['photo3'] : "";
    @$photo4 = isset($_GET['photo4']) ? $_GET['photo4'] : "";
    $productModel = $this->model->models($this->productModel);
    $uploadProduct = "upload/product/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadProduct . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $productModel->edit($this->table, ["photo1" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/product/show?id=" . $id);
    } elseif ($photo2 && !empty($id)) {
      $filename = $uploadProduct . $photo2;
      if (file_exists($filename) && !empty($photo2)) unlink($filename);
      $productModel->edit($this->table, ["photo2" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/product/show?id=" . $id);
    } elseif ($photo3 && !empty($id)) {
      $filename = $uploadProduct . $photo3;
      if (file_exists($filename) && !empty($photo3)) unlink($filename);
      $productModel->edit($this->table, ["photo3" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/product/show?id=" . $id);
    } elseif ($photo4 && !empty($id)) {
      $filename = $uploadProduct . $photo4;
      if (file_exists($filename) && !empty($photo4)) unlink($filename);
      $productModel->edit($this->table, ["photo4" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/product/show?id=" . $id);
    } else {
      Functions::redirect($this->urlBase . "admin/product/show?id=" . $id);
    }
  }

  /* Xóa chi tiết thư viện ảnh con */
  public function destroyGallery()
  {
    @$type = $this->productType;
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
    Functions::transfer("Xóa", "success", $this->urlBase . "admin/product/show?id=" . $idParent);
  }

  /* Nhân bản sản phẩm */
  public function duplicate()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
    $duplicateRandom = " $hashString";
    $duplicateTitle = str_repeat($duplicateRandom, 1);
    $productModel = $this->model->models($this->productModel);
    $productDetail = Functions::rawOne($productModel->all('*', $this->table, "`type` = '{$type}' AND `id` = $id limit 0,1"));
    $d = array(
      'slug' => $productDetail['slug'] . $duplicateTitle,
      'title' => $productDetail['title'] . $duplicateTitle,
      'description' => isset($productDetail['description']) ? $productDetail['description'] : null,
      'content' => isset($productDetail['content']) ? $productDetail['content'] : null,
      'photo1' => null,
      'photo2' => null,
      'photo3' => null,
      'photo4' => null,
      'status' => $productDetail['status'],
      'num' => 0,
      'quantity' => $productDetail['quantity'],
      'code' => $productDetail['code'],
      'regular_price' => $productDetail['regular_price'],
      'sale_price' => $productDetail['sale_price'],
      'discount' => $productDetail['discount'],
      'type' => $type,
      'hash' => $hashString,
      'id_parent1' => isset($productDetail['id_parent1']) ? $productDetail['id_parent1'] : "",
      'id_parent2' => isset($productDetail['id_parent2']) ? $productDetail['id_parent2'] : "",
      'id_parent3' => isset($productDetail['id_parent3']) ? $productDetail['id_parent3'] : "",
      'id_parent4' => isset($productDetail['id_parent4']) ? $productDetail['id_parent4'] : "",
      'created_at' => time(),
    );
    $productModel->create($this->table, $d);
    Functions::transfer("Nhân bản dữ liệu", "success", $this->urlBase . "admin/product/index");
  }

  /* Xử lý lưu && lưu tại trang && cập nhật dữ liệu sản phẩm */
  public function stored()
  {
    @$id = !empty($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->productType;
    $productModel = $this->model->models($this->productModel);
    $seoModel = $this->model->models($this->seoModel);
    $hashString = Functions::rawOne($productModel->all('`hash`', $this->table, "`type` = '{$type}' AND `id` = '{$id}' LIMIT 0,1"));

    if ($id) {
      $productDetail = Functions::rawOne($productModel->all('*', $this->table, "`type` = '{$type}' AND `id` = $id limit 0,1"));
      /** Lưu tại trang **/
      if (isset($_POST['save-here'])) {
        /* Slug */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $productModel->all('*', $this->table, "`type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo1 = isset($productDetail['photo1']) && !empty($productDetail['photo1']) ? $productDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo2 = isset($productDetail['photo2']) && !empty($productDetail['photo2']) ? $productDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo3 = isset($productDetail['photo3']) && !empty($productDetail['photo3']) ? $productDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo4 = isset($productDetail['photo4']) && !empty($productDetail['photo4']) ? $productDetail['photo4'] : null;
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $file_mp4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          } else {
            $file_mp4 = isset($productDetail['file_mp4']) && !empty($productDetail['file_mp4']) ? $productDetail['file_mp4'] : null;
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $file_attach = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          } else {
            $file_attach = isset($productDetail['file_attach']) && !empty($productDetail['file_attach']) ? $productDetail['file_attach'] : null;
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
            'quantity' => isset($_POST['quantity']) ? $_POST['quantity'] : null,
            'code' => isset($_POST['code']) ? htmlspecialchars($_POST['code']) : null,
            'regular_price' => isset($_POST['regular_price']) ? str_replace(",", "", $_POST['regular_price']) : null,
            'sale_price' => isset($_POST['sale_price']) ? str_replace(",", "", $_POST['sale_price']) : null,
            'discount' => isset($_POST['discount']) ? $_POST['discount'] : null,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : "",
            'file_mp4' => isset($file_mp4) ? $file_mp4 : "",
            'hash' => $hashString['hash'],
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $productModel->edit($this->table, $d, "`id`='{$id}'");
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
            $seoModel->create($this->tableSeo, $d_seo);
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/product/show?id=" . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/product/show?id=" . $id);
        }

        /** Tiến trình tạo schema **/
        if (isset($_POST['build-schema'])) {
          $hashSeo = $productDetail['hash'];
          $seoModel->edit($this->tableSeo, ['id_parent' => $id], "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}'");
          $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}' LIMIT 0,1"));
          $photo = isset($productDetail['photo1']) ? $productDetail['photo1'] : "";
          $imageDetail = "upload/product/" . $photo;
          $d_schema = Functions::buildSchemaProduct($id, $seo['title_seo'], $imageDetail, $seo['description_seo'], $productDetail['code'], "Tên danh mục cấp 1", "Phat", $productDetail['slug'], $productDetail['sale_price']);
          if (Functions::checkData($seo)) {
            $seoModel->edit($this->tableSeo, ['schema' => $d_schema], "`type` = '{$type}' AND `hash_seo` = '{$hashSeo}'");
            Functions::transfer("Tiến trình Schema JSON", "success", $this->urlBase . "admin/product/show?id=" . $id);
          } else {
            echo "<script>alert('Bạn cần có Data SEO để tạo Schema JSON Product')</script>";
            Functions::transfer("Tiến trình Schema JSON", "danger", $this->urlBase . "admin/product/show?id=" . $id);
          }
        }
      }

      /** Cập nhập **/
      if (isset($_POST['update'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $productModel->all('*', $this->table, "`type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo1 = isset($productDetail['photo1']) && !empty($productDetail['photo1']) ? $productDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo2 = isset($productDetail['photo2']) && !empty($productDetail['photo2']) ? $productDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo3 = isset($productDetail['photo3']) && !empty($productDetail['photo3']) ? $productDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          } else {
            $photo4 = isset($productDetail['photo4']) && !empty($productDetail['photo4']) ? $productDetail['photo4'] : null;
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $file_mp4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          } else {
            $file_mp4 = isset($productDetail['file_mp4']) && !empty($productDetail['file_mp4']) ? $productDetail['file_mp4'] : null;
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $file_attach = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          } else {
            $file_attach = isset($productDetail['file_attach']) && !empty($productDetail['file_attach']) ? $productDetail['file_attach'] : null;
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
            'quantity' => isset($_POST['quantity']) ? $_POST['quantity'] : null,
            'code' => isset($_POST['code']) ? htmlspecialchars($_POST['code']) : null,
            'regular_price' => isset($_POST['regular_price']) ? str_replace(",", "", $_POST['regular_price']) : null,
            'sale_price' => isset($_POST['sale_price']) ? str_replace(",", "", $_POST['sale_price']) : null,
            'discount' => isset($_POST['discount']) ? $_POST['discount'] : null,
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
          $productModel->edit($this->table, $d, "`id`='{$id}'");
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
            $seoModel->create($this->tableSeo, $d_seo);
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/product/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/product/index");
        }
      }

      /** Tiến trình tạo schema **/
      if (isset($_POST['build-schema'])) {
        $hashSeo = $productDetail['hash'];
        $seoModel->edit($this->tableSeo, ['id_parent' => $id], "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}'");
        $seo = Functions::rawOne($seoModel->all('*', $this->tableSeo, "`type` = '{$type}' AND `hash_Seo`='{$hashSeo}' LIMIT 0,1"));
        $photo = isset($productDetail['photo1']) ? $productDetail['photo1'] : "";
        $imageDetail = "upload/product/" . $photo;
        $d_schema = Functions::buildSchemaProduct($id, $seo['title_seo'], $imageDetail, $seo['description_seo'], $productDetail['code'], "Tên danh mục cấp 1", "Phat", $productDetail['slug'], $productDetail['sale_price']);
        if (Functions::checkData($seo)) {
          $seoModel->edit($this->tableSeo, ['schema' => $d_schema], "`hash_seo` = '{$hashSeo}'");
          Functions::transfer("Tiến trình Schema JSON", "success", $this->urlBase . "admin/product/show?id=" . $id);
        } else {
          echo "<script>alert('Bạn cần có Data SEO để tạo Schema JSON Product')</script>";
          Functions::transfer("Tiến trình Schema JSON", "danger", $this->urlBase . "admin/product/show?id=" . $id);
        }
      }
    } else {
      /* SAVE DATA */
      if (isset($_POST['save'])) {
        $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $productModel->all('*', $this->table, "`type` = '{$type}' AND `slug` = '{$slugCondition}'");
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
            $photo1 = Functions::uploadFile("photo1", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          }
          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile("photo2", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          }
          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile("photo3", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
          }
          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile("photo4", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/product/");
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
            'quantity' => isset($_POST['quantity']) ? $_POST['quantity'] : null,
            'code' => isset($_POST['code']) ? htmlspecialchars($_POST['code']) : null,
            'regular_price' => isset($_POST['regular_price']) ? str_replace(",", "", $_POST['regular_price']) : null,
            'sale_price' => isset($_POST['sale_price']) ? str_replace(",", "", $_POST['sale_price']) : null,
            'discount' => isset($_POST['discount']) ? $_POST['discount'] : null,
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
          $productModel->create($this->table, $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/product/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/product/create");
        }
      }
    }
  }

  /* Xử lý update tiêu đề thư viện ảnh con */
  public function updateTitleGallery()
  {
    @$id = $_POST['id'];
    @$type = $this->productType;
    @$id_parent = isset($_POST['id_parent']) ? $_POST['id_parent'] : "";
    @$hash = isset($_POST['hash']) ? htmlspecialchars($_POST['hash']) : "";
    @$value = isset($_POST['value']) ? htmlspecialchars($_POST['value']) : "";
    @$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : "";
    @$table = $_POST['table'];
    $galleryModel = $this->model->models($this->galleryModel);
    $galleryModel->update($table, array('title' => $value, 'hash' => $hash, 'id_parent' => $id_parent, "status" => $status), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Xử lý Upload ajax thư viện ảnh con */
  public function uploadGallery()
  {
    @$type = $this->productType;
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    $galleryModel = $this->model->models($this->galleryModel);
    $statusDefault = "hienthi";
    $uploadGallery = "upload/gallery/";
    $typeAllow = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
    /* Lưu thư viện ảnh con */
    if (Functions::hasFile("file")) {
      $fileResult = Functions::uploadFile("file", $typeAllow, $uploadGallery);
      $d_gallery = [
        'photo' => $fileResult,
        'id_parent' => $id,
        'title' => pathinfo($fileResult, PATHINFO_FILENAME),
        'status' => $statusDefault,
        'type' => $type,
        'created_at' => time(),
      ];
      $galleryModel->create($this->tableGallery, $d_gallery);
      Functions::transfer("Lưu thư viện ảnh", "danger", $this->urlBase . "admin/product/index");
    }
  }

  /* Xử lý ajax load danh mục cấp 2 từ danh mục cấp 1 */
  public function filterCategory()
  {
    @$type = $this->productType;
    @$id = isset($_POST['id']) ? $_POST['id'] : "";
    $categoryProductModel = $this->model->models($this->productCategoryModel);
    $categoryProduct2 = $categoryProductModel->all('*', $this->tableCategory, "`level` = 2 AND `type` = '{$type}' AND `id_parent` = '{$id}' AND `deleted_at` IS NULL  ORDER BY num,id DESC");
    if (Functions::checkData($categoryProduct2)) {
      $output = '';
      $output .= '<option>Danh mục cấp 2</option>';
      foreach ($categoryProduct2 as $v2) {
        $output .= '<option value="' . $v2['id'] . '">
                    ' . $v2['title'] . '
                  </option>';
      }
      echo $output;
    }
  }

  /* Xử lý load ajax thuộc tính sản phẩm (size & color) */
  public function loadSizeColor()
  {
    $sizeModel = $this->model->models('SizeAdmin');
    $colorModel = $this->model->models('ColorAdmin');
    $sizes = $sizeModel->all('*', 'size', "`type_size` = '{$this->productType}'");
    $colors = $colorModel->all('*', 'color', "`type_color` = '{$this->productType}'");
    include("app/views/admin/partials/load_data_options.php");
  }

  /* Page danh sách size */
  public function indexSize()
  {
    $sizeModel = $this->model->models('SizeAdmin');
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$url = $this->urlBase . "admin/product/size/index";
    @$numberPerPage = Configurations::configurationsBackEnd()['product']['size_info']['num_per_page'];
    $where = "";

    if ($keyword) {
      $where .= "`name_size` LIKE '%{$keyword}%' AND ";
    }
    $where .= "`type_size` = '{$this->productType}' ORDER BY num_size,id_size DESC";
    $sizes = $sizeModel->all('*', 'size', $where);
    $numberRow = count($sizes);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $sizePaginate = $sizeModel->all('*', 'size', $where . $limit);
    if ($sizePaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = 'Danh sách thuộc tính size';
    $this->data['module'] = $this->nameModule;
    $this->data['paginate'] = $paginate;
    $this->data['sizes'] = $sizePaginate;
    $this->data['action'] = 'index_size';
    $this->views($this->data, 'admin');
  }

  /* Page danh sách color */
  public function indexColor()
  {
    $colorModel = $this->model->models('ColorAdmin');
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$url = $this->urlBase . "admin/product/color/index";
    @$numberPerPage = Configurations::configurationsBackEnd()['product']['color_info']['num_per_page'];
    $where = "";

    if ($keyword) {
      $where .= "`name_color` LIKE '%{$keyword}%' AND ";
    }
    $where .= "`type_color` = '{$this->productType}' ORDER BY num_color,id_color DESC";
    $colors = $colorModel->all('*', 'color', $where);
    $numberRow = count($colors);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";

    $colorPaginate = $colorModel->all('*', 'color', $where . $limit);
    if ($colorPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = 'Danh sách thuộc tính color';
    $this->data['module'] = $this->nameModule;
    $this->data['paginate'] = $paginate;
    $this->data['colors'] = $colorPaginate;
    $this->data['action'] = 'index_color';
    $this->views($this->data, 'admin');
  }

  /* Page detail product size */
  public function showSize()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $sizeModel = $this->model->models('SizeAdmin');
    $sizeDetail = Functions::rawOne($sizeModel->all('*', 'size', "`id_size` = '{$id}' AND `type_size` = '{$this->productType}'"));
    $this->data['seoTitle'] = $sizeDetail['name_size'];
    $this->data['module'] = $this->nameModule;
    $this->data['sizeDetail'] = $sizeDetail;
    $this->data['action'] = 'show_size';
    $this->views($this->data, 'admin');
  }

  /* Page detail product color */
  public function showColor()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $colorModel = $this->model->models('ColorAdmin');
    $colorDetail = Functions::rawOne($colorModel->all('*', 'color', "`id_color` = '{$id}' AND `type_color` = '{$this->productType}'"));
    $this->data['seoTitle'] = $colorDetail['name_color'];
    $this->data['module'] = $this->nameModule;
    $this->data['colorDetail'] = $colorDetail;
    $this->data['action'] = 'show_color';
    $this->views($this->data, 'admin');
  }

  /* Page create size */
  public function createSize()
  {
    $this->data['seoTitle'] = 'Thêm thuộc tính size';
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'create_size';
    $this->views($this->data, 'admin');
  }

  /* Page create color */
  public function createColor()
  {
    $this->data['seoTitle'] = 'Thêm thuộc tính color';
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'create_color';
    $this->views($this->data, 'admin');
  }

  /* Xử lý thêm và cập nhật thuộc tính size */
  public function storedSize()
  {
    $sizeModel = $this->model->models('SizeAdmin');
    @$id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id) {
      /*UPDATE*/
      if (isset($_POST['update'])) {
        if (empty($this->error)) {
          $d = [
            'name_size' => htmlspecialchars($_POST['title'])
          ];
          $sizeModel->edit('size', $d, "`id_size`='{$id}'");
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/product/size/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/product/size/index");
        }
      }
    } else {
      /*SAVE*/
      if (isset($_POST['save'])) {
        if (empty($this->error)) {
          $d = array(
            'name_size' => htmlspecialchars($_POST['title']),
            'type_size' => $this->productType,
            'num_size' => 0,
          );
          $sizeModel->create('size', $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/product/size/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/product/size/index");
        }
      }
    }
  }
  /* Xử lý thêm và cập nhật thuộc tính color */
  public function storedColor()
  {
    $colorModel = $this->model->models('ColorAdmin');
    @$id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id) {
      /*UPDATE*/
      if (isset($_POST['update'])) {
        if (empty($this->error)) {
          $d = [
            'name_color' => htmlspecialchars($_POST['title'])
          ];
          $colorModel->edit('color', $d, "`id_color`='{$id}'");
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/product/color/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/product/color/index");
        }
      }
    } else {
      /*SAVE*/
      if (isset($_POST['save'])) {
        if (empty($this->error)) {
          $d = array(
            'name_color' => htmlspecialchars($_POST['title']),
            'type_color' => $this->productType,
            'num_color' => 0,
          );
          $colorModel->create('color', $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/product/color/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/product/color/index");
        }
      }
    }
  }

  /* Handle update options color & size product detail */
  public function optionStored()
  {
    $productSaleModel = $this->model->models('ProductSaleAdmin');
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    @$options = isset($_POST['options']) ? $_POST['options'] : [];
    if (Functions::hasFile("photo_color")) {
      $photoColor = Functions::uploadFile("photo_color", array('png', 'jpg', 'jpeg', 'gif', 'webp'), "upload/color/");
    }

    if (empty($this->error)) {
      $d = [
        'id_parent' => $id,
        'photo_color' => $photoColor,
        'regular_price' => isset($options['regular_price']) ? str_replace(',', '', $options['regular_price']) : 0,
        'sale_price' => isset($options['sale_price']) ? str_replace(',', '', $options['sale_price']) : 0,
        'discount' => isset($options['discount']) ? $options['discount'] : 0,
        'id_color' => isset($options['color']) ? $options['color'] : 0,
        'id_size' => isset($options['size']) ? $options['size'] : 0,
        'type' => $this->productType
      ];
      $productSaleModel->create('product_sale', $d);
      Functions::transfer("Thêm thuộc tính", "success", $this->urlBase . "admin/product/show?id=" . $id);
    } else {
      foreach ($this->error as $k => $v) {
        Flash::set($k, $v, 'danger');
      }
      Functions::transfer("Thêm thuộc tính", "danger", $this->urlBase . "admin/product/show?id=" . $id);
    }
  }
}
