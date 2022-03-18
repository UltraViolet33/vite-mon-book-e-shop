<?php

class Category
{
    /**
     * create
     * insert a category into the database
     * @param  object $data
     * @return bool
     */
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

    /**
     * delete
     * delete one category in the BDD
     * @param  int $idCategory
     * @return void
     */
    public function delete($idCategory)
    {
        $db = Database::newInstance();

        if (isset($idCategory)) {
            $check = $db->write("DELETE FROM category WHERE idCategory = $idCategory");

            if ($check) {
                return true;
            } else {
                $_SESSION['error'] = "Une erreur est survenue.";
            }
            return false;
        }
    }

    /**
     * updateCategory
     * update one category in the BDD
     * @param  int $idCategory
     * @param  string $nameCategory
     * @return void
     */
    public function updateCategory($idCategory, $nameCategory)
    {
        $db = Database::newInstance();

        if (isset($idCategory) && isset($nameCategory)) {
            $query = "UPDATE  category SET nameCategory = :nameCategory WHERE idCategory = :idCategory";
            $arr['idCategory'] = $idCategory;
            $arr['nameCategory'] = $nameCategory;

            $check = $db->write($query, $arr);

            if ($check) {
                return true;
            } else {
                $_SESSION['error'] = "Une erreur est survenue.";
            }
            return false;
        }
    }

    /**
     * getAll
     * select all the categories from the database
     * @return array
     */
    public function getAll()
    {
        $db = Database::newInstance();
        $data = $db->read("SELECT * FROM category ORDER BY idCategory DESC");
        return $data;
    }


    /**
     * makeTable
     * make the categories HTML table for admin categories view
     * @param  array $categories
     * @return string HTML elements
     */
    public function makeTable($categories)
    {
        $tableHTML = "";
        if (is_array($categories)) {
            foreach ($categories as $category) {
                $args = $category->idCategory . ",'" . $category->nameCategory . "'";

                $tableHTML .= '<tr>
                            <th scope="row">' . $category->idCategory . '</th>
                            <td>' . $category->nameCategory . '</td>
                            <td><button class="btn btn-primary" onclick="displayEditForm(' . $args . ')">Modifier</button></td>
                            <td><button class="btn btn-warning" onclick="deleteCategory(' . $category->idCategory . ')">Supprimer</button></td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}
