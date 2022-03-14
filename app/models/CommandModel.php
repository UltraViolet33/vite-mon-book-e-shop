<?php


class CommandModel
{
    public function create()
    {
        $db = Database::newInstance();

        show($_SESSION['cart']);

        $montant = 0;

        for ($i = 0; $i < count($_SESSION['cart']['price']); $i++) {
            $montant += $_SESSION['cart']['price'][$i] * $_SESSION['cart']['quantity'][$i];
        }
        echo $montant;


        $arr['idUserCommand'] = $_SESSION['idMember'];
        $arr['amountCommand'] = $montant;
        $arr['stateCommand'] = "En cours de traitement";


        $query = "INSERT INTO command (idUserCommand, amountCommand, dateCommand, stateCommand) 
             VALUES (:idUserCommand, :amountCommand, NOW(), :stateCommand)";
        $check = $db->write($query, $arr);

        show($check);

        $idCommand =  $db->getLastInsertId();
        $this->createDetailsCommand($idCommand);

        return $idCommand;

        //  for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        // {
        //     executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        // }
        // return $check;
    }


    public function createDetailsCommand($idCommand)
    {
        $db = Database::newInstance();

        for ($i = 0; $i < count($_SESSION['cart']['idProduct']); $i++) {
            $arr['idCommandDetailsCommand'] = $idCommand;
            $arr['idProductDetailsCommand'] = $_SESSION['cart']['idProduct'][$i];
            $arr['quantityDetailsCommand'] = $_SESSION['cart']['quantity'][$i];
            $arr['priceDetailsCommand'] = $_SESSION['cart']['price'][$i];


            $query = "INSERT INTO detailsCommand (idCommandDetailsCommand, idProductDetailsCommand, quantityDetailsCommand, priceDetailsCommand)
            VALUES (:idCommandDetailsCommand, :idProductDetailsCommand, :quantityDetailsCommand, :priceDetailsCommand)";

            $check = $db->write($query, $arr);

            show($check);
        }
    }
}
