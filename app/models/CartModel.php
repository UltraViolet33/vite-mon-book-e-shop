<?php

class CartModel
{
    public function __construct()
    {
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();
            $_SESSION['cart']['name'] = array();
            $_SESSION['cart']['idProduct'] = array();
            $_SESSION['cart']['quantity'] = array();
            $_SESSION['cart']['price'] = array();
        }
    }

    public function addToCart($product)
    {
        $_SESSION['cart']['name'][] = $product->nameProduct;
        $_SESSION['cart']['idProduct'][] = $product->idProduct;
        $_SESSION['cart']['quantity'][] = 1;
        $_SESSION['cart']['price'][] = $product->priceProduct;
    }

    public function deleteCart()
    {
        unset($_SESSION['cart']);
    }

    public function makeHTMLCart($cart)
    {
        show($cart);

        $html = "";
        for($i=0; $i<count($cart['idProduct']); $i++)
        {
            $html .= '<tr>
                        <th scope="row">1</th>
                        <td>'.$cart['name'][$i].'</td>
                        <td>'.$cart['quantity'][$i].'</td>
                        <td>'.$cart['price'][$i].'</td>
                        </th>';
        }

        return $html;

    }

    
}
