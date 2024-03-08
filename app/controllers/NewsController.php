<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Functions;
use Models;

class NewsController extends Controllers
{
  public $data = [];
  public $model;
  public $urlBase;
  public $newsType;
  public $newsModel;
  public $tableNews;
  public $tableCategoryNews;
  public $moduleNews;
  public $seoPageModel;
  public $tableSeoPage;
  public $tableSeo;
  public $seoModel;

  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->newsType = 'tin-tuc';
    $this->newsModel = 'News';
    $this->tableNews = 'news';
    $this->tableSeoPage = 'seopage';
    $this->tableSeo = 'seo';
    $this->tableCategoryNews = 'category_news';
    $this->moduleNews = 'news';
    $this->seoPageModel = 'SeoPageAdmin';
    $this->seoModel = 'SeoAdmin';
  }

  public function index()
  {
    @$type = $this->newsType;
    @$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    @$slug1 = isset($_GET['slug1']) ? $_GET['slug1'] : '';
    @$slug2 = isset($_GET['slug2']) ? $_GET['slug2'] : '';
    $newsModel = $this->model->models($this->newsModel);
    $seoPageModel = $this->model->models($this->seoPageModel);
    $seoModel = $this->model->models($this->seoModel);

    if ($slug) {
      $where = "`type` = '{$type}' AND `slug` = '{$slug}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $newsDetail = Functions::rawOne($newsModel->all('id,slug,photo1,title,description,content,hash', $this->tableNews, $where));
      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$newsDetail['hash']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['newsDetail'] = $newsDetail;
      $this->data['action'] = 'show';
    } elseif ($slug1) {
      $categoryNews = Functions::rawOne($newsModel->all('*', $this->tableCategoryNews, "`type` = '{$type}' AND `slug` = '{$slug1}' AND `level` = 1 AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC"));
      $where = "`type` = '{$type}' AND `id_parent1` = '{$categoryNews['id']}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $news = $newsModel->all('*', $this->tableNews, $where);
      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$categoryNews['hash']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['newsType'] = $this->newsType;
      $this->data['titleMain'] = $categoryNews['title'];
      $this->data['news'] = $news;
      $this->data['action'] = 'index';
    } elseif ($slug2) {
      $categoryNews = Functions::rawOne($newsModel->all('*', $this->tableCategoryNews, "`type` = '{$type}' AND `slug` = '{$slug2}' AND `level` = 2 AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC"));
      $where = "`type` = '{$type}' AND `id_parent2` = '{$categoryNews['id']}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $news = $newsModel->all('*', $this->tableNews, $where);
      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$categoryNews['hash']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['titleMain'] = $categoryNews['title'];
      $this->data['newsType'] = $this->newsType;
      $this->data['news'] = $news;
      $this->data['action'] = 'index';
    } else {
      $where = "`type` = '{$type}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $news = $newsModel->all('*', $this->tableNews, $where);
      $seoPage = Functions::rawOne($seoPageModel->all('title, keywords, description', $this->tableSeoPage, "`type` = '{$this->newsType}'"));
      Functions::set('title', $seoPage['title']);
      Functions::set('description', $seoPage['description']);
      Functions::set('keywords', $seoPage['keywords']);
      $this->data['newsType'] = $this->newsType;
      $this->data['titleMain'] = 'Tin tức';
      $this->data['action'] = 'index';
      $this->data['news'] = $news;
    }
    $this->data['module'] = $this->moduleNews;
    $this->views($this->data, 'index');
  }
}
