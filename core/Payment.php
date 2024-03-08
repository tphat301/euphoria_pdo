<?php

class Payment
{
  public $vnp_TmnCode;
  public $vnp_HashSecret;
  public $vnp_Url;
  public $vnp_Returnurl;
  public $vnp_apiUrl;
  public $apiUrl;
  public $startTime;
  public $expire;
  public $urlBase;
  public function __construct()
  {
    /* Configure vnpay */
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $this->vnp_TmnCode = "G7PTV3KW"; //Mã định danh merchant kết nối (Terminal Id) khi đăng ký sẽ có trong gmail
    $this->vnp_HashSecret = "GJLRQOFKVPMVSIYDRRWLHKMQLYCGNBND"; //Secret key khi đăng ký sẽ có trong gmail
    $this->vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $this->vnp_Returnurl = $this->urlBase . "cart/vnpay"; //Đường dẫn trả về khi thanh toán
    $this->vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    $this->apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
    $this->startTime = date("YmdHis");
    $this->expire = date('YmdHis', strtotime('+15 minutes', strtotime($this->startTime)));
  }

  public function vnpay($codeOrder, $totalPrice)
  {
    $vnp_Url = $this->vnp_Url;
    $vnp_Returnurl = $this->vnp_Returnurl;
    $vnp_TmnCode = $this->vnp_TmnCode; //Mã website tại VNPAY 
    $vnp_HashSecret = $this->vnp_HashSecret; //Chuỗi bí mật

    $vnp_TxnRef = $codeOrder; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán hóa đơn đặt hàng tại website";
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $totalPrice * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    $vnp_ExpireDate = $this->expire;
    //Billing
    // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
    // $vnp_Bill_Email = $_POST['txt_billing_email'];
    // $fullName = trim($_POST['txt_billing_fullname']);
    // if (isset($fullName) && trim($fullName) != '') {
    //   $name = explode(' ', $fullName);
    //   $vnp_Bill_FirstName = array_shift($name);
    //   $vnp_Bill_LastName = array_pop($name);
    // }
    // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
    // $vnp_Bill_City = $_POST['txt_bill_city'];
    // $vnp_Bill_Country = $_POST['txt_bill_country'];
    // $vnp_Bill_State = $_POST['txt_bill_state'];
    // Invoice
    // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
    // $vnp_Inv_Email = $_POST['txt_inv_email'];
    // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
    // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
    // $vnp_Inv_Company = $_POST['txt_inv_company'];
    // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
    // $vnp_Inv_Type = $_POST['cbo_inv_type'];
    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_Returnurl,
      "vnp_TxnRef" => $vnp_TxnRef,
      "vnp_ExpireDate" => $vnp_ExpireDate,
      // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
      // "vnp_Bill_Email" => $vnp_Bill_Email,
      // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
      // "vnp_Bill_LastName" => $vnp_Bill_LastName,
      // "vnp_Bill_Address" => $vnp_Bill_Address,
      // "vnp_Bill_City" => $vnp_Bill_City,
      // "vnp_Bill_Country" => $vnp_Bill_Country,
      // "vnp_Inv_Phone" => $vnp_Inv_Phone,
      // "vnp_Inv_Email" => $vnp_Inv_Email,
      // "vnp_Inv_Customer" => $vnp_Inv_Customer,
      // "vnp_Inv_Address" => $vnp_Inv_Address,
      // "vnp_Inv_Company" => $vnp_Inv_Company,
      // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
      // "vnp_Inv_Type" => $vnp_Inv_Type
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    //   $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    // }
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
      $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
      $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
      $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
      'code' => '00', 'message' => 'success', 'data' => $vnp_Url
    );
    if (isset($_POST['redirect'])) {
      header('Location: ' . $vnp_Url);
      die();
    } else {
      echo json_encode($returnData);
    }
  }

  public function momo($codeOrder, $totalPrice)
  {
    header('Content-type: text/html; charset=utf-8');
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo";
    $amount = $totalPrice;
    $orderId = $codeOrder; // Mã đơn hàng
    $redirectUrl = $this->urlBase . "cart/momo_stored";
    $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
    $extraData = "";

    $requestId = time() . "";
    $requestType = "payWithATM";
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array(
      'partnerCode' => $partnerCode,
      'partnerName' => "Test",
      "storeId" => "MomoTestStore",
      'requestId' => $requestId,
      'amount' => $amount,
      'orderId' => $orderId,
      'orderInfo' => $orderInfo,
      'redirectUrl' => $redirectUrl,
      'ipnUrl' => $ipnUrl,
      'lang' => 'vi',
      'extraData' => $extraData,
      'requestType' => $requestType,
      'signature' => $signature
    );
    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json
    //Just a example, please check more in there
    header('Location: ' . $jsonResult['payUrl']);
  }

  // Helper momo execPostRequest
  public function execPostRequest($url, $data)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
      $ch,
      CURLOPT_HTTPHEADER,
      array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
      )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
  }
}
