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
        // $db = Database::newInstance();
        $db = Database::getInstance();



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
        // $db = Database::newInstance();
        $db = Database::getInstance();
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
        // $db = Database::newInstance();
        $db = Database::getInstance();

        if (count($allowed) > 0) {
            $arr['idMember'] = $_SESSION['idMember'];
            $query = "SELECT * FROM member  WHERE idMember = :idMember limit 1";
            $result = $db->read($query, $arr);

            if (is_array($result)) {
                $result = $result[0];

                if ($result->isAdmin && $allowed[0] === 'admin') {
                    return $result;
                } elseif ($allowed[1] === "customer") {
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
        // $db = Database::newInstance();
        $db = Database::getInstance();
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
        // $db = Database::newInstance();
        $db = Database::getInstance();
        $query = "SELECT * FROM member WHERE pseudoMember = :pseudoMember limit 1";
        $arr['pseudoMember'] = $data['pseudoMember'];
        return $db->read($query, $arr);
    }

    /**
     * updateUser
     * update the user data in the BDD
     * @param  int $idMember
     * @return void
     */
    public function updateUser($idMember)
    {
        // $db = Database::newInstance();
        $db = Database::getInstance();

        $data = array();
        $data['nameMember'] = validateData($_POST['name']);
        $data['firstnameMember'] = validateData($_POST['firstname']);
        $data['pseudoMember'] = validateData($_POST['pseudo']);
        $data['emailMember'] = validateData($_POST['email']);
        $data['cityMember'] = validateData($_POST['city']);
        $data['postalCodeMember'] = validateData($_POST['postalCode']);
        $data['adressMember'] = validateData($_POST['adress']);
        $data['passwordMember'] = $_POST['password'];
        $data['idMember'] = $idMember;
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

        if ($this->error == "") {
            $data['passwordMember'] = hash('sha1', $data['passwordMember']);

            $query = "UPDATE member SET pseudoMember = :pseudoMember, nameMember = :nameMember, firstnameMember = :firstnameMember, emailMember = :emailMember, postalCodeMember = :postalCodeMember, cityMember = :cityMember, adressMember = :adressMember, passwordMember = :passwordMember WHERE idMember = :idMember";
            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . ROOT . "profil");
                die;
            }
        }
        $_SESSION['error'] = $this->error;
    }

    /**
     * deleteUser
     * delete one user in the BDD
     * @param  int $idMember
     * @return void
     */
    public function deleteUser($idMember)
    {
        $db = Database::getInstance();
        $db->write("DELETE FROM member WHERE idMember = $idMember");
        header("Location: " . ROOT . "login");
    }

    /**
     * getAllUsers
     * select all the users in the BDD
     * @return array
     */
    public function getAllUsers()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM member ORDER BY isAdmin DESC";
        $data = $db->read($query);
        return $data;
    }

    /**
     * getAllCustomers
     * select all the customers in the BDD
     * @return array
     */
    public function getAllCustomers()
    {
        // $db = Database::newInstance();
        $db = Database::getInstance();
        $query = "SELECT * FROM member WHERE isAdmin = 0";
        $data = $db->read($query);
        return $data;
    }

    /**
     * getAllAdmins
     * select all the admins in the BDD
     * @return array
     */
    public function getAllAdmins()
    {
        // $db = Database::newInstance();
        $db = Database::getInstance();
        $query = "SELECT * FROM member WHERE isAdmin = 1";
        $data = $db->read($query);
        return $data;
    }

    /**
     * makeTableUsers
     * make HTML table to display all the users in the admin part
     * @param  arrays $members
     * @return HTML 
     */
    public function makeTableUsers($members)
    {
        $tableHTML = "";
        if (is_array($members)) {
            foreach ($members as $member) {
                $statut =  $member->isAdmin ? "Admin" : "Customer";
                $tableHTML .= '<tr>
                            <th scope="row">' . $member->idMember . '</th>
                            <td>' . $statut . '</td>
                            <td>' . $member->pseudoMember . '</td>
                            <td>' . $member->nameMember . '</td>
                            <td>' . $member->firstnameMember . '</td>
                            <td>' . $member->emailMember . '</td>
                            <td>' . $member->cityMember . '</td>
                            <td>' . $member->postalCodeMember . '</td>
                            <td>' . $member->adressMember . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}
