<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Functions;
use Models;

class SearchController extends Controllers
{
  public $model;
  public $tableProduct;
  public $productModel;
  public $typeProduct;
  public $urlBase;
  public $data = [];
  public function __construct()
  {
    $this->model = new Models();
    $this->productModel = 'Product';
    $this->tableProduct = 'products';
    $this->typeProduct = 'san-pham';
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
  }

  public function index()
  {
    $productModel = $this->model->models($this->productModel);
    if (isset($_GET['keyword'])) {
      $keywords = htmlspecialchars($_GET['keyword']);
      $products = $productModel->all('*', $this->tableProduct, "`title` LIKE '%{$keywords}%' AND `type` = '{$this->typeProduct}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC");
      Functions::set('title', 'Tìm kiếm');
      Functions::set('keywords', '');
      Functions::set('description', '');
      $this->data['titleMain'] = 'Tìm kiếm';

      if ($products) {
        $numberRow = count($products);
        $totalPage = ceil($numberRow / 10);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $numberStart = ($page - 1) * 10;
        $limit = " LIMIT $numberStart,10";
        $productPaginate = $productModel->all('*', $this->tableProduct, "`title` LIKE '%{$keywords}%' AND `type` = 'san-pham' AND `deleted_at` IS NULL ORDER BY num,id DESC" . $limit);
        if ($productPaginate) {
          $paginate = Functions::Paginate($page, $totalPage, $this->urlBase . 'san-pham', false, false);
        } else {
          $paginate = "";
        }
        $this->data['productType'] = 'san-pham';
        $this->data['module'] = 'product';
        $this->data['products'] = $productPaginate;
        $this->data['paginate'] = $paginate;
        $this->data['action'] = 'index';
        $this->views($this->data, 'index');
      } else {
        Functions::redirect($this->urlBase . '404');
      }
    }
  }
}
