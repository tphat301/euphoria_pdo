<?php

final class Web extends Routers
{
  public static function init()
  {
    /* CLIENT ROUTER */
    Routers::get('/', "HomeController@index");
    Routers::get('/tin-tuc', "NewsController@index");
    Routers::get('/san-pham', "ProductController@index");
    Routers::get('/gioi-thieu', "AboutController@index");

    /* Cart */
    Routers::get('/cart', "CartController@index");
    Routers::get('/cart/add', "CartController@add");
    Routers::get('/cart/destroy', "CartController@destroy");
    Routers::get('/cart/delete', "CartController@delete");
    Routers::get('/cart/update', "CartController@update");
    Routers::get('/cart/thank', "CartController@thank");
    Routers::get('/cart/vnpay', "CartController@vnpayStored");
    Routers::get('/cart/momo_stored', "CartController@momoStored");
    Routers::post('/cart/momo_atm', "CartController@momoAtm");
    Routers::post('/cart/checkout', "CartController@checkout");

    // Search 
    Routers::get('/search', "SearchController@index");
    Routers::get('/404', 'NotFoundController@index');

    // User Accout
    Routers::get('/register', "UserController@register");
    Routers::get('/login', "UserController@login");
    Routers::get('/logout', "UserController@logout");
    Routers::get('/reset_password', "UserController@resetPassword");
    Routers::get('/reset_password/reset_token', "UserController@newPassword");
    Routers::get('/register/active_token', "UserController@activeToken");
    Routers::post('/reset_password/stored', "UserController@resetPasswordStore");
    Routers::post('/reset_password/new_password', "UserController@newPasswordStore");
    Routers::post('/login/stored', "UserController@loginStored");
    Routers::post('/register/stored', "UserController@registerStored");

    // New
    Routers::get('/tin-tuc', "NewsController@index");

    // Policy
    Routers::get('/chinh-sach', "PolicyController@index");

    // Newsletter
    Routers::post('/newsletter/stored', "NewsletterController@stored");


    /** ADMIN ROUTER **/
    Routers::get('/admin', "AuthenticationAdminController@login");
    Routers::get('/admin/logout', "AuthenticationAdminController@logout");
    Routers::post('/admin/login/stored', "AuthenticationAdminController@stored");
    if (isset($_SESSION['login_admin'])) {
      /*Dashboard*/
      Routers::get('/admin/dashboard', "DashboardAdminController@index");
      Routers::post('/admin/dashboard/chart', "DashboardAdminController@chart");

      /* Product */
      Routers::get('/admin/product/color/show', "ProductAdminController@showColor");
      Routers::get('/admin/product/color/index', "ProductAdminController@indexColor");
      Routers::get('/admin/product/color/create', "ProductAdminController@createColor");
      Routers::get('/admin/product/size/show', "ProductAdminController@showSize");
      Routers::get('/admin/product/size/index', "ProductAdminController@indexSize");
      Routers::get('/admin/product/size/create', "ProductAdminController@createSize");
      Routers::get('/admin/product/option/load_data', "ProductAdminController@loadSizeColor");
      Routers::get('/admin/product/index', "ProductAdminController@index");
      Routers::get('/admin/product/create', "ProductAdminController@create");
      Routers::get('/admin/product/show', "ProductAdminController@show");
      Routers::get('/admin/product/delete', "ProductAdminController@destroy");
      Routers::get('/admin/product/size/delete', "ProductAdminController@destroySize");
      Routers::get('/admin/product/color/delete', "ProductAdminController@destroyColor");
      Routers::get('/admin/product/delete_photo', "ProductAdminController@deletePhoto");
      Routers::get('/admin/product/option/delete', "ProductAdminController@deleteOption");
      Routers::get('/admin/product/delete_gallery', "ProductAdminController@destroyGallery");
      Routers::get('/admin/product/soft_delete', "ProductAdminController@softDelete");
      Routers::get('/admin/product/duplicate', "ProductAdminController@duplicate");
      Routers::get('/admin/product/soft', "ProductAdminController@softDeleteIndex");
      Routers::get('/admin/product/restore', "ProductAdminController@restore");
      Routers::post('/admin/product/stored', "ProductAdminController@stored");
      Routers::post('/admin/product/ajax_status', "ProductAdminController@ajaxStatus");
      Routers::post('/admin/product/ajax_num', "ProductAdminController@ajaxNumber");
      Routers::post('/admin/product/size/ajax_num', "ProductAdminController@ajaxNumberSize");
      Routers::post('/admin/product/color/ajax_num', "ProductAdminController@ajaxNumberColor");
      Routers::post('/admin/product/delete_all', "ProductAdminController@deleteAll");
      Routers::post('/admin/product/size/delete_all', "ProductAdminController@deleteAllSize");
      Routers::post('/admin/product/color/delete_all', "ProductAdminController@deleteAllColor");
      Routers::post('/admin/product/soft_delete_all', "ProductAdminController@softDeleteAll");
      Routers::post('/admin/product/restore_all', "ProductAdminController@restoreAll");
      Routers::post('/admin/product/update_title_gallery', "ProductAdminController@updateTitleGallery");
      Routers::post('/admin/product/upload_gallery', "ProductAdminController@uploadGallery");
      Routers::post('/admin/product/filter_category', "ProductAdminController@filterCategory");
      Routers::post('/admin/product/size/stored', "ProductAdminController@storedSize");
      Routers::post('/admin/product/color/stored', "ProductAdminController@storedColor");
      Routers::post('/admin/product/option_stored', "ProductAdminController@optionStored");

      /* Category product level 1 */
      Routers::get('/admin/category_product1/index', "CategoryProduct1Admin@index");
      Routers::get('/admin/category_product1/create', "CategoryProduct1Admin@create");
      Routers::get('/admin/category_product1/show', "CategoryProduct1Admin@show");
      Routers::get('/admin/category_product1/delete', "CategoryProduct1Admin@destroy");
      Routers::get('/admin/category_product1/delete_photo', "CategoryProduct1Admin@deletePhoto");
      Routers::get('/admin/category_product1/soft_delete', "CategoryProduct1Admin@softDelete");
      Routers::get('/admin/category_product1/duplicate', "CategoryProduct1Admin@duplicate");
      Routers::get('/admin/category_product1/soft', "CategoryProduct1Admin@softDeleteIndex");
      Routers::get('/admin/category_product1/restore', "CategoryProduct1Admin@restore");
      Routers::post('/admin/category_product1/stored', "CategoryProduct1Admin@stored");
      Routers::post('/admin/category_product1/ajax_status', "CategoryProduct1Admin@ajaxStatus");
      Routers::post('/admin/category_product1/ajax_num', "CategoryProduct1Admin@ajaxNumber");
      Routers::post('/admin/category_product1/delete_all', "CategoryProduct1Admin@deleteAll");
      Routers::post('/admin/category_product1/soft_delete_all', "CategoryProduct1Admin@softDeleteAll");
      Routers::post('/admin/category_product1/restore_all', "CategoryProduct1Admin@restoreAll");

      /* Category product level 2 */
      Routers::get('/admin/category_product2/index', "CategoryProduct2Admin@index");
      Routers::get('/admin/category_product2/create', "CategoryProduct2Admin@create");
      Routers::get('/admin/category_product2/show', "CategoryProduct2Admin@show");
      Routers::get('/admin/category_product2/delete', "CategoryProduct2Admin@destroy");
      Routers::get('/admin/category_product2/delete_photo', "CategoryProduct2Admin@deletePhoto");
      Routers::get('/admin/category_product2/soft_delete', "CategoryProduct2Admin@softDelete");
      Routers::get('/admin/category_product2/duplicate', "CategoryProduct2Admin@duplicate");
      Routers::get('/admin/category_product2/soft', "CategoryProduct2Admin@softDeleteIndex");
      Routers::get('/admin/category_product2/restore', "CategoryProduct2Admin@restore");
      Routers::post('/admin/category_product2/stored', "CategoryProduct2Admin@stored");
      Routers::post('/admin/category_product2/ajax_status', "CategoryProduct2Admin@ajaxStatus");
      Routers::post('/admin/category_product2/ajax_num', "CategoryProduct2Admin@ajaxNumber");
      Routers::post('/admin/category_product2/delete_all', "CategoryProduct2Admin@deleteAll");
      Routers::post('/admin/category_product2/soft_delete_all', "CategoryProduct2Admin@softDeleteAll");
      Routers::post('/admin/category_product2/restore_all', "CategoryProduct2Admin@restoreAll");

      /* Category product level 3 */
      Routers::get('/admin/category_product3/index', "CategoryProduct3Admin@index");
      Routers::get('/admin/category_product3/create', "CategoryProduct3Admin@create");
      Routers::get('/admin/category_product3/show', "CategoryProduct3Admin@show");
      Routers::get('/admin/category_product3/delete', "CategoryProduct3Admin@destroy");
      Routers::get('/admin/category_product3/delete_photo', "CategoryProduct3Admin@deletePhoto");
      Routers::get('/admin/category_product3/soft_delete', "CategoryProduct3Admin@softDelete");
      Routers::get('/admin/category_product3/duplicate', "CategoryProduct3Admin@duplicate");
      Routers::get('/admin/category_product3/soft', "CategoryProduct3Admin@softDeleteIndex");
      Routers::get('/admin/category_product3/restore', "CategoryProduct3Admin@restore");
      Routers::post('/admin/category_product3/stored', "CategoryProduct3Admin@stored");
      Routers::post('/admin/category_product3/ajax_status', "CategoryProduct3Admin@ajaxStatus");
      Routers::post('/admin/category_product3/ajax_num', "CategoryProduct3Admin@ajaxNumber");
      Routers::post('/admin/category_product3/delete_all', "CategoryProduct3Admin@deleteAll");
      Routers::post('/admin/category_product3/soft_delete_all', "CategoryProduct3Admin@softDeleteAll");
      Routers::post('/admin/category_product3/restore_all', "CategoryProduct3Admin@restoreAll");

      /* Category product level 4 */
      Routers::get('/admin/category_product4/index', "CategoryProduct4Admin@index");
      Routers::get('/admin/category_product4/create', "CategoryProduct4Admin@create");
      Routers::get('/admin/category_product4/show', "CategoryProduct4Admin@show");
      Routers::get('/admin/category_product4/delete', "CategoryProduct4Admin@destroy");
      Routers::get('/admin/category_product4/delete_photo', "CategoryProduct4Admin@deletePhoto");
      Routers::get('/admin/category_product4/soft_delete', "CategoryProduct4Admin@softDelete");
      Routers::get('/admin/category_product4/duplicate', "CategoryProduct4Admin@duplicate");
      Routers::get('/admin/category_product4/soft', "CategoryProduct4Admin@softDeleteIndex");
      Routers::get('/admin/category_product4/restore', "CategoryProduct4Admin@restore");
      Routers::post('/admin/category_product4/stored', "CategoryProduct4Admin@stored");
      Routers::post('/admin/category_product4/ajax_status', "CategoryProduct4Admin@ajaxStatus");
      Routers::post('/admin/category_product4/ajax_num', "CategoryProduct4Admin@ajaxNumber");
      Routers::post('/admin/category_product4/delete_all', "CategoryProduct4Admin@deleteAll");
      Routers::post('/admin/category_product4/soft_delete_all', "CategoryProduct4Admin@softDeleteAll");
      Routers::post('/admin/category_product4/restore_all', "CategoryProduct4Admin@restoreAll");

      // Gallery router
      Routers::get('/admin/gallery/delete', "GalleryAdminController@destroy");

      /* News */
      Routers::get('/admin/news/index', "NewsAdminController@index");
      Routers::get('/admin/news/create', "NewsAdminController@create");
      Routers::get('/admin/news/show', "NewsAdminController@show");
      Routers::get('/admin/news/delete', "NewsAdminController@destroy");
      Routers::get('/admin/news/delete_photo', "NewsAdminController@deletePhoto");
      Routers::get('/admin/news/delete_gallery', "NewsAdminController@destroyGallery");
      Routers::get('/admin/news/soft_delete', "NewsAdminController@softDelete");
      Routers::get('/admin/news/duplicate', "NewsAdminController@duplicate");
      Routers::get('/admin/news/soft', "NewsAdminController@softDeleteIndex");
      Routers::get('/admin/news/restore', "NewsAdminController@restore");
      Routers::post('/admin/news/stored', "NewsAdminController@stored");
      Routers::post('/admin/news/ajax_status', "NewsAdminController@ajaxStatus");
      Routers::post('/admin/news/ajax_num', "NewsAdminController@ajaxNumber");
      Routers::post('/admin/news/delete_all', "NewsAdminController@deleteAll");
      Routers::post('/admin/news/soft_delete_all', "NewsAdminController@softDeleteAll");
      Routers::post('/admin/news/restore_all', "NewsAdminController@restoreAll");
      Routers::post('/admin/news/update_title_gallery', "NewsAdminController@updateTitleGallery");
      Routers::post('/admin/news/upload_gallery', "NewsAdminController@uploadGallery");
      Routers::post('/admin/news/filter_category', "NewsAdminController@filterCategory");

      /* Category news level 1 */
      Routers::get('/admin/category_news1/index', "CategoryNews1Admin@index");
      Routers::get('/admin/category_news1/create', "CategoryNews1Admin@create");
      Routers::get('/admin/category_news1/show', "CategoryNews1Admin@show");
      Routers::get('/admin/category_news1/delete', "CategoryNews1Admin@destroy");
      Routers::get('/admin/category_news1/delete_photo', "CategoryNews1Admin@deletePhoto");
      Routers::get('/admin/category_news1/soft_delete', "CategoryNews1Admin@softDelete");
      Routers::get('/admin/category_news1/duplicate', "CategoryNews1Admin@duplicate");
      Routers::get('/admin/category_news1/soft', "CategoryNews1Admin@softDeleteIndex");
      Routers::get('/admin/category_news1/restore', "CategoryNews1Admin@restore");
      Routers::post('/admin/category_news1/stored', "CategoryNews1Admin@stored");
      Routers::post('/admin/category_news1/ajax_status', "CategoryNews1Admin@ajaxStatus");
      Routers::post('/admin/category_news1/ajax_num', "CategoryNews1Admin@ajaxNumber");
      Routers::post('/admin/category_news1/delete_all', "CategoryNews1Admin@deleteAll");
      Routers::post('/admin/category_news1/soft_delete_all', "CategoryNews1Admin@softDeleteAll");
      Routers::post('/admin/category_product1/restore_all', "CategoryNews1Admin@restoreAll");

      /* Category news level 2 */
      Routers::get('/admin/category_news2/index', "CategoryNews2Admin@index");
      Routers::get('/admin/category_news2/create', "CategoryNews2Admin@create");
      Routers::get('/admin/category_news2/show', "CategoryNews2Admin@show");
      Routers::get('/admin/category_news2/delete', "CategoryNews2Admin@destroy");
      Routers::get('/admin/category_news2/delete_photo', "CategoryNews2Admin@deletePhoto");
      Routers::get('/admin/category_news2/soft_delete', "CategoryNews2Admin@softDelete");
      Routers::get('/admin/category_news2/duplicate', "CategoryNews2Admin@duplicate");
      Routers::get('/admin/category_news2/soft', "CategoryNews2Admin@softDeleteIndex");
      Routers::get('/admin/category_news2/restore', "CategoryNews2Admin@restore");
      Routers::post('/admin/category_news2/stored', "CategoryNews2Admin@stored");
      Routers::post('/admin/category_news2/ajax_status', "CategoryNews2Admin@ajaxStatus");
      Routers::post('/admin/category_news2/ajax_num', "CategoryNews2Admin@ajaxNumber");
      Routers::post('/admin/category_news2/delete_all', "CategoryNews2Admin@deleteAll");
      Routers::post('/admin/category_news2/soft_delete_all', "CategoryNews2Admin@softDeleteAll");
      Routers::post('/admin/category_news2/restore_all', "CategoryNews2Admin@restoreAll");

      /* Category news level 3 */
      Routers::get('/admin/category_news3/index', "CategoryNews3Admin@index");
      Routers::get('/admin/category_news3/create', "CategoryNews3Admin@create");
      Routers::get('/admin/category_news3/show', "CategoryNews3Admin@show");
      Routers::get('/admin/category_news3/delete', "CategoryNews3Admin@destroy");
      Routers::get('/admin/category_news3/delete_photo', "CategoryNews3Admin@deletePhoto");
      Routers::get('/admin/category_news3/soft_delete', "CategoryNews3Admin@softDelete");
      Routers::get('/admin/category_news3/duplicate', "CategoryNews3Admin@duplicate");
      Routers::get('/admin/category_news3/soft', "CategoryNews3Admin@softDeleteIndex");
      Routers::get('/admin/category_news3/restore', "CategoryNews3Admin@restore");
      Routers::post('/admin/category_news3/stored', "CategoryNews3Admin@stored");
      Routers::post('/admin/category_news3/ajax_status', "CategoryNews3Admin@ajaxStatus");
      Routers::post('/admin/category_news3/ajax_num', "CategoryNews3Admin@ajaxNumber");
      Routers::post('/admin/category_news3/delete_all', "CategoryNews3Admin@deleteAll");
      Routers::post('/admin/category_news3/soft_delete_all', "CategoryNews3Admin@softDeleteAll");
      Routers::post('/admin/category_news3/restore_all', "CategoryNews3Admin@restoreAll");

      /* Category news level 4 */
      Routers::get('/admin/category_news4/index', "CategoryNews4Admin@index");
      Routers::get('/admin/category_news4/create', "CategoryNews4Admin@create");
      Routers::get('/admin/category_news4/show', "CategoryNews4Admin@show");
      Routers::get('/admin/category_news4/delete', "CategoryNews4Admin@destroy");
      Routers::get('/admin/category_news4/delete_photo', "CategoryNews4Admin@deletePhoto");
      Routers::get('/admin/category_news4/soft_delete', "CategoryNews4Admin@softDelete");
      Routers::get('/admin/category_news4/duplicate', "CategoryNews4Admin@duplicate");
      Routers::get('/admin/category_news4/soft', "CategoryNews4Admin@softDeleteIndex");
      Routers::get('/admin/category_news4/restore', "CategoryNews4Admin@restore");
      Routers::post('/admin/category_news4/stored', "CategoryNews4Admin@stored");
      Routers::post('/admin/category_news4/ajax_status', "CategoryNews4Admin@ajaxStatus");
      Routers::post('/admin/category_news4/ajax_num', "CategoryNews4Admin@ajaxNumber");
      Routers::post('/admin/category_news4/delete_all', "CategoryNews4Admin@deleteAll");
      Routers::post('/admin/category_news4/soft_delete_all', "CategoryNews4Admin@softDeleteAll");
      Routers::post('/admin/category_news4/restore_all', "CategoryNews4Admin@restoreAll");

      /* Static router */
      Routers::get('/admin/static/about', "StaticAdminController@about");
      Routers::get('/admin/static/slogan', "StaticAdminController@slogan");
      Routers::get('/admin/static/contact', "StaticAdminController@contact");
      Routers::get('/admin/static/footer', "StaticAdminController@footer");
      Routers::get('/admin/static/delete_photo', "StaticAdminController@deletePhoto");
      Routers::post('/admin/static/stored', "StaticAdminController@stored");

      /* Setting router */
      Routers::get('/admin/setting/index', "SettingAdminController@index");
      Routers::post('/admin/setting/stored', "SettingAdminController@stored");

      /* Newsletter router */
      Routers::get('/admin/newsletter/index', "NewsletterAdminController@index");
      Routers::get('/admin/newsletter/create', "NewsletterAdminController@create");
      Routers::post('/admin/newsletter/stored', "NewsletterAdminController@stored");
      Routers::post('/admin/newsletter/ajax_num', "NewsletterAdminController@ajaxNumber");
      Routers::get('/admin/newsletter/show', "NewsletterAdminController@show");
      Routers::get('/admin/newsletter/delete', "NewsletterAdminController@destroy");
      Routers::post('/admin/newsletter/ajax_status', "NewsletterAdminController@ajaxStatus");
      Routers::post('/admin/newsletter/delete_all', "NewsletterAdminController@deleteAll");

      /* Seopage router */
      Routers::get('/admin/seopage/home', "SeoPageAdminController@home");
      Routers::get('/admin/seopage/product', "SeoPageAdminController@product");
      Routers::get('/admin/seopage/news', "SeoPageAdminController@news");
      Routers::get('/admin/seopage/contact', "SeoPageAdminController@contact");
      Routers::get('/admin/seopage/static', "SeoPageAdminController@static");
      Routers::get('/admin/seopage/delete_photo', "SeoPageAdminController@deletePhoto");
      Routers::post('/admin/seopage/stored', "SeoPageAdminController@stored");

      /* Photo multiple & Video router */
      Routers::get('/admin/photo/slideshow_index', "PhotoAdminController@slideshowIndex");
      Routers::get('/admin/photo/slideshow_create', "PhotoAdminController@slideshowCreate");
      Routers::get('/admin/photo/slideshow_show', "PhotoAdminController@slideshowShow");
      Routers::get('/admin/photo/partner_index', "PhotoAdminController@partnerIndex");
      Routers::get('/admin/photo/partner_create', "PhotoAdminController@partnerCreate");
      Routers::get('/admin/photo/partner_show', "PhotoAdminController@partnerShow");
      Routers::get('/admin/photo/social_header_index', "PhotoAdminController@socialHeaderIndex");
      Routers::get('/admin/photo/social_header_create', "PhotoAdminController@socialHeaderCreate");
      Routers::get('/admin/photo/social_header_show', "PhotoAdminController@socialHeaderShow");
      Routers::get('/admin/photo/social_footer_index', "PhotoAdminController@socialFooterIndex");
      Routers::get('/admin/photo/social_footer_create', "PhotoAdminController@socialFooterCreate");
      Routers::get('/admin/photo/social_footer_show', "PhotoAdminController@socialFooterShow");
      Routers::post('/admin/photo/stored', "PhotoAdminController@stored");
      Routers::get('/admin/photo/delete_photo', "PhotoAdminController@deletePhoto");
      Routers::post('/admin/photo/ajax_num', "PhotoAdminController@ajaxNumber");
      Routers::post('/admin/photo/ajax_status', "PhotoAdminController@ajaxStatus");
      Routers::post('/admin/photo/delete_all', "PhotoAdminController@deleteAll");
      Routers::get('/admin/photo/delete', "PhotoAdminController@destroy");

      /* Photo static router */
      Routers::get('/admin/static_photo/logo', "PhotoStaticAdminController@logo");
      Routers::get('/admin/static_photo/banner', "PhotoStaticAdminController@banner");
      Routers::get('/admin/static_photo/favicon', "PhotoStaticAdminController@favicon");
      Routers::get('/admin/static_photo/delete_photo', "PhotoStaticAdminController@deletePhoto");
      Routers::post('/admin/static_photo/stored', "PhotoStaticAdminController@stored");

      /* Order router */
      Routers::get('/admin/order/index', "OrderAdminController@index");
      Routers::get('/admin/order/show', "OrderAdminController@show");
      Routers::get('/admin/order/status', "OrderAdminController@status");
      Routers::get('/admin/order/delete', "OrderAdminController@destroy");
      Routers::post('/admin/order/ajax_num', "OrderAdminController@ajaxNumber");
      Routers::post('/admin/order_detail/ajax_num', "OrderAdminController@ajaxNumberDetail");

      /* Policy */
      Routers::get('/admin/policy/index', "PolicyAdminController@index");
      Routers::get('/admin/policy/create', "PolicyAdminController@create");
      Routers::get('/admin/policy/show', "PolicyAdminController@show");
      Routers::get('/admin/policy/delete', "PolicyAdminController@destroy");
      Routers::get('/admin/policy/delete_photo', "PolicyAdminController@deletePhoto");
      Routers::post('/admin/policy/stored', "PolicyAdminController@stored");
      Routers::post('/admin/policy/ajax_status', "PolicyAdminController@ajaxStatus");
      Routers::post('/admin/policy/ajax_num', "PolicyAdminController@ajaxNumber");
      Routers::post('/admin/policy/delete_all', "PolicyAdminController@deleteAll");
    }

    /* Router run */
    Routers::route();
  }
}
