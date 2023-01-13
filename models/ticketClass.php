<?php
require_once("config.php");
class Ticket{
    public string $price;
    public int $id;


    static function readTicket(int $clientId):array {
    global $pdo;
    // SELECT  clients . id, COUNT(*),  SUM(tickets . price)
    // FROM clients
    // LEFT JOIN tickets ON  clients . id = tickets . clientsId
    // GROUP BY clients.id
        $sql = "SELECT  id, price  
            FROM tickets
            WHERE clientsId = :clientId
            ";
    //preparation requête
    $statement = $pdo->prepare($sql);
    //jonction entre le paramètre nommé :clientId et $clientId
    $statement->bindParam(":clientId",$clientId,PDO::PARAM_INT);
    //execution requête
    $statement->execute();

   
    $ticket = $statement->fetchAll(PDO::FETCH_CLASS,"Ticket");

    return $ticket;


    }

    public function afficherTicket(){
        echo "<tr>";
        echo "<td>".$this->price."</td>";
        echo "</tr>";
    }
}


?>