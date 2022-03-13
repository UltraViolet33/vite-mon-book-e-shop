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
        $html = $cart->makeHTMLCart($_SESSION['cart']);

        // show($_SESSION['cart']);

        $data['cart'] =   $html;
        $data['pageTitle'] = "Panier";
        $this->view("cart", $data);
    }

    public function addCart($idProduct)
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $productModel = $this->loadModel('Product');
        $product = $productModel->getOneProduct($idProduct);
        $cart = $this->loadModel('CartModel');
        //show($product);
        $cart->addToCart($product[0]);
        //show($_SESSION['cart']);
        header("location:" . ROOT . "cart");
    }

    public function deleteCart()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);
        if (is_object($userData)) {
            $data['userData'] = $userData;
        }
        $cart = $this->loadModel('CartModel');
        $cart->deleteCart();
        // $data['cart'] =   $_SESSION['cart'];
        $data['pageTitle'] = "Panier";
        $this->view("cart", $data);
    }
}
