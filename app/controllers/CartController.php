<?php

namespace App\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Cart;
use Configurations;
use Controllers;
use Functions;
use Models;
use Mail;
use Payment;

class CartController extends Controllers
{
  public $data = [];
  public $model;
  public $tableProduct;
  public $tableOrder;
  public $tableOrderDetail;
  public $productModel;
  public $orderModel;
  public $productType;
  public $urlBase;
  public $titleSeoCart;
  public $moduleCart;
  public $cart;
  public $mailer;
  public $contentMail;
  public $settingModel;
  public $setting;
  public $tableSetting;
  public $options;
  public $paymentClass;

  public function __construct()
  {
    $this->cart = new Cart();
    $this->model = new Models();
    $this->paymentClass = new Payment();
    $this->tableProduct = 'products';
    $this->tableOrder = 'orders';
    $this->tableOrderDetail = 'orders_detail';
    $this->productModel = 'Product';
    $this->orderModel = 'Order';
    $this->productType = 'san-pham';
    $this->titleSeoCart = 'Giỏ hàng';
    $this->moduleCart = 'cart';
    $this->mailer = new Mail();

    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->settingModel = 'Setting';
    $this->tableSetting = 'setting';
    $this->setting = Functions::rawOne($this->model->Models($this->settingModel)->all('*', $this->tableSetting, "`type` = 'setting'"));
    $this->options = json_decode($this->setting['options']);
  }

  public function index()
  {
    $cartInfo = $this->cart->cartInfo();
    $this->data['total'] = isset($cartInfo['total']) ? number_format($cartInfo['total'], 0, ',', '.') . 'đ' : 0;
    $this->data['carts'] = $this->cart->getInfo('cart', 'buy');
    $this->data['titleMain'] = $this->titleSeoCart;
    Functions::set('title', 'Trang giỏ hàng');
    Functions::set('description', '');
    Functions::set('keywords', '');
    $this->data['module'] = $this->moduleCart;
    $this->data['action'] = 'index';
    $this->views($this->data, 'index');
  }

  public function update()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$qty = isset($_GET['qty']) ? $_GET['qty'] : "";
    @$price = isset($_GET['price']) ? $_GET['price'] : "";
    if (isset($_SESSION['cart']['buy']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
      $_SESSION['cart']['buy'][$id]['qty'] = $qty;
      $sub_total = $qty * $price;
      $_SESSION['cart']['buy'][$id]['sub_total'] =  $sub_total;
      $_SESSION['cart']['buy'][$id]['info']['total'] = $qty * $price;
      $this->cart->updateCart();
      $total = $this->cart->cartInfo();
    }
    $data = array(
      "sub_total" => number_format($sub_total, 0, ',', '.') . 'đ',
      "total" => number_format($total['total'], 0, ',', '.') . 'đ'
    );
    echo json_encode($data);
  }

  public function delete()
  {
    if (isset($_GET['id'])) {
      @$id = $_GET['id'];
      $this->cart->delete($id, 'cart', 'buy');
      $this->cart->updateCart();
      Functions::redirect($this->urlBase . 'cart');
    }
  }

  public function destroy()
  {
    $this->cart->delete('');
    Functions::redirect($this->urlBase . 'cart');
  }

  public function add()
  {
    @$nameSize = isset($_GET['name_size']) ? $_GET['name_size'] : "";
    @$nameColor = isset($_GET['name_color']) ? $_GET['name_color'] : "";
    @$id = isset($_GET['id']) ? $_GET['id'] : '';
    @$idColor = isset($_GET['id_color']) ? $_GET['id_color'] : '';
    @$idSize = isset($_GET['id_size']) ? $_GET['id_size'] : '';
    @$hashKeyCart = md5($id . $idColor . $idSize);
    @$salePrice = isset($_GET['sale_price']) ? $_GET['sale_price'] : '';
    @$regularPrice = isset($_GET['regular_price']) ? $_GET['regular_price'] : '';
    @$productModel = $this->model->models($this->productModel);
    @$qty = 1;
    $options = [
      'sale_price' => $salePrice,
      'regular_price' => $regularPrice,
      'name_size' => $nameSize,
      'name_color' => $nameColor,
    ];
    $product = Functions::rawOne($productModel->all('id,slug,photo1,code,title,description,content,quantity,regular_price,sale_price,discount', 'products', "`type` = '{$this->productType}' AND `id` = '{$id}' AND `deleted_at` IS NULL ORDER BY num,id DESC"));
    $this->cart->add($product, 'cart', 'buy', $hashKeyCart, $qty, $options);
    $this->cart->updateCart();
  }

  public function thank()
  {
    include("app/views/cart/thank_tpl.php");
  }

  public function checkout()
  {
    $cartInfo = $this->cart->cartInfo();
    $totalPrice = isset($cartInfo['total']) ? $cartInfo['total'] : 0; /* Tổng đơn hàng */
    $id_users = isset($_SESSION['login']['id']) ? $_SESSION['login']['id'] : 0; /* id user đăng ký */
    $adress = isset($_SESSION['login']['address']) ? $_SESSION['login']['address'] : 0; /* Adress user đăng ký */
    $codeOrder = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null; /* mã đơn hàng */
    $orderModel = $this->model->models($this->orderModel); /* Model của đơn hàng */
    $carts = $this->cart->getInfo('cart', 'buy'); /* Lấy thông tin giỏ hàng từ SESSION */

    @$payment = $_POST['payment']; /* Kiểm tra hình thức thanh toán */
    if (isset($payment)) {
      switch ($payment) {
          /* Phương thức thanh toán bằng tiền mặt */
        case 'tienmat':
          $dataOrder = [
            'id_users' => $id_users,
            'code' => $codeOrder,
            'status' => 0,
            'number' => 0,
            'order_payment' => 'tienmat',
            'time_buy' => Carbon::now('Asia/Ho_Chi_Minh')
          ];
          $orderModel->create($this->tableOrder, $dataOrder);

          foreach ($carts as $v) {
            $dataOrderDetail = [
              'id_products' => $v['id'],
              'code_order_detail' => $codeOrder,
              'qty' => $v['qty'],
              'numb' => 0,
            ];
            $orderModel->create($this->tableOrderDetail, $dataOrderDetail);
          }
          $titleSendMail = "Cảm ơn quý khách đã đặt hàng tại CMSP";
          $subjectMail = 'Mail đơn hàng';
          $subject = 'Mail phản hồi đơn hàng';
          $carts = $this->cart->getInfo('cart', 'buy');
          $this->contentMail = $this->mailer->contentMailOrder('Logo', $subjectMail, $adress, $titleSendMail, $codeOrder, $this->options->email, $this->options->hotline, $_SESSION['login']['email'], $_SESSION['login']['fullname'], $carts);
          $this->mailer->send($_SESSION['login']['email'], $_SESSION['login']['fullname'], $subject, $this->contentMail);
          $this->cart->delete('');
          Functions::redirect($this->urlBase . 'cart/thank');
          break;

          /* Phương thức thanh toán bằng ATM */
        case 'chuyenkhoan':
          $dataOrder = [
            'id_users' => $id_users,
            'code' => $codeOrder,
            'status' => 0,
            'number' => 0,
            'order_payment' => 'atm',
            'time_buy' => Carbon::now('Asia/Ho_Chi_Minh')
          ];
          $orderModel->create($this->tableOrder, $dataOrder);

          foreach ($carts as $v) {
            $dataOrderDetail = [
              'id_products' => $v['id'],
              'code_order_detail' => $codeOrder,
              'qty' => $v['qty'],
              'numb' => 0,
            ];
            $orderModel->create($this->tableOrderDetail, $dataOrderDetail);
          }
          $titleSendMail = "Cảm ơn quý khách đã đặt hàng tại CMSP";
          $subjectMail = 'Mail đơn hàng';
          $subject = 'Mail phản hồi đơn hàng';
          $carts = $this->cart->getInfo('cart', 'buy');
          $this->contentMail = $this->mailer->contentMailOrder('Logo', $subjectMail, $adress, $titleSendMail, $codeOrder, $this->options->email, $this->options->hotline, $_SESSION['login']['email'], $_SESSION['login']['fullname'], $carts);
          $this->mailer->send($_SESSION['login']['email'], $_SESSION['login']['fullname'], $subject, $this->contentMail);
          $this->cart->delete('');
          Functions::redirect($this->urlBase . 'cart/thank');
          break;

          /* Phương thức thanh toán bằng VnPay */
        case 'vnpay':
          $this->paymentClass->vnpay($codeOrder, $totalPrice);
          break;

        default:
          break;
      }
    } else {
      // code
    }
  }

  public function vnpayStored()
  {
    $vnpayModel = $this->model->models('Vnpay');
    $orderModel = $this->model->models($this->orderModel); /* Model của đơn hàng */
    $carts = $this->cart->getInfo('cart', 'buy'); /* Lấy thông tin giỏ hàng từ SESSION */
    $id_users = isset($_SESSION['login']['id']) ? $_SESSION['login']['id'] : 0; /* id user đăng ký */
    $adress = isset($_SESSION['login']['address']) ? $_SESSION['login']['address'] : 0; /* Adress user đăng ký */
    if (isset($_GET['vnp_Amount'])) {
      $vnp_Amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : "";
      $vnp_BankCode = isset($_GET['vnp_BankCode']) ? $_GET['vnp_BankCode'] : "";
      $vnp_BankTranNo = isset($_GET['vnp_BankTranNo']) ? $_GET['vnp_BankTranNo'] : "";
      $vnp_CardType = isset($_GET['vnp_CardType']) ? $_GET['vnp_CardType'] : "";
      $vnp_OrderInfo = isset($_GET['vnp_OrderInfo']) ? $_GET['vnp_OrderInfo'] : "";
      $vnp_TmnCode = isset($_GET['vnp_TmnCode']) ? $_GET['vnp_TmnCode'] : "";
      $vnp_TransactionNo = isset($_GET['vnp_TransactionNo']) ? $_GET['vnp_TransactionNo'] : "";
      $dataVnpay = [
        'vnp_amount' => $vnp_Amount,
        'vnp_bankcode' => $vnp_BankCode,
        'vnp_banktranno' => $vnp_BankTranNo,
        'vnp_cardtype' => $vnp_CardType,
        'vnp_orderinfo' => $vnp_OrderInfo,
        'vnp_tmncode' => $vnp_TmnCode,
        'vnp_transactionno' => $vnp_TransactionNo
      ];
      $dataOrder = [
        'id_users' => $id_users,
        'code' => $vnp_TmnCode,
        'status' => 0,
        'number' => 0,
        'order_payment' => $vnp_CardType,
        'time_buy' => Carbon::now('Asia/Ho_Chi_Minh')
      ];
      $vnpayModel->create('vnpay', $dataVnpay);
      $orderModel->create($this->tableOrder, $dataOrder);

      foreach ($carts as $v) {
        $dataOrderDetail = [
          'id_products' => $v['id'],
          'code_order_detail' => $vnp_TmnCode,
          'qty' => $v['qty'],
          'numb' => 0,
        ];
        $orderModel->create($this->tableOrderDetail, $dataOrderDetail);
      }
      $titleSendMail = "Cảm ơn quý khách đã đặt hàng tại CMSP";
      $subjectMail = 'Mail đơn hàng';
      $subject = 'Mail phản hồi đơn hàng';
      $carts = $this->cart->getInfo('cart', 'buy');
      $this->contentMail = $this->mailer->contentMailOrder('Logo', $subjectMail, $adress, $titleSendMail, $vnp_TmnCode, $this->options->email, $this->options->hotline, $_SESSION['login']['email'], $_SESSION['login']['fullname'], $carts);
      $this->mailer->send($_SESSION['login']['email'], $_SESSION['login']['fullname'], $subject, $this->contentMail);
      $this->cart->delete('');
      Functions::redirect($this->urlBase . 'cart/thank');
    }
  }

  /* Thanh toán momo atm */
  public function momoAtm()
  {
    $cartInfo = $this->cart->cartInfo();
    $totalPrice = isset($cartInfo['total']) ? $cartInfo['total'] : 0; /* Tổng đơn hàng */
    $codeOrder = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null; /* mã đơn hàng */
    $this->paymentClass->momo($codeOrder, $totalPrice);
  }

  /* Momo stored */
  public function momoStored()
  {
    $momoModel = $this->model->models('Momo');
    $orderModel = $this->model->models($this->orderModel); /* Model của đơn hàng */
    $carts = $this->cart->getInfo('cart', 'buy'); /* Lấy thông tin giỏ hàng từ SESSION */
    $id_users = isset($_SESSION['login']['id']) ? $_SESSION['login']['id'] : 0; /* id user đăng ký */
    $adress = isset($_SESSION['login']['address']) ? $_SESSION['login']['address'] : 0; /* Adress user đăng ký */
    if (isset($_GET['partnerCode'])) {
      $dataMomo = [
        'partnercode' => isset($_GET['partnerCode']) ? $_GET['partnerCode'] : '',
        'amount' => isset($_GET['amount']) ? $_GET['amount'] : '',
        'momo_order_id' => isset($_GET['orderId']) ? $_GET['orderId'] : '',
        'momo_order_info' => isset($_GET['orderInfo']) ? $_GET['orderInfo'] : '',
        'momo_order_type' => isset($_GET['requestType']) ? $_GET['requestType'] : '',
        'momo_trans_id' => isset($_GET['requestId']) ? $_GET['requestId'] : '',
      ];
      $dataOrder = [
        'id_users' => $id_users,
        'code' => isset($_GET['orderId']) ? $_GET['orderId'] : '',
        'status' => 0,
        'number' => 0,
        'order_payment' => isset($_GET['requestType']) ? $_GET['requestType'] : '',
        'time_buy' => Carbon::now('Asia/Ho_Chi_Minh')
      ];
      $momoModel->create('momo', $dataMomo);
      $orderModel->create($this->tableOrder, $dataOrder);

      foreach ($carts as $v) {
        $dataOrderDetail = [
          'id_products' => $v['id'],
          'code_order_detail' => isset($_GET['orderId']) ? $_GET['orderId'] : '',
          'qty' => $v['qty'],
          'numb' => 0,
        ];
        $orderModel->create($this->tableOrderDetail, $dataOrderDetail);
      }
    }
    $titleSendMail = "Cảm ơn quý khách đã đặt hàng tại CMSP";
    $subjectMail = 'Mail đơn hàng';
    $subject = 'Mail phản hồi đơn hàng';
    $carts = $this->cart->getInfo('cart', 'buy');
    $this->contentMail = $this->mailer->contentMailOrder('Logo', $subjectMail, $adress, $titleSendMail, isset($_GET['orderId']) ? $_GET['orderId'] : '', $this->options->email, $this->options->hotline, $_SESSION['login']['email'], $_SESSION['login']['fullname'], $carts);
    $this->mailer->send($_SESSION['login']['email'], $_SESSION['login']['fullname'], $subject, $this->contentMail);
    $this->cart->delete('');
    Functions::redirect($this->urlBase . 'cart/thank');
  }
}
