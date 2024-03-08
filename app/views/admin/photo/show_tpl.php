<?php
require(dirname(dirname(__FILE__)) . "/partials/header.php");
require(dirname(dirname(__FILE__)) . "/partials/sidebar.php");
?>

<div class="content-wrapper" style="min-height: 378px;">
  <!-- Content tab -->
  <section class="content-header text-sm">
    <div class="container-fluid">
      <div class="row">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
          <li class="breadcrumb-item active">Thêm <?= $configAdmin['photo'][$type]['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . 'admin/photo/stored?id=' . $item['id'] . '&req=' . $type ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="update" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
        <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/photo/' . $type . '_index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
      </div>

      <!-- Start item -->
      <div class="card card-primary card-outline text-sm">
        <div class="card-header">
          <h3 class="card-title">Chi tiết <?= $configAdmin['photo'][$type]['name'] ?> </h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="upload-file">
              <p>Upload hình ảnh <?= $configAdmin['photo'][$type]['name'] ?>:</p>
              <label class="upload-file-label mb-2" for="file">
                <div class="upload-file-image rounded mb-3 position-relative">
                  <img class="rounded img-upload upload_photo_detail_preview" src="<?= isset($item['photo']) && !empty($item['photo']) ? $configBase['baseUrl'] . "upload/photo/" .  $item['photo'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="Ảnh" style="object-fit: cover;" />
                  <?php if (isset($item['photo'])) { ?>
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/photo/delete_photo?id=" . $item['id'] . "&photo=" . $item['photo'] . "&req=" . $type ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                  <?php } ?>
                </div>
                <div class="custom-file my-custom-file">
                  <input type="file" class="custom-file-input upload_photo" name="photo" id="upload_photo_detail" value="" />
                  <label class="custom-file-label mb-0" data-browse="Chọn" for="upload_photo">Chọn file</label>
                </div>
              </label>
              <strong class="d-block text-sm"><?= $configAdmin['photo'][$type]['upload_rules'] ?></strong>
            </div>
          </div>
          <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" class="form-control text-sm" name="link" id="link" placeholder="Link" value="<?= isset($item['link']) ? $item['link'] : '' ?>" />
          </div>

          <?php if (isset($configAdmin['photo'][$type]['status'])) { ?>
            <div class="form-group">
              <?php
              $statusConfig = $configAdmin['photo'][$type]['status'];
              if (!empty($item['status'])) {
                $status = explode(",", $item['status']);
              } else {
                $status = [];
              }
              $statusTitleConfig = $configAdmin['photo'][$type]['status_title'];
              foreach ($statusConfig as $kStatus => $vStatus) {
              ?>
                <div class="form-group d-inline-block mb-2 mr-2">
                  <label for="<?= $kStatus ?>-checkbox" class="d-inline-block align-middle mb-0 mr-2"><?= $statusTitleConfig[$kStatus] ?>:</label>
                  <div class="custom-control custom-checkbox d-inline-block align-middle">
                    <input type="checkbox" class="form-check-input" id="<?= $kStatus ?>-checkbox" name="status[]" <?= in_array($kStatus, $status) && isset($status) ? 'checked' : '' ?> value="<?= !empty($kStatus) ? $kStatus : "" ?>" />
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>

          <div class="form-group">
            <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
            <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="num" id="num" placeholder="Số thứ tự" value="<?= isset($item['num']) ? $item['num'] : '' ?>">
          </div>
          <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="tabs-lang" data-toggle="pill" aria-selected="true">Tiếng Việt</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                  <div class="form-group">
                    <label for="title">Tiêu đề <?= $configAdmin['photo'][$type]['name'] ?>:</label>
                    <input type="text" class="form-control text-sm" name="title" id="title" placeholder="Tiêu đề <?= $configAdmin['photo'][$type]['name'] ?>" value="<?= isset($item['title']) ? $item['title'] : '' ?>" required />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End item -->
    </form>
  </section>
</div>

<?php require(dirname(dirname(__FILE__)) . "/partials/footer.php"); ?>