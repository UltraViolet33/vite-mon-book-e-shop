<?php

class CartModel
{    
    /**
     * addToCart
     * add one product to the cart
     * @param  object $product
     * @return void
     */
    public function addToCart($product)
    {
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();
            $_SESSION['cart']['name'] = array();
            $_SESSION['cart']['idProduct'] = array();
            $_SESSION['cart']['quantity'] = array();
            $_SESSION['cart']['price'] = array();
        }

        $_SESSION['cart']['name'][] = $product->nameProduct;
        $_SESSION['cart']['idProduct'][] = $product->idProduct;
        $_SESSION['cart']['quantity'][] = 1;
        $_SESSION['cart']['price'][] = $product->priceProduct;
    }
    
    /**
     * deleteCart
     * delete the cart
     * @return void
     */
    public function deleteCart()
    {
        unset($_SESSION['cart']);
    }
    
    /**
     * makeHTMLCart
     * make HTML table for the cart
     * @param  array $cart
     * @return void
     */
    public function makeHTMLCart($cart)
    {
        $html = "";
        if(is_array($cart))
        {
            for($i=0; $i<count($cart['idProduct']); $i++)
            { 
                $html .= '<tr>
                            <th scope="row">1</th>
                            <td>'.$cart['name'][$i].'</td>
                            <td>'.$cart['quantity'][$i].'</td>
                            <td>'.$cart['price'][$i].'</td>
                            </th>';
            }
        }
        return $html;
    }
}
