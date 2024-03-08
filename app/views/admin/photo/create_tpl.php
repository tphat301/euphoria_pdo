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
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/photo/stored?req=" . $type ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="save" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/photo/' . $type . '_index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
      </div>

      <!-- Start item -->
      <?php for ($i = 0; $i < @$createNumber; $i++) {
        $n = $i + 1;
      ?>
        <div class="card card-primary card-outline text-sm">
          <div class="card-header">
            <h3 class="card-title">Chi tiết <?= $configAdmin['photo'][$type]['name'] ?> <?= $n ?></h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div class="upload-file">
                <p>Upload hình ảnh <?= $configAdmin['photo'][$type]['name'] ?>:</p>
                <label class="upload-file-label mb-2" for="file<?= $n ?>">
                  <div class="upload-file-image rounded mb-3">
                    <img class="rounded img-upload upload_photo_preview_<?= $n ?>" src="<?= $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="Ảnh" width="300" height="130" style="object-fit: contain;" />
                  </div>
                  <div class="custom-file my-custom-file">
                    <input type="file" class="custom-file-input upload_photo" name="photo<?= $n ?>" id="upload_photo_<?= $n ?>" data-order="<?= $n ?>" value="" />
                    <label class="custom-file-label mb-0" data-browse="Chọn" for="upload_photo_<?= $n ?>">Chọn file</label>
                  </div>
                </label>
                <strong class="d-block text-sm"><?= $configAdmin['photo'][$type]['upload_rules'] ?></strong>
              </div>
            </div>
            <div class="form-group">
              <label for="link">Link:</label>
              <input type="text" class="form-control text-sm" name="dataMultiple[<?= $n ?>][link]" id="link" placeholder="Link" />
            </div>

            <?php if (isset($configAdmin['photo'][$type]['status'])) { ?>
              <div class="form-group">
                <?php if (isset($configAdmin['photo'][$type]['status_title'])) {
                  foreach ($configAdmin['photo'][$type]['status_title'] as $kStatus => $vStatus) {
                ?>
                    <div class="form-group d-inline-block mb-2 mr-2">
                      <label for="<?= $kStatus ?>-checkbox-<?= $n ?>" class="d-inline-block align-middle mb-0 mr-2"><?= $vStatus ?>:</label>
                      <div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input <?= $kStatus ?>-checkbox-<?= $n ?>" name="dataMultiple[<?= $n ?>][status][]" id="<?= $kStatus ?>-checkbox-<?= $n ?>" value="<?= $kStatus ?>" />
                        <label for="<?= $kStatus ?>-checkbox-<?= $n ?>" class="custom-control-label"></label>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            <?php } ?>

            <div class="form-group">
              <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
              <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="dataMultiple[<?= $n ?>][num]" id="num" placeholder="Số thứ tự" value="1">
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
                      <input type="text" class="form-control text-sm" name="dataMultiple[<?= $n ?>][title]" id="title" placeholder="Tiêu đề <?= $configAdmin['photo'][$type]['name'] ?>" required />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <!-- End item -->
    </form>
  </section>
</div>

<?php require(dirname(dirname(__FILE__)) . "/partials/footer.php"); ?>