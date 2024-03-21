<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{

    if (isset($_GET['editid'])){
        $idE = $_GET['editid'];
        $_SESSION['$idE'] = $idE;
        $resultat = $conect->query("SELECT todo FROM tache WHERE idtache='$idE' "); //pour garder la tache editer
        $i = $resultat->fetch_assoc();
        $todo = $i['todo'];
        $_SESSION['$todo'] = $todo;
    
    


?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="dessin.css">
<head>
    <h1>Editeur</h1> 
    <button><a href="sortir.php">Se déconnecter</a></button>
</head>

<body>
    
        <form action="finalsave.php" method="POST">
            <input class="mdf" name="tache" type="text" placeholder="Saisir votre tâche" value="<?php echo $todo;?>">
            <br><input type="submit" name="oui" value="sauvgarder">
            <button><a href="todo.php" >Annuler</a></button>
        </form>
        
</body>
</html>

<?php } 
} ?>