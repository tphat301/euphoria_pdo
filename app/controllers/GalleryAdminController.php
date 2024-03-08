<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Functions;
use Models;

class GalleryAdminController extends Controllers
{
  public $data = [];
  public $error = [];
  public $success = [];
  public $model;
  public function __construct()
  {
    $this->model = new Models();
  }

  /* Delete by id*/
  public function destroy()
  {
    @$id = (int)$_GET['id'];
    @$id_page = (int)$_GET['id_page']; // Redirect here when delete gallery
    $galleryModel = $this->model->models('GalleryAdmin');
    $galleryModel->destroy('gallery', "`id`='{$id}'");
    Functions::transfer("Xóa", "success", Configurations::configurationsBase()['baseUrl'] . "admin/product/show?id=" . $id_page);
  }
}
