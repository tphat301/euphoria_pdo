<?php

namespace App\Controllers;

use Controllers;
use Functions;
use Models;

class AboutController extends Controllers
{
  public $data = [];
  public $model;
  public $error = [];
  public $success = [];
  public function __construct()
  {
    $this->model = new Models();
  }

  public function index()
  {
    $seoPageModel = $this->model->models('SeoPageAdmin');
    $aboutModel = $this->model->models('About');
    $about = Functions::rawOne($aboutModel->all('title,content', 'static', "`type` = 'gioi-thieu' AND `status` = 'hienthi'"));
    $seoPage = Functions::rawOne($seoPageModel->all('title, keywords, description', 'seopage', "`type` = 'gioi-thieu'"));
    Functions::set('title', $seoPage['title']);
    Functions::set('description', $seoPage['description']);
    Functions::set('keywords', $seoPage['keywords']);
    $this->data['about'] = $about;
    $this->data['module'] = 'about';
    $this->data['action'] = 'index';
    $this->views($this->data, 'index');
  }
}
