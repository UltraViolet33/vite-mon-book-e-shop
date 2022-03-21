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

        $html = '<tr><td colspan="4" class="text-center">Vous n\'avez aucun produit dans votre panier</td></tr>';
        $buttonValidate = null;
        $button = '<button class="btn btn-primary"><a href="' . ROOT . 'products">Voir les produits</a></button>';

        if (isset($_SESSION['cart'])) {
            $cart = $this->loadModel('CartModel');
            $html = $cart->makeHTMLCart($_SESSION['cart']);
            $buttonValidate = '<button class="btn btn-primary"><a href="' . ROOT . 'command">Valider</a></button>';
            $button = '<button class="btn btn-danger"><a href="' . ROOT . 'cart/deleteCart">Supprimer le panier</a></button>';
        }

        $data['button'] = $button;
        $data['buttonValidate'] = $buttonValidate;
        $data['cart'] = $html;
        $data['pageTitle'] = "Panier";
        $this->view('cart', $data);
    }

    /**
     * addCart
     * add a product to the cart
     * @param  int $idProduct
     * @return view cart
     */
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
        $cart->addToCart($product[0]);
        header("location:" . ROOT . "cart");
    }

    /**
     * deleteCart
     * delete the cart
     * @return void
     */
    public function deleteCart()
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }
        header("location:" . ROOT . "cart");
    }
}
