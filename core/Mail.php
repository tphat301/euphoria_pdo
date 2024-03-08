<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/src/Exception.php');
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');

final class Mail
{
  public $mail;
  public $configBaseGoogleMail;
  public $db;
  public $setting;
  public $options;
  public function __construct()
  {
    $this->mail =  new PHPMailer(true);
    $this->configBaseGoogleMail = Configurations::configurationsBase()['email']['googleMail'];
    $this->db = new Database();
    $this->setting = Functions::rawOne($this->db->select('*', 'setting', "`type` = 'setting'"));
    $this->options = json_decode($this->setting['options']);
  }

  public function send($sendToMail, $sendToFullname, $subject, $content, $options = array())
  {

    try {
      //Server settings
      $this->mail->SMTPDebug = 0;
      $this->mail->isSMTP(); /* Send using SMTP */
      $this->mail->CharSet = 'UTF-8'; /* Send using Charset */
      $this->mail->Host       = $this->configBaseGoogleMail['hostEmail']; /* Host email */
      $this->mail->SMTPAuth   = true; /* Enable SMTP authentication */
      $this->mail->Username   = $this->configBaseGoogleMail['usernameEmail']; /* SMTP Username Email */
      $this->mail->Password   = $this->configBaseGoogleMail['passwordEmail'];  /* SMTP Password Email */
      $this->mail->SMTPSecure = $this->configBaseGoogleMail['SMTPSecure']; /* TLS encryption */
      $this->mail->Port       = $this->configBaseGoogleMail['portEmail']; /* Port */

      //Recipients
      $this->mail->setFrom($this->configBaseGoogleMail['usernameEmail'], $this->configBaseGoogleMail['fullnameEmail']); /* From email */
      $this->mail->addAddress(!empty($sendToMail) ? $sendToMail : $this->options->email, $sendToFullname);     // Gửi mail khách hàng
      $this->mail->addReplyTo($this->configBaseGoogleMail['usernameEmail'], $this->configBaseGoogleMail['fullnameEmail']);

      //Attachments
      // $this->mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $this->mail->isHTML(true);                                  //Set email format to HTML
      $this->mail->Subject = $subject;
      $this->mail->Body    = $content;
      $this->mail->send();
      return true;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
    }
  }

  public function contentMailActiveRegister($fullname, $linkActiveToken, $nameCompany, $mailCompany, $hotline)
  {
    $str = "";
    $str .= "<h3>Chào bạn <strong>{$fullname}</strong></h3>" .
      "<p>Chúc mừng bạn đã đăng ký thành công tài khoản cá nhận tại <strong>$nameCompany</strong></p>" .
      "<p>Bạn vui lòng nhấn vào đường link <a href='{$linkActiveToken}'>{$linkActiveToken}</a> này để xác thực tài khoản đã đăng ký</p>" .
      "<p>Nếu không phải bạn đăng ký tài khoản thì vui lòng bỏ qua email này!</p>" .
      "<p>Mọi thắc mắc xin vui lòng liên hệ tại: <b>$hotline</b></p>" .
      "<p><strong>Team Support</strong>: $mailCompany</p>";
    return $str;
  }

  public function contentMailOrder($logoMail = "", $subjectMail = 'Mail đơn hàng', $address, $title, $code, $mailCompany, $hotline, $emailCustomer, $fullnameCustomer, $data)
  {
    $str = '';

    $str .= "<table align=\"center\" bgcolor=\"#dcf0f8\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin:0;padding:0;background-color:#f2f2f2;width:100%!important;color:#444;line-height:18px\" width=\"100%\">
    <tbody>";

    $str .= "<tr>
        <td align=\"center\" style=\"color:#444;line-height:18px;font-weight:normal\" valign=\"top\">
          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin-top:15px\" width=\"600\">
            <tbody>
              <td align=\"center\" valign=\"bottom\">
                <table cellpadding=\"0\" cellspacing=\"0\" style=\"border-bottom:3px solid #000;padding:10px 0px;background-color:#fff\" width=\"100%\">
                  <tbody>
                    <tr>
                      <td bgcolor=\"#FFFFFF\" style=\"padding:0\" valign=\"top\" width=\"100%\">
                        <table style=\"width:100%;\">
                          <tbody>
                            <tr>
                              <td>
                                $logoMail
                              </td>
                              <td style=\"text-align:right\">
                                <div style=\"margin-right:20px;\">$subjectMail</div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tbody>
          </table>
        </td>
      </tr>";

    $str .= "<tr>
        <td align=\"center\" style=\"color:#444;line-height:18px;font-weight:normal\" valign=\"top\">
          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
            <tbody>
              <tr style=\"background:#fff\">
                <td align=\"left\" height=\"auto\" style=\"padding:15px\" width=\"600\">
                  <table width=\"100%\">
                    <tbody>
                      <tr>
                        <td>
                          <h1 style=\"font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0\">$title</h1>
                          <p style=\"margin:4px 0;color:#444;line-height:18px;font-weight:normal\">Chúng tôi rất vui thông báo đơn hàng $code của quý khách đã được tiếp nhận và đang trong quá trình xử lý. $mailCompany sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
                          <h3 style=\"font-size:13px;font-weight:bold;color:#000;text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd\">Thông tin đơn hàng $code <span style=\"font-size:12px;color:#777;text-transform:none;font-weight:normal\">$mailCompany.</span></h3>
                        </td>
                      </tr>
                      <tr>
                        <td style=\"color:#444;line-height:18px\">
                          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                            <thead>
                              <tr>
                                <th align=\"left\" style=\"padding:6px 9px 0px 0px;color:#444;font-weight:bold\" width=\"50%\">Thông tin thanh toán</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td valign=\"top\"><span style=\"text-transform:capitalize; display: block; margin-top: 5px;\"><small>Họ tên: $fullnameCustomer</small></span>
                                </td>
                              </tr>
                              <tr>
                                <td valign=\"top\"><a href=\"mailto:{emailOrderInfoEmail}\" target=\"_blank\" style=\"text-decoration: none; margin-top: 5px; display: block;\"><small>Email: $emailCustomer</small></a>
                                </td>
                              </tr>
                              <tr>
                                <td valign=\"top\"><span style=\"text-transform:capitalize; display: block; margin-top: 5px;\"><small>Địa chỉ giao hàng: $address</small></span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h2 style=\"text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#000\">CHI TIẾT ĐƠN HÀNG</h2>
  
                          <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"background:#f5f5f5\" width=\"100%\">
                            <thead>";
    $totalPrice = 0;
    $totalQty = 0;
    foreach ($data as $v) {
      $totalQty += $v['qty'];
      $totalPrice += $v['sub_total'];
      $str .= "<tr>
                                <th align=\"left\" bgcolor=\"#000\" style=\"padding:6px 9px;color:#fff;line-height:14px\">" . $v['title'] . "</th>
                                <th align=\"center\" bgcolor=\"#000\" style=\"padding:6px 9px;color:#fff;line-height:14px;min-width:55px;\">Số lượng: " . $v['qty'] . "</th>
                                <th align=\"right\" bgcolor=\"#000\" style=\"padding:6px 9px;color:#fff;line-height:14px\">Thành tiền: " . number_format($v['sub_total'], 0, ',', '.') . 'đ' . "</th>
                              </tr>";
    }
    $str .= "</thead>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <span style=\"margin-top:20px; display:block;\"><strong>Tổng đơn hàng: " . number_format($totalPrice, 0, ',', '.') . 'đ' . "</strong></span>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>";

    $str .= "<tr>
        <td align=\"center\">
          <table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
            <tbody>
              <tr style=\"background:#fff\">
                <td align=\"left\" height=\"auto\" style=\"padding:15px\" width=\"600\">
                  <table style=\"border-top: 1px solid #cccccc6e;padding-top: 15px;\">
                    <tbody>
                      <tr>
                        <td>
                          <p style=\"color:#444;line-height:18px;font-weight:normal;border:1px #000 dashed;padding:10px;list-style-type:none\">Bạn cần được hỗ trợ ngay? Chỉ cần gửi mail về <a href=\"mailto:$mailCompany\" style=\"color:#000;text-decoration:none\" target=\"_blank\"> <strong>abc.com</strong> </a>, hoặc gọi về
                            hotline <a href=\"tel:$hotline\" style=\"color:#000\">$hotline</a>. Chúng tôi luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          &nbsp;
                          <p style=\"margin:0;padding:0;line-height:18px;color:#444;font-weight:bold\">Một lần nữa chúng tôi $title.</p>
                          <p style=\"color:#444;line-height:18px;font-weight:normal;text-align:right\"><strong><a href=\"\" style=\"color:#000;text-decoration:none;font-size:14px\" target=\"_blank\">Team support: $mailCompany</a> </strong></p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>";

    $str .= "</tbody></table>";

    return $str;
  }
}
