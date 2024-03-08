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
          <li class="breadcrumb-item active">Quản lý <?= $configAdmin['order']['name'] ?></li>
        </ol>
      </div>
    </div>
  </section>

  <section class="content">
    <form action="" class="form-product-list" method="POST">
      <div class="card card-primary card-outline text-sm mb-0 rendering">
        <div class="card-header">
          <h3 class="card-title">Danh sách <?= $configAdmin['order']['name'] ?></h3>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="align-middle text-center" width="10%">STT</th>
                <th class="align-middle" style="width:30%">Tiêu đề</th>
                <th class="align-middle">Mã đơn hàng</th>
                <th class="align-middle">Trạng thái</th>
                <th class="align-middle">Hình thức thanh toán</th>
                <th class="align-middle">Ngày đặt hàng</th>
                <th class="align-middle text-center">Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($orders)) { ?>
                <?php foreach ($orders as $k => $v) { ?>
                  <tr>
                    <td class="align-middle">
                      <input type="number" class="update-num-order form-control form-control-mini m-auto" min="0" value="<?= $v['number'] ?>" data-id="<?= $v['id_order'] ?>" data-table="<?= $configAdmin['order']['table'] ?>">
                      <input name="_token_num" value="<?php echo time() ?>" type="hidden" />
                    </td>
                    <td class="align-middle">
                      <span><?= $v['fullname'] ?></span>
                    </td>
                    <td class="align-middle">
                      <span><?= $v['code'] ?></span>
                    </td>
                    <td class="align-middle">
                      <?php if ($v['status'] == 0) { ?>
                        <a class="text-warning text-break" href="<?= $configBase['baseUrl'] . "admin/order/status?id=" . $v['id_order'] . "&sst=" . $v['status'] . "&order_code=" . $v['code'] ?>" title="Đợi xác nhận">
                          Đợi xác nhận
                        </a>
                      <?php } else { ?>
                        <span class="text-success">Đã xác nhận <i class="fa-solid fa-circle-check text-success"></i></span>
                      <?php } ?>
                    </td>
                    <td class="align-middle">
                      <span>
                        <?= $v['order_payment'] ?>
                      </span>
                    </td>
                    <td class="align-middle">
                      <span>
                        <?= $v['time_buy'] ?>
                      </span>
                    </td>
                    <td class="align-middle text-center text-md text-nowrap">
                      <a class="text-primary" href="<?= $configBase['baseUrl'] . "admin/order/show?code=" . $v['code'] ?>" title="Xem đơn hàng"><i class="far fa-eye mr-1"></i></a>
                      <a href="javascript:void()" class="text-danger" data-url="<?= $configBase['baseUrl'] . "admin/order/delete?code=" . $v['code'] . "&order_payment=" . $v['order_payment'] ?>" id="delete-item" title="Xóa vĩnh viễn">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="12"><span class="text-danger">Danh sách <?= $configAdmin['order']['name'] ?> trống</span></td>
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
</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>