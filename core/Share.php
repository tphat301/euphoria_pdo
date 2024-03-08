<?php

class Share
{
  public $url;
  public $productModel;
  public $tableProduct;
  public $tableCategoryProduct;
  public $productType;
  public function __construct()
  {
    $this->url = Configurations::configurationsBase()['baseUrl'];
    $this->productModel = 'Product';
    $this->tableProduct = 'products';
    $this->tableCategoryProduct = 'category_products';
    $this->productType = 'san-pham';
  }

  public function main(string $direct = '')
  {
    $d = new Database();
    $uri = Functions::URI(Configurations::configurationsBase()['url']);
    /* Category product query */
    $categoryProduct = $d->select('id, id_parent, level, title, photo1, slug, description, content', 'category_products', "`type` = 'san-pham' AND find_in_set('hienthi',status) AND `deleted_at` IS NULL ORDER BY num,id DESC");
    $categoryProduct = Functions::recursiveCategory($categoryProduct, 0, 'san-pham', $this->url);
    $slogan =  Functions::rawOne($d->select('title', 'static', "`type` = 'slogan'"));
    $logo = Functions::rawOne($d->select('photo, title', 'photo', "`type` = 'logo' AND `action` = 'photo_static'"));
    $favicon = Functions::rawOne($d->select('photo, title', 'photo', "`type` = 'favicon' AND `action` = 'photo_static'"));
    $banner = Functions::rawOne($d->select('photo, title', 'photo', "`type` = 'banner' AND `action` = 'photo_static'"));
    $setting = Functions::rawOne($d->select('*', 'setting', "`type` = 'setting'"));
    $options = json_decode($setting['options']);
    $footer = Functions::rawOne($d->select('title,content', 'static', "`type` = 'footer'"));
    $policy = $d->select('title,slug', 'news', "`type` = 'chinh-sach' AND find_in_set('hienthi',status) ORDER BY num,id DESC");
    $socialFooter = $d->select('title,photo,link', 'photo', "`type` = 'social_footer' AND find_in_set('hienthi',status) ORDER BY num,id DESC");

    include($direct);
  }
}
