<?php
require(dirname(dirname(__FILE__)) . "/partials/header.php");
require(dirname(dirname(__FILE__)) . "/partials/sidebar.php");
$options = json_decode($setting['options']);
?>
<div class="content-wrapper" style="min-height: 378px;">
  <!-- Content tab -->
  <section class="content-header text-sm">
    <div class="container-fluid">
      <div class="row">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="" title="Bảng điều khiển">Bảng điều khiển</a></li>
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['setting']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <form class="validation-form" method="POST" action="<?= $configBase['baseUrl'] . "admin/setting/stored?req=setting" ?>" enctype="multipart/form-data">
      <div class="card-footer text-sm sticky-top">
        <button type="submit" name="<?= isset($setting) ? 'save-here' : 'save' ?>" class="btn btn-sm bg-gradient-primary submit-check"><i class="far fa-save mr-2"></i>Lưu</button>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <!-- Content setting -->
          <div class="card card-primary card-outline text-sm">
            <div class="card-header">
              <h3 class="card-title">Nội dung <?= $configAdmin['setting']['name'] ?></h3>
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

                      <?php if (isset($configAdmin['setting']['title']) && $configAdmin['setting']['title'] === true) { ?>
                        <div class="form-group">
                          <label for="title">Tên công ty:</label>
                          <input type="text" class="form-control text-sm" name="title" id="title" value="<?= isset($setting) && !empty($setting['title']) ? $setting['title'] : '' ?>" placeholder="Tên công ty" />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['setting']['address']) && $configAdmin['setting']['address'] === true) { ?>
                        <div class="form-group">
                          <label for="address">Địa chỉ:</label>
                          <input type="text" class="form-control text-sm" name="address" id="address" value="<?= isset($setting) && !empty($setting['address']) ? $setting['address'] : '' ?>" placeholder="Địa chỉ" />
                        </div>
                      <?php } ?>

                      <?php if (isset($configAdmin['setting']['copyright']) && $configAdmin['setting']['copyright'] === true) { ?>
                        <div class="form-group">
                          <label for="copyright">Copyright:</label>
                          <input type="text" class="form-control text-sm" name="copyright" id="copyright" value="<?= isset($setting) && !empty($setting['copyright']) ? $setting['copyright'] : '' ?>" placeholder="Copyright" />
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <?php if (isset($configAdmin['setting']['worktime']) && $configAdmin['setting']['worktime'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="worktime">Thời gian làm việc:</label>
                    <input type="text" class="form-control text-sm" name="options[worktime]" id="worktime" placeholder="Thời gian làm việc" value="<?= isset($options) && !empty($options->worktime) ? $options->worktime : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['email']) && $configAdmin['setting']['email'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control text-sm" name="options[email]" id="email" placeholder="Email" value="<?= isset($options) && !empty($options->email) ? $options->email : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['hotline']) && $configAdmin['setting']['hotline'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="hotline">Hotline:</label>
                    <input type="number" class="form-control text-sm" name="options[hotline]" id="hotline" placeholder="Hotline" value="<?= isset($options) && !empty($options->hotline) ? $options->hotline : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['phone']) && $configAdmin['setting']['phone'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="phone">Điện thoại:</label>
                    <input type="number" class="form-control text-sm" name="options[phone]" id="phone" placeholder="Điện thoại" value="<?= isset($options) && !empty($options->phone) ? $options->phone : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['zalo']) && $configAdmin['setting']['zalo'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="zalo">Zalo:</label>
                    <input type="number" class="form-control text-sm" name="options[zalo]" id="zalo" placeholder="Zalo" value="<?= isset($options) && !empty($options->zalo) ? $options->zalo : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['website']) && $configAdmin['setting']['website'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="website">Website:</label>
                    <input type="text" class="form-control text-sm" name="options[website]" id="website" placeholder="Website" value="<?= isset($options) && !empty($options->website) ? $options->website : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['fanpage']) && $configAdmin['setting']['fanpage'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="fanpage">Fanpage:</label>
                    <input type="text" class="form-control text-sm" name="options[fanpage]" id="fanpage" placeholder="Fanpage" value="<?= isset($options) && !empty($options->fanpage) ? $options->fanpage : '' ?>" />
                  </div>
                <?php } ?>

                <?php if (isset($configAdmin['setting']['link_ggmap']) && $configAdmin['setting']['link_ggmap'] === true) { ?>
                  <div class="form-group col-md-4 col-sm-6">
                    <label for="link_ggmap">Link google map:</label>
                    <input type="text" class="form-control text-sm" name="options[link_ggmap]" id="link_ggmap" placeholder="Link google map" value="<?= isset($options) && !empty($options->link_ggmap) ? $options->link_ggmap : '' ?>" />
                  </div>
                <?php } ?>
              </div>

              <?php if (isset($configAdmin['setting']['iframe_ggmap']) && $configAdmin['setting']['iframe_ggmap'] === true) { ?>
                <div class="form-group">
                  <label for="iframe_ggmap">Iframe google map:</label>
                  <textarea class="form-control text-sm" name="options[iframe_ggmap]" id="iframe_ggmap" rows="5" placeholder="Iframe google map:"><?= isset($options) && !empty($options->iframe_ggmap) ? $options->iframe_ggmap : '' ?></textarea>
                </div>
              <?php } ?>

              <?php if (isset($configAdmin['setting']['headjs']) && $configAdmin['setting']['headjs'] === true) { ?>
                <div class="form-group">
                  <label for="headjs">Head JS:</label>
                  <textarea class="form-control text-sm" name="headjs" id="headjs" rows="5" placeholder="Head JS:"><?= isset($setting) && !empty($setting['headjs']) ? htmlspecialchars_decode($setting['headjs']) : '' ?></textarea>
                </div>
              <?php } ?>
              <?php if (isset($configAdmin['setting']['bodyjs']) && $configAdmin['setting']['bodyjs'] === true) { ?>
                <div class="form-group">
                  <label for="bodyjs">Body JS:</label>
                  <textarea class="form-control text-sm" name="bodyjs" id="bodyjs" rows="5" placeholder="Body JS:"><?= isset($setting) && !empty($setting['bodyjs']) ? htmlspecialchars_decode($setting['bodyjs']) : '' ?></textarea>
                </div>
              <?php } ?>
            </div>
          </div> <!-- End content setting  -->
        </div>
      </div>
    </form>
  </section>
</div>
<?php require(dirname(dirname(__FILE__)) . "/partials/footer.php"); ?>