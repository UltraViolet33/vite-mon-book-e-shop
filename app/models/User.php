<?php

class User
{
    private $error = "";

    /**
     * signUp
     * check the data from the signUp form and insert the user in the database if there is no error
     */
    public function signUp()
    {
        $db = Database::newInstance();

        /**
         * trim and htmlspecialchars on the data POST
         * do a method
         * checkif the pseudo already exists
         */

        $data = array();
        $data['nameMember'] = $_POST['name'];
        $data['firstnameMember'] = $_POST['firstname'];
        $data['pseudoMember'] = $_POST['pseudo'];
        $data['emailMember'] = $_POST['email'];
        $data['cityMember'] = $_POST['city'];
        $data['postalCodeMember'] = $_POST['postalCode'];
        $data['adressMember'] = $_POST['adress'];
        $data['passwordMember'] = $_POST['password'];
        $password2 = $_POST['password2'];

        // check the datas 
        if (empty($data['nameMember']) || !preg_match("/^[a-zA-Z]+$/", $data['nameMember'])) {
            // $this->error .= "Veuillez entrez un nom valide. <br>";
        }

        if (empty($data['firstnameMember']) || !preg_match("/^[a-zA-Z]+$/", $data['firstnameMember'])) {
            // $this->error .= "Veuillez entrez un prénom valide. <br>";
        }

        if (empty($data['pseudoMember']) || !preg_match("/^[a-zA-Z]+$/", $data['pseudoMember'])) {
            // $this->error .= "Veuillez entrez un pseudo valide. <br>";
        }

        if (empty($data['emailMember']) || !preg_match("/^[a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['emailMember'])) {
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

        $check = $this->checkEmail($data);

        if (is_array($check)) {
            $this->error .= "L'email existe déjà, veuillez en renseigner un autre. <br>";
        }

        if ($this->error == "") {
            $data['isAdmin'] = 0;
            $data['passwordMember'] = hash('sha1', $data['passwordMember']);

            $query = "INSERT INTO member (pseudoMember, passwordMember, nameMember, firstnameMember, emailMember, cityMember, postalCodeMember, adressMember, isAdmin) 
            VALUES (:pseudoMember, :passwordMember, :nameMember, :firstnameMember, :emailMember, :cityMember, :postalCodeMember, :adressMember, :isAdmin)";

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
     */
    public function login()
    {
        $db = Database::newInstance();
        $data = array();
        /**
         * trim and htmlspecialchars on the data POST
         * do a method
         */
        $data['emailMember'] = trim($_POST['email']);
        $data['passwordMember'] = trim($_POST['password']);


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

    public function checkLogin($allowed = array())
    {
        $db = Database::newInstance();

        if (count($allowed) > 0) {
            $arr['idMember'] = $_SESSION['idMember'];
            $query = "SELECT * FROM member  WHERE idMember = :idMember limit 1";
            $result = $db->read($query, $arr);

            if (is_array($result)) {
                $result = $result[0];

                if (in_array($result->rank, $allowed)) {
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
                $arr['idMember'] =   $_SESSION['idMember'];
                $query = "SELECT * FROM member  WHERE idMember = :idMember limit 1";
                $result = $db->read($query, $arr);
                if (is_array($result)) {
                    show($result[0]);
                    return $result[0];
                }
            }
        }
        return false;
    }





    /**
     * checkEmail
     * check if there is already an email in the members table
     */
    private function checkEmail($data)
    {
        $db = Database::newInstance();
        $query = "SELECT * FROM member WHERE emailMember = :emailMember limit 1";
        $arr['emailMember'] = $data['emailMember'];
        return $db->read($query, $arr);
    }
}
