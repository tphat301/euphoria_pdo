<?php

namespace App\Controllers;

use Configurations;
use Controllers;
use Flash;
use Functions;
use Models;

class PolicyAdminController extends Controllers
{
  public $model;
  public $urlBase;
  public $newsType;
  public $table;
  public $seoTitleIndex;
  public $seoTitleCreate;
  public $tableGallery;
  public $numberPage;
  public $tableSeo;
  public $nameModule;
  public $newsModel;
  public $seoModel;
  public $data = [];
  public $error = [];
  public $success = [];

  /* The first __construct function */
  public function __construct()
  {
    $this->model = new Models();
    $this->urlBase = Configurations::configurationsBase()['baseUrl'];
    $this->newsType = Configurations::configurationsBackEnd()['policy']['type'];
    $this->numberPage = Configurations::configurationsBackEnd()['policy']['num_per_page'];
    $this->table = Configurations::configurationsBackEnd()['policy']['table'];
    $this->newsModel = "NewsAdmin";
    $this->tableSeo = 'seo';
    $this->nameModule = "policy";
    $this->seoTitleIndex = "Danh sách chính sách";
    $this->seoTitleCreate = "Thêm chính sách";
    $this->seoModel = "SeoAdmin";
  }

  /* UI News List */
  public function index()
  {
    @$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
    @$type = $this->newsType;
    @$url = $this->urlBase . "admin/policy/index";
    @$numberPerPage = $this->numberPage;
    $newsModel = $this->model->models($this->newsModel);
    $where = "";

    if ($keyword) {
      $where .= "`title` LIKE '%{$keyword}%' AND ";
    }

    $where .= "`type` = '{$type}' AND `deleted_at` IS NULL ORDER BY num,id DESC";
    $news = $newsModel->all('*', $this->table, $where);
    $numberRow = count($news);
    $totalPage = ceil($numberRow / $numberPerPage);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $numberStart = ($page - 1) * $numberPerPage;
    $limit = " LIMIT $numberStart,$numberPerPage";
    $newsPaginate = $newsModel->all('*', $this->table, $where . $limit);
    if ($newsPaginate) {
      $paginate = Functions::Paginate($page, $totalPage, $url);
    } else {
      $paginate = "";
    }
    $this->data['seoTitle'] = $this->seoTitleIndex;
    $this->data['news'] = $newsPaginate;
    $this->data['module'] = $this->nameModule;
    $this->data['paginate'] = $paginate;
    $this->data['action'] = 'index';
    $this->views($this->data, 'admin');
  }

  /* UI News Create */
  public function create()
  {
    @$type = $this->newsType;
    $this->data['seoTitle'] = $this->seoTitleCreate;
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'create';
    $this->views($this->data, 'admin');
  }

