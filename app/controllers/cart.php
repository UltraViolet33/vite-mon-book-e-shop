<?php

require_once('../app/core/controller.php');

class Cart extends Controller
{
    /**
     * index
     * Load the User model and the cart view
     * @return cart view
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $data['cart'] = false;
        $cart = $this->loadModel('CartModel');

        $data['cart'] =   $_SESSION['cart'];
        $data['pageTitle'] = "Panier";
        $this->view("cart", $data);
    }
}
