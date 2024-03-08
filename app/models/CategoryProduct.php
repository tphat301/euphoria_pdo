<?php
class CategoryProduct extends Database
{
  public function all($field, $tablename, $condition = 1)
  {
    return $this->select($field, $tablename, $condition);
  }
}
