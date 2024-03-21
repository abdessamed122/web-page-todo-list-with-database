<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site";
$conect = new mysqli($servername, $username, $password, $dbname, 3306);

if ($conect->connect_error) {
    die("Erreur de connexion".$conect->connect_error);
}
?>