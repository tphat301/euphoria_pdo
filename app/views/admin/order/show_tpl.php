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
          <li class="breadcrumb-item active">Quản lý chi tiết đơn hàng</li>
        </ol>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card-footer text-sm sticky-top">
      <a class="btn btn-sm bg-gradient-danger" href="<?= $configBase['baseUrl'] . 'admin/order/index' ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
    <div class="card card-primary card-outline text-sm mb-0 rendering">
      <div class="card-header">
        <h3 class="card-title">Danh sách chi tiết đơn hàng</h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="align-middle text-center" width="10%">STT</th>
              <th class="align-middle" style="width:30%">Tiêu đề</th>
              <th class="align-middle">Mã đơn hàng</th>
              <th class="align-middle">Số lượng</th>
              <th class="align-middle">Đơn giá</th>
              <th class="align-middle">Tình trạng</th>
              <th class="align-middle">Ngân hàng (nếu có)</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($orders)) { ?>
              <?php
              $totalPrice = 0;
              $totalQty = 0;
              foreach ($orders as $k => $v) {
                $totalQty += $v['qty'];
                $totalPrice += $v['qty'] * $v['sale_price'];
              ?>
                <tr>
                  <td class="align-middle">
                    <input type="number" class="update-num-order-detail form-control form-control-mini m-auto" min="0" value="<?= $v['numb'] ?>" data-id="<?= $v['id_order_detail'] ?>" data-table="orders_detail" />
                    <input name="_token_num" value="<?php echo time() ?>" type="hidden" />
                  </td>
                  <td class="align-middle">
                    <span><?= $v['title'] ?></span>
                  </td>
                  <td class="align-middle">
                    <span><?= $v['code_order_detail'] ?></span>
                  </td>
                  <td class="align-middle">
                    <span>
                      <?= $v['qty'] ?>
                    </span>
                  </td>
                  <td class="align-middle">
                    <span>
                      <?= number_format($v['sale_price'], 0, ",", ".") . ' đ' ?>
                    </span>
                  </td>
                  <td class="align-middle">
                    <?php if ($v['status'] == 0) { ?>
                      <span class="text-warning">Đợi xác nhận</span>
                    <?php } else { ?>
                      <span class="text-success">Đã xác nhận <i class="fa-solid fa-circle-check text-success"></i></span>
                    <?php } ?>
                  </td>
                  <?php if (!empty($v['vnp_bankcode'])) { ?>
                    <td class="align-middle">
                      <span>
                        <?= $v['vnp_bankcode'] ?>
                      </span>
                    </td>
                  <?php } else { ?>
                    <td class="align-middle"></td>
                  <?php } ?>
                </tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="12"><span class="text-danger">Danh sách chi tiết đơn hàng trống</span></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="card-header">
          <div><strong>Số lượng đơn:</strong> <?= $totalQty ?></div>
          <div><strong>Tổng tiền đơn hàng:</strong> <?= number_format($totalPrice, 0, ",", ".") . ' đ' ?></div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>