<?php
class Show{
    private string $title;
    private string $performer;
    private string $date;
    private string $type;
    
    static function readAll():array{
        global $pdo;
        //j'execute la requete sql pour afficher title,artist,date et type dans le deux table
        $sql = "SELECT title, performer, date, type 
                FROM shows
                INNER JOIN showtypes
                WHERE shows.id = showtypes.id";
        //preparation 
        $statement = $pdo->prepare($sql);
        //execution statement
        $statement->execute();
        $details = $statement->fetchAll(PDO::FETCH_CLASS,"Show");

        return $details;

    }
    public function afficherInfos(){
        echo "<tr>";
        echo "<td>".$this->title."</td>";
        echo "<td>".$this->performer."</td>";
        echo "<td>".$this->date."</td>";
        echo "<td>".$this->type."</td>";
        echo "</tr>";

    }
}
?>