<?php

class CartModel
{
    public function __construct()
    {
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();
            $_SESSION['cart'] = array();
            $_SESSION['cart']['name'] = array();
            $_SESSION['cart']['idProduct'] = array();
            $_SESSION['cart']['quantity'] = array();
            $_SESSION['cart']['price'] = array();
        }
    }

    public function addToCart()
    {

    }
}