  /* UI News Show */
  public function show()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : null;
    $newsModel = $this->model->models($this->newsModel);
    $seoModel = $this->model->models($this->seoModel);
    $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`id` = $id AND `type` = '{$type}' LIMIT 0,1"));
    $hash = $newsDetail['hash'];
    $seo = Functions::rawOne($seoModel->all('*', 'seo', "`hash_seo` = '{$hash}' AND `type` = '{$type}' ORDER BY ID ASC LIMIT 0,1"));
    $this->data['seo'] = $seo;
    $this->data['seoTitle'] = $newsDetail['title'];
    $this->data['schema'] = isset($seo['schema']) ? $seo['schema'] : "";
    $this->data['module'] = $this->nameModule;
    $this->data['action'] = 'show';
    $this->data['newsDetail'] = $newsDetail;
    $this->views($this->data, 'admin');
  }

  /* Admin News AjaxStatus */
  public function ajaxStatus()
  {
    @$id = $_POST['id'];
    @$status = $_POST['status'];
    @$table = $_POST['table'];
    @$type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    $statusNews = Functions::rawOne($newsModel->all('status', $table, "`id` = '{$id}' AND `type` = '{$type}'"))['status'];
    $statusNewsArray = !empty($statusNews) ? explode(',', $statusNews) : [];
    if (array_search($status, $statusNewsArray) !== false) {
      $key = array_search($status, $statusNewsArray);
      unset($statusNewsArray[$key]);
    } else {
      array_push($statusNewsArray, $status);
    }
    $statusNewStr = implode(',', $statusNewsArray);
    $newsModel->update($table, array('status' => $statusNewStr), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Admin News Ajax number */
  public function ajaxNumber()
  {
    @$id = $_POST['id'];
    @$num = $_POST['value'];
    @$table = $_POST['table'];
    $type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    $newsModel->update($table, array('num' => $num), "`id`='$id' AND `type` = '{$type}'");
  }

  /* Delete all */
  public function deleteAll()
  {
    if ($_POST['checkitem']) {
      @$type = $this->newsType;
      $uploadNews = "upload/news/";
      $newsModel = $this->model->models($this->newsModel);
      $seoModel = $this->model->models($this->seoModel);
      $listCheck = implode(',', array_values($_POST['checkitem']));
      $listHash = "'" . implode("','", array_values($_POST['hashes'])) . "'";
      $seo = $seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      $newsByListId = $newsModel->all("*", $this->table, "`id` IN ($listCheck) AND `type` = '{$type}'");
      if (Functions::checkData($seo)) {
        $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` IN ($listHash)");
      }
      foreach ($newsByListId as $v) {
        $photo1 = isset($v['photo1']) && !empty($v['photo1']) ? $v['photo1'] : "";
        $photo2 = isset($v['photo2']) && !empty($v['photo2']) ? $v['photo2'] : "";
        $photo3 = isset($v['photo3']) && !empty($v['photo3']) ? $v['photo3'] : "";
        $photo4 = isset($v['photo4']) && !empty($v['photo4']) ? $v['photo4'] : "";
        $filenameNews1 = $uploadNews . $photo1;
        $filenameNews2 = $uploadNews . $photo2;
        $filenameNews3 = $uploadNews . $photo3;
        $filenameNews4 = $uploadNews . $photo4;
        if (file_exists($filenameNews1) && !empty($photo1)) unlink($filenameNews1);
        if (file_exists($filenameNews2) && !empty($photo2)) unlink($filenameNews2);
        if (file_exists($filenameNews3) && !empty($photo3)) unlink($filenameNews3);
        if (file_exists($filenameNews4) && !empty($photo4)) unlink($filenameNews4);
      }
      $newsModel->destroy($this->table, "`id` IN ($listCheck) AND `type` = '{$type}'");
      Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/policy/index");
    } else {
      Functions::transfer("Xóa dữ liệu", "danger", $this->urlBase . "admin/policy/index");
    }
  }

  /* Delete by id */
  public function destroy()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$hash = isset($_GET['hash']) ? $_GET['hash'] : "";
    $newsModel = $this->model->models($this->newsModel);
    $seoModel = $this->model->models($this->seoModel);
    $uploadNews = "upload/news/";
    $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`type` = '{$type}' AND `hash` = '{$hash}' AND `id` = '{$id}' LIMIT 0,1"));
    $seo = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}' LIMIT 0,1"));
    if (Functions::checkData($seo)) $seoModel->destroy($this->tableSeo, "`type` = '{$type}' AND `hash_seo` = '{$hash}'");
    $photo1 = isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $newsDetail['photo1'] : "";
    $photo2 = isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $newsDetail['photo2'] : "";
    $photo3 = isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $newsDetail['photo3'] : "";
    $photo4 = isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $newsDetail['photo4'] : "";
    $filenameNews1 = $uploadNews . $photo1;
    $filenameNews2 = $uploadNews . $photo2;
    $filenameNews3 = $uploadNews . $photo3;
    $filenameNews4 = $uploadNews . $photo4;
    if (file_exists($filenameNews1) && !empty($photo1)) unlink($filenameNews1);
    if (file_exists($filenameNews2) && !empty($photo2)) unlink($filenameNews2);
    if (file_exists($filenameNews3) && !empty($photo3)) unlink($filenameNews3);
    if (file_exists($filenameNews4) && !empty($photo4)) unlink($filenameNews4);
    $newsModel->destroy($this->table, "`type` = '{$type}' AND `id`='{$id}'");
    Functions::transfer("Xóa dữ liệu", "success", $this->urlBase . "admin/policy/index");
  }

  /* Delete photo */
  public function deletePhoto()
  {
    @$type = $this->newsType;
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$photo1 = isset($_GET['photo1']) ? $_GET['photo1'] : "";
    @$photo2 = isset($_GET['photo2']) ? $_GET['photo2'] : "";
    @$photo3 = isset($_GET['photo3']) ? $_GET['photo3'] : "";
    @$photo4 = isset($_GET['photo4']) ? $_GET['photo4'] : "";
    $newsModel = $this->model->models($this->newsModel);
    $uploadNews = "upload/news/";
    if ($photo1 && !empty($id)) {
      $filename = $uploadNews . $photo1;
      if (file_exists($filename) && !empty($photo1)) unlink($filename);
      $newsModel->edit($this->table, ["photo1" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/policy/show?id=" . $id);
    } elseif ($photo2 && !empty($id)) {
      $filename = $uploadNews . $photo2;
      if (file_exists($filename) && !empty($photo2)) unlink($filename);
      $newsModel->edit($this->table, ["photo2" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/policy/show?id=" . $id);
    } elseif ($photo3 && !empty($id)) {
      $filename = $uploadNews . $photo3;
      if (file_exists($filename) && !empty($photo3)) unlink($filename);
      $newsModel->edit($this->table, ["photo3" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/policy/show?id=" . $id);
    } elseif ($photo4 && !empty($id)) {
      $filename = $uploadNews . $photo4;
      if (file_exists($filename) && !empty($photo4)) unlink($filename);
      $newsModel->edit($this->table, ["photo4" => null], "`type` = '{$type}' AND `id` = '{$id}'");
      Functions::transfer("Xóa ảnh", "success", $this->urlBase . "admin/policy/show?id=" . $id);
    } else {
      Functions::redirect($this->urlBase . "admin/policy/show?id=" . $id);
    }
  }

  /* Hanlde save && save here && update product */
  public function stored()
  {
    @$id = isset($_GET['id']) ? $_GET['id'] : "";
    @$type = $this->newsType;
    $newsModel = $this->model->models($this->newsModel);
    $seoModel = $this->model->models($this->seoModel);
    $hashString = Functions::rawOne($newsModel->all('`hash`', $this->table, "`type` = '{$type}' AND `id` = '{$id}' LIMIT 0,1"));

    if ($id) {
      $newsDetail = Functions::rawOne($newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` = $id limit 0,1"));
      /** SAVE HERE **/
      if (isset($_POST['save-here'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
          if (Functions::checkData($slugs)) {
            $this->success['slug'] = htmlspecialchars($_POST['slug']);
            foreach ($this->success as $k => $v) {
              Flash::set($k, $v, 'success');
            }
            Flash::set('slug', 'Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!', 'danger');
            $this->error['slug'] = "Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!";
          } else {
            $slug = htmlspecialchars($_POST['slug']);
          }
        } else {
          $this->error['slug'] = "Đường dẫn không được bỏ trống";
        }

        if (empty($this->error)) {
          /* Photo 1 */
          if (Functions::hasFile("photo1")) {
            $photo1 = Functions::uploadFile(
              "photo1",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo1 = isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $newsDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile(
              "photo2",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo2 = isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $newsDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile(
              "photo3",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo3 = isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $newsDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile(
              "photo4",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo4 = isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $newsDetail['photo4'] : null;
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $file_mp4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          } else {
            $file_mp4 = isset($newsDetail['file_mp4']) && !empty($newsDetail['file_mp4']) ? $newsDetail['file_mp4'] : null;
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $file_attach = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          } else {
            $file_attach = isset($newsDetail['file_attach']) && !empty($newsDetail['file_attach']) ? $newsDetail['file_attach'] : null;
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
            'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'photo4' => $photo4,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : "",
            'file_mp4' => isset($file_mp4) ? $file_mp4 : "",
            'hash' => $hashString['hash'],
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'id_parent3' => isset($_POST['id_parent3']) ? $_POST['id_parent3'] : null,
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $newsModel->edit($this->table, $d, "`id`='{$id}'");
          $seos = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`hash_seo` = '{$haskValue}'"));
          if (Functions::checkData($seos)) {
            $d_seo = [
              'id_parent' => $id,
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
              'schema' => !empty($_POST['schema']) ? htmlspecialchars($_POST['schema']) : null,
            ];
            $seoModel->edit($this->tableSeo, $d_seo, "`type` = '{$type}' AND `hash_seo` = '{$haskValue}'");
          } else {
            $d_seo = [
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'id_parent' => isset($_POST['title_seo']) && !empty($_POST['title_seo']) ? $id : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
            ];
            $seoModel->create(
              $this->tableSeo,
              $d_seo
            );
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/policy/show?id=" . $id);
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/policy/show?id=" . $id);
        }
      }

      /** UPDATE **/
      if (isset($_POST['update'])) {
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `id` <> $id AND `slug` = '{$slugCondition}'");
          if (Functions::checkData($slugs)) {
            $this->success['slug'] = htmlspecialchars($_POST['slug']);
            foreach ($this->success as $k => $v) {
              Flash::set($k, $v, 'success');
            }
            Flash::set('slug', 'Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!', 'danger');
            $this->error['slug'] = "Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!";
          } else {
            $slug = htmlspecialchars($_POST['slug']);
          }
        } else {
          $this->error['slug'] = "Đường dẫn không được bỏ trống";
        }

        if (empty($this->error)) {
          /* Photo 1 */
          if (Functions::hasFile("photo1")) {
            $photo1 = Functions::uploadFile(
              "photo1",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo1 = isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $newsDetail['photo1'] : null;
          }

          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile(
              "photo2",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo2 = isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $newsDetail['photo2'] : null;
          }

          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile(
              "photo3",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo3 = isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $newsDetail['photo3'] : null;
          }

          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile(
              "photo4",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          } else {
            $photo4 = isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $newsDetail['photo4'] : null;
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $file_mp4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          } else {
            $file_mp4 = isset($newsDetail['file_mp4']) && !empty($newsDetail['file_mp4']) ? $newsDetail['file_mp4'] : null;
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $file_attach = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          } else {
            $file_attach = isset($newsDetail['file_attach']) && !empty($newsDetail['file_attach']) ? $newsDetail['file_attach'] : null;
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null,
            'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'photo3' => $photo3,
            'photo4' => $photo4,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : "",
            'file_mp4' => isset($file_mp4) ? $file_mp4 : "",
            'hash' => $hashString['hash'],
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'id_parent3' => isset($_POST['id_parent3']) ? $_POST['id_parent3'] : null,
            'id_parent4' => isset($_POST['id_parent4']) ? $_POST['id_parent4'] : null,
            'updated_at' => time(),
          );
          $haskValue = $hashString['hash'];
          $newsModel->edit($this->table, $d, "`id`='{$id}'");
          $seos = Functions::rawOne($seoModel->all("*", $this->tableSeo, "`hash_seo` = '{$haskValue}' LIMIT 0,1"));
          if (Functions::checkData($seos)) {
            $d_seo = [
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'id_parent' => isset($_POST['title_seo']) && !empty($_POST['title_seo']) ? $id : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
              'schema' => !empty($_POST['schema']) ? htmlspecialchars($_POST['schema']) : null,
            ];
            $seoModel->edit($this->tableSeo, $d_seo, "`type` = '{$type}' AND `hash_seo` = '{$haskValue}'");
          } else {
            $d_seo = [
              'id_parent' => $id,
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => isset($hashString['hash']) ? $hashString['hash'] : null,
            ];
            $seoModel->create(
              $this->tableSeo,
              $d_seo
            );
          }
          Functions::transfer("Cập nhật dữ liệu", "success", $this->urlBase . "admin/policy/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Cập nhật dữ liệu", "danger", $this->urlBase . "admin/policy/index");
        }
      }
    } else {
      /* SAVE DATA */
      if (isset($_POST['save'])) {
        $hashString = !empty(Functions::stringRandom(4)) ? strtolower(Functions::stringRandom(4)) : null;
        /* Slug validation */
        if (!empty($_POST['slug'])) {
          $slugCondition = htmlspecialchars($_POST['slug']);
          $slugs = $newsModel->all('*', $this->table, "`type` = '{$type}' AND `slug` = '{$slugCondition}'");
          if (Functions::checkData($slugs)) {
            $this->success['slug'] = htmlspecialchars($_POST['slug']);
            foreach ($this->success as $k => $v) {
              Flash::set($k, $v, 'success');
            }
            Flash::set('slug', 'Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!', 'danger');
            $this->error['slug'] = "Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!";
          } else {
            $slug = htmlspecialchars($_POST['slug']);
          }
        } else {
          $this->error['slug'] = "Đường dẫn không được bỏ trống";
        }

        if (empty($this->error)) {
          /* Photo 1 */
          if (Functions::hasFile("photo1")) {
            $photo1 = Functions::uploadFile(
              "photo1",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }
          /* Photo 2 */
          if (Functions::hasFile("photo2")) {
            $photo2 = Functions::uploadFile(
              "photo2",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }
          /* Photo 3 */
          if (Functions::hasFile("photo3")) {
            $photo3 = Functions::uploadFile(
              "photo3",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }
          /* Photo 4 */
          if (Functions::hasFile("photo4")) {
            $photo4 = Functions::uploadFile(
              "photo4",
              array('png', 'jpg', 'jpeg', 'gif', '.webp'),
              "upload/news/"
            );
          }

          /* Video mp4 */
          if (Functions::hasFile("file_mp4")) {
            $photo4 = Functions::uploadFile("file_mp4", array('.mp4'), "upload/file/");
          }

          /* File attach */
          if (Functions::hasFile("file_attach")) {
            $photo4 = Functions::uploadFile("file_attach", array('.pdf'), "upload/file_attach/");
          }

          $d = array(
            'slug' => htmlspecialchars($slug),
            'title' => htmlspecialchars($_POST['title']),
            'file_youtube' => isset($_POST['file_youtube']) ? htmlspecialchars($_POST['file_youtube']) : null,
            'description' => isset($_POST['description']) ? htmlspecialchars($_POST['description']) : null,
            'content' => isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null,
            'photo1' => isset($photo1) ? $photo1 : null,
            'photo2' => isset($photo2) ? $photo2 : null,
            'photo3' => isset($photo3) ? $photo3 : null,
            'photo4' => isset($photo4) ? $photo4 : null,
            'status' => isset($_POST['status']) ? implode(',', $_POST['status']) : null,
            'num' => isset($_POST['num']) ? htmlspecialchars($_POST['num']) : 0,
            'type' => $type,
            'file_attach' => isset($file_attach) ? $file_attach : null,
            'file_mp4' => isset($file_mp4) ? $file_mp4 : null,
            'hash' => $hashString,
            'id_parent1' => isset($_POST['id_parent1']) ? $_POST['id_parent1'] : null,
            'id_parent2' => isset($_POST['id_parent2']) ? $_POST['id_parent2'] : null,
            'id_parent3' => isset($_POST['id_parent3']) ? $_POST['id_parent3'] : null,
            'id_parent4' => isset($_POST['id_parent4']) ? $_POST['id_parent4'] : null,
            'created_at' => time(),
          );

          if (isset($_POST['title_seo']) && !empty($_POST['title_seo'])) {
            $d_seo = [
              'title_seo' => isset($_POST['title_seo']) ? htmlspecialchars($_POST['title_seo']) : null,
              'description_seo' => isset($_POST['description_seo']) ? htmlspecialchars($_POST['description_seo']) : null,
              'keywords' => isset($_POST['keywords']) ? htmlspecialchars($_POST['keywords']) : null,
              'type' => $type,
              'hash_seo' => $hashString,
            ];
          }

          if (isset($d_seo) && !empty($d_seo)) $seoModel->create($this->tableSeo, $d_seo);
          $newsModel->create($this->table, $d);
          Functions::transfer("Thêm dữ liệu", "success", $this->urlBase . "admin/policy/index");
        } else {
          foreach ($this->error as $k => $v) {
            Flash::set($k, $v, 'danger');
          }
          Functions::transfer("Thêm dữ liệu", "danger", $this->urlBase . "admin/policy/create");
        }
      }
    }
  }
}
