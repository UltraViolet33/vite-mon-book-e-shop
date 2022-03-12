<?php

class Product
{
    private $error = "";

    public function create()
    {
        $db = Database::newInstance();
        $data = array();

        $data['nameProduct'] = validateData($_POST['name']);
        $data['descriptionProduct'] = validateData($_POST['description']);
        $data['priceProduct'] = validateData($_POST['price']);
        $data['priceProduct'] = (int)$data['priceProduct'];
        $data['stockProduct'] = validateData($_POST['stock']);
        $data['stockProduct'] = (int)$data['stockProduct'];
        $data['idCategoryProduct'] = validateData($_POST['category']);
        $data['idCategoryProduct'] = (int)$data['idCategoryProduct'];


        $data['imageProduct'] =  $_FILES['image']['name'];

        if (empty($data['nameProduct'])) {
            $this->error .= "Veuillez entrez un nom de produit valide. <br>";
        }

        if (empty($data['descriptionProduct'])) {
            $this->error .= "Veuillez entrez une description de produit. <br>";
        }

        if (empty($data['priceProduct'])) {
            $this->error .= "Veuillez entrez un prix de produit valide. <br>";
        }

        if (empty($data['stockProduct'])) {
            $this->error .= "Veuillez entrez un stock de produit valide. <br>";
        }

        if (empty($data['idCategoryProduct'])) {
            $this->error .= "Veuillez entrez une catégorie de produit. <br>";
        }

        if (empty($data['imageProduct'])) {
            $this->error .= "Veuillez choisir une image de produit. <br>";
        }

        if ($this->error == "") {

            $query = "INSERT INTO product (nameProduct, descriptionProduct, imageProduct, priceProduct, stockProduct, idCategoryProduct) 
            VALUES (:nameProduct, :descriptionProduct, :imageProduct, :priceProduct, :stockProduct, :idCategoryProduct)";

            $result = $db->write($query, $data);
            if ($result) {
              echo "OK";
             
            }else
            {
                echo "pas ok";
            }
        }



        $_SESSION['error'] = $this->error;
    }

    public function makeSelectCategories($categories)
    {
        $selectHTML = "";
        foreach ($categories as $category) {
            $selectHTML .= '<option value="' . $category->idCategory . '">' . $category->nameCategory . '</option>';
        }
        return $selectHTML;
    }
}
