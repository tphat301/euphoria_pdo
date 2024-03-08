<?php

namespace App\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Controllers;
use Functions;
use Models;

class DashboardAdminController extends Controllers
{
  public $charArtModel;
  public $tableChart;
  public $model;
  public $data = [];
  public function __construct()
  {
    $this->model = new Models();
    $this->charArtModel = 'CharArtAdmin';
    $this->tableChart = 'chart';
  }

  public function index()
  {
    $this->data['module'] = 'dashboard';
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* Chart data */
  public function chart()
  {
    if (isset($_POST['date'])) {
      @$time = $_POST['date'];
    } else {
      $time = '';
      $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    if ($time == '7ngayqua') {
      $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    } elseif ($time == '14ngayqua') {
      $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(14)->toDateString();
    } elseif ($time == '28ngayqua') {
      $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
    } elseif ($time == '365ngayqua') {
      $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    }

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $chartModel = $this->model->models($this->charArtModel);
    $charts = $chartModel->all('*', $this->tableChart, "order_date BETWEEN '$subdays' AND '$now'");
    foreach ($charts as $v) {
      $chartData[] = [
        'order_date' => $v['order_date'],
        'order' => $v['order'],
        'order_sales' => $v['order_sales'],
        'order_buy_qty' => $v['order_buy_qty']
      ];
    }
    echo $data = json_encode(isset($chartData) ? $chartData : []);
  }
}
