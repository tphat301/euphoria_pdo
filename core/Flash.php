<?php
class Flash
{
  public static function set(string $key, string $value, string $status)
  {
    if (!empty($key) && !empty($value)) {
      $_SESSION[$status][$key] = $value;
    }
  }

  public static function get(string $key, string $status)
  {
    $data = isset($_SESSION[$status][$key]) ? $_SESSION[$status][$key] : null;
    unset($_SESSION[$status][$key]);
    return $data;
  }
}
