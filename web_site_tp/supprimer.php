<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{

if (isset($_GET['deletid'])) {
	$idS = $_GET['deletid']; //garder id de latache qui va supprimé.
    $supprime = $conect->query("DELETE FROM tache WHERE idtache = '$idS' ");
	header('location: todo.php');
}


}
?>
