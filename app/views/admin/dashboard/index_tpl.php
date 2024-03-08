<?php
require(dirname(dirname(__FILE__)) . "/partials/header.php");
require(dirname(dirname(__FILE__)) . "/partials/sidebar.php");
?>
<div class="content-wrapper" style="min-height: 378px;">
  <section class="content pb-4 pt-3">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Thống kê doanh thu bán hàng <span id="text-date"></span></h5>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <select class="form-control col-md-6" id="select-date-chart">
              <option value="">Chọn thống kê theo ngày</option>
              <option value="7ngayqua">7 ngày qua</option>
              <option value="14ngayqua">14 ngày qua</option>
              <option value="28ngayqua">28 ngày qua</option>
              <option value="365ngayqua">365 ngày qua</option>
            </select>
          </div>
          <div id="myfirstchart" style="height: 450px;"></div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
require(dirname(dirname(__FILE__)) . "/partials/footer.php");
?>