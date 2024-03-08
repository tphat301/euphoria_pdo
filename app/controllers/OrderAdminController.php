<?php

namespace App\Controllers;

use Carbon\Carbon;
use Configurations;
use Controllers;
use Functions;
use Models;

class OrderAdminController extends Controllers
{
  public $data = [];
  public $model;
  public $error = [];
  public $success = [];
  public $moduleOrder;
  public $tableOrder;
  public $tableVnpay;
  public $tableOrderDetail;
  public $orderModel;
  public $urlBase;
  public $numberPage;
  public function __construct()
  {
    $this->model = new Models();
    $this->tableOrder = 'orders';
    $this->moduleOrder = 'order';
    $this->tableOrderDetail = 'orders_detail';
    $this->orderModel = 'Order';
    $this->tableVnpay = 'vnpay';
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->numberPage = Configurations::configurationsBackEnd()['order']['num_per_page'];
  }

  public function index()
  {
    @$url = $this->urlBase . "admin/order/index";
    @$numberPerPage = $this->numberPage;
    $orderModel = $this->model->models($this->orderModel);
    $orders = $orderModel->all('*', 'users,orders', "users.id = orders.id_users ORDER BY number,id_order DESC");
    $numberRow = count($orders);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $orderPaginate = $orderModel->all('*', 'users,orders', "users.id = orders.id_users ORDER BY number,id_order DESC LIMIT $numberStart,$numberPerPage");
    if ($orderPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['orders'] = $orderPaginate;
    $this->data['module'] = $this->moduleOrder;
    $this->data['paginate'] = $paginate;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  public function show()
  {
    @$code = isset($_GET['code']) ? $_GET['code'] : "";
    $orderModel = $this->model->models($this->orderModel);
    $orders = $orderModel->all('*', 'orders_detail,products,orders,vnpay', "`code_order_detail` = '{$code}' AND orders_detail.id_products = products.id AND orders_detail.code_order_detail = orders.code AND orders_detail.code_order_detail = vnpay.vnp_tmncode ORDER BY numb,id_order_detail DESC");
    $this->data['orders'] = $orders;
    $this->data['module'] = $this->moduleOrder;
    $this->data['action'] = 'show';
    $this->views($this->data, 'admin');
  }

  public function destroy()
  {
    @$code = isset($_GET['code']) ? $_GET['code'] : "";
    @$order_payment = isset($_GET['order_payment']) ? $_GET['order_payment'] : "";
    $orderModel = $this->model->models($this->orderModel);
    switch ($order_payment) {
      case 'tienmat':
        $orderModel->destroy($this->tableOrder, "code = '{$code}'");
        $orderModel->destroy($this->tableOrderDetail, "code_order_detail = '{$code}'");
        break;
      case 'chuyenkhoan':
        $orderModel->destroy($this->tableOrder, "code = '{$code}'");
        $orderModel->destroy($this->tableOrderDetail, "code_order_detail = '{$code}'");
        break;
      case 'ATM':
        $orderModel->destroy($this->tableOrder, "code = '{$code}'");
        $orderModel->destroy($this->tableOrderDetail, "code_order_detail = '{$code}'");
        $orderModel->destroy($this->tableVnpay, "vnp_tmncode = '{$code}'");
        break;

      default:
        break;
    }
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/order/index");
  }

  public function ajaxNumber()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $orderModel = $this->model->models($this->orderModel);
    $orderModel->update($table, array('number' => $num), "`id_order`='$id'");
  }

  public function ajaxNumberDetail()
  {
    @$id = $_POST['id'];
    @$numb = $_POST['value'];
    @$table = $_POST['table'];
    $orderModel = $this->model->models($this->orderModel);
    $orderModel->update($table, array('numb' => $numb), "`id_order_detail`='$id'");
  }

  public function status()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$code = isset($_GET['order_code']) ? $_GET['order_code'] : "";
    $orderModel = $this->model->models($this->orderModel);
    $chartModel = $this->model->models('CharArtAdmin');
    $orders = $orderModel->all('*', 'orders_detail,products,orders', "`code_order_detail` = '{$code}' AND orders_detail.id_products = products.id AND orders_detail.code_order_detail = orders.code ORDER BY numb,id_order_detail DESC");
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $charts = $chartModel->all('*', 'chart', "`order_date` = '{$now}'");
    $totalSubPrice = 0;
    $totalQty = 0;
    foreach ($orders as $row) {
      $totalSubPrice += $row['sale_price'];
      $totalQty += $row['qty'];
    }
    if ($charts) {
      foreach ($charts as $v) {
        $dataUpdate = [
          'order' => $v['order'] + 1,
          'order_sales' => $v['order_sales'] + $totalSubPrice,
          'order_buy_qty' => $v['order_buy_qty'] + $totalQty
        ];
        $chartModel->edit('chart', $dataUpdate, "`order_date` = '$now'");
      }
    } else {

      $dataCreate = [
        'order_date' => $now,
        'order' => 1,
        'order_sales' => $totalSubPrice,
        'order_buy_qty' => $totalQty
      ];
      $chartModel->create('chart', $dataCreate);
    }
    if (isset($_GET['sst']) && $_GET['sst'] == 0) {
      $orderModel->edit($this->tableOrder, ['status' => 1], "`id_order` = '{$id}'");
    }
    Functions::redirect($this->urlBase . "admin/order/index");
  }
}
