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

        if (strlen($htmlProducts) == 0) {
            $data['htmlProducts'] = "Il n'y a aucun livre pour l'instant dans notre site. Revenez plus tard ! ";
        }
        $data['pageTitle'] = "Produits";
        $this->view("products", $data);
    }

    /**
     * details
     * get the data about the product and load the detailsProduct view
     * @param  int $idProduct
     * @return view detailsProduct
     */
    public function details($idProduct)
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        //get the datas about the produt
        $product = $this->loadModel('Product');
        $singleProduct = $product->getOneProduct($idProduct);

        $data['product'] = $singleProduct[0];
        $data['pageTitle'] = "Details Produit";
        $this->view("detailsProduct", $data);
    }
}
