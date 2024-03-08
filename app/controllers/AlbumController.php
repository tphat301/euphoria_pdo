<?php

namespace App\Controllers;

use Controllers;
use Models;

class AlbumController extends Controllers
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
  }

  public function create()
  {
  }

  public function show()
  {
  }

  public function deleteAll()
  {
  }

  public function destroy()
  {
  }

  public function ajaxStatus()
  {
  }

  public function ajaxNumber()
  {
  }

  public function softDeleteIndex()
  {
  }

  public function stored()
  {
  }
}
