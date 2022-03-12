<?php

require_once('../app/core/controller.php');

class Admin extends Controller
{
    /**
     * index
     * Load the User model and the admin/index view
     * @return admin/index view
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);
        if (is_object($userData)) {
            $data['userData'] = $userData;
        }
        $data['pageTitle'] = "Admin - Home";
        $this->view("admin/index", $data);
    }

    /**
     * categories
     * Load the User model and the admin/categories view
     * @return admin/categories view
     */
    public function categories()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        // get all the categories and the HTML table
        $category = $this->loadModel('Category');
        $allCategories = $category->getAll();
        $tableHTML = $category->makeTable($allCategories);


        $data['tableHTML'] = $tableHTML;
        $data['pageTitle'] = "Admin - Categories";
        $this->view("admin/categories", $data);
    }

    /**
     * categories
     * Load the User model and the admin/categories view
     * @return admin/categories view
     */
    public function products($method = false, $arg = "")
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $product = $this->loadModel('Product');

        if ($method === "add") {
            $this->addProduct($data, $product);
        } elseif ($method === "home") {
            // get all the products and the HTML table
            $data['pageTitle'] = "Admin - Products";
            $this->view("admin/products", $data);
        }
    }

    /**
     * addProduct
     *Load the admin/products/add view
     * @param  array $data
     * @return admin/products/add view
     */
    public function addProduct($data, $productModel)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $productModel->create();
            show($_POST);
            show($_FILES);
        }
        $category = $this->loadModel('Category');
        $allCategories = $category->getAll();
        $selectHTML = $productModel->makeSelectCategories($allCategories);

        $data['selectHTML'] = $selectHTML;
        $data['categories'] = $allCategories;
        $data['pageTitle'] = "Admin - Add Product";
        $this->view("admin/addProduct", $data);
    }
}
