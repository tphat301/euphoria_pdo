<?php

final class Validate
{
  public static function isUsername($value)
  {
    $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (preg_match($pattern, $value)) return true;
    return FALSE;
  }

  public static function isPassword($value)
  {
    $pattern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (preg_match($pattern, $value)) return true;
    return FALSE;
  }

  public static function isEmail($value)
  {
    $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (preg_match($pattern, $value)) return true;
    return FALSE;
  }

  public static function isPhone($value)
  {
    $pattern = "/^[0-9]{3}[0-9]{4}[0-9]{3,4}$/";
    if (preg_match($pattern, $value)) return true;
    return FALSE;
  }
}
