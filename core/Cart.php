<?php

class Cart
{
  public function add($data, $key = 'cart', $key1, $id, $qty = 1, $options = [])
  {
    if (isset($_SESSION[$key][$key1]) && array_key_exists($id, $_SESSION[$key][$key1])) {
      $qty = $_SESSION[$key][$key1][$id]['qty'] + 1;
    }
    $_SESSION[$key][$key1][$id] = [
      'id' => $id,
      'photo' => $data['photo1'],
      'code' => $data['code'],
      'title' => $data['title'],
      'price' => isset($options['sale_price']) && !empty($options['sale_price'])  ? $options['sale_price'] : $data['sale_price'],
      'qty' =>  $qty,
      'sub_total' => $qty * isset($options['sale_price']) && !empty($options['sale_price'])  ? $options['sale_price'] : $data['sale_price'],
      'options' => isset($options) ? $options : []
    ];
    $this->updateCart();
  }

  public function delete($id, $key = 'cart', $key1 = 'buy')
  {
    if (isset($_SESSION[$key][$key1]) && !empty($id)) {
      unset($_SESSION[$key][$key1][$id]);
      $this->updateCart();
    } else {
      unset($_SESSION[$key][$key1]);
      $this->updateCart();
    }
    return FALSE;
  }

  public function getInfo(string $key, string $key1)
  {
    if (isset($_SESSION[$key][$key1])) {
      return $_SESSION[$key][$key1];
    }
    return FALSE;
  }

  public function updateCart($key = 'cart', $key1 = 'buy')
  {
    $num_order = 0;
    $total = 0;
    if (isset($_SESSION[$key][$key1])) {
      foreach ($_SESSION[$key][$key1] as $item) {
        $num_order += $item['qty'];
        $total += $item['sub_total'];
      }
    }

    $_SESSION[$key]['info'] = array(
      "num_order" => $num_order,
      "total" => $total
    );
  }

  public function cartInfo($key = 'cart')
  {
    if (isset($_SESSION[$key]['info'])) {
      return $_SESSION[$key]['info'];
    }
  }
}
