<?php

require_once('../app/core/controller.php');

class Command extends Controller
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

        $command = $this->loadModel('CommandModel');
        $idCommand = $command->create();

            unset($_SESSION['cart']);

            $_SESSION['idCommand'] = $idCommand;
        echo $idCommand;

        header("location:" . ROOT . "cart");

        // $data['pageTitle'] = "Produits";
        // $this->view("products", $data);
    }
}
