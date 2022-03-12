<?php

class User
{
    private $error = "";

    /**
     * signUp
     * check the data from the signUp form and insert the user in the database if there is no error
     * @return void
     */
    public function signUp()
    {
        $db = Database::newInstance();

        $data = array();
        $data['nameMember'] = validateData($_POST['name']);
        $data['firstnameMember'] = validateData($_POST['firstname']);
        $data['pseudoMember'] = validateData($_POST['pseudo']);
        $data['emailMember'] = validateData($_POST['email']);
        $data['cityMember'] = validateData($_POST['city']);
        $data['postalCodeMember'] = validateData($_POST['postalCode']);
        $data['adressMember'] = validateData($_POST['adress']);
        $data['passwordMember'] = $_POST['password'];
        $password2 = $_POST['password2'];

        // check the datas 
        if (empty($data['nameMember']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nameMember'])) {
            $this->error .= "Veuillez entrez un nom valide. <br>";
        }

        if (empty($data['firstnameMember']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['nameMember'])) {
            $this->error .= "Veuillez entrez un prénom valide. <br>";
        }

        if (empty($data['pseudoMember'])) {
            $this->error .= "Veuillez entrez un pseudo valide. <br>";
        }

        if (empty($data['emailMember']) || (!filter_var($data['emailMember'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Veuillez entrez un email valide. <br>";
        }

        if (empty($data['postalCodeMember']) || !preg_match("/^[0-9]{5}$/", $data['postalCodeMember'])) {
            $this->error .= "Veuillez entrez un code postal valide. <br>";
        }

        if (empty($data['cityMember'])) {
            $this->error .= "Veuillez entrez une ville valide. <br>";
        }

        if (empty($data['adressMember'])) {
            $this->error .= "Veuillez entrez une adresse valide. <br>";
        }

        if ($data['passwordMember'] !== $password2) {
            $this->error .= "Les mots de passes ne correspondent pas. <br>";
        }

        if (strlen($data['passwordMember']) < 4) {
            $this->error .= "Le mot de passe doit être long de 4 caractères au minimun. <br>";
        }

        $checkEmail = $this->checkEmail($data);

        if (is_array($checkEmail)) {
            $this->error .= "L'email existe déjà, veuillez en renseigner un autre. <br>";
        }

        $checkPseudo = $this->checkPseudo($data);

        if (is_array($checkPseudo)) {
            $this->error .= "Le pseudo existe déjà, veuillez en renseigner un autre. <br>";
        }

        if ($this->error == "") {
            $data['passwordMember'] = hash('sha1', $data['passwordMember']);

            $query = "INSERT INTO member (pseudoMember, passwordMember, nameMember, firstnameMember, emailMember, cityMember, postalCodeMember, adressMember) 
            VALUES (:pseudoMember, :passwordMember, :nameMember, :firstnameMember, :emailMember, :cityMember, :postalCodeMember, :adressMember)";

            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . "login");
                die;
            }
        }
        $_SESSION['error'] = $this->error;
    }

    /**
     * login
     * check the data from the login form and login the user if there are corrects
     * @return void
     */
    public function login()
    {
        $db = Database::newInstance();
        
        $data = array();
        $data['emailMember'] = validateData($_POST['email']);
        $data['passwordMember'] = validateData($_POST['password']);

        if (empty($data['emailMember'])) {
            $this->error .= "Veuillez entrez un email valide. <br>";
        }

        if (empty($data['passwordMember'])) {
            $this->error .= "Veuillez renseigner votre mot de passe. <br>";
        }

        if ($this->error == "") {
            //confirm
            $data['passwordMember'] = hash('sha1', $data['passwordMember']);

            //check if email exists with the password
            $sql = "SELECT * FROM member WHERE emailMember = :emailMember && passwordMember = :passwordMember limit 1";
            $result = $db->read($sql, $data);

            if (is_array($result)) {
                $_SESSION['idMember'] = $result[0]->idMember;
                header("Location: " . "home");
                die;
            }
            $this->error .= "Email ou mot de passe incorrect. <br>";
        }
        $_SESSION['error'] = $this->error;
    }

    /**
     * checkLogin
     * check if the user is log in and if he is admin (to access admin part)
     * @return object
     */
    public function checkLogin($allowed = array())
    {
        $db = Database::newInstance();

        if (count($allowed) > 0) {
            $arr['idMember'] = $_SESSION['idMember'];
            $query = "SELECT * FROM member  WHERE idMember = :idMember limit 1";
            $result = $db->read($query, $arr);

            if (is_array($result)) {
                $result = $result[0];

                if ($result->isAdmin) {
                    return $result;
                } else {
                    header("Location: " . "login");
                    die;
                }
            } else {
                header("Location: " . "login");
                die;
            }
        } else {
            if (isset($_SESSION['idMember'])) {
                $arr = false;
                $arr['idMember'] = $_SESSION['idMember'];
                $query = "SELECT * FROM member  WHERE idMember = :idMember limit 1";
                $result = $db->read($query, $arr);
                if (is_array($result)) {
                    return $result[0];
                }
            }
        }
        return false;
    }

    /**
     * logout
     * logout the user and load the home view
     * @return void
     */
    public function logout()
    {
        if (isset($_SESSION['idMember'])) {
            unset($_SESSION['idMember']);
        }
        header("Location: " . ROOT . "home");
    }

    /**
     * checkEmail
     * check if there is already an email in the members table
     * @param array $data
     * @return array
     */
    private function checkEmail($data)
    {
        $db = Database::newInstance();
        $query = "SELECT * FROM member WHERE emailMember = :emailMember limit 1";
        $arr['emailMember'] = $data['emailMember'];
        return $db->read($query, $arr);
    }
    
    /**
     * checkPseudo
     * check if the pseudo is already in the member table
     * @param  array $data
     * @return array
     */
    private function checkPseudo($data)
    {
        $db = Database::newInstance();
        $query = "SELECT * FROM member WHERE pseudoMember = :pseudoMember limit 1";
        $arr['pseudoMember'] = $data['pseudoMember'];
        return $db->read($query, $arr);
    }
}
