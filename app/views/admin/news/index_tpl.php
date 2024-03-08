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
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['news']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Content main -->
  <section class="content">
    <form action="" class="form-product-list" method="POST">
      <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?= $configBase['baseUrl'] . 'admin/news/create' ?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>

        <?php if (count($news) !== 0 && isset($configAdmin['news']['soft_delete']) && $configAdmin['news']['soft_delete'] === true) { ?>
          <a class="btn btn-sm bg-gradient-danger text-white delete-all" id="delete-all" href="javascript:void()" title="Xóa tất cả" data-url="<?= $configBase['baseUrl'] . "admin/news/soft_delete_all" ?>"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <?php } else { ?>
          <a class="btn btn-sm bg-gradient-danger text-white delete-all" id="delete-all" href="javascript:void()" title="Xóa tất cả" data-url="<?= $configBase['baseUrl'] . "admin/news/delete_all" ?>"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <?php } ?>

        <?php if (isset($configAdmin['news']['soft_delete']) && $configAdmin['news']['soft_delete'] === true) { ?>
          <a class="btn btn-sm bg-gradient-warning text-dark" id="trash-view" href="<?= $configBase['baseUrl'] . 'admin/news/soft' ?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Thùng rác (<?= isset($softDelete) ? count($softDelete) : 0 ?>)</a>
        <?php } ?>

        <div class="form-inline form-search d-inline-block align-middle ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar text-sm keyword" type="text" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="" data-url="admin/news/index" />
            <div class="input-group-append bg-primary rounded-right">
              <button onclick="onSearch('keyword')" class="btn btn-navbar text-white" type="button">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <?php if (isset($configAdmin['news']['toggle_category']) && $configAdmin['news']['toggle_category'] === true && count($categoryNews1) > 0 && count($news) > 0) { ?>
        <div class="card-footer form-group-category text-sm bg-light row">
          <?php if (isset($configAdmin['news']['category_news1']) && $configAdmin['news']['category_news1'] === true && count($categoryNews1) > 0) { ?>
            <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
              <select id="id_parent1" name="id_parent1" class="form-control filter-category-rendering select2 select2-hidden-accessible" data-field="id_parent1" tabindex="-1" data-url="admin/news/index" aria-hidden="true">
                <option><?= $configAdmin['category_news1']['name'] ?></option>
                <?php foreach ($categoryNews1 as $k1 => $v1) { ?>
                  <option value="<?= $v1['id'] ?>">
                    <?= $v1['title'] ?>
                  </option>
                <?php } ?>
                <input type="hidden" name="_token_filter_category" value="<?= time() ?>" />
              </select>
            </div>
          <?php } ?>

          <?php if (isset($configAdmin['news']['category_news2']) && $configAdmin['news']['category_news2'] === true && count($categoryNews2) > 0) { ?>
            <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
              <select id="id_parent2" name="id_parent2" class="form-control select2 select2-hidden-accessible filter-category-rendering select2" data-url="admin/news/index" tabindex="-1" aria-hidden="true">
                <option><?= $configAdmin['category_news2']['name'] ?></option>
                <?php foreach ($categoryNews2 as $k2 => $v2) { ?>
                  <option value="<?= $v2['id'] ?>">
                    <?= $v2['title'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>

          <?php if (isset($configAdmin['news']['category_news3']) && $configAdmin['news']['category_news3'] === true && count($categoryNews3) > 0) { ?>
            <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
              <select id="id_parent3" name="id_parent3" class="form-control select2 select2-hidden-accessible filter-category-rendering select2" data-url="admin/news/index" tabindex="-1" aria-hidden="true">
                <option><?= $configAdmin['category_news3']['name'] ?></option>
                <?php foreach ($categoryNews3 as $k3 => $v3) { ?>
                  <option value="<?= $v3['id'] ?>">
                    <?= $v3['title'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>

          <?php if (isset($configAdmin['news']['category_news4']) && $configAdmin['news']['category_news4'] === true && count($categoryNews3) > 0) { ?>
            <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
              <select id="id_parent4" name="id_parent4" class="form-control select2 select2-hidden-accessible filter-category-rendering select2" data-url="admin/news/index" tabindex="-1" aria-hidden="true">
                <option><?= $configAdmin['category_news4']['name'] ?></option>
                <?php foreach ($categoryNews3 as $k4 => $v4) { ?>
                  <option value="<?= $v4['id'] ?>">
                    <?= $v4['title'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>
        </div>
      <?php } ?>

      <div class="card card-primary card-outline text-sm mb-0 rendering">
        <div class="card-header">
          <h3 class="card-title">Danh sách <?= $configAdmin['news']['name'] ?></h3>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="align-middle" width="5%">
                  <div class="custom-control custom-checkbox my-checkbox">
                    <input type="checkbox" class="checkall custom-control-input" id="selectall-checkbox">
                    <label for="selectall-checkbox" class="custom-control-label"></label>
                  </div>
                </th>
                <th class="align-middle text-center" width="10%">STT</th>
                <th class="align-middle">Hình ảnh</th>
                <th class="align-middle" style="width:30%">Tiêu đề</th>
                <?php
                if (isset($configAdmin['news']['status'])) {
                  foreach ($configAdmin['news']['status_title'] as $kStatus => $vStatus) { ?>
                    <th class="align-middle text-center">
                      <?= $vStatus ?>
                    </th>
                <?php }
                } ?>
                <th class="align-middle text-center">Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($news)) { ?>
                <?php foreach ($news as $k => $v) { ?>
                  <tr>
                    <td class="align-middle">
                      <div class="custom-control custom-checkbox my-checkbox">
                        <input type="checkbox" name="checkitem[]" class="checkitem custom-control-input select-checkbox" id="select-checkbox-36" value="<?= $v['id'] ?>">
                        <input type="hidden" name="hashes[]" value="<?= $v['hash'] ?>">
                        <label for="select-checkbox-36" class="custom-control-label"></label>
                      </div>
                    </td>
                    <td class="align-middle">
                      <input type="number" class="update-num-news form-control form-control-mini m-auto update-numb" min="0" value="<?= $v['num'] ?>" data-id="<?= $v['id'] ?>" data-table="<?= $configAdmin['news']['table'] ?>">
                      <input name="_token_num" value="<?php echo time() ?>" type="hidden" />
                    </td>
                    <td class="align-middle">
                      <a href="<?= $configBase['baseUrl'] . "admin/news/show?id=" . $v['id'] ?>" title="<?= $v['title'] ?>">
                        <img class="rounded img-preview img-fluid" src="<?= !empty($v['photo1']) ? $configBase['baseUrl'] . 'upload/news/' . $v['photo1'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>" width="70" height="50" style="object-fit: contain;" />
                      </a>
                    </td>
                    <td class="align-middle">
                      <a class="text-dark text-break" href="<?= $configBase['baseUrl'] . "admin/news/show?id=" . $v['id'] ?>" title="<?= $v['title'] ?>">
                        <?= $v['title'] ?>
                      </a>
                    </td>
                    <?php
                    $statusConfig = $configAdmin['news']['status'];
                    if (isset($statusConfig)) {
                      if (!empty($v['status'])) {
                        $status = explode(",", $v['status']);
                      } else {
                        $status = [];
                      }
                      foreach ($statusConfig as $kStatus => $vStatus) {
                    ?>
                        <td class="align-middle text-center">
                          <div class="custom-control custom-checkbox my-checkbox">
                            <input type="checkbox" class="check-sst-news custom-control-input show-checkbox" id="check-sst-news" data-table="<?= $configAdmin['news']['table'] ?>" name="<?= $kStatus ?>" data-id="<?= $v['id'] ?>" <?= in_array($kStatus, $status) && !empty($status) ? 'checked' : '' ?> />
                            <label for="check-sst-news" class="custom-control-label"></label>
                            <input name="_token" value="<?php echo time() ?>" type="hidden" />
                          </div>
                        </td>
                    <?php }
                    } ?>
                    <td class="align-middle text-center text-md text-nowrap">
                      <a class="text-primary mr-2" href="<?= $configBase['baseUrl'] . "admin/news/show?id=" . $v['id'] ?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                      <div class="dropdown d-inline-block align-middle">
                        <a id="dropdownCopy" href="<?= $configBase['baseUrl'] . "admin/news/duplicate?id=" . $v['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link text-success p-0 pr-2" title="Copy">
                          <i class="far fa-clone"></i>
                        </a>
                      </div>
                      <?php if (isset($configAdmin['news']['soft_delete']) && $configAdmin['news']['soft_delete'] === true) { ?>
                        <a href="<?= $configBase['baseUrl'] . "admin/news/soft_delete?id=" . $v['id'] ?>" class="text-danger" id="delete-item" title="Xóa tạm thời">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      <?php } else { ?>
                        <a href="javascript:void()" class="text-danger" data-url="<?= $configBase['baseUrl'] . "admin/news/delete?id=" . $v['id'] . "&hash=" . $v['hash'] ?>" id="delete-item" title="Xóa vĩnh viễn">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="12"><span class="text-danger">Danh sách <?= $configAdmin['news']['name'] ?> trống</span></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Paginate -->
      <?php if (isset($paginate)) {
        echo $paginate;
      } ?>
    </form>
  </section>
  <!-- End content main -->
</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>