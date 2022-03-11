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
            $this->error .= "Veuillez entrez un nom valide. <br>";
        }

        if (empty($data['firstnameMember']) || !preg_match("/^[a-zA-Z]+$/", $data['firstnameMember'])) {
            $this->error .= "Veuillez entrez un prénom valide. <br>";
        }

        if (empty($data['pseudoMember']) || !preg_match("/^[a-zA-Z]+$/", $data['pseudoMember'])) {
            $this->error .= "Veuillez entrez un pseudo valide. <br>";
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

                echo "ok!!!!!";
                //   header("Location: " . ROOT . "login");
                //   die;
            } else {
                echo "pas ok";
            }
        }
        $_SESSION['error'] = $this->error;
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
