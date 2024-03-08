<?php
class User extends Database
{
  public function all($field, $tablename, $condition = 1)
  {
    return $this->select($field, $tablename, $condition);
  }

  public function create($tablename, $options)
  {
    return $this->insert($tablename, $options);
  }
  public function edit($tablename, $options, $condition)
  {
    return $this->update($tablename, $options, $condition);
  }
}
