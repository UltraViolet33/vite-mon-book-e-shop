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

    /**
     * update
     * update the user data in the BDD
     * @return void
     */
    public function update()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            show($_POST);
            $user->updateUser($userData->idMember);
        }

        $data['pageTitle'] = "Modifier Profil";
        $this->view('updateProfil', $data);
    }

    /**
     * delete
     * delete the user in the BDD
     * @return void
     */
    public function delete()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $user->deleteUser($userData->idMember);
    }

    public function commands()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin(['admin', 'customer']);

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $command = $this->loadModel('CommandModel');
        $allCommandsUser = $command->getAllCommandsUser($userData->idMember);
        $commandsHTML =  $command->makeTableUser($allCommandsUser);
        $data['commands'] = $commandsHTML;
        $this->view('commands', $data);
    }
}
