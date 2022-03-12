<?php

class Category
{

    public function create($data)
    {
        $db = Database::newInstance();
        $arr['nameCategory'] = $data->data;

        if (!preg_match("/^[a-zA-Z ]+$/", trim($arr['nameCategory']))) {
            $_SESSION['error'] = "Veuillez entrer un nom de categorie valide.";
        }

        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $query = "INSERT INTO category (nameCategory) VALUES (:nameCategory)";
            $check = $db->write($query, $arr);

            if ($check) {
                return true;
            }
        }
        return false;
    }

    public function getAll()
    {
        $db = Database::newInstance();
        $data = $db->read("SELECT * FROM category ORDER BY idCategory DESC");
        return $data;
    }

}
