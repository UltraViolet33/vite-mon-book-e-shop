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
}
