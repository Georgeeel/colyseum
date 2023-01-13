<?php
//inclusion clientClass
require_once("models/clientClass.php");
//head
require_once("assets/inc/head.php");
//appellé la method readOne pour récupérer l'id du URL
$unClient = Client::readOne($_GET["id"]);
// var_dump($unClient);
// exit;
require_once("models/ticketClass.php");
//$ticket = Ticket::readTicket($_GET["id"]);
// var_dump($unClient->ticketListe);
?>
<title>Detail d'un client</title>
<?php require_once("assets/inc/header.php");?>
    <main>
    <h3 class="text text-center">Colyseum</h3>
        <div class="container mt-4">
            <div class="row">
                <div class="col-8">
                <h4>Detail client</h4>
                <table class="table table-striped table-info">
                    <tr>
                        <th scope="col">Last Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Card</th>
                        <th scope="col">N° card</th>
                    </tr>
                        <?php
                        $unClient->afficherDetail();
                        ?>
                </table>
                </div>
                <div class="col-4">
                    <h4>Detail carte</h4>
                    <table class="table table-striped table-info">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Discount</th>
                            <?php
                            $unClient->detailCarte();
                            ?>
                        </tr>
                    </table>
                </div>
               
                <div class="row ">
                    <div class="col-4">
                    <!-- tableau afficher le prix total -->
                    <table class="table table-striped table-success">
                        <tr>
                            <th scope="col">Prix</th>
                        </tr>
                        <tr>
                            <?php
                                $totalPrice = 0;
                                foreach($unClient->ticketListe as $ticket){ 
                                    $totalPrice += $ticket->price
                            ?>
                                <td><?=$ticket->price?></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    </div>
                    <div class="col-4">
                        <table class="table table-striped table-success">
                            <tr>
                                <th scope="col">Prix total:</th>
                            </tr>
                            <tr>
                                <td><?= $totalPrice;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-2">
                    <a type='button' class='btn btn-secondary'href='index.php'>Retour</a>
                </div>
            </div>
        </div>
    </main>
    <?php


    ?>
