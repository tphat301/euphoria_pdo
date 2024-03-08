<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Functions;
use Models;

class PolicyController extends Controllers
{
  public $data = [];
  public $model;
  public $urlBase;
  public $policyType;
  public $policyModel;
  public $tableNews;
  public $tableCategoryNews;
  public $modulePolicy;
  public $tableSeo;
  public $seoModel;

  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->policyType = 'chinh-sach';
    $this->policyModel = 'Policy';
    $this->tableNews = 'news';
    $this->tableSeo = 'seo';
    $this->modulePolicy = 'policy';
    $this->seoModel = 'SeoAdmin';
  }

  public function index()
  {
    @$type = $this->policyType;
    @$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    $policyModel = $this->model->models($this->policyModel);
    $seoModel = $this->model->models($this->seoModel);

    if ($slug) {
      $where = "`type` = '{$type}' AND `slug` = '{$slug}' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC";
      $policyDetail = Functions::rawOne($policyModel->all('id,slug,photo1,title,description,content,hash', $this->tableNews, $where));
      $seo = Functions::rawOne($seoModel->all('title_seo, keywords, description_seo', $this->tableSeo, "`hash_seo` = '{$policyDetail['hash']}'"));
      Functions::set('title', isset($seo['title_seo']) ? $seo['title_seo'] : '');
      Functions::set('keywords', isset($seo['keywords']) ? $seo['keywords'] : '');
      Functions::set('description', isset($seo['description_seo']) ? $seo['description_seo'] : '');
      $this->data['newsDetail'] = $policyDetail;
      $this->data['action'] = 'show';
      $this->data['module'] = $this->modulePolicy;
      $this->views($this->data, 'index');
    }
  }
}
