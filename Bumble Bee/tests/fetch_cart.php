<?php
      session_start();

      $total_price = 0;
      $total_item = 0;

      $output = '
      <div class="" id="order_table">
      <form id="checkout-form" method="post" >
      <table class="">
      <tr>
      <th >Product Name</th>
      <th > Flavour</th>
      <th > Size</th>
      <th > </th>
      <th >Quantity</th>
      <th ></th>
      <th >Price</th>
      <th >Total</th>
      <th Action</th>
      </tr>
      ';
      if(!empty($_SESSION['cart']))
      {
        foreach($_SESSION['cart'] as $keys => $values)
        {
          $output .= '
          <tr>
          <td>'.$values["p_name"].'</td>
          <td>'.$values["p_flavour"].'</td>
          <td>'.$values["p_size"].'</td>
          <td><button name="remove" class="remove" id="'. $values['pid'].'">-</button></td>
          <td>'.$values["p_quantity"].'</td>
          <td><button name="add" class="add" id="'. $values['pid'].'">+</button></td>
          <td align="right">Rs '.$values["p_price"].'</td>
          <td align="right">Rs'.number_format((int)$values["p_quantity"] * (int)$values["p_price"], 2).'</td>
          <input type="hidden" id="img'. $values["pid"].'" value="'.$values['p_img'].'">
          <input type="hidden" id="name'. $values["pid"].'" value="'.$values['p_name'].'">
          <input type="hidden" id="flavour'. $values["pid"].'" value="'.$values['p_flavour'].'">
          <input type="hidden" id="size'. $values["pid"].'" value="'.$values['p_size'].'">
          <input type="hidden" id="price'. $values["pid"].'" value="'.$values['p_price'].'">
          <input type="hidden" id="quantity'. $values["pid"].'" value="'.$values['p_quantity'].'">
          <td><button name="delete" class="delete" id="'. $values["pid"].'">Delete item</button></td>
          </tr>
          ';
          $total_price = $total_price + ((int)$values["p_quantity"] * (int)$values["p_price"]);
          $total_item = $total_item + 1;
        }
        $output .= '
        <button type="submit" name="checkout" id="checkout-btn" disabled="disabled">Checkout</button>
        </form>
        <tr>
        <td colspan="3" align="right">Total</td>
        <td align="right">  Rs '.number_format($total_price, 2).'</td>
        <td></td>
        </tr>

        ';
      }
      else
      {
        $output .= '
        <tr>
        <td colspan="5" align="center">
        Your Cart is Empty!
        </td>
        </tr>
        ';
      }
      $output .= '</table></div>';
      $data = array(
      'cart_details'  => $output,
      'total_price'  => 'Rs' . number_format($total_price, 2),
      'total_item'  => $total_item
      );

      echo json_encode($data);



?>
