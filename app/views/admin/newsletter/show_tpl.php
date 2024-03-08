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
          <li class="breadcrumb-item active">Quản lý tin tức</li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/newsletter/stored?id=" . $newsletterDetail['id'] ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="update" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
        <button type="submit" class="btn btn-sm bg-gradient-success submit-check" name="save-here"><i class="far fa-save mr-2"></i>Lưu tại trang</button>
        <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/newsletter/index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
      </div>
      <div class="row">
        <div class="col-xl-12">

          <!-- Content newsletter -->
          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Nội dung <?= $configAdmin['newsletter']['name'] ?></h3>
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

                      <?php if (isset($configAdmin['newsletter']['fullname']) && $configAdmin['newsletter']['fullname'] === true) { ?>
                        <div class="form-group">
                          <label for="fullname">Họ tên:</label>
                          <input type="text" class="form-control text-sm" name="fullname" id="fullname" placeholder="Họ tên" value="<?= isset($newsletterDetail['fullname']) ? $newsletterDetail['fullname'] : '' ?>" required />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['newsletter']['email']) && $configAdmin['newsletter']['email'] === true) { ?>
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control text-sm" name="email" id="email" placeholder="Email" value="<?= isset($newsletterDetail['email']) ? $newsletterDetail['email'] : '' ?>" required />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['newsletter']['phone']) && $configAdmin['newsletter']['phone'] === true) { ?>
                        <div class="form-group">
                          <label for="phone">Số điện thoại:</label>
                          <input type="number" class="form-control text-sm" name="phone" id="phone" placeholder="Số điện thoại" value="<?= isset($newsletterDetail['phone']) ? $newsletterDetail['phone'] : '' ?>" />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['newsletter']['address']) && $configAdmin['newsletter']['address'] === true) { ?>
                        <div class="form-group">
                          <label for="address">Địa chỉ:</label>
                          <input type="text" class="form-control text-sm" name="address" id="address" placeholder="Địa chỉ" value="<?= isset($newsletterDetail['address']) ? $newsletterDetail['address'] : '' ?>" />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['newsletter']['note']) && $configAdmin['newsletter']['note'] === true) { ?>
                        <div class="form-group">
                          <label for="note">Ghi chú:</label>
                          <textarea class="form-control text-sm" name="note" id="note" rows="5" placeholder="Ghi chú"><?= isset($newsletterDetail['note']) ? $newsletterDetail['note'] : '' ?></textarea>
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['newsletter']['subject']) && $configAdmin['newsletter']['subject'] === true) { ?>
                        <div class="form-group">
                          <label for="subject">Chủ đề:</label>
                          <textarea class="form-control text-sm" name="subject" id="subject" rows="5" placeholder="Chủ đề"><?= isset($newsletterDetail['subject']) ? $newsletterDetail['subject'] : '' ?></textarea>
                        </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End content product  -->

        </div>
      </div>
    </form>
  </section>
</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>