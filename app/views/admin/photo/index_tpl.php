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
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['photo'][$type]['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <!-- Content main -->
  <section class="content">
    <form action="" class="form-product-list" method="POST">
      <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?= $configBase['baseUrl'] . 'admin/photo/' . $type . '_create' ?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white delete-all" id="delete-all" href="javascript:void()" title="Xóa tất cả" data-url="<?= $configBase['baseUrl'] . 'admin/photo/delete_all?req=' . $type ?>"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
      </div>

      <div class="card card-primary card-outline text-sm mb-0 rendering">
        <div class="card-header">
          <h3 class="card-title">Danh sách <?= $configAdmin['photo'][$type]['name'] ?></h3>
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
                <th class="align-middle" style="width:30%">Link</th>
                <?php
                if (isset($configAdmin['photo'][$type]['status'])) {
                  foreach ($configAdmin['photo'][$type]['status_title'] as $kStatus => $vStatus) { ?>
                    <th class="align-middle text-center">
                      <?= $vStatus ?>
                    </th>
                <?php }
                } ?>
                <th class="align-middle text-center">Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count(@$items)) { ?>
                <?php foreach (@$items as $k => $v) { ?>
                  <tr>
                    <td class="align-middle">
                      <div class="custom-control custom-checkbox my-checkbox">
                        <input type="checkbox" name="checkitem[]" class="checkitem custom-control-input select-checkbox" id="select-checkbox-36" value="<?= $v['id'] ?>">
                        <input type="hidden" name="hashes[]" value="<?= $v['hash'] ?>">
                        <label for="select-checkbox-36" class="custom-control-label"></label>
                      </div>
                    </td>
                    <td class="align-middle">
                      <input type="number" class="update-num-photo form-control form-control-mini m-auto" min="0" value="<?= $v['num'] ?>" data-id="<?= $v['id'] ?>" data-table="<?= $configAdmin['photo']['table'] ?>">
                      <input name="_token_num" value="<?php echo time() ?>" type="hidden" />
                    </td>
                    <td class="align-middle">
                      <a href="<?= $configBase['baseUrl'] . 'admin/photo/' . $type . '_show?id=' . $v['id'] ?>" title="<?= $v['title'] ?>">
                        <img class="rounded img-preview img-fluid" src="<?= !empty($v['photo']) ? $configBase['baseUrl'] . 'upload/photo/' . $v['photo'] : $configBase['baseUrl'] . 'public/images/noimage.png' ?>" alt="<?= $v['title'] ?>" width="70" height="50" style="object-fit: contain;" />
                      </a>
                    </td>
                    <td class="align-middle">
                      <a class="text-dark text-break" href="<?= $configBase['baseUrl'] . 'admin/photo/' . $type . '_show?id=' . $v['id'] ?>" title="<?= $v['title'] ?>">
                        <?= $v['title'] ?>
                      </a>
                    </td>
                    <td class="align-middle">
                      <?= $v['link'] ?>
                    </td>
                    <?php
                    $statusConfig = $configAdmin['photo'][$type]['status'];
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
                            <input type="checkbox" id="check-sst-photo" class="check-sst-photo custom-control-input show-checkbox" data-table="<?= $configAdmin['photo']['table'] ?>" name="<?= $kStatus ?>" data-id="<?= $v['id'] ?>" <?= in_array($kStatus, $status) && !empty($status) ? 'checked' : '' ?> />
                            <label for="check-sst-photo" class="custom-control-label"></label>
                            <input name="_token" value="<?php echo time() ?>" type="hidden" />
                          </div>
                        </td>
                    <?php }
                    } ?>
                    <td class="align-middle text-center text-md text-nowrap">
                      <a class="text-primary mr-2" href="<?= $configBase['baseUrl'] . 'admin/photo/' . $type . '_show?id=' . $v['id'] ?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                      <a href="javascript:void()" class="text-danger" data-url="<?= $configBase['baseUrl'] . 'admin/photo/delete?id=' . $v['id'] . "&hash=" . $v['hash'] . '&req=' . $type ?>" id="delete-item" title="Xóa vĩnh viễn">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="12"><span class="text-danger">Danh sách <?= $configAdmin['photo'][$type]['name'] ?> trống</span></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Paginate -->
      <?php if (isset($paginate)) {
        echo $paginate;
      }
      ?>
    </form>
  </section>
  <!-- End content main -->

</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>