<?php

class Controllers
{
  public function views(array $data = array(), string $permisionLayout = 'index')
  {
    if (!empty($data)) {
      extract($data);
    }

    $clientView = "app/views/index.php";
    $adminView = "app/views/admin/index.php";

    if (file_exists($clientView) && $permisionLayout === 'index') {
      return require($clientView);
    }

    if (file_exists($adminView) && $permisionLayout === 'admin') {
      return require($adminView);
    }
  }
}
