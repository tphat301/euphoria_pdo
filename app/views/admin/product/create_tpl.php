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
          <li class="breadcrumb-item active">Thêm <?= $configAdmin['product']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/product/stored" ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="save" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
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
                        <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="javscript:void()" role="tab" aria-selected="true">Tiếng Việt</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                      <div class="tab-pane fade show active" id="tabs-sluglang-vi" role="tabpanel" aria-labelledby="tabs-lang">
                        <div class="form-gourp mb-0">
                          <label class="d-block">Đường dẫn mẫu:<span class="pl-2 font-weight-normal" id="slugurlpreviewvi"><strong class="text-info"></strong></span></label>
                          <input type="text" class="slug-seo form-control slug-input no-validate text-sm" name="slug" id="slug" value="<?php echo Flash::get('slug', 'success') ?>" placeholder="Đường dẫn mẫu" />
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
                      <a class="nav-link active" id="tabs-lang" data-toggle="pill" href="javscript:void()" role="tab" aria-controls="tabs-lang-vi" aria-selected="true">Tiếng Việt</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body card-article">
                  <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                    <div class="tab-pane fade show active" id="tabs-lang-vi" role="tabpanel" aria-labelledby="tabs-lang">

                      <?php if (isset($configAdmin['product']['title']) && $configAdmin['product']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tiêu đề:</label>
                          <input type="text" class="for-seo form-control text-sm" name="title" id="title" placeholder="Tiêu đề" required>
                        </div>
                      <?php } ?>
                      <?php if (isset($configAdmin['product']['video_youtube']) && $configAdmin['product']['video_youtube'] === true) { ?>
                        <div class="form-group">
                          <label for="link_video">Video youtube:</label>
                          <input type="text" class="form-control text-sm" name="file_youtube" id="link_video" placeholder="Video youtube:">
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['video_mp4']) && $configAdmin['product']['video_mp4'] === true) { ?>
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
                          <strong class="d-block mt-2 mb-2 text-sm"><?= $configAdmin['product']['video_type'] ?></strong>
                          <div class="custom-file my-custom-file d-none">
                            <input type="file" class="custom-file-input" name="file_mp4" id="file_mp4">
                            <label class="custom-file-label" for="file_mp4">Chọn file</label>
                          </div>
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
                            <strong class="d-block text-sm"><?= $configAdmin['product']['file_attact_type'] ?></strong>
                          </div>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['desc']) && $configAdmin['product']['desc'] === true) { ?>
                        <div class="form-group">
                          <label for="desc">Mô tả:</label>
                          <textarea class="<?= $configAdmin['product']['desc_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="description" id="desc" rows="5" placeholder="Mô tả"></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['product']['content']) && $configAdmin['product']['content'] === true) { ?>
                        <div class="form-group">
                          <label for="content">Nội dung:</label>
                          <textarea class="<?= $configAdmin['product']['content_tiny'] === true ? 'tiny' : '' ?> form-control text-sm form-control-ckeditor" name="content" id="content" rows="5" placeholder="Nội dung"></textarea>
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
                      <label class="d-block" for="id_parent1"><?= $configAdmin['category_product1']['name'] ?>:</label>
                      <select id="id_parent1" name="id_parent1" class="form-control filter-category select2-hidden-accessible" data-url="admin/product/filter_category" tabindex="-1" aria-hidden="true">
                        <option><?= $configAdmin['category_product1']['name'] ?></option>
                        <?php foreach ($categoryProduct1 as $k1 => $v1) { ?>
                          <option value="<?= $v1['id'] ?>">
                            <?= $v1['title'] ?>
                          </option>
                        <?php } ?>
                        <input type="hidden" name="_token_filter_category" value="<?= time() ?>" />
                      </select>
                    </div>
                  <?php } ?>

                  <?php if (isset($configAdmin['product']['category_product2']) && $configAdmin['product']['category_product2'] === true) { ?>
                    <div class="form-group col-xl-6 col-sm-4">
                      <label class="d-block" for="id_parent2"><?= $configAdmin['category_product2']['name'] ?>:</label>
                      <select id="id_parent2" name="id_parent2" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                        <option value="0"><?= $configAdmin['category_product2']['name'] ?></option>
                        <?php foreach ($categoryProduct2 as $k2 => $v2) { ?>
                          <option value="<?= $v2['id'] ?>">
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
              <?php if (isset($configAdmin['product']['status'])) { ?>
                <div class="form-group">
                  <?php if (isset($configAdmin['product']['status_title'])) {
                    foreach ($configAdmin['product']['status_title'] as $kStatus => $vStatus) {
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

              <!-- STT -->
              <?php if (isset($configAdmin['product']['num']) && $configAdmin['product']['num'] === true) { ?>
                <div class="form-group">
                  <label for="numb" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                  <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="num" id="numb" placeholder="Số thứ tự" value="1" />
                </div>
              <?php } ?>
              <?php if (isset($configAdmin['product']['quantity']) && $configAdmin['product']['quantity'] === true) { ?>
                <div class="form-group">
                  <label for="quantity" class="d-inline-block align-middle mb-0 mr-2">Số lượng:</label>
                  <input type="number" class="form-control form-control-mini d-inline-block align-middle text-sm" min="0" name="quantity" id="quantity" placeholder="Số lượng" value="1" />
                </div>
              <?php } ?>

              <div class="row">
                <!-- Code -->
                <?php if (isset($configAdmin['product']['code']) && $configAdmin['product']['code'] === true) { ?>
                  <div class="form-group col-md-6">
                    <label class="d-block" for="code">Mã sản phẩm:</label>
                    <input type="text" class="form-control text-sm" name="code" id="code" placeholder="Mã sản phẩm" />
                  </div>
                <?php } ?>

                <!-- Sale price -->
                <?php if (isset($configAdmin['product']['sale_price']) && $configAdmin['product']['sale_price'] === true) { ?>
                  <div class="form-group col-md-6">
                    <label class="d-block" for="sale_price">Giá bán:</label>
                    <div class="input-group">
                      <input type="text" class="form-control format-price sale_price text-sm" name="sale_price" id="sale_price" placeholder="Giá mới" />
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
                      <input type="text" class="form-control format-price regular_price text-sm" name="regular_price" id="regular_price" placeholder="Giá bán" />
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
                      <input type="text" class="form-control discount text-sm" name="discount" id="discount" placeholder="Chiết khấu" value="" maxlength="3" readonly="" />
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
                    <img class="rounded" src="<?= $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo">
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
                    <img class="rounded" src="<?= $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo">
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
                    <img class="rounded" src="<?= $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo">
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
                    <img class="rounded" src="<?= $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt=" Alt Photo">
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
                          <label for="titlevi">SEO Title:</label>
                        </div>
                        <input type="text" class="form-control check-seo title-seo text-sm" name="title_seo" id="titlevi" placeholder="SEO Title" value="">
                      </div>
                      <div class="form-group">
                        <div class="label-seo">
                          <label for="keywordsvi">SEO Keywords (tối đa 70 ký tự):</label>
                        </div>
                        <input type="text" class="form-control check-seo keywords-seo text-sm" name="keywords" id="keywordsvi" placeholder="SEO Keywords" value="">
                      </div>
                      <div class="form-group">
                        <div class="label-seo">
                          <label for="descriptionvi">SEO Description (tối đa 160 ký tự):</label>
                        </div>
                        <textarea class="form-control check-seo description-seo text-sm" name="description_seo" id="descriptionvi" rows="5" placeholder="SEO Description"></textarea>
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

<?php require(dirname(dirname(__FILE__)) . "/partials/footer.php"); ?>