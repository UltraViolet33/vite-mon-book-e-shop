<?php

require_once('../app/core/controller.php');

class Products extends Controller
{
    /**
     * index
     * load the User model and load the home view
     * @return view home
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $product = $this->loadModel('Product');
        $allProducts = $product->getAllProducts();
        $htmlProducts = $product->makeFrontProducts($allProducts);

        $data['htmlProducts'] = $htmlProducts;
        $data['pageTitle'] = "Produits";
        $this->view("products", $data);
    }
}
