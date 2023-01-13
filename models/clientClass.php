<?php
//inclusion la config(BDD)
require("config.php");

require_once("ticketClass.php");

Class Client {
    public int $id;
    private string $firstName; //prenom
    private string $lastName; //nom
    private string $birthDate;
    private ?int $cardNumber; 
    public bool $card;
    private ?string $type;
    private ?int $discount;
    public ?array $ticketListe;
    
   


    // public function __construct(string $firstName,string $lastName,int $birthDate, int $cardNumber, bool $card)
    // {
    //     $this->firstName = $firstName;
    //     $this->lastName = $lastName;
    //     $this->birthDate = $birthDate;
    //     $this->cardNumber = $cardNumber;
    //     $this->card = $card;
    // }
    //Exercice 2

    public function displayBirthDate():string{
        $date = new DateTime($this->birthDate);
        $dateOutput = $date->format("d / m / Y") ;
        return $dateOutput;
    }
    static function readAll():array{
        global $pdo;

        $sql = "SELECT `id`,`lastName`, `firstName`,`birthDate`,`cardNumber`,`card` FROM `clients` LIMIT 20";
        //preparation bdd
        $statement = $pdo->prepare($sql);
        //execution
        $statement->execute();
        //
        $clients = $statement->fetchAll(PDO::FETCH_CLASS,"Client");
        
        return $clients;
    }
   
    

    function afficherInfos(){
        echo "<tr>";
        echo "<td>".$this->lastName."</td>";
        echo "<td>".$this->firstName."</td>";
        echo "<td>".$this->displayBirthDate()."</td>";
        echo "<td>".$this->card."</td>";
        echo "<td>".$this->cardNumber."</td>";
        echo "<td><a type='button' class='btn btn-secondary'href='clientDetail.php?id=$this->id'>Detail</a></td>";
        echo "<tr>";
    }


    static function readAllWithCard():array{
        global $pdo;
        
       
        $sql = "SELECT * FROM clients WHERE card = 1 ";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $clientAvecCarte = $statement->fetchAll(PDO::FETCH_CLASS,"Client");

        return $clientAvecCarte;

    }
    //function static de type Client
    static function readOne(int $id):Client{
        global $pdo;
        //requete SQL avec la selection d'un id client
        // $sql = "SELECT clients.id ,clients.lastName, clients.firstName, clients.birthDate, clients.card, clients.cardNumber,cardtypes.type,cardtypes.discount
        // FROM clients
        // INNER JOIN cards
        // ON clients.cardNumber = cards.cardNumber
        // INNER JOIN cardtypes
        // ON cardtypes.id = cards.cardTypesId
        // WHERE id = :id";
        $sql = "SELECT clients . id, 
                        clients . lastName,
                        clients . firstName, 
                        clients . birthDate, 
                        clients . cardNumber,
                        clients . card,
                        cardtypes . type,
                        cardtypes . discount
        FROM clients
        LEFT JOIN cards ON clients . cardNumber = cards . cardNumber
        LEFT JOIN cardtypes ON cards . cardTypesId = cardtypes . id
        WHERE clients . id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Client');

        $unClient = $statement->fetch();

        //recuperation des information de ses tickets
        $unClient->ticketListe = Ticket::readTicket($id);
        
        return $unClient;
        
        
        // $statement = $pdo->prepare($sql);
        // //Exécution d'une requête préparée avec des emplacements nommés
        // $statement->bindParam(":id",$id,PDO::PARAM_INT);

        // $statement->execute();
        // //Définit le mode de récupération par défaut pour cette instruction
        // $statement->setFetchMode(PDO::FETCH_CLASS,"Client");

        // $unClient = $statement->fetch();

        // return $unClient;

    }
    //function pour afficher le detail d'un client
    function afficherDetail(){
        echo "<tr>";
        echo "<td>".$this->lastName."</td>";
        echo "<td>".$this->firstName."</td>";
        echo "<td>".$this->displayBirthDate()."</td>";
        // echo "<td>".$this->card."</td>";
        // echo "<td>".$this->cardNumber."</td>";

        //si existe un card
        echo ($this->card == 1 ) ? "<td>"."Oui"."</td>" : "<td>"."Non"."</td>";
        // if($this->card == 1) {
        //     echo "<td>"."Oui"."</td>";
        // }else{
        //     echo "<td>"."Non"."</td>";
        // }
        //si existe cardNumber
        echo ($this->cardNumber == NULL ) ?  "<td>"."-"."</td>" : "<td>".$this->cardNumber."</td>";
        // if($this->cardNumber == NULL ){
        //     echo "<td>"."-"."</td>";
        // }else{
        //     echo "<td>".$this->cardNumber."</td>";
        // }      
        echo "</tr>";
    }
    //function afficher les details de la carte fidelite
    function detailCarte(){
        echo "<tr>";
        echo "<td>".$this->type."</td>";
        echo "<td>".$this->discount."</td>";
        echo "</tr>";
    }

    

}

?>