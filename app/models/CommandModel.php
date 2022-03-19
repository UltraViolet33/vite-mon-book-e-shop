<?php

class CommandModel
{
    /**
     * create
     * insert one command in the BDD
     * @return void
     */
    public function create()
    {
        $db = Database::newInstance();
        $montant = 0;

        for ($i = 0; $i < count($_SESSION['cart']['price']); $i++) {
            $montant += $_SESSION['cart']['price'][$i] * $_SESSION['cart']['quantity'][$i];
        }

        $arr['idUserCommand'] = $_SESSION['idMember'];
        $arr['amountCommand'] = $montant;
        $arr['stateCommand'] = "En cours de traitement";

        $query = "INSERT INTO command (idUserCommand, amountCommand, dateCommand, stateCommand) 
             VALUES (:idUserCommand, :amountCommand, NOW(), :stateCommand)";
        $check = $db->write($query, $arr);

        $idCommand =  $db->getLastInsertId();
        $this->createDetailsCommand($idCommand);
        return $idCommand;
    }

    /**
     * createDetailsCommand
     * insert the details of one command in the BDD
     * @param  int $idCommand
     * @return void
     */
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
        }
    }
    
    /**
     * getAllCommands
     * select all commands in the BDD
     * @return array
     */
    public function getAllCommands()
    {
        $db = Database::newInstance();
        $result = $db->read("SELECT * FROM command ORDER BY idCommand DESC");
        return $result;
    }
    
    /**
     * makeTable
     * make HTML table to display commands
     * @param  array $commands
     * @return HTML elements
     */
    public function makeTable($commands)
    {
        $tableHTML = "";
        if (is_array($commands)) {
            foreach ($commands as $command) {
                $date = date("d/m/Y H:i:s", strtotime($command->dateCommand));
                $tableHTML .= '<tr>
                            <th scope="row">' . $command->idCommand . '</th>
                            <td>' . $command->idUserCommand . '</td>
                            <td>' . $command->amountCommand . '</td>
                            <td>' . $date . '</td>
                            <td>' . $command->stateCommand . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}
