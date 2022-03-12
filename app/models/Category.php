<?php

class Category
{
    /**
     * create
     * insert a category into the database
     * @param  object $data
     * @return void
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
     * getAll
     * select all the categories from the database
     * @return array
     */
    public function getAll()
    {
        $db = Database::newInstance();
        $data = $db->read("SELECT * FROM category ORDER BY idCategory ASC");
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
                $tableHTML .= '<tr>
                            <th scope="row">' . $category->idCategory . '</th>
                            <td>' . $category->nameCategory . '</td>
                            <td><button class="btn btn-primary">Modifier</button></td>
                            <td><button class="btn btn-warning">Supprimer</button></td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}
