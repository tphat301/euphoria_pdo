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
          <li class="breadcrumb-item"><a href="" title="Bảng điều khiển">Bảng điều khiển</a></li>
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['seopage']['news']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/seopage/stored?req=news" ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="<?= isset($seopageNews) ? 'save-here' : 'save' ?>" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
      </div>
      <div class="row">
        <div class="col-xl-8">

          <!-- Content news -->
          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Nội dung <?= $configAdmin['seopage']['news']['name'] ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="javascript:void()" role="tab" aria-selected="true">Tiếng Việt</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body card-article">
                  <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tabs-lang">
                      <?php if (isset($configAdmin['seopage']['news']['title']) && $configAdmin['seopage']['news']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tiêu đề (SEO):</label>
                          <input type="text" class="for-seo form-control text-sm" name="title" id="title" value="<?= isset($seopageNews) && !empty($seopageNews['title']) ? $seopageNews['title'] : '' ?>" placeholder="Tiêu đề (SEO)" required />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['seopage']['news']['keywords']) && $configAdmin['seopage']['news']['keywords'] === true) { ?>
                        <div class="form-group">
                          <label for="keywords">Keywords (SEO):</label>
                          <textarea class="form-control text-sm form-control-ckeditor" name="keywords" id="keywords" rows="5" placeholder="Keywords (SEO)"><?= isset($seopageNews) && !empty($seopageNews['keywords']) ? htmlspecialchars_decode($seopageNews['keywords']) : '' ?></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['seopage']['news']['desc']) && $configAdmin['seopage']['news']['desc'] === true) { ?>
                        <div class="form-group">
                          <label for="desc">Mô tả (SEO):</label>
                          <textarea class="form-control text-sm form-control-ckeditor" name="description" id="desc" rows="5" placeholder="Mô tả (SEO)"><?= isset($seopageNews) && !empty($seopageNews['description']) ? htmlspecialchars_decode($seopageNews['description']) : '' ?></textarea>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End content seopage  -->
        </div>

        <!-- Static right -->
        <div class="col-xl-4">
          <!-- Photo -->
          <?php if (isset($configAdmin['seopage']['news']['photo1']) && $configAdmin['seopage']['news']['photo1'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Hình ảnh</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="photoUpload-zone">
                  <div class="photoUpload-detail" id="photoUpload-preview">
                    <img class="rounded" src="<?= isset($seopageNews['photo1']) && !empty($seopageNews['photo1']) ? $configBase['baseUrl'] . "upload/seopage/" .  $seopageNews['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="Alt Photo" />
                    <?php if (isset($seopageNews['photo1']) && !empty($seopageNews['photo1'])) { ?>
                      <div class="delete-photo">
                        <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/seopage/delete_photo?id=" . $seopageNews['id'] . "&photo1=" . $seopageNews['photo1'] . "&req=news" ?>"><i class="far fa-trash-alt"></i></a>
                      </div>
                    <?php } ?>
                  </div>
                  <label class="photoUpload-file" id="photo-zone" for="file-zone">
                    <input type="file" name="photo1" id="file-zone">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                    <p class="photoUpload-or">hoặc</p>
                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                  </label>
                  <div class="photoUpload-dimension">
                    <?= $configAdmin['seopage']['news']['upload_rules1'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </form>
  </section>
</div>
<?php require(dirname(dirname(__FILE__)) . "/partials/footer.php"); ?>