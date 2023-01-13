<?php
//inclusion client class
require_once("models/clientClass.php");
//inclusion show class
require_once("models/showClass.php");
//inclusion ticket class
require_once("models/ticketClass.php");
//inclusion head
require_once("assets/inc/head.php");
//appellé la methode static readAll
$clients = Client::readAll();
// var_dump($clients);
//static method pour afficher les client avec une carte
$clientAvecCarte = Client::readAllWithCard();
//static method afficher les show
$details = Show::readAll();


?>
<title>Colyseum</title>
<!-- inclusion header -->
<?php require_once("assets/inc/header.php");?>
<main>
    <h3 class="text text-center">Liste de clients</h3>
    <div class="container">
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th scope="col">Last name</th>
                    <th scope="col">First name</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Card</th>
                    <th scope="col">Card number</th>
                    <th scope="col">Action</th>
                </tr>
                <?php
                foreach($clients as $client){
                    $client->afficherInfos();
                }
                ?>
            </table>

            <h4>Client avec une carte</h4>
            <table class="table table-striped">
                <tr>
                <th scope="col">Last name</th>
                    <th scope="col">First name</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Card</th>
                    <th scope="col">Card number</th>
                </tr>
                <?php
                foreach($clientAvecCarte as $value){
                    $value->afficherInfos();
                }
                ?>
            </table>
            <h4>Afficher spectacle</h4>
            <table class="table table-striped table-info bordered">
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Artiste</th>
                    <th scope="col">Date</th>
                    <th scope="col">Show type</th>
                </tr>
                <?php
                foreach($details as $detail){
                    $detail->afficherInfos();
                }
                ?>
            </table>
        </div>
    </div>
</main>