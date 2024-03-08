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
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['static']['about']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/static/stored?req=gioithieu" ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="<?= isset($about) ? 'save-here' : 'save' ?>" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
      </div>
      <div class="row">
        <div class="col-xl-8">
          <!-- Slug -->
          <?php if (isset($configAdmin['static']['about']['slug']) && $configAdmin['static']['about']['slug'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Đường dẫn</h3>
                <span class="pl-2 text-danger">(Vui lòng không nhập trùng tiêu đề)</span>
              </div>
              <div class="card-body card-slug">
                <div class="card card-primary card-outline card-outline-tabs">
                  <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-sluglang-vi" role="tab" aria-controls="tabs-sluglang-vi" aria-selected="true">Tiếng Việt</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                      <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tabs-lang">
                        <div class="form-gourp mb-0">
                          <label class="d-block">Đường dẫn mẫu:<span class="pl-2 font-weight-normal" id="slugurlpreviewvi"><strong class="text-info"></strong></span></label>
                          <input type="text" class="slug-seo form-control slug-input no-validate text-sm" name="slug" id="slug" value="<?= isset($about) && !empty($about['slug']) ? $about['slug'] : '' ?>" placeholder="Đường dẫn mẫu" required />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Nội dung <?= $configAdmin['static']['about']['name'] ?></h3>
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
                      <?php if (isset($configAdmin['static']['about']['slogan']) && $configAdmin['static']['about']['slogan'] === true) { ?>
                        <div class="form-group">
                          <label for="slogan">Slogan:</label>
                          <input type="text" class="form-control text-sm" name="slogan" id="slogan" value="<?= isset($about) && !empty($about['slogan']) ? $about['slogan'] : '' ?>" placeholder="Slogan" />
                        </div>
                      <?php } ?>
                      <?php if (isset($configAdmin['static']['about']['title']) && $configAdmin['static']['about']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tiêu đề:</label>
                          <input type="text" class="for-seo form-control text-sm" name="title" id="title" value="<?= isset($about) && !empty($about['title']) ? $about['title'] : '' ?>" placeholder="Tiêu đề" required />
                        </div>
                      <?php } ?>
                      <?php if (isset($configAdmin['static']['about']['video_youtube']) && $configAdmin['static']['about']['video_youtube'] === true) { ?>
                        <div class="form-group">
                          <label for="link_video">Video youtube:</label>
                          <input type="text" class="form-control text-sm" name="file_youtube" id="link_video" placeholder="Video youtube:" />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['static']['about']['video_mp4']) && $configAdmin['static']['about']['video_mp4'] === true) { ?>
                        <div class="form-group">
                          <label class="change-photo" for="file_mp4">
                            <p>Upload File MP4:</p>
                            <div class="rounded">
                              <video controls>
                                <source src="<?= $configBase['baseUrl'] . 'public/images/noimage.png' ?>" type="video/mp4">
                              </video>
                              <strong>
                                <b class="text-sm text-split"></b>
                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn file</span>
                              </strong>
                            </div>
                          </label>
                          <strong class="d-block mt-2 mb-2 text-sm"><?= $configAdmin['static']['about']['video_type'] ?></strong>
                          <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file_mp4" id="file_mp4" />
                            <label class="custom-file-label" for="file_mp4">Chọn file</label>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['static']['about']['file_attach']) && $configAdmin['static']['about']['file_attach'] === true) { ?>
                        <div class="form-group">
                          <div class="upload-file mb-2">
                            <label class="mb-2 d-block">Upload tập tin:</label>
                            <label class="upload-file-label mb-2" for="file_attach">
                              <div class="custom-file my-custom-file">
                                <input type="file" class="custom-file-input" name="file_attach" id="file_attach">
                                <label class="custom-file-label mb-0" data-browse="Chọn" for="file_attach">
                                  Chọn file
                                </label>
                              </div>
                            </label>
                            <strong class="d-block text-sm"><?= $configAdmin['static']['about']['file_attact_type'] ?></strong>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['static']['about']['desc']) && $configAdmin['static']['about']['desc'] === true) { ?>
                        <div class="form-group">
                          <label for="desc">Mô tả:</label>
                          <textarea class="<?= $configAdmin['static']['about']['desc_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="description" id="desc" rows="5" placeholder="Mô tả"><?= isset($about) && !empty($about['description']) ? htmlspecialchars_decode($about['description']) : '' ?></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['static']['about']['content']) && $configAdmin['static']['about']['content'] === true) { ?>
                        <div class="form-group">
                          <label for="content">Nội dung:</label>
                          <textarea class="<?= $configAdmin['static']['about']['content_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="content" id="content" rows="5" placeholder="Nội dung"><?= isset($about) && !empty($about['content']) ? htmlspecialchars_decode($about['content']) : '' ?></textarea>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End content news  -->
        </div>

        <!-- Static right -->
        <div class="col-xl-4">
          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Thông tin <?= $configAdmin['static']['about']['name'] ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <!-- Status  -->
              <?php if (isset($configAdmin['static']['about']['status'])) { ?>
                <?php if (isset($about['status'])) { ?>
                  <div class="form-group">
                    <?php
                    $statusConfig = $configAdmin['static']['about']['status'];
                    if (!empty($about['status'])) {
                      $status = explode(",", $about['status']);
                    } else {
                      $status = [];
                    }
                    $statusTitleConfig = $configAdmin['static']['about']['status_title'];
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
                <?php } else { ?>
                  <div class="form-group">
                    <?php if (isset($configAdmin['static']['about']['status_title'])) {
                      foreach ($configAdmin['static']['about']['status_title'] as $kStatus => $vStatus) {
                    ?>
                        <div class="form-group d-inline-block mb-2 mr-2">
                          <label for="<?= $kStatus ?>-checkbox" class="d-inline-block align-middle mb-0 mr-2"><?= $vStatus ?>:</label>
                          <div class="custom-control custom-checkbox d-inline-block align-middle">
                            <input type="checkbox" class="custom-control-input <?= $kStatus ?>-checkbox" name="status[]" id="<?= $kStatus ?>-checkbox" value="<?= $kStatus ?>" />
                            <label for="<?= $kStatus ?>-checkbox" class="custom-control-label"></label>
                          </div>
                        </div>
                    <?php }
                    } ?>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
          </div>

          <!-- Photo 1 -->
          <?php if (isset($configAdmin['static']['about']['photo1']) && $configAdmin['static']['about']['photo1'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Hình ảnh 1</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="photoUpload-zone">
                  <div class="photoUpload-detail" id="photoUpload-preview">
                    <img class="rounded" src="<?= isset($about['photo1']) && !empty($about['photo1']) ? $configBase['baseUrl'] . "upload/static/" .  $about['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/static/delete_photo?id=" . $about['id'] . "&photo1=" . $about['photo1'] . "&req=gioithieu" ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                  </div>
                  <label class="photoUpload-file" id="photo-zone" for="file-zone">
                    <input type="file" name="photo1" id="file-zone">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                    <p class="photoUpload-or">hoặc</p>
                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                  </label>
                  <div class="photoUpload-dimension">
                    <?= $configAdmin['static']['about']['upload_rules1'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 2 -->
          <?php if (isset($configAdmin['static']['about']['photo2']) && $configAdmin['static']['about']['photo2'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Hình ảnh 2</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="photoUpload-zone">
                  <div class="photoUpload-detail" id="photoUpload-preview2">
                    <img class="rounded" src="<?= isset($about['photo2']) && !empty($about['photo2']) ? $configBase['baseUrl'] . "upload/static/" .  $about['photo2'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/static/delete_photo?id=" . $about['id'] . "&photo2=" . $about['photo2'] . "&req=gioithieu" ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                  </div>
                  <label class="photoUpload-file" id="photo-zone2" for="file-zone2">
                    <input type="file" name="photo2" id="file-zone2">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                    <p class="photoUpload-or">hoặc</p>
                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                  </label>
                  <div class="photoUpload-dimension">
                    <?= $configAdmin['static']['about']['upload_rules2'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 3 -->
          <?php if (isset($configAdmin['static']['about']['photo3']) && $configAdmin['static']['about']['photo3'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Hình ảnh 3</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="photoUpload-zone">
                  <div class="photoUpload-detail" id="photoUpload-preview3">
                    <img class="rounded" src="<?= isset($about['photo3']) && !empty($about['photo3']) ? $configBase['baseUrl'] . "upload/static/" .  $about['photo3'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/static/delete_photo?id=" . $about['id'] . "&photo3=" . $about['photo3'] . "&req=gioithieu" ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                  </div>
                  <label class="photoUpload-file" id="photo-zone3" for="file-zone3">
                    <input type="file" name="photo3" id="file-zone3">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                    <p class="photoUpload-or">hoặc</p>
                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                  </label>
                  <div class="photoUpload-dimension">
                    <?= $configAdmin['static']['about']['upload_rules3'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 4 -->
          <?php if (isset($configAdmin['static']['about']['photo4']) && $configAdmin['static']['about']['photo4'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Hình ảnh 4</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="photoUpload-zone">
                  <div class="photoUpload-detail" id="photoUpload-preview4">
                    <img class="rounded" src="<?= isset($about['photo4']) && !empty($about['photo4']) ? $configBase['baseUrl'] . "upload/static/" .  $about['photo4'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/static/delete_photo?id=" . $about['id'] . "&photo4=" . $about['photo4'] . "&req=gioithieu" ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                  </div>
                  <label class="photoUpload-file" id="photo-zone4" for="file-zone4">
                    <input type="file" name="photo4" id="file-zone4">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
                    <p class="photoUpload-or">hoặc</p>
                    <p class="photoUpload-choose btn btn-sm bg-gradient-success">Chọn hình</p>
                  </label>
                  <div class="photoUpload-dimension">
                    <?= $configAdmin['static']['about']['upload_rules4'] ?>
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