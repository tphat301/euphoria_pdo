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
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['product']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/product/stored?id=" . $productDetail['id'] ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="update" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
        <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/product/index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
      </div>
      <div class="row">
        <div class="col-xl-8">

          <!-- Slug -->
          <?php if (isset($configAdmin['product']['slug']) && $configAdmin['product']['slug'] === true) { ?>
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
                          <input type="text" class="slug-seo form-control slug-input no-validate text-sm" name="slug" id="slug" value="<?= $productDetail['slug'] ?>" placeholder="Đường dẫn mẫu" />
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
              <h3 class="card-title">Nội dung <?= $configAdmin['product']['name'] ?></h3>
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

                      <?php if (isset($configAdmin['product']['title']) && $configAdmin['product']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tiêu đề:</label>
                          <input type="text" class="for-seo form-control text-sm" name="title" id="title" placeholder="Tiêu đề" value="<?= $productDetail['title'] ?>" required />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['video_youtube']) && $configAdmin['product']['video_youtube'] === true) { ?>
                        <div class="form-group">
                          <label for="link_video">Video youtube:</label>
                          <input type="text" class="form-control text-sm" name="file_youtube" id="link_video" placeholder="Video youtube:" value="<?= isset($productDetail['file_youtube']) ? $productDetail['file_youtube'] : "" ?>">
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['file_attach']) && $configAdmin['product']['file_attach'] === true) { ?>
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
                              <a target="_blank" class="btn btn-sm bg-gradient-primary text-white d-inline-block align-middle rounded p-2" href="<?= isset($productDetail['file_attach']) ? $configBase['baseUrl'] . "upload/file/" . $productDetail['file_attach'] : "" ?>" title="Dowload tập tin hiện tại"><i class="fas fa-download mr-2"></i>Dowload tập tin hiện tại</a>
                            </div>
                            <strong class="d-block text-sm"><?= $configAdmin['product']['file_attact_type'] ?></strong>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['video_mp4']) && $configAdmin['product']['video_mp4'] === true) { ?>
                        <div class="form-group">
                          <label class="change-photo" for="file_mp4">
                            <p>Upload File MP4:</p>
                            <div class="rounded">
                              <video controls class="video-preview">
                                <source src="<?= isset($productDetail['file_mp4']) ? $configBase['baseUrl'] . 'upload/file/' . $productDetail['file_mp4'] : "" ?>" type="video/mp4">
                              </video>
                              <strong>
                                <b class="text-sm text-split"></b>
                                <span class="btn btn-sm bg-gradient-success"><i class="fas fa-camera mr-2"></i>Chọn file</span>
                              </strong>
                            </div>
                          </label>
                          <strong class="d-block mt-2 mb-2 text-sm"><?= $configAdmin['product']['video_type'] ?></strong>
                          <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file_mp4" id="file_mp4">
                            <label class="custom-file-label" for="file_mp4">Chọn file</label>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['desc']) && $configAdmin['product']['desc'] === true) { ?>
                        <div class="form-group">
                          <label for="desc">Mô tả:</label>
                          <textarea class="<?= $configAdmin['product']['desc_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="description" id="desc" rows="5" placeholder="Mô tả"><?= isset($productDetail['description']) ? htmlspecialchars_decode($productDetail['description']) : "" ?></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['content']) && $configAdmin['product']['content'] === true) { ?>
                        <div class="form-group">
                          <label for="content">Nội dung:</label>
                          <textarea class="<?= $configAdmin['product']['content_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="content" id="content" rows="5" placeholder="Nội dung"><?= isset($productDetail['content']) ? htmlspecialchars_decode($productDetail['content']) : "" ?></textarea>
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
          <?php if (isset($configAdmin['product']['toggle_category']) && $configAdmin['product']['toggle_category'] === true) { ?>
            <div class="card card-primary card-outline text-sm">
              <div class="card-header">
                <h3 class="card-title">Danh mục <?= $configAdmin['product']['name'] ?></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group-category row">
                  <?php if (isset($configAdmin['product']['category_product1']) && $configAdmin['product']['category_product1'] === true) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_list"><?= $configAdmin['category_product1']['name'] ?>:</label>
                      <select id="id_parent1" name="id_parent1" class="form-control filter-category select2-hidden-accessible" data-url="admin/product/filter_category" tabindex="-1" aria-hidden="true">
                        <option><?= $configAdmin['category_product1']['name'] ?></option>
                        <?php foreach ($categoryProduct1 as $k1 => $v1) { ?>
                          <option value="<?= $v1['id'] ?>" <?= $productDetail['id_parent1'] === $v1['id'] ? 'selected' : '' ?>>
                            <?= $v1['title'] ?>
                          </option>
                        <?php } ?>
                        <input type="hidden" name="_token_filter_category" value="<?= time() ?>" />
                      </select>
                    </div>
                  <?php } ?>

                  <?php if (isset($configAdmin['product']['category_product2']) && $configAdmin['product']['category_product2'] === true) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_cat"><?= $configAdmin['category_product2']['name'] ?>:</label>
                      <select id="id_parent2" name="id_parent2" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option><?= $configAdmin['category_product2']['name'] ?></option>
                        <?php foreach ($categoryProduct2 as $k2 => $v2) { ?>
                          <option value="<?= $v2['id'] ?>" <?= $productDetail['id_parent2'] === $v2['id'] ? 'selected' : '' ?>>
                            <?= $v2['title'] ?>
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
              <h3 class="card-title">Thông tin <?= $configAdmin['product']['name'] ?></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <!-- Status  -->
              <div class="form-group">
                <?php
                $statusConfig = $configAdmin['product']['status'];
                if (!empty($productDetail['status'])) {
                  $status = explode(",", $productDetail['status']);
                } else {
                  $status = [];
                }
                $statusTitleConfig = $configAdmin['product']['status_title'];
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
              <?php if (isset($configAdmin['product']['num']) && $configAdmin['product']['num'] === true) { ?>
                <div class="form-group">
                  <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                  <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="num" id="numb" placeholder="Số thứ tự" value="<?= $productDetail['num'] ?>" />
                </div>
              <?php } ?>
              <?php if (isset($configAdmin['product']['quantity']) && $configAdmin['product']['quantity'] === true) { ?>
                <div class="form-group">
                  <label for="quantity" class="d-inline-block align-middle mb-0 mr-2">Số lượng:</label>
                  <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="quantity" id="quantity" placeholder="Số lượng" value="<?= !empty($productDetail['quantity']) ? $productDetail['quantity'] : "" ?>" />
                </div>
              <?php } ?>

              <div class="row">
                <!-- Code -->
                <?php if (isset($configAdmin['product']['code']) && $configAdmin['product']['code'] === true) { ?>
                  <div class="form-group col-md-6">
                    <label class="d-block" for="code">Mã sản phẩm:</label>
                    <input type="text" class="form-control text-sm" name="code" id="code" value="<?= $productDetail['code'] ?>" placeholder="Mã sản phẩm" />
                  </div>
                <?php } ?>

                <!-- Sale price -->
                <?php if (isset($configAdmin['product']['sale_price']) && $configAdmin['product']['sale_price'] === true) { ?>
                  <div class="form-group col-md-6">
                    <label class="d-block" for="sale_price">Giá bán:</label>
                    <div class="input-group">
                      <input type="text" class="form-control format-price sale_price text-sm" name="sale_price" id="sale_price" value="<?= $productDetail['sale_price'] ?>" placeholder="Giá mới" />
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <strong>
                            <?= isset($configAdmin['product']['unit']) ? $configAdmin['product']['unit'] : 'VNĐ' ?>
                          </strong>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                <!-- Regular price -->
                <?php if (isset($configAdmin['product']['regular_price']) && $configAdmin['product']['regular_price'] === true) { ?>
                  <div class="form-group col-md-6">
                    <label class="d-block" for="regular_price">Giá cũ (nếu có):</label>
                    <div class="input-group">
                      <input type="text" class="form-control format-price regular_price text-sm" name="regular_price" id="regular_price" placeholder="Giá bán" value="<?= $productDetail['regular_price'] ?>" />
                      <div class="input-group-append">
                        <div class="input-group-text"><strong>VNĐ</strong></div>
                      </div>
                    </div>
                  </div>
                <?php } ?>

                <!-- Discount -->
                <?php if (isset($configAdmin['product']['discount']) && $configAdmin['product']['discount'] === true) { ?>
                  <div class="form-group col-md-6">
                    <label class="d-block" for="discount">Chiết khấu:</label>
                    <div class="input-group">
                      <input type="text" class="form-control discount text-sm" name="discount" id="discount" placeholder="Chiết khấu" value="<?= $productDetail['discount'] ?>" maxlength="3" readonly="" />
                      <div class="input-group-append">
                        <div class="input-group-text"><strong>%</strong></div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <!-- Photo 1 -->
          <?php if (isset($configAdmin['product']['photo1']) && $configAdmin['product']['photo1'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($productDetail['photo1']) && !empty($productDetail['photo1']) ? $configBase['baseUrl'] . "upload/product/" .  $productDetail['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/product/delete_photo?id=" . $productDetail['id'] . "&photo1=" . $productDetail['photo1'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['product']['upload_rules1'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 2 -->
          <?php if (isset($configAdmin['product']['photo2']) && $configAdmin['product']['photo2'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($productDetail['photo2']) && !empty($productDetail['photo2']) ? $configBase['baseUrl'] . "upload/product/" .  $productDetail['photo2'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/product/delete_photo?id=" . $productDetail['id'] . "&photo2=" . $productDetail['photo2'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['product']['upload_rules2'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 3 -->
          <?php if (isset($configAdmin['product']['photo3']) && $configAdmin['product']['photo3'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($productDetail['photo3']) && !empty($productDetail['photo3']) ? $configBase['baseUrl'] . "upload/product/" .  $productDetail['photo3'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/product/delete_photo?id=" . $productDetail['id'] . "&photo3=" . $productDetail['photo3'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['product']['upload_rules3'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

          <!-- Photo 4 -->
          <?php if (isset($configAdmin['product']['photo4']) && $configAdmin['product']['photo4'] === true) { ?>
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
                    <img class="rounded" src="<?= isset($productDetail['photo4']) && !empty($productDetail['photo4']) ? $configBase['baseUrl'] . "upload/product/" .  $productDetail['photo4'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" />
                    <div class="delete-photo">
                      <a href="javascript:void(0)" id="delete-photo" title="Xóa hình ảnh" data-url="<?= $configBase['baseUrl'] . "admin/product/delete_photo?id=" . $productDetail['id'] . "&photo4=" . $productDetail['photo4'] ?>"><i class="far fa-trash-alt"></i></a>
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
                    <?= $configAdmin['product']['upload_rules4'] ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <!-- SEO -->
      <?php if (isset($configAdmin['product']['seo']) && $configAdmin['product']['seo'] === true) { ?>
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

      <!-- Select size && color -->
      <div class="card card-primary card-outline text-sm">
        <div class="card-header">
          <h3 class="card-title">Thêm thuộc tính sản phẩm</h3>
        </div>
        <div class="card-body">
          <div class="formRight">
            <div id="load_data_options" class="row">
              <?php if (isset($options) && count($options) > 0) {
                foreach ($options as $kOpt => $vOpt) {
              ?>
                  <div class="col-md-12 form-group inputs-render">
                    <form class="form-opt-product" method="POST" enctype="multipart/form-data">
                      <div class="d-flex row">
                        <div class="col-2 d-flex flex-column justify-content-between align-item-center mt-1">
                          <label for="color" class="d-block w-100">Màu sắc:</label>
                          <select name="options[color]" class="color form-select py-2 border">
                            <option value="">Chọn màu sắc</option>
                            <?php if (isset($colors) && count($colors) > 0) {
                              foreach ($colors as $k => $v) {
                            ?>
                                <option value="<?= $v['id_color'] ?>" <?= $vOpt['id_color'] == $v['id_color'] ? 'selected' : '' ?>><?= $v['name_color'] ?></option>
                            <?php }
                            } ?>
                          </select>
                        </div>

                        <div class="col-2 d-flex flex-column justify-content-between align-item-center mt-1">
                          <label for="size" class="d-block w-100">Size:</label>
                          <select name="options[size]" class="size form-select py-2 border">
                            <option value="">Chọn size</option>
                            <?php if (isset($sizes) && count($sizes) > 0) {
                              foreach ($sizes as $k => $v) {
                            ?>
                                <option value="<?= $v['id_size'] ?>" <?= $vOpt['id_size'] == $v['id_size'] ? 'selected' : '' ?>><?= $v['name_size'] ?></option>
                            <?php }
                            } ?>
                          </select>
                        </div>
                        <div class="col-1 d-flex align-items-center">
                          <div>
                            <label for="" class="d-block" style="opacity: 0;">Xóa</label>
                            <a href="<?= $configBase['baseUrl'] . 'admin/product/option/delete?id=' . $vOpt['id'] ?>" class="btn btn-danger mt-1 btn-delete-option">
                              <i class="fas fa-trash-alt text-white"></i>
                            </a>
                          </div>
                        </div>

                      </div>
                      <div class="form-group option-main mt-3">
                        <div class="card card-outline text-sm">
                          <div class="card-header">
                            <h3 class="card-title">
                              <strong class="card-title1">Thông tin thuộc tính</strong>
                              <strong class="card-title2"></strong>
                            </h3>
                          </div>
                          <div class="card-body">
                            <div class="formRight">
                              <div class="row">
                                <div class="form-group col-2">
                                  <label class="d-block" for="photo_color">Hình ảnh màu sắc (nếu có):</label>
                                  <div class="input-group d-flex align-items-center" style="gap: 8px;">
                                    <input type="file" name="photo_color" class="form-control format-price-opt photo_color_opt text-sm" />
                                    <img class="rounded" src="<?= isset($vOpt['photo_color']) ? $configBase['baseUrl'] . 'upload/color/' . $vOpt['photo_color']  : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo" width="40" height="40" style="object-fit: contain;" />
                                  </div>
                                </div>
                                <div class="form-group col-2">
                                  <label class="d-block" for="regular_price">Giá cũ (nếu có):</label>
                                  <div class="input-group">
                                    <input type="text" class="form-control format-price-render regular_price_render text-sm" name="options[regular_price]" placeholder="Giá bán" value="<?= $vOpt['regular_price'] ?>" />
                                    <div class="input-group-append">
                                      <div class="input-group-text"><strong>VNĐ</strong></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-2">
                                  <label class="d-block" for="sale_price">Giá bán:</label>
                                  <div class="input-group">
                                    <input type="text" class="form-control format-price-render sale_price_render text-sm" name="options[sale_price]" value="<?= $vOpt['sale_price'] ?>" placeholder="Giá mới" />
                                    <div class="input-group-append">
                                      <div class="input-group-text">
                                        <strong>
                                          VNĐ
                                        </strong>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-2">
                                  <label class="d-block" for="discount">Chiết khấu:</label>
                                  <div class="input-group">
                                    <input type="text" class="form-control discount_render text-sm" name="options[discount]" placeholder="Chiết khấu" value="<?= $vOpt['discount'] ?>" maxlength="3" readonly="" />
                                    <div class="input-group-append">
                                      <div class="input-group-text"><strong>%</strong></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
              <?php }
              } ?>
            </div>
            <div class="btn-add-option btn btn-sm bg-gradient-primary" data-id="<?= $productDetail['id'] ?>" style="width: fit-content;">Thêm thuộc tính</div>
          </div>
        </div>
      </div>

      <!-- Schema SEO -->
      <?php if (isset($configAdmin['product']['schema']) && $configAdmin['product']['schema'] === true) { ?>
        <div class="card card-primary card-outline text-sm">
          <div class="card-header">
            <h3 class="card-title">Schema JSON Product</h3>
            <button type="submit" class="btn btn-sm bg-gradient-success float-right submit-check" name="build-schema"><i class="far fa-save mr-2"></i>Lưu và tạo tự động Schema</button>
          </div>
          <div class="card-body">
            <div class="card-seo">
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab-lang" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="tabs-lang-schema" data-toggle="pill" href="#tabs-schemalang-vi" role="tab" aria-controls="tabs-schemalang-vi" aria-selected="true">Schema JSON</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-one-tabContent-lang">
                    <div class="tab-pane fade show active" id="tabs-schemalang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                      <div class="form-group">
                        <div class="label-seo">
                          <label for="schemavi">Schema JSON:</label>
                        </div>
                        <textarea class="form-control schema-seo" name="schema" id="schemavi" rows="15" placeholder="Nếu quý khách không biết cách sử dụng Data Structure vui lòng không nhập nội dung vào khung này để tránh phát sinh lỗi..."><?= $schema ?></textarea>
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

    <!-- Gallery photo -->
    <?php if (isset($configAdmin['product']['gallery']) && $configAdmin['product']['gallery'] === true) { ?>
      <div class="card card-primary card-outline text-sm">
        <div class="card-header">
          <h3 class="card-title">Bộ sưu tập <?= $configAdmin['product']['name'] ?></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <label for="filer-gallery" class="label-filer-gallery mb-3">
                Album hình ảnh: (.jpg|.gif|.png|.jpeg|.gif)
              </label>
              <button type="submit" class="btn btn-sm bg-gradient-success gallery-sending-hide" id="submit-all">Upload ảnh</button>
              <input type="hidden" name="_token_gallery_title" value="<?= time() ?>" />
            </div>
            <form class="jFiler jFiler-theme-dragdropbox dropzone" action="<?= $configBase['baseUrl'] . "admin/product/upload_gallery?id=" . $productDetail['id'] ?>" method="POST" id="dropzoneFrom" style="background: #f9fbfe;">
              <div class="jFiler-input-dragDrop" style="border:0">
                <div class="jFiler-input-inner">
                  <div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php if (count($gallerys) > 0) {  ?>
          <div>
            <div class="jFiler-items my-jFiler-items jFiler-row">
              <ul class="jFiler-items-list jFiler-items-grid row scroll-bar" id="jFilerSortable">
                <?php foreach ($gallerys as $v) { ?>
                  <li class="jFiler-item my-jFiler-item my-jFiler-item-66 col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                    <div class="jFiler-item-container">
                      <div class="jFiler-item-inner">
                        <div class="jFiler-item-thumb">
                          <div class="jFiler-item-thumb-image">
                            <img src="<?= isset($v['photo']) ? $configBase['baseUrl'] . "upload/gallery/" .  $v['photo'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" class="h-100 w-100" alt="">
                            <i class="fas fa-arrows-alt"></i>
                          </div>
                        </div>
                        <div class="jFiler-item-assets jFiler-row">
                          <ul class="list-inline pull-right d-flex align-items-center">
                            <li class="ml-1">
                              <a href="<?= $configBase['baseUrl'] . "admin/product/delete_gallery?id=" . $v['id'] . "&id_parent=" . $productDetail['id'] . "&hash=" . $v['hash'] . "&photo_gallery=" . $v['photo'] ?>" class="icon-jfi-trash jFiler-item-trash-action my-jFiler-item-trash text-danger remove_image" id="delete-item-gallery" title="Xóa ảnh" data-url="admin/product/upload_gallery"></a>
                            </li>
                          </ul>
                        </div>
                        <input type="number" class="form-control form-control-sm my-jFiler-item-info rounded mb-1 text-sm update-num-gallery" value="<?= $v['num'] ?>" data-id="<?= $v['id'] ?>" data-table="gallery" />
                        <input type="text" class="form-control form-control-sm my-jFiler-item-info rounded text-sm gallery-title-ajx" data-table="gallery" data-idparent="<?= $productDetail['id'] ?>" data-id="<?= $v['id'] ?>" data-status="<?= $productDetail['status'] ?>" data-hash="<?= $productDetail['hash'] ?>" data-url="admin/product/update_title_gallery" value="<?= $v['title'] ?>" placeholder="Tiêu đề" />
                        <input type="hidden" name="_token_gallery_title" value="<?= time() ?>" />
                      </div>
                    </div>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </section>
</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>