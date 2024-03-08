<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class NewsletterAdminController extends Controllers
{
  public $model;
  public $urlBase;
  public $newsletterType;
  public $numberPage;
  public $data = [];
  public $error = [];
  public $success = [];

  public function __construct()
  {
    $this->model = new Models();
    $this->newsletterType = Configurations::configurationsBackEnd()['newsletter']['type'];
    $this->numberPage = Configurations::configurationsBackEnd()['newsletter']['num_per_page'];

    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
  }

  public function index()
  {
    @$type = $this->newsletterType;
    @$url = $this->urlBase . "admin/newsletter/index";
    @$numberPerPage = $this->numberPage;
    $newsletterModel = $this->model->models('NewsletterAdmin');
    $where = "";

    $where .= "`type` = '{$type}' ORDER BY num,id DESC";
    $newsletter = $newsletterModel->all(
      '*',
      'newsletter',
      $where
    );
    $numberRow = count($newsletter);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";
    $newsletterPaginate = $newsletterModel->all('*', 'newsletter', $where . $limit);
    if ($newsletterPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = "Đăng ký nhận tin";
    $this->data['newsletter'] = $newsletterPaginate;
    $this->data['module'] = 'newsletter';
    $this->data['paginate'] = $paginate;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  public function create()
  {
    $this->data['seoTitle'] = "Thêm đăng ký nhận tin";
    $this->data['module'] = 'newsletter';
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  public function show()
  {
    @$type = $this->newsletterType;
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $newsModel = $this->model->models('NewsletterAdmin');
    $newsletterDetail = Functions::rawOne($newsModel->all('*', 'newsletter', "`id` = $id AND `type` = '{$type}' LIMIT 0,1"));
    $this->data['seoTitle'] = 'Chi tiết đăng ký nhận tin';
    $this->data['schema'] = isset($seo['schema']) ? $seo['schema'] : "";
    $this->data['module'] = 'newsletter';
    $this->data['action'] = 'show';
    $this->data['newsletterDetail'] = $newsletterDetail;
    $this->views($this->data, 'admin');
  }

  public function destroy()
  {
    @$type = $this->newsletterType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    $newsletterModel = $this->model->models('NewsletterAdmin');
    $newsletterModel->destroy('newsletter', "`type` = '{$type}' AND `id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/newsletter/index");
  }

  public function deleteAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->newsletterType;
      $newsletterModel = $this->model->models('NewsletterAdmin');
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $newsletterModel->destroy('newsletter', "`id` IN ($listCheck) AND `type` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/newsletter/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/newsletter/index");
    }
  }

  public function ajaxStatus()
  {
    @$id = $_POST['id'];
    @$status = $_POST['status'];
    @$table = $_POST['table'];
    @$type = $this->newsletterType;
    $newsModel = $this->model->models('NewsletterAdmin');
    $statusNews = Functions::rawOne($newsModel->all('status', $table, "`id` = '{$id}' AND `type` = '{$type}'"))['status'];
    $statusNewsletterArray = !empty($statusNews) ? explode(',', $statusNews) : [];
    if (array_search($status, $statusNewsletterArray) !== false) {
      $key = array_search($status, $statusNewsletterArray);
      unset($statusNewsletterArray[$key]);
    } else {
      array_push($statusNewsletterArray, $status);
    }
    $statusNewsletterStr = implode(',', $statusNewsletterArray);
    $newsModel->update($table, array('status' => $statusNewsletterStr), "`id`='$id' AND `type` = '{$type}'");
  }

  public function ajaxNumber()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $type = $this->newsletterType;
    $newsletterModel = $this->model->models('NewsletterAdmin');
    $newsletterModel->update($table, array('num' => $num), "`id`='$id' AND `type` = '{$type}'");
  }

  public function stored()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsletterType;
    $newsletterModel = $this->model->models('NewsletterAdmin');
    if ($id) {
      /* SAVE HERE */
      if (isset($_POST['save-here'])) {
        if (empty($this->error)) {
          $d = [
            'fullname' => isset($_POST['fullname']) ? $_POST['fullname'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'phone' => isset($_POST['phone']) ? $_POST['phone'] : null,
            'address' => isset($_POST['address']) ? $_POST['address'] : null,
            'note' => isset($_POST['note']) ? $_POST['note'] : null,
            'subject' => isset($_POST['subject']) ? $_POST['subject'] : null,
            'type' => $type,
            'status' => 'hienthi',
            'updated_at' => time()
          ];
          $newsletterModel->edit('newsletter', $d);
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/newsletter/show?id=" . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/newsletter/show?id=" . $id);
        }
      } else {
        if (empty($this->error)) {
          $d = [
            'fullname' => isset($_POST['fullname']) ? $_POST['fullname'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'phone' => isset($_POST['phone']) ? $_POST['phone'] : null,
            'address' => isset($_POST['address']) ? $_POST['address'] : null,
            'note' => isset($_POST['note']) ? $_POST['note'] : null,
            'subject' => isset($_POST['subject']) ? $_POST['subject'] : null,
            'type' => $type,
            'status' => 'hienthi',
            'updated_at' => time()
          ];
          $newsletterModel->edit('newsletter', $d);
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/newsletter/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/newsletter/create");
        }
      }
    } else {
      /* SAVE */
      $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
      if (isset($_POST['save'])) {
        if (empty($this->error)) {
          $d = [
            'fullname' => isset($_POST['fullname']) ? $_POST['fullname'] : null,
            'email' => isset($_POST['email']) ? $_POST['email'] : null,
            'phone' => isset($_POST['phone']) ? $_POST['phone'] : null,
            'address' => isset($_POST['address']) ? $_POST['address'] : null,
            'note' => isset($_POST['note']) ? $_POST['note'] : null,
            'subject' => isset($_POST['subject']) ? $_POST['subject'] : null,
            'type' => $type,
            'num' => 0,
            'hash' => $hashString,
            'status' => 'hienthi',
            'created_at' => time()
          ];
          $newsletterModel->create('newsletter', $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/newsletter/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/newsletter/create");
        }
      }
    }
  }
}
