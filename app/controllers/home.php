<?php

require_once('../app/core/controller.php');

class Home extends Controller
{
    /**
     * index
     * load the User model and load the home views
     * @return view
     */
    public function index()
    {
        // $user = $this->loadModel('User');
        // $userData = $user->checkLogin();
        // if (is_object($userData)) {
        //     $data['userData'] = $userData;
        // }

        // $data['pageTitle'] = "Home";
        $this->view("home");
    }
}
