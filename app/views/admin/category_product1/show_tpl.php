<?php
// Functions::dd($seo, true);
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
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['category_product1']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/category_product1/stored?id=" . $catProductDetail['id'] ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="update" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
        <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/category_product1/index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
      </div>
      <div class="row">
        <div class="col-xl-8">

          <!-- Slug -->
          <?php if (isset($configAdmin['category_product1']['slug']) && $configAdmin['category_product1']['slug'] === true) { ?>
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
                          <input type="text" class="slug-seo form-control slug-input no-validate text-sm" name="slug" id="slug" value="<?= $catProductDetail['slug'] ?>" placeholder="Đường dẫn mẫu" />
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
              <h3 class="card-title">Nội dung <?= $configAdmin['category_product1']['name'] ?></h3>
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

                      <?php if (isset($configAdmin['category_product1']['title']) && $configAdmin['category_product1']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tiêu đề:</label>
                          <input type="text" class="for-seo form-control text-sm" name="title" id="title" placeholder="Tiêu đề" value="<?= $catProductDetail['title'] ?>" required />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['category_product1']['desc']) && $configAdmin['category_product1']['desc'] === true) { ?>
                        <div class="form-group">
                          <label for="desc">Mô tả:</label>
                          <textarea class="<?= $configAdmin['category_product1']['desc_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="description" id="desc" rows="5" placeholder="Mô tả"><?= isset($catProductDetail['description']) ? htmlspecialchars_decode($catProductDetail['description']) : "" ?></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['category_product1']['content']) && $configAdmin['category_product1']['content'] === true) { ?>
                        <div class="form-group">
                          <label for="content">Nội dung:</label>
                          <textarea class="<?= $configAdmin['category_product1']['content_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="content" id="content" rows="5" placeholder="Nội dung"><?= isset($catProductDetail['content']) ? htmlspecialchars_decode($catProductDetail['content']) : "" ?></textarea>
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

          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Thông tin <?= $configAdmin['category_product1']['name'] ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <!-- Status  -->
              <div class="form-group">
                <?php
                if (!empty($catProductDetail['status'])) {
                  $status = explode(",", $catProductDetail['status']);
                } else {
                  $status = [];
                }
                $statusConfig = $configAdmin['category_product1']['status'];
                $statusTitleConfig = $configAdmin['category_product1']['status_title'];
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
              <?php if (isset($configAdmin['category_product1']['num']) && $configAdmin['category_product1']['num'] === true) { ?>
                <div class="form-group">
                  <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                  <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="num" id="numb" placeholder="Số thứ tự" value="<?= $catProductDetail['num'] ?>" />
                </div>
              <?php } ?>
            </div>
          </div>

          <!-- Photo 1 -->
          <?php if (isset($configAdmin['category_product1']['photo1']) && $configAdmin['category_product1']['photo1'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($catProductDetail['photo1']) && !empty($catProductDetail['photo1']) ? $configBase['baseUrl'] . "upload/category_product1/" .  $catProductDetail['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/category_product1/delete_photo?id=" . $catProductDetail['id'] . "&photo1=" . $catProductDetail['photo1'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['category_product1']['upload_rules1'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 2 -->
          <?php if (isset($configAdmin['category_product1']['photo2']) && $configAdmin['category_product1']['photo2'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($catProductDetail['photo2']) && !empty($catProductDetail['photo2']) ? $configBase['baseUrl'] . "upload/category_product1/" .  $catProductDetail['photo2'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/category_product1/delete_photo?id=" . $catProductDetail['id'] . "&photo2=" . $catProductDetail['photo2'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['category_product1']['upload_rules2'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 3 -->
          <?php if (isset($configAdmin['category_product1']['photo3']) && $configAdmin['category_product1']['photo3'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($catProductDetail['photo3']) && !empty($catProductDetail['photo3']) ? $configBase['baseUrl'] . "upload/category_product1/" .  $catProductDetail['photo3'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/category_product1/delete_photo?id=" . $catProductDetail['id'] . "&photo3=" . $catProductDetail['photo3'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['category_product1']['upload_rules3'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 4 -->
          <?php if (isset($configAdmin['category_product1']['photo4']) && $configAdmin['category_product1']['photo4'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($catProductDetail['photo4']) && !empty($catProductDetail['photo4']) ? $configBase['baseUrl'] . "upload/category_product1/" .  $catProductDetail['photo4'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/category_product1/delete_photo?id=" . $catProductDetail['id'] . "&photo4=" . $catProductDetail['photo4'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['category_product1']['upload_rules4'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <!-- SEO -->
      <?php if (isset($configAdmin['category_product1']['seo']) && $configAdmin['category_product1']['seo'] === true) { ?>
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