<div class="col-md-12 form-group inputs-main">
  <form class="form-opt-product" method="POST" enctype="multipart/form-data">
    <div class="d-flex row">
      <div class="col-2 d-flex flex-column justify-content-between align-item-center mt-1">
        <label for="color" class="d-block w-100">Màu sắc:</label>
        <select name="options[color]" class="color form-select py-2 border">
          <option value="">Chọn màu sắc</option>
          <?php if (isset($colors) && count($colors) > 0) {
            foreach ($colors as $k => $v) {
          ?>
              <option value="<?= $v['id_color'] ?>"><?= $v['name_color'] ?></option>
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
              <option value="<?= $v['id_size'] ?>"><?= $v['name_size'] ?></option>
          <?php }
          } ?>
        </select>
      </div>
      <div class="col-1 d-flex align-items-center">
        <div class="mr-2">
          <label for="" class="d-block" style="opacity: 0;">Lưu</label>
          <button type="submit" class="btn btn-primary bg-gradient-primary mt-1 btn-save-option">
            <i class="far fa-save mr-2 text-white"></i>
          </button>
        </div>
        <div>
          <label for="" class="d-block" style="opacity: 0;">Xóa</label>
          <div class="btn btn-danger mt-1 btn-delete-option" onclick="this.parentNode.parentNode.parentNode.parentNode.remove()">
            <i class="fas fa-trash-alt text-white"></i>
          </div>
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
                <div class="input-group d-flex align-items-center">
                  <input type="file" name="photo_color" class="form-control format-price-opt photo_color_opt text-sm" />
                </div>
              </div>
              <div class="form-group col-2">
                <label class="d-block" for="regular_price">Giá cũ (nếu có):</label>
                <div class="input-group">
                  <input type="text" class="form-control format-price-opt regular_price_opt text-sm" name="options[regular_price]" placeholder="Giá bán" value="" />
                  <div class="input-group-append">
                    <div class="input-group-text"><strong>VNĐ</strong></div>
                  </div>
                </div>
              </div>
              <div class="form-group col-2">
                <label class="d-block" for="sale_price">Giá bán:</label>
                <div class="input-group">
                  <input type="text" class="form-control format-price-opt sale_price_opt text-sm" name="options[sale_price]" value="" placeholder="Giá mới" />
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
                  <input type="text" class="form-control discount_opt text-sm" name="options[discount]" placeholder="Chiết khấu" value="" maxlength="3" readonly="" />
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