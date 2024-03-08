<?php

class Models
{
  public function models($filename)
  {
    $path = "app/models/" . $filename . '.php';
    if (file_exists($path)) {
      require($path);
      return new $filename();
    }
  }
}
