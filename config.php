<?php

define("DB_NAME", "colyseum");

define("DB_USER", "root");

define("DB_PASSWORD","");

define("DB_HOST","localhost");

$pdo = new PDO("mysql:dbname=". DB_NAME . ";host=" .DB_HOST, DB_USER, DB_PASSWORD);



?>