<?php
class Functions
{
  public static $data = [];
  /* Handle Print Data */
  public static function dd($value, bool $exist = false)
  {
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    $exist ? exit() : '';
  }

  /* Transfer */
  public static function transfer(string $message, string $status, string $url)
  {
    include_once('app/views/admin/partials/transfer.php');
  }

  /* Handle check Google Page Speed */
  public static function isGoogleSpeed()
  {
    if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false || stripos($_SERVER['HTTP_USER_AGENT'], 'Google-InspectionTool') === false) {
      return false;
    }
    return true;
  }

  /* Handle redirect */
  public static function redirect(string $url, $statusCode = 303)
  {
    header('Location: ' . $url, true, $statusCode);
    die();
  }

  /* Handle format money */
  public static function formatMoney($price = 0, $unit = 'đ')
  {
    $str = '';
    if ($price) {
      $str .= number_format($price, 0, ',', '.');
      if (!empty($unit)) {
        $str .= '<span>' . $unit . '</span>';
      } else {
        $str .= $unit;
      }
    }
    return $str;
  }

  /* Handle format phone */
  public static function formatPhone($number, $dash = ' ')
  {
    if (preg_match('/^(\d{4})(\d{3})(\d{3})$/', $number, $matches) || preg_match('/^(\d{3})(\d{4})(\d{4})$/', $number, $matches)) {
      return $matches[1] . $dash . $matches[2] . $dash . $matches[3];
    }
  }

  /* Handle format money social */
  public static function formatLargeMoney($number)
  {
    if (($number < 0) || ($number > 999999999999999)) {
      echo "Number over large";
    } else {
      if (($number >= 1000000000) && ($number <= 999999999999999)) // Billion
      {
        $billion = round(($number / 1000000000), 2);
        $price = $billion . ' tỷ';
      }
      if (($number >= 1000000) && ($number < 1000000000)) // Milion
      {
        $million = round(($number / 1000000), 2);
        $price = $million . ' triệu';
      }
      if (($number < 1000000)) {
        $price = number_format($number, 0, ',', '.');
      }
    }
    return $price;
  }

  public static function notFound($statusCode = 404)
  {
    http_response_code($statusCode);
    echo '404 Not Found';
    die();
  }

  public static function stringRandom($characterNumber = 10)
  {
    $str = '';

    if ($characterNumber > 0) {
      $str_default = 'ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789';
      for ($i = 0; $i < $characterNumber; $i++) {
        $index = mt_rand(0, strlen($str_default));
        $str = $str . substr($str_default, $index, 1);
      }
    }
    return $str;
  }

  public static function Paginate($page, $totalPage, $url = "", $category = false, $admin = true)
  {
    $range = 2;
    $start = max(1, $page - $range);
    $end = min($totalPage, $page + $range);
    $dotDOM = '<li class="page-item">
              <a class="page-link">...</a>
            </li>';
    if ($admin === true) {
      if (!empty($totalPage)) {
        $paginateString = "<div class=\"card-footer text-sm\">
      <ul class=\"pagination flex-wrap justify-content-center mb-0\">";
        $paginateString .= "<li class=\"page-item\"><a class=\"page-link\">Trang $page / $totalPage</a></li>";
        if ($start > 1) {
          $previous = $page - 1;
          if ($category) {
            $paginateString .= "<li class=\"page-item\">
              <a href=\"$url&page=$previous\" class=\"page-link\">Trước</a>
            </li>";
          } else {
            $paginateString .= "<li class=\"page-item\">
              <a href=\"$url?page=$previous\" class=\"page-link\">Trước</a>
            </li>";
          }
          if ($start > 2) {
            $paginateString .= $dotDOM;
          }
        }
        for ($i = $start; $i <= $end; $i++) {
          if ($page === $i) {
            $active = "active";
          } else {
            $active = "";
          }
          if ($category) {
            $paginateString .= "<li class=\"page-item $active\">
              <a href=\"$url&page=$i\" class=\"page-link\">$i</a>
            </li>";
          } else {
            $paginateString .= "<li class=\"page-item $active\">
              <a href=\"$url?page=$i\" class=\"page-link\">$i</a>
            </li>";
          }
        }
        if ($end < $totalPage) {
          $next = $page + 1;
          if ($end < $totalPage - 1) {
            $paginateString .= $dotDOM;
          }
          if ($category) {
            $paginateString .= "<li class=\"page-item\">
              <a href=\"$url&page=$next\" class=\"page-link\">Sau</a>
            </li>";
          } else {
            $paginateString .= "<li class=\"page-item\">
              <a href=\"$url?page=$next\" class=\"page-link\">Sau</a>
            </li>";
          }
        }
        $paginateString .= "</ul></div>";
        return $paginateString;
      }
    } else {
      if (!empty($totalPage)) {
        $paginateString = "<div class=\"card-footer text-sm\">
      <ul class=\"pagination mb-0\">";
        $paginateString .= "<li class=\"page-item\"><a class=\"page-link\">Trang $page / $totalPage</a></li>";
        if ($start > 1) {
          $previous = $page - 1;
          if ($category) {
            $paginateString .= "<li class=\"page-item\">
              <a href=\"$url&page=$previous\" class=\"page-link\">Trước</a>
            </li>";
          } else {
            $paginateString .= "<li class=\"page-item\">
              <a href=\"$url?page=$previous\" class=\"page-link\">Trước</a>
            </li>";
          }
          if ($start > 2) {
            $paginateString .= $dotDOM;
          }
        }
        for ($i = $start; $i <= $end; $i++) {
          if ($page === $i) {
            $active = "text-red-600";
          } else {
            $active = "";
          }
          $paginateString .= "<li class=\"page-item $active\">
              <a href=\"$url?page=$i\" class=\"page-link\">$i</a>
            </li>";
        }
        if ($end < $totalPage) {
          $next = $page + 1;
          if ($end < $totalPage - 1) {
            $paginateString .= $dotDOM;
          }
          $paginateString .= "<li class=\"page-item\">
              <a href=\"$url?page=$next\" class=\"page-link\">Sau</a>
            </li>";
        }
        $paginateString .= "</ul></div>";
        return $paginateString;
      }
    }
  }

  /* Build Schema Product */
  public static function buildSchemaProduct($idProduct, $name, $image, $description, $codeProduct, $nameBrand, $nameAuthor, $url, $price)
  {
    $str = '{';
    $str .= '"@context": "https://schema.org/",';
    $str .= '"@type": "Product",';
    $str .= '"name": "' . $name . '",';
    $str .= '"image":';
    $str .= '[';
    $str .= '"' . $image . '"';
    $str .= '],';
    $str .= '"description": "' . $description . '",';
    $str .= '"sku":"SP0' . $idProduct . '",';
    $str .= '"mpn": "' . $codeProduct . '",';
    $str .= '"brand":';
    $str .= '{';
    $str .= '"@type": "Brand",';
    $str .= '"name": "' . $nameBrand . '"';
    $str .= '},';
    $str .= '"review":';
    $str .= '{';
    $str .= '"@type": "Review",';
    $str .= '"reviewRating":';
    $str .= '{';
    $str .= '"@type": "Rating",';
    $str .= '"ratingValue": "5",';
    $str .= '"bestRating": "5"';
    $str .= '},';
    $str .= '"author":';
    $str .= '{';
    $str .= '"@type": "Person",';
    $str .= '"name": "' . $nameAuthor . '"';
    $str .= '}';
    $str .= '},';
    $str .= '"aggregateRating":';
    $str .= '{';
    $str .= '"@type": "AggregateRating",';
    $str .= '"ratingValue": "4.4",';
    $str .= '"reviewCount": "89"';
    $str .= '},';
    $str .= '"offers":';
    $str .= '{';
    $str .= '"@type": "Offer",';
    $str .= '"url": "' . $url . '",';
    $str .= '"priceCurrency": "VND",';
    $str .= '"priceValidUntil": "2099-11-20",';
    $str .= '"price": "' . $price . '",';
    $str .= '"itemCondition": "https://schema.org/UsedCondition",';
    $str .= '"availability": "https://schema.org/InStock"';
    $str .= '}';
    $str .= '}';
    $str = json_encode(json_decode($str), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return $str;
  }

  /* Build Schema Article */
  public static function buildSchemaArticle($name, $image, $createTime, $updateTime, $nameAuthor, $url, $logo, $urlAuthor = "")
  {
    $str = '{';
    $str .= '"@context": "https://schema.org",';
    $str .= '"@type": "NewsArticle",';
    $str .= '"mainEntityOfPage": ';
    $str .= '{';
    $str .= '"@type": "WebPage",';
    $str .= '"@id": "' . $url . '"';
    $str .= '},';
    $str .= '"headline": "' . $name . '",';
    $str .= '"image":"' . $image . '",';
    $str .= '"datePublished": "' . date('c', $createTime) . '",';
    $str .= '"dateModified": "' . date('c', $updateTime) . '",';
    $str .= '"author":';
    $str .= '{';
    $str .= '"@type": "Person",';
    $str .= '"name": "' . $nameAuthor . '",';
    $str .= '"url": "' . $urlAuthor . '"';
    $str .= '},';
    $str .= '"publisher": ';
    $str .= '{';
    $str .= '"@type": "Organization",';
    $str .= '"name": "' . $nameAuthor . '",';
    $str .= '"logo": ';
    $str .= '{';
    $str .= '"@type": "ImageObject",';
    $str .= '"url": "' . $logo . '"';
    $str .= '}';
    $str .= '}';
    $str .= '}';
    $str = json_encode(json_decode($str), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return $str;
  }

  /* SERVER URI */
  public static function URI(string $url)
  {
    $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    $uri = str_replace($url, '', $uri);
    return $uri;
  }

  /* Get data one */
  public static function rawOne(array $value)
  {
    if (isset($value) && count($value) === 1) {
      return $value[0];
    }
    return $value;
  }

  /* Check data */
  public static function checkData(array $d)
  {
    if (count($d) > 0 && isset($d)) return true;
    return FALSE;
  }

  public static function alert(string $notify = '')
  {
    echo '<script language="javascript">alert("' . $notify . '")</script>';
  }

  /* Upload file */
  public static function uploadFile(string $field = "", array $extensionAllow = [], string $folderUploadFile, $postMaxSize = 20971520)
  {
    if (isset($_FILES[$field]) && !$_FILES[$field]['error']) {
      $filename = $_FILES[$field]['name'];
      $filesize = $_FILES[$field]['size'];
      $name = pathinfo($filename, PATHINFO_FILENAME);

      if (!file_exists($folderUploadFile)) {
        mkdir($folderUploadFile, 0777, true);
      }

      $uploadfile = $folderUploadFile . $filename;

      $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

      if (!in_array($extension, $extensionAllow)) {
        self::alert('Chỉ hỗ trợ upload file có các định dạng' . implode(",", $extensionAllow));
        return false;
      }

      if ($filesize >= $postMaxSize) {
        self::alert('Dung lượng file không được vượt quá ' . $postMaxSize . "byte");
        return false;
      }

      if (file_exists($uploadfile)) {
        for ($i = 0; $i < 1000; $i++) {
          if (!file_exists($folderUploadFile . $name . $i . '.' . $extension)) {
            $filename = $name . $i . '.' . $extension;
            $uploadfile = $folderUploadFile . $filename;
            break;
          }
        }
      } else {
        $filename = $_FILES[$field]['name'];
        $uploadfile = $folderUploadFile . $filename;
      }

      if (!copy($_FILES[$field]['tmp_name'], $uploadfile)) {
        if (!move_uploaded_file($_FILES[$field]['tmp_name'], $uploadfile)) {
          return false;
        }
      }
      return $filename;
    }
    return FALSE;
  }

  /* Check field upload file */
  public static function hasFile($field)
  {
    if (isset($_FILES[$field])) {
      if ($_FILES[$field]['error'] == 4) {
        return false;
      } else if ($_FILES[$field]['error'] == 0) {
        return true;
      }
    } else {
      return false;
    }
  }

  public static function isChild($data, $id)
  {
    foreach ($data as &$value) {
      if ($value['id_parent'] == $id) return true;
    }
    return FALSE;
  }

  /* Check status */
  public static function checkStatus(string $statusDefault, string $statusStr)
  {
    if (isset($statusStr)) $sst = explode(',', $statusStr);
    if (in_array($statusDefault, $sst)) return true;
    return FALSE;
  }

  /* Đệ quy danh mục */
  public static function recursiveCategory($data, $idParent = 0, $categoryDirect, $url, $id = 1)
  {
    $categories = "";
    $idParent == 0 ? $categories .= '<ul class="main-menu">' : $categories .= '<ul class="sub-menu-' . $id . '">';
    foreach ($data as $key => &$value) {
      if ($value['id_parent'] == $idParent) {
        $categories .= "<li>";
        $categories .= '<a href="' . $url . $categoryDirect . '?slug' . $id . '=' . $value['slug'] . '">' . $value['title'] . '</a>';
        unset($data[$key]);
        if (self::isChild($data, $value['id'])) {
          $categories .= self::recursiveCategory($data, $value['id'], $categoryDirect, $url, $id + 1);
        }
        $categories .= "</li>";
      }
    }
    $categories .= "</ul>";
    return $categories;
  }

  public static function renderNav($module, $navIcon)
  {
    $module = trim($module);
    $configBase = Configurations::configurationsBase();
    $configBackend = Configurations::configurationsBackEnd();
    $uri = Functions::URI($configBase['url']);
    $baseUrl = $configBase['baseUrl'];
    $str = '';
    $data = [];
    $dataCategory = [];
    if ($module && isset($configBackend[$module])) {
      $data[] = $configBackend[$module];
      foreach ($data as &$v) {

        /* Cấu hình templeat sidebar multiple */
        if (isset($configBackend[$module]['sidebar']) && $configBackend[$module]['sidebar'] === true) {
          if (isset($configBackend[$module]['toggle_category']) && $configBackend[$module]['toggle_category'] === true) {
            if ($uri == $v[$module . '1_route_index'] || $uri == $v[$module . '1_route_create'] || $uri == $v[$module . '2_route_index'] || $uri == $v[$module . '2_route_create'] || $uri == $v[$module . '3_route_index'] || $uri == $v[$module . '3_route_create'] || $uri == $v[$module . '4_route_index'] || $uri == $v[$module . '4_route_create']) {
              $menuOpen = 'menu-open';
            } else {
              $menuOpen = '';
            }
          }
          if ($uri == 'admin/product/size/index' || $uri == 'admin/product/size/create' || $uri == 'admin/product/color/create' || $uri == 'admin/product/color/index' || $uri == $v[$module . '_route_index'] || $uri == $v[$module . '_route_create']) {
            $menuOpen = 'menu-open';
          } else {
            $menuOpen = '';
          }
          $str .= '<li class="nav-item has-treeview menu-group ' . $menuOpen . '">
                    <a class="nav-link" title="' . $v['name'] . '">
                      ' . $navIcon . '
                      <p>
                        Quản lý ' . $v['name'] . '<i class="right fas fa-angle-left"></i>
                      </p>
                    </a>';
          /* Kiểm tra danh mục với từng cấp khác nhau */
          if (isset($v['category_' . $module . '1']) && $v['category_' . $module . '1'] == 1) $dataCategory['category_' . $module . '1'] = $configBackend['category_' . $module . '1'];
          if (isset($v['category_' . $module . '2']) && $v['category_' . $module . '2'] == 1) $dataCategory['category_' . $module . '2'] = $configBackend['category_' . $module . '2'];
          if (isset($v['category_' . $module . '3']) && $v['category_' . $module . '3'] == 1) $dataCategory['category_' . $module . '3'] = $configBackend['category_' . $module . '3'];
          if (isset($v['category_' . $module . '4']) && $v['category_' . $module . '4'] == 1) $dataCategory['category_' . $module . '4'] = $configBackend['category_' . $module . '4'];

          $str .= '<ul class="nav nav-treeview">';
          if (isset($configBackend[$module]['toggle_category']) && $configBackend[$module]['toggle_category'] === true) {
            $str .=
              '<li class="nav-item has-treeview ' . $menuOpen . '">
                <a class="nav-link" href="#" title="' . $v['name'] . '">
                  <i class="nav-icon text-sm fas fa-boxes"></i>
                  <p>
                    Danh mục ' . $v['name'] . '
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">';
            $count = 0;
            foreach ($dataCategory as $kcat => $vcat) {
              if (isset($configBackend[$module][$kcat]) && $configBackend[$module][$kcat] === true) {
                $str .= '<li class="nav-item">';
                $count = $count + 1;
                if ($uri == $vcat['category_' . $module . $count . '_route_index'] || $uri == $vcat['category_' . $module . $count . '_route_create']) {
                  $navLinkActive = 'active';
                } else {
                  $navLinkActive = '';
                }
                $str .= '<a class="nav-link ' . $navLinkActive . '" href="' . $baseUrl . $vcat['category_' . $module . $count . '_route_index'] . '" title="' . $vcat['name'] . '">';
                $str .= '<i class="nav-icon text-sm far fa-caret-square-right"></i>';
                $str .= $vcat['name'];
                $str .= '</a>';
                $str .= '</li>';
              }
            }
            $str .= '</ul>';
            $str .= '</li>';
          }

          if (isset($configBackend[$module]['size']) && $configBackend[$module]['size'] === true) {
            $str .= '<li class="nav-item">';
            if ($uri == 'admin/product/size/index' || $uri == 'admin/product/size/create') {
              $active = 'active';
            } else {
              $active = '';
            }
            $str .= '<a class="nav-link ' . $active . '" href="' . $baseUrl . 'admin/product/size/index' . '" title="' . $v['size_info']['name'] . '">';
            $str .= '<i class="nav-icon text-sm fas fa-boxes"></i>';
            $str .= '<p>' . $v['size_info']['name'] . '</p>';
            $str .= '</a>';
            $str .= '</li>';
          }

          if (isset($configBackend[$module]['color']) && $configBackend[$module]['color'] === true) {
            $str .= '<li class="nav-item">';
            if ($uri == 'admin/product/color/index' || $uri == 'admin/product/color/create') {
              $active = 'active';
            } else {
              $active = '';
            }
            $str .= '<a class="nav-link ' . $active . '" href="' . $baseUrl . 'admin/product/color/index' . '" title="' . $v['color_info']['name'] . '">';
            $str .= '<i class="nav-icon text-sm fas fa-boxes"></i>';
            $str .= '<p>' . $v['color_info']['name'] . '</p>';
            $str .= '</a>';
            $str .= '</li>';
          }

          $str .= '<li class="nav-item">';
          if ($uri == $v[$module . '_route_index'] || $uri == $v[$module . '_route_create']) {
            $active = 'active';
          } else {
            $active = '';
          }
          $str .= '<a class="nav-link ' . $active . '" href="' . $baseUrl . $v[$module . '_route_index'] . '" title="' . $v['name'] . '">';
          $str .= '<i class="nav-icon text-sm fas fa-boxes"></i>';
          $str .= '<p>' . $v['name'] . '</p>';
          $str .= '</a>';
          $str .= '</li>';
          $str .= '</ul>';
          $str .= '</li>';
        }
      }
      echo $str;
    }
  }

  public static function renderStaticNav(string $moduleParent, array $moduleChild = [], $navIcon)
  {
    $configBase = Configurations::configurationsBase();
    $configBackend = Configurations::configurationsBackEnd();
    $uri = Functions::URI($configBase['url']);
    $uriArray = explode('/', $uri);
    $baseUrl = $configBase['baseUrl'];
    $str = '';
    $data = [];
    $dataCategory = [];
    $data[] = $configBackend[$moduleParent];
    if (isset($configBackend[$moduleParent]['sidebar']) && $configBackend[$moduleParent]['sidebar'] === true && isset($configBackend[$moduleParent])) {
      foreach ($data as &$v) {
        if (count($uriArray) === 3 && $moduleParent == $uriArray[1]) {
          $menuOpen = 'menu-open';
        } else {
          $menuOpen = '';
        }
        $str .= '<li class="nav-item has-treeview ' . $menuOpen . '">';
        $str .=   '<a class="nav-link" href="javascript:void()" title="' . $v['name'] . '">
                    ' . $navIcon . '
                    <p>
                      Quản lý ' . $v['name'] . '
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>';
        $str .= '<ul class="nav nav-treeview">';
        foreach ($moduleChild as &$vchild2) {
          if (isset($v[$vchild2])) $dataCategory[$vchild2] = $v[$vchild2];
        }
        foreach ($dataCategory as &$vcat) {
          $active = $uri === $vcat['route'] ?  'active' : '';
          $str .= '<li class="nav-item">';
          $str .= '<a class="nav-link ' . $active . '" href="' . $baseUrl . $vcat['route'] . '" title="' . $vcat['name'] . '">';
          $str .= '<i class="nav-icon text-sm far fa-caret-square-right"></i>';
          $str .= '<p>' . $vcat['name'] . '</p>';
          $str .= '</a>';
          $str .= '</li>';
        }
        $str .= '</ul>';
        $str .= '</li>';
      }
    }
    echo $str;
  }

  /* Get SeoPage */
  public static function getSeoPage(string $value, array $data)
  {
    if (in_array($value, $data)) {
      return $value;
    }
  }

  /* Set SeoPage */
  public static function set($key = '', $value = '')
  {
    if (!empty($key) && !empty($value)) {
      self::$data[$key] = $value;
    }
  }

  /* Get key data */
  public static function get($key)
  {
    return (!empty(self::$data[$key])) ? self::$data[$key] : '';
  }
}
