<?php

require_once('../app/core/controller.php');

class Logout extends Controller
{
    /**
     * index
     * load the User Model and the logout method
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $user->logout();
    }
}