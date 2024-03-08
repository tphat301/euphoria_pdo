<?php

namespace App\Controllers;

use Configurations;

class NotFoundController
{
  public $data = [];
  public $urlBase;
  public function index()
  {
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    include("app/views/404/404_tpl.php");
  }
}
