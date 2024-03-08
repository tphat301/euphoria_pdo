<?php
class Configurations
{
  /*Configurations Main*/
  public static function configurationsBase()
  {
    return [
      'url' => '/euphoria_pdo/',
      'http' => 'http://',
      'https' => 'https://',
      'baseUrl' => 'http://localhost/euphoria_pdo/',
      'error-reporting' => true,
      'post-max-size' => 20971520, // 20MB
      'email' => 'dolamthanhphat@gmail.com',
      'author' => 'Mr.Phat',
      'birthday' => "30/01/1998",
      'dealine' => 'dd/mm/yyyy',
      'job' => 'Backend Developer',
      'phpVersion' => '8.2.4',

      'email' => [
        /* Mail google configuration */
        'googleMail' => [
          'mode' => true,
          'hostEmail' => 'smtp.gmail.com',
          'portEmail' => 587,
          'SMTPSecure' => 'tls',
          'fullnameEmail' => 'Euphoria',
          'usernameEmail' => 'dltphat301@gmail.com',
          'passwordEmail' => 'fbnx typo nzds yucy'
        ]
      ],
      'payments' => [
        'vnpay' => true,
        'momo' => false
      ]
    ];
  }


  // Configurations Frontend
  public static function configurationsFrontEnd()
  {
    // code
  }

  /* Configurations Backend */
  public static function configurationsBackEnd()
  {
    return [

      /* Database */
      "database" => self::db()['database'],

      /* Order Module Import */
      'order' => self::orderAdmin()['order'],

      /* Product Module Import */
      'product' => self::productAdmin()['product'],

      /* Category1 Product Level 1 Import */
      'category_product1' => self::categoryProductAdmin1()['category_product1'],

      /* Category Product Level 2 Import */
      'category_product2' => self::categoryProductAdmin2()['category_product2'],

      /* Category Product Level 3 Import */
      'category_product3' => self::categoryProductAdmin3()['category_product3'],

      /* Category Product Level 4 Import */
      'category_product4' => self::categoryProductAdmin4()['category_product4'],

      /* Newsletter Module Import */
      "newsletter" => self::newsletterAdmin()['newsletter'],

      /* SeoPage Module Import */
      "seopage" => self::seoPageAdmin()['seopage'],

      /* Multiple Photo Module Import */
      "photo" => self::photoAdmin()['photo'],

      /* Static Photo Module Import */
      "static_photo" => self::staticPhotoAdmin()['static_photo'],

      /* News Module Import */
      "news" => self::newsAdmin()['news'],

      /* Policy Module Import */
      "policy" => self::policyAdmin()['policy'],

      /* Category1 News Level 1 Import */
      'category_news1' => self::categoryNewsAdmin1()['category_news1'],

      /* Category News Level 2 Import */
      'category_news2' => self::categoryNewsAdmin2()['category_news2'],

      /* Category News Level 3 Import */
      'category_news3' => self::categoryNewsAdmin3()['category_news3'],

      /* Category News Level 4 Import */
      'category_news4' => self::categoryNewsAdmin4()['category_news4'],

      /* Configuration Static */
      'static' => self::staticAdmin()['static'],

      /* Configuration Setting */
      'setting' => self::settingAdmin()['setting'],
    ];
  }

  /* Database config */
  private static function db()
  {
    $databaseConfig = [
      "database" => [
        'driver' => 'PDO',
        'databaseName' => 'euphoria_pdo',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8'
      ]
    ];
    return $databaseConfig;
  }

  /* Order Module */
  private static function orderAdmin()
  {
    $module_order = [
      'order' => [
        'name' => "Đơn hàng",
        'sidebar' => true,
        'table' => "orders",
        'title' => true,
        'code' => true,
        'status' => true,
        'num_per_page' => 10,
      ]
    ];
    return $module_order;
  }

  /* Product Module */
  private static function productAdmin()
  {
    $module_product = [
      'product' => [
        'name' => 'Sản phẩm',
        'sidebar' => true,
        'table' => 'products',
        'type' => 'san-pham',
        'slug' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'soft_delete' => false,
        'video_youtube' => false,
        'video_mp4' => false,
        'file_attach' => false,
        'photo1' => true,
        'photo2' => false,
        'photo3' => false,
        'photo4' => false,
        'sale_price' => true,
        'regular_price' => true,
        'discount' => true,
        'unit' => "VNĐ",
        'quantity' => true,
        'gallery' => true,
        'size' => true,
        'size_info' => [
          'name' => 'Size',
          'title' => true,
          'table' => 'size',
          'num_per_page' => 10,
        ],
        'color' => true,
        'color_info' => [
          'name' => 'Màu sắc',
          'title' => true,
          'table' => 'color',
          'num_per_page' => 10,
        ],
        'counpond' => false,
        'code' => true,
        'num' => true,
        'status' => ['banchay' => true, 'noibat' => true, 'hienthi' => true],
        'status_title' => ['banchay' => "Bán chạy", 'noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'toggle_category' => true,
        'category_product1' => true,
        'category_product2' => true,
        'category_product3' => false,
        'category_product4' => false,
        'seo' => true,
        'schema' => true,
        'type_image' => '',
        'num_per_page' => 10,
        'upload_rules1' => 'Width: 282 px - Height: 370 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'file_attact_type' => '.pdf',
        'video_type' => '.mp4',
        'product_route_index' => 'admin/product/index',
        'product1_route_index' => self::categoryProductAdmin1()['category_product1']['category_product1_route_index'],
        'product2_route_index' => self::categoryProductAdmin2()['category_product2']['category_product2_route_index'],
        'product3_route_index' => self::categoryProductAdmin3()['category_product3']['category_product3_route_index'],
        'product_route_create' => 'admin/product/create',
        'product1_route_create' => self::categoryProductAdmin1()['category_product1']['category_product1_route_create'],
        'product2_route_create' => self::categoryProductAdmin2()['category_product2']['category_product2_route_create'],
        'product3_route_create' => self::categoryProductAdmin3()['category_product3']['category_product3_route_create'],
        'product4_route_index' => self::categoryProductAdmin4()['category_product4']['category_product4_route_index'],
        'product4_route_create' => self::categoryProductAdmin4()['category_product4']['category_product4_route_create'],
      ]
    ];
    return $module_product;
  }

  /* Category Product 1 Module */
  private static function categoryProductAdmin1()
  {
    $module_categoryProduct1 = [
      'category_product1' => [
        'name' => 'Danh mục cấp 1',
        'table' => 'category_products',
        'slug' => true,
        'num' => true,
        'copy' => false,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => false,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 282 px - Height: 370 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_product1_route_index' => 'admin/category_product1/index',
        'category_product1_route_create' => 'admin/category_product1/create',
      ]
    ];
    return $module_categoryProduct1;
  }

  /* Category Product 2 Module */
  private static function categoryProductAdmin2()
  {
    $module_categoryProduct2 = [
      'category_product2' => [
        'name' => 'Danh mục cấp 2',
        'table' => 'category_products',
        'slug' => true,
        'num' => true,
        'copy' => false,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => false,
        'content_tiny' => false,
        'photo1' => true,
        'photo2' => false,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 282 px - Height: 370 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_product2_route_index' => 'admin/category_product2/index',
        'category_product2_route_create' => 'admin/category_product2/create',
      ]
    ];
    return $module_categoryProduct2;
  }

  /* Category Product 3 Module */
  private static function categoryProductAdmin3()
  {
    $module_categoryProduct3 = [
      'category_product3' => [
        'name' => 'Danh mục cấp 3',
        'table' => 'category_products',
        'slug' => true,
        'num' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => true,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_product3_route_index' => 'admin/category_product3/index',
        'category_product3_route_create' => 'admin/category_product3/create',
      ]
    ];
    return $module_categoryProduct3;
  }

  /* Category Product 4 Module */
  private static function categoryProductAdmin4()
  {
    $module_categoryProduct4 = [
      'category_product4' => [
        'name' => 'Danh mục cấp 4',
        'table' => 'category_products',
        'slug' => true,
        'num' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => true,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_product4_route_index' => 'admin/category_product4/index',
        'category_product4_route_create' => 'admin/category_product4/create',
      ]
    ];
    return $module_categoryProduct4;
  }

  /* News Module */
  private static function newsAdmin()
  {
    $module_news = [
      'news' => [
        'name' => 'Tin tức',
        'table' => 'news',
        'type' => 'tin-tuc',
        'sidebar' => true,
        'slug' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'soft_delete' => false,
        'video_youtube' => false,
        'video_mp4' => false,
        'file_attach' => false,
        'photo1' => true,
        'photo2' => false,
        'photo3' => false,
        'photo4' => false,
        'gallery' => false,
        'num' => true,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'toggle_category' => false,
        'category_news1' => false,
        'category_news2' => false,
        'category_news3' => false,
        'category_news4' => false,
        'seo' => true,
        'schema' => true,
        'num_per_page' => 10,
        'upload_rules1' => 'Width: 350 px - Height: 250 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'file_attact_type' => '.pdf',
        'video_type' => '.mp4',
        'news_route_index' => 'admin/news/index',
        'news1_route_index' => self::categoryNewsAdmin1()['category_news1']['category_news1_route_index'],
        'news2_route_index' => self::categoryNewsAdmin2()['category_news2']['category_news2_route_index'],
        'news3_route_index' => self::categoryNewsAdmin3()['category_news3']['category_news3_route_index'],
        'news4_route_index' => self::categoryNewsAdmin4()['category_news4']['category_news4_route_index'],
        'news_route_create' => 'admin/news/create',
        'news1_route_create' => self::categoryNewsAdmin1()['category_news1']['category_news1_route_create'],
        'news2_route_create' => self::categoryNewsAdmin2()['category_news2']['category_news2_route_create'],
        'news3_route_create' => self::categoryNewsAdmin3()['category_news3']['category_news3_route_create'],
        'news4_route_create' => self::categoryNewsAdmin4()['category_news4']['category_news4_route_create'],
      ]
    ];
    return $module_news;
  }

  /* Policy Module */
  private static function policyAdmin()
  {
    $module_policy = [
      'policy' => [
        'name' => 'Chính sách',
        'table' => 'news',
        'type' => 'chinh-sach',
        'sidebar' => true,
        'slug' => true,
        'title' => true,
        'content' => true,
        'content_tiny' => true,
        'video_youtube' => false,
        'toggle_category' => false,
        'video_mp4' => false,
        'file_attach' => false,
        'photo1' => true,
        'photo2' => false,
        'photo3' => false,
        'photo4' => false,
        'num' => true,
        'status' => ['hienthi' => true],
        'status_title' => ['hienthi' => "Hiển thị"],
        'seo' => true,
        'num_per_page' => 10,
        'upload_rules1' => 'Width: 350 px - Height: 250 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'file_attact_type' => '.pdf',
        'video_type' => '.mp4',
        'policy_route_index' => 'admin/policy/index',
        'policy_route_create' => 'admin/policy/create'
      ]
    ];
    return $module_policy;
  }

  /* Newsletter Module */
  private static function newsletterAdmin()
  {
    $module_newsletter = [
      'newsletter' => [
        'name' => 'Đăng ký nhận tin',
        'table' => 'newsletter',
        'type' => 'newsletter',
        'sidebar' => true,
        'fullname' => true,
        'email' => true,
        'phone' => true,
        'address' => true,
        'note' => true,
        'subject' => true,
        'num' => true,
        'status' => ['hienthi' => true],
        'status_title' => ['hienthi' => "Hiển thị"],
        'num_per_page' => 10,
      ]
    ];
    return $module_newsletter;
  }

  /* SeoPage Module */
  private static function seoPageAdmin()
  {
    $module_seopage = [
      'seopage' => [
        'name' => 'Seo Page',
        'table' => 'seopage',
        'sidebar' => true,

        /* Seopage Home */
        'home' => [
          'name' => 'Trang chủ',
          'title' => true,
          'photo1' => true,
          'keywords' => true,
          'desc' => true,
          'type' => 'home',
          'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/seopage/home'
        ],

        /* Seopage Static */
        'static' => [
          'name' => 'Giới thiệu',
          'title' => true,
          'photo1' => true,
          'keywords' => true,
          'desc' => true,
          'type' => 'gioi-thieu',
          'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/seopage/static'
        ],

        /* Seopage Product */
        'product' => [
          'name' => 'Sản phẩm',
          'title' => true,
          'photo1' => true,
          'type' => 'san-pham',
          'keywords' => true,
          'desc' => true,
          'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/seopage/product'
        ],

        /* Seopage News */
        'news' => [
          'name' => 'Tin tức',
          'title' => true,
          'photo1' => true,
          'type' => 'tin-tuc',
          'keywords' => true,
          'desc' => true,
          'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/seopage/news'
        ],

        /* Seopage Contact */
        // 'contact' => [
        //   'name' => 'Liên hệ',
        //   'title' => true,
        //   'photo1' => true,
        //   'type' => 'contact',
        //   'keywords' => true,
        //   'desc' => true,
        //   'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        //   'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        //   'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        //   'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        //   'route' => 'admin/seopage/contact'
        // ]
      ]
    ];
    return $module_seopage;
  }

  /* Photo Static Module */
  private static function staticPhotoAdmin()
  {
    $module_static_photo = [
      'static_photo' => [
        'name' => 'Photo Tĩnh',
        'table' => 'photo',
        'sidebar' => true,

        /* Banner */
        // 'banner' => [
        //   'name' => 'Banner',
        //   'title' => true,
        //   'photo' => true,
        //   'type' => 'banner',
        //   'action' => 'photo_static',
        //   'upload_rules' => 'Width: 600 px - Height: 200 px (.jpg|.gif|.png|.jpeg|.gif)',
        //   'route' => 'admin/static_photo/banner'
        // ],

        /* Logo */
        'logo' => [
          'name' => 'Logo',
          'title' => true,
          'photo' => true,
          'type' => 'logo',
          'action' => 'photo_static',
          'upload_rules' => 'Width: 93 px - Height: 45 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/static_photo/logo'
        ],

        /* Favicon */
        'favicon' => [
          'name' => 'Favicon',
          'title' => true,
          'photo' => true,
          'type' => 'favicon',
          'action' => 'photo_static',
          'upload_rules' => 'Width: 50 px - Height: 50 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/static_photo/favicon'
        ],
      ]
    ];
    return $module_static_photo;
  }

  /* Multiple Photo Module */
  private static function photoAdmin()
  {
    $module_photo = [
      'photo' => [
        'name' => 'Slide ảnh - Video',
        'table' => 'photo',
        'sidebar' => true,

        /* Slideshow */
        'slideshow' => [
          'name' => 'Slideshow',
          'title' => true,
          'photo' => true,
          'link' => true,
          'photo' => true,
          'type' => 'slideshow',
          'action' => 'photo_multiple',
          'create_number' => 2,
          'num_per_page' => 10,
          'status' => ['hienthi' => true],
          'status_title' => ['hienthi' => "Hiển thị"],
          'upload_rules' => 'Width: 1366 px - Height: 500 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/photo/slideshow_index'
        ],

        /* Partner */
        'partner' => [
          'name' => 'Đối tác',
          'title' => true,
          'photo' => true,
          'link' => true,
          'photo' => true,
          'type' => 'partner',
          'action' => 'photo_multiple',
          'create_number' => 4,
          'num_per_page' => 10,
          'status' => ['hienthi' => true],
          'status_title' => ['hienthi' => "Hiển thị"],
          'upload_rules' => 'Width: 175 px - Height: 95 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/photo/partner_index'
        ],

        /* Social header */
        // 'social_header' => [
        //   'name' => 'Social header',
        //   'title' => true,
        //   'photo' => true,
        //   'link' => true,
        //   'photo' => true,
        //   'type' => 'social_header',
        //   'action' => 'photo_multiple',
        //   'create_number' => 4,
        //   'num_per_page' => 10,
        //   'status' => ['hienthi' => true],
        //   'status_title' => ['hienthi' => "Hiển thị"],
        //   'upload_rules' => 'Width: 30 px - Height: 30 px (.jpg|.gif|.png|.jpeg|.gif)',
        //   'route' => 'admin/photo/social_header_index'
        // ],

        /* Social footer */
        'social_footer' => [
          'name' => 'Social footer',
          'title' => true,
          'photo' => true,
          'link' => true,
          'photo' => true,
          'type' => 'social_footer',
          'action' => 'photo_multiple',
          'create_number' => 4,
          'num_per_page' => 10,
          'status' => ['hienthi' => true],
          'status_title' => ['hienthi' => "Hiển thị"],
          'upload_rules' => 'Width: 30 px - Height: 30 px (.jpg|.gif|.png|.jpeg|.gif)',
          'route' => 'admin/photo/social_footer_index'
        ]
      ]
    ];
    return $module_photo;
  }

  /* Category News 1 Module */
  private static function categoryNewsAdmin1()
  {
    $module_categoryNews1 = [
      'category_news1' => [
        'name' => 'Danh mục cấp 1',
        'table' => 'category_news',
        'slug' => true,
        'num' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => false,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_news1_route_index' => 'admin/category_news1/index',
        'category_news1_route_create' => 'admin/category_news1/create',
      ]
    ];
    return $module_categoryNews1;
  }

  /* Category News 2 Module */
  private static function categoryNewsAdmin2()
  {
    $module_categoryNews2 = [
      'category_news2' => [
        'name' => 'Danh mục cấp 2',
        'table' => 'category_news',
        'slug' => true,
        'num' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => true,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_news2_route_index' => 'admin/category_news2/index',
        'category_news2_route_create' => 'admin/category_news2/create',
      ]
    ];
    return $module_categoryNews2;
  }

  /* Category News 3 Module */
  private static function categoryNewsAdmin3()
  {
    $module_categoryNews3 = [
      'category_news3' => [
        'name' => 'Danh mục cấp 3',
        'table' => 'category_news',
        'slug' => true,
        'num' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => true,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_news3_route_index' => 'admin/category_news3/index',
        'category_news3_route_create' => 'admin/category_news3/create',
      ]
    ];
    return $module_categoryNews3;
  }

  /* Category News 4 Module */
  private static function categoryNewsAdmin4()
  {
    $module_categoryNews4 = [
      'category_news4' => [
        'name' => 'Danh mục cấp 4',
        'table' => 'category_news',
        'slug' => true,
        'num' => true,
        'title' => true,
        'desc' => true,
        'desc_tiny' => true,
        'content' => true,
        'content_tiny' => true,
        'photo1' => true,
        'photo2' => true,
        'photo3' => false,
        'photo4' => false,
        'seo' => true,
        'soft_delete' => false,
        'num_per_page' => 10,
        'status' => ['noibat' => true, 'hienthi' => true],
        'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
        'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
        'category_news4_route_index' => 'admin/category_news4/index',
        'category_news4_route_create' => 'admin/category_news4/create',
      ]
    ];
    return $module_categoryNews4;
  }

  /* Static Module */
  private static function staticAdmin()
  {
    $module_static = [
      'static' => [
        'name' => 'Trang tĩnh',
        'table' => 'static',
        'sidebar' => true,

        /* Static slogan */
        'slogan' => [
          'name' => 'Slogan',
          'type' => 'slogan',
          'title' => true,
          'route' => 'admin/static/slogan'
        ],

        /* About admin */
        'about' => [
          'name' => 'Giới thiệu',
          'type' => 'gioi-thieu',
          'slug' => true,
          'slogan' => false,
          'title' => true,
          'desc' => true,
          'desc_tiny' => true,
          'content' => true,
          'content_tiny' => true,
          'video_youtube' => false,
          'video_mp4' => false,
          'file_attach' => false,
          'photo1' => true,
          'photo2' => false,
          'photo3' => false,
          'photo4' => false,
          // 'status' => ['noibat' => false, 'hienthi' => true],
          // 'status_title' => ['noibat' => "Nổi bật", 'hienthi' => "Hiển thị"],
          'status' => ['hienthi' => true],
          'status_title' => ['hienthi' => "Hiển thị"],
          'num_per_page' => 10,
          'upload_rules1' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules2' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules3' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'upload_rules4' => 'Width: 580 px - Height: 580 px (.jpg|.gif|.png|.jpeg|.gif)',
          'file_attact_type' => '.pdf',
          'video_type' => '.mp4',
          'route' => 'admin/static/about'
        ],

        /* Static contact */
        // 'contact' => [
        //   'name' => 'Liên hệ',
        //   'type' => 'contact',
        //   'title' => false,
        //   'content' => true,
        //   'content_tiny' => true,
        //   'status' => ['hienthi' => true],
        //   'status_title' => ['hienthi' => "Hiển thị"],
        //   'route' => 'admin/static/contact'
        // ],

        /* Static footer */
        'footer' => [
          'name' => 'Footer',
          'type' => 'footer',
          'title' => true,
          'content' => true,
          'content_tiny' => true,
          'status' => ['hienthi' => true],
          'status_title' => ['hienthi' => "Hiển thị"],
          'route' => 'admin/static/footer'
        ]
      ]
    ];
    return $module_static;
  }

  /* Setting Module */
  private static function settingAdmin()
  {
    $module_setting = [
      'setting' => [
        'name' => 'Thiết lập chung',
        'table' => 'setting',
        'sidebar' => true,
        'title' => true,
        'address' => true,
        'website' => true,
        'email' => true,
        'hotline' => true,
        'phone' => true,
        'fanpage' => true,
        'zalo' => true,
        'copyright' => true,
        'headjs' => true,
        'bodyjs' => true,
        'iframe_ggmap' => true,
        'link_ggmap' => true,
        'worktime' => false,
      ]
    ];
    return $module_setting;
  }
}
