<?php

require_once('../app/core/controller.php');

class Home extends Controller
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

        if (strlen($htmlProducts) == 0) {
            $data['htmlProducts'] = "Il n'y a aucun livre pour l'instant dans notre site. Revenez plus tard ! ";
        }

     
        $data['pageTitle'] = "Home";
        $this->view("home", $data);
    }
}
