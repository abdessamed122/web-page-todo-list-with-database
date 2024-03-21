<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{

session_destroy();
header('location: start.php');

}
?>