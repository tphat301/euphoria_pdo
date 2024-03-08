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
          <li class="breadcrumb-item active">Quản lý chính sách</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/policy/stored?id=" . $newsDetail['id'] ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="update" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
        <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/policy/index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
      </div>
      <div class="row">
        <div class="col-xl-8">

          <!-- Slug -->
          <?php if (isset($configAdmin['policy']['slug']) && $configAdmin['policy']['slug'] === true) { ?>
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
                      <div class="tab-pane fade show active" id="tabs-sluglang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                        <div class="form-gourp mb-0">
                          <label class="d-block">Đường dẫn mẫu:<span class="pl-2 font-weight-normal" id="slugurlpreviewvi"><strong class="text-info"></strong></span></label>
                          <input type="text" class="slug-seo form-control slug-input no-validate text-sm" name="slug" id="slug" value="<?= $newsDetail['slug'] ?>" placeholder="Đường dẫn mẫu" />
                          <?php if (Flash::get('slug', 'danger')) { ?>
                            <p class="alert-slugvi text-danger mt-2 mb-0" id="alert-slug-dangervi">
                              <i class="fas fa-exclamation-triangle mr-1"></i>
                              <span>Đường dẫn đã tồn tại. Đường dẫn truy cập mục này có thể bị trùng lặp.!</span>
                            </p>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Content product -->
          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Nội dung <?= $configAdmin['policy']['name'] ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-lang-vi" role="tab" aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body card-article">
                  <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                    <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">

                      <?php if (isset($configAdmin['policy']['title']) && $configAdmin['policy']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tiêu đề:</label>
                          <input type="text" class="for-seo form-control text-sm" name="title" id="title" placeholder="Tiêu đề" value="<?= $newsDetail['title'] ?>" required />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['policy']['video_youtube']) && $configAdmin['policy']['video_youtube'] === true) { ?>
                        <div class="form-group">
                          <label for="link_video">Video youtube:</label>
                          <input type="text" class="form-control text-sm" name="file_youtube" id="link_video" placeholder="Video youtube:" value="<?= isset($newsDetail['file_youtube']) ? $newsDetail['file_youtube'] : "" ?>">
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['policy']['file_attach']) && $configAdmin['policy']['file_attach'] === true) { ?>
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
                            <div class="file-uploaded mb-2">
                              <a target="_blank" class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle rounded p-2" href="<?= isset($newsDetail['file_attach']) ? $configBase['baseUrl'] . "upload/file/" . $newsDetail['file_attach'] : "" ?>" title="Dowload tập tin hiện tại"><i class="fas fa-download mr-2"></i>Dowload tập tin hiện tại</a>
                            </div>
                            <strong class="d-block text-sm"><?= $configAdmin['policy']['file_attact_type'] ?></strong>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['policy']['video_mp4']) && $configAdmin['policy']['video_mp4'] === true) { ?>
                        <div class="form-group">
                          <label class="change-photo" for="file_mp4">
                            <p>Upload File MP4:</p>
                            <div class="rounded">
                              <video controls class="video-preview">
                                <source src="<?= isset($newsDetail['file_mp4']) ? $configBase['baseUrl'] . 'upload/file/' . $newsDetail['file_mp4'] : "" ?>" type="video/mp4">
                              </video>
                              <strong>
                                <b class="text-sm text-split"></b>
                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn file</span>
                              </strong>
                            </div>
                          </label>
                          <strong class="d-block mt-2 mb-2 text-sm"><?= $configAdmin['policy']['video_type'] ?></strong>
                          <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file_mp4" id="file_mp4">
                            <label class="custom-file-label" for="file_mp4">Chọn file</label>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['policy']['desc']) && $configAdmin['policy']['desc'] === true) { ?>
                        <div class="form-group">
                          <label for="desc">Mô tả:</label>
                          <textarea class="<?= $configAdmin['policy']['desc_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="description" id="desc" rows="5" placeholder="Mô tả"><?= isset($newsDetail['description']) ? htmlspecialchars_decode($newsDetail['description']) : "" ?></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['policy']['content']) && $configAdmin['policy']['content'] === true) { ?>
                        <div class="form-group">
                          <label for="content">Nội dung:</label>
                          <textarea class="<?= $configAdmin['policy']['content_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="content" id="content" rows="5" placeholder="Nội dung"><?= isset($newsDetail['content']) ? htmlspecialchars_decode($newsDetail['content']) : "" ?></textarea>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End content product  -->

        </div>

        <!-- Product right -->
        <div class="col-xl-4">

          <!-- Category -->
          <?php if (isset($configAdmin['policy']['toggle_category']) && $configAdmin['policy']['toggle_category'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Danh mục <?= $configAdmin['policy']['name'] ?></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group-category row">
                  <?php if (isset($configAdmin['policy']['category_news1']) && $configAdmin['policy']['category_news1'] === true && count($categoryNews1) > 0) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_parent1"><?= $configAdmin['category_news1']['name'] ?>:</label>
                      <select id="id_parent1" name="id_parent1" class="form-control filter-category select2-hidden-accessible" data-url="admin/policy/filter_category" tabindex=" -1" aria-hidden="true">
                        <option><?= $configAdmin['category_news1']['name'] ?></option>
                        <?php foreach ($categoryNews1 as $k1 => $v1) { ?>
                          <option value="<?= $v1['id'] ?>" <?= $newsDetail['id_parent1'] === $v1['id'] ? 'selected' : '' ?>>
                            <?= $v1['title'] ?>
                          </option>
                        <?php } ?>
                        <input type="hidden" name="_token_filter_category" value="<?= time() ?>" />
                      </select>
                    </div>
                  <?php } ?>

                  <?php if (isset($configAdmin['policy']['category_news2']) && $configAdmin['policy']['category_news2'] === true && count($categoryNews2) > 0) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_parent2"><?= $configAdmin['category_news2']['name'] ?>:</label>
                      <select id="id_parent2" name="id_parent2" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="0" data-select2-id="4"><?= $configAdmin['category_news2']['name'] ?></option>
                        <?php foreach ($categoryNews2 as $k2 => $v2) { ?>
                          <option value="<?= $v2['id'] ?>" <?= $newsDetail['id_parent2'] === $v2['id'] ? 'selected' : '' ?>>
                            <?= $v2['title'] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>

                  <?php if (isset($configAdmin['policy']['category_news3']) && $configAdmin['policy']['category_news3'] === true && count($categoryNews3) > 0) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_parent3"><?= $configAdmin['category_news3']['name'] ?>:</label>
                      <select id="id_parent3" name="id_parent3" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="0" data-select2-id="4"><?= $configAdmin['category_news3']['name'] ?></option>
                        <?php foreach ($categoryNews3 as $k3 => $v3) { ?>
                          <option value="<?= $v3['id'] ?>" <?= $newsDetail['id_parent3'] === $v3['id'] ? 'selected' : '' ?>>
                            <?= $v3['title'] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>

                  <?php if (isset($configAdmin['policy']['category_news4']) && $configAdmin['policy']['category_news4'] === true && count($categoryNews4) > 0) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_parent3"><?= $configAdmin['category_news4']['name'] ?>:</label>
                      <select id="id_parent3" name="id_parent3" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="0" data-select2-id="4"><?= $configAdmin['category_news4']['name'] ?></option>
                        <?php foreach ($categoryNews4 as $k4 => $v4) { ?>
                          <option value="<?= $v4['id'] ?>" <?= $newsDetail['id_parent3'] === $v4['id'] ? 'selected' : '' ?>>
                            <?= $v4['title'] ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>

                </div>
              </div>
            </div>
          <?php } ?>

          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Thông tin <?= $configAdmin['policy']['name'] ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <!-- Status  -->
              <div class="form-group">
                <?php
                $statusConfig = $configAdmin['policy']['status'];
                if (!empty($newsDetail['status'])) {
                  $status = explode(",", $newsDetail['status']);
                } else {
                  $status = [];
                }
                $statusTitleConfig = $configAdmin['policy']['status_title'];
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

              <!-- STT -->
              <?php if (isset($configAdmin['policy']['num']) && $configAdmin['policy']['num'] === true) { ?>
                <div class="form-group">
                  <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                  <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="num" id="numb" placeholder="Số thứ tự" value="<?= $newsDetail['num'] ?>" />
                </div>
              <?php } ?>
            </div>
          </div>

          <!-- Photo 1 -->
          <?php if (isset($configAdmin['policy']['photo1']) && $configAdmin['policy']['photo1'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($newsDetail['photo1']) && !empty($newsDetail['photo1']) ? $configBase['baseUrl'] . "upload/policy/" .  $newsDetail['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/policy/delete_photo?id=" . $newsDetail['id'] . "&photo1=" . $newsDetail['photo1'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['policy']['upload_rules1'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 2 -->
          <?php if (isset($configAdmin['policy']['photo2']) && $configAdmin['policy']['photo2'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($newsDetail['photo2']) && !empty($newsDetail['photo2']) ? $configBase['baseUrl'] . "upload/policy/" .  $newsDetail['photo2'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/policy/delete_photo?id=" . $newsDetail['id'] . "&photo2=" . $newsDetail['photo2'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['policy']['upload_rules2'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 3 -->
          <?php if (isset($configAdmin['policy']['photo3']) && $configAdmin['policy']['photo3'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($newsDetail['photo3']) && !empty($newsDetail['photo3']) ? $configBase['baseUrl'] . "upload/policy/" .  $newsDetail['photo3'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/policy/delete_photo?id=" . $newsDetail['id'] . "&photo3=" . $newsDetail['photo3'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['policy']['upload_rules3'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 4 -->
          <?php if (isset($configAdmin['policy']['photo4']) && $configAdmin['policy']['photo4'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($newsDetail['photo4']) && !empty($newsDetail['photo4']) ? $configBase['baseUrl'] . "upload/policy/" .  $newsDetail['photo4'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/policy/delete_photo?id=" . $newsDetail['id'] . "&photo4=" . $newsDetail['photo4'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['policy']['upload_rules4'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <!-- SEO -->
      <?php if (isset($configAdmin['policy']['seo']) && $configAdmin['policy']['seo'] === true) { ?>
        <div class="card card-primary card-outline text-sm">
          <div class="card-header">
            <h3 class="card-title">Nội dung SEO</h3>
            <div class="build-seo bg-gradient-success py-2 px-3 rounded  float-right submit-check"><i class="far fa-save mr-2"></i>Tạo SEO</div>
          </div>
          <div class="card-body">
            <div class="card-seo">
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="#tabs-seolang-vi" role="tab" aria-controls="tabs-seolang-vi" aria-selected="true">SEO</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                    <div class="tab-pane fade show active" id="tabs-seolang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                      <div class="form-group">
                        <div class="label-seo">
                          <label for="title_seo">SEO Title:</label>
                        </div>
                        <input type="text" class="form-control check-seo title-seo text-sm" name="title_seo" id="title_seo" placeholder="SEO Title" value="<?= isset($seo['title_seo']) ? $seo['title_seo'] : "" ?>">
                      </div>
                      <div class="form-group">
                        <div class="label-seo">
                          <label for="keywords_seo">SEO Keywords (tối đa 70 ký tự):</label>
                        </div>
                        <input type="text" class="form-control check-seo keywords-seo text-sm" name="keywords" id="keywords_seo" placeholder="SEO Keywords" value="<?= isset($seo['keywords']) ? $seo['keywords'] : "" ?>">
                      </div>
                      <div class="form-group">
                        <div class="label-seo">
                          <label for="description_seo">SEO Description (tối đa 160 ký tự):</label>
                        </div>
                        <textarea class="form-control check-seo description-seo text-sm" name="description_seo" id="description_seo" rows="5" placeholder="SEO Description"><?= isset($seo['description_seo']) ? $seo['description_seo'] : "" ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </form>
  </section>
</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>