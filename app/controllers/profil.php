<?php

require_once('../app/core/controller.php');

class Profil extends Controller
{
    /**
     * index
     * load the User model and load the profil view
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();
        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $data['pageTitle'] = "Profil";
        $this->view('profil', $data);
    }
}
