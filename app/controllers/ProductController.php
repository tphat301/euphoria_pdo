<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Functions;
use Models;

class ProductController extends Controllers
{
  public $data = [];
  public $model;
  public $urlBase;
  public $productType;
  public $productModel;
  public $tableProduct;
  public $tableCategoryProduct;
  public $moduleProduct;
  public $seoPageModel;
  public $galleryModel;
  public $tableSeoPage;
  public $tableSeo;
  public $seoModel;
  public $tableGallery;

  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->productType = 'san-pham';
    $this->productModel = 'Product';
    $this->galleryModel = 'Gallery';
    $this->tableProduct = 'products';
    $this->tableSeoPage = 'seopage';
    $this->tableSeo = 'seo';
    $this->tableGallery = 'gallery';
    $this->tableCategoryProduct = 'category_products';
    $this->moduleProduct = 'product';
    $this->seoPageModel = 'SeoPageAdmin';
    $this->seoModel = 'SeoAdmin';
  }

  /* Product list */
  public function index()
  {
    @$type = $this->productType;
    @$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    @$slug1 = isset($_GET['slug1']) ? $_GET['slug1'] : '';
    @$slug2 = isset($_GET['slug2']) ? $_GET['slug2'] : '';
    $productModel = $this->model->models($this->productModel);
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seoModel = $this->model->models($this->seoModel);

    if ($slug) {

      $where = "`type` = '{$type}' AND `slug` = '{$slug}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $productDetail = Functions::rawOne($productModel->all('id,slug,photo1,code,title,description,content,quantity,regular_price,sale_price,discount,hash', $this->tableProduct, $where));

      $colorByProductSale = $productModel->all('*', 'product_sale,color', "`id_parent` = '{$productDetail['id']}' AND product_sale.id_color = color.id_color  AND `type` = '{$type}' ORDER BY id DESC");
      $sizeByProductSale = $productModel->all('*', 'product_sale,size', "`id_parent` = '{$productDetail['id']}' AND product_sale.id_size = size.id_size  AND `type` = '{$type}' ORDER BY id DESC");

      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$productDetail['hash']}'"));
      $galleryModel = $this->model->models($this->galleryModel);
      $gallerys = Functions::rawOne($galleryModel->all('title,photo', $this->tableGallery, "`id_parent` = '{$productDetail['id']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['colorByProductSale'] = $colorByProductSale;
      $this->data['sizeByProductSale'] = $sizeByProductSale;
      $this->data['productDetail'] = $productDetail;
      $this->data['gallerys'] = $gallerys;
      $this->data['productType'] = $this->productType;
      $this->data['action'] = 'show';
    } elseif ($slug1) {
      $categoryProduct = Functions::rawOne($productModel->all('*', $this->tableCategoryProduct, "`type` = '{$type}' AND `slug` = '{$slug1}' AND `level` = 1 AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC"));
      $idParent1 = $categoryProduct['id'];
      $where = "`type` = '{$type}' AND `id_parent1` = '{$idParent1}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $products = $productModel->all('*', $this->tableProduct, $where);
      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$categoryProduct['hash']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['productType'] = $this->productType;
      $this->data['titleMain'] = $categoryProduct['title'];
      $this->data['action'] = 'index';

      // Paginate
      $numberRow = count($products);
      $totalPage = ceil($numberRow / 10);
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $numberStart = ($page - 1) * 10;
      $limit = " LIMIT $numberStart,10";
      $productPaginate = $productModel->all('*', $this->tableProduct, "`type` = '{$type}' AND `id_parent1` = '{$idParent1}' AND `deleted_at` IS NULL ORDER BY num,id DESC" . $limit);
      if ($productPaginate) {
        $paginate = Functions::Paginate($page, $totalPage, $this->urlBase . $this->productType, false, false);
      } else {
        $paginate = "";
      }
      $this->data['products'] = $productPaginate;
      $this->data['paginate'] = $paginate;
    } elseif ($slug2) {
      $categoryProduct = Functions::rawOne($productModel->all('*', $this->tableCategoryProduct, "`type` = '{$type}' AND `slug` = '{$slug2}' AND `level` = 2 AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC"));
      $idParent2 = $categoryProduct['id'];
      $where = "`type` = '{$type}' AND `id_parent2` = '{$categoryProduct['id']}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $products = $productModel->all('*', $this->tableProduct, $where);
      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$categoryProduct['hash']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['titleMain'] = $categoryProduct['title'];
      $this->data['productType'] = $this->productType;
      $this->data['action'] = 'index';

      // Paginate
      $numberRow = count($products);
      $totalPage = ceil($numberRow / 10);
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $numberStart = ($page - 1) * 10;
      $limit = " LIMIT $numberStart,10";
      $productPaginate = $productModel->all('*', $this->tableProduct, "`type` = '{$type}' AND `id_parent2` = '{$idParent2}' AND `deleted_at` IS NULL ORDER BY num,id DESC" . $limit);
      if ($productPaginate) {
        $paginate = Functions::Paginate($page, $totalPage, $this->urlBase . $this->productType, false, false);
      } else {
        $paginate = "";
      }
      $this->data['products'] = $productPaginate;
      $this->data['paginate'] = $paginate;
    } else {
      $where = "`type` = '{$type}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $products = $productModel->all('*', $this->tableProduct, $where);
      $seoPage = Functions::rawOne($seoPageModel->all('title, keywords, description', $this->tableSeoPage, "`type` = '{$this->productType}'"));
      Functions::set('title', $seoPage['title']);
      Functions::set('description', $seoPage['description']);
      Functions::set('keywords', $seoPage['keywords']);
      $this->data['productType'] = $this->productType;
      $this->data['titleMain'] = 'Sản phẩm';
      $this->data['action'] = 'index';
      // Paginate
      $numberRow = count($products);
      $totalPage = ceil($numberRow / 10);
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $numberStart = ($page - 1) * 10;
      $limit = " LIMIT $numberStart,10";
      $productPaginate = $productModel->all('*', $this->tableProduct, "`type` = '{$type}' AND `deleted_at` IS NULL ORDER BY num,id DESC" . $limit);
      if ($productPaginate) {
        $paginate = Functions::Paginate($page, $totalPage, $this->urlBase . $this->productType, false, false);
      } else {
        $paginate = "";
      }
      $this->data['products'] = $productPaginate;
      $this->data['paginate'] = $paginate;
    }
    $this->data['module'] = $this->moduleProduct;
    $this->views($this->data, 'index');
  }
}
