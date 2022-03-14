<?php

require_once('../app/core/controller.php');

class Profil extends Controller
{
    /**
     * index
     * load the User model and load the profil view
     * @return view profil
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);
        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $data['pageTitle'] = "Profil";
        $this->view('profil', $data);
    }
}
