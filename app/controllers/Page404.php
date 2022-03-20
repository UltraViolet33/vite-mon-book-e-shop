<?php

require_once('../app/core/controller.php');

class Page404 extends Controller
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

        $data['css'] = "css/404.css";
        $this->view("404", $data);
    }
}
