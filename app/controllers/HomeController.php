<?php

namespace App\Controllers;

use Controllers;
use Functions;
use Models;

class HomeController extends Controllers
{
  public $data = [];
  public $model;
  public $productType;
  public $newsType;
  public $homeType;
  public $productTable;
  public $moduleHome;
  public $tableSeoPage;
  public $tableNews;
  public $seoPageModel;
  public $productModel;
  public $newsModel;
  public $tablePhoto;
  public $photoModel;
  public $bestSellerTitleMain;
  public function __construct()
  {
    $this->model = new Models();
    $this->moduleHome = 'index';
    $this->productTable = 'products';
    $this->tableNews = 'news';
    $this->tablePhoto = 'photo';
    $this->productType = 'san-pham';
    $this->newsType = 'tin-tuc';
    $this->homeType = 'home';
    $this->tableSeoPage = 'seopage';
    $this->seoPageModel = 'SeoPageAdmin';
    $this->productModel = 'Product';
    $this->photoModel = 'Photo';
    $this->newsModel = 'News';
  }

  public function index()
  {
    $seoPageModel = $this->model->models($this->seoPageModel);
    $productModel = $this->model->models($this->productModel);
    $newsModel = $this->model->models($this->newsModel);
    $photoModel = $this->model->models($this->photoModel);
    $slideshow = $photoModel->all('*', $this->tablePhoto, "`type` = 'slideshow' AND find_in_set('hienthi',status) AND `action` = 'photo_multiple' ORDER BY num,id DESC");
    $partner = $photoModel->all('*', $this->tablePhoto, "`type` = 'partner' AND find_in_set('hienthi',status) AND `action` = 'photo_multiple' ORDER BY num,id DESC");
    $productBestSellers = $productModel->all('*', $this->productTable, "`type` = '$this->productType' AND find_in_set('banchay',status) AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC");
    $productHot = $productModel->all('*', $this->productTable, "`type` = '$this->productType' AND find_in_set('noibat',status) AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC");
    $news = $newsModel->all('id, title, photo1, slug, description, content', $this->tableNews, "`type` = '$this->newsType' AND find_in_set('noibat',status) AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC");
    $this->data['news'] = $news;
    $this->data['partner'] = $partner;
    $this->data['slideshow'] = $slideshow;
    $this->data['productBestSellers'] = $productBestSellers;
    $this->data['productHot'] = $productHot;
    $this->data['productType'] = $this->productType;
    $this->data['newsType'] = $this->newsType;
    $seoPage = Functions::rawOne($seoPageModel->all('title, keywords, description, photo1', $this->tableSeoPage, "`type` = '{$this->homeType}'"));
    Functions::set('photo1', $seoPage['photo1']);
    Functions::set('title', $seoPage['title']);
    Functions::set('description', $seoPage['description']);
    Functions::set('keywords', $seoPage['keywords']);
    $this->data['module'] = $this->moduleHome;
    $this->views($this->data, 'index');
  }
}
