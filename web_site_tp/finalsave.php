<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{

    if(isset($_POST['oui'])){

        $tdo = $_SESSION['$todo'];
        $idedit = $_SESSION['$idE'];

        if ($_POST['tache'] == $tdo) { //si ne modifier rien!
            header('location: todo.php');
        }elseif($_POST['tache']==""){ //s'il supprime et fait sauvgarder ==> supprimer la tache
            header('location: supprimer.php?deletid='.$idedit);
        }else {
            $nv = $_POST['tache'];
            $editer = $conect->query("UPDATE tache SET todo = '$nv' WHERE idtache = '$idedit' ");
            if ($editer) {
                header('location: todo.php');
            }else {
                echo 'Dzl, un erreur de mis à jour!' ;
            }

        }
    
    }

}
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    echo "Connectez vous d'abord, svp.";
    exit;
}

$email = $_SESSION['email'];
$id = null;

$resultat = $conect->query("SELECT iduser FROM user WHERE email='$email' ");
if ($resultat && $resultat->num_rows > 0) {
    $i = $resultat->fetch_assoc();
    $id = $i['iduser'];
} else {
    echo "Une erreur est survenue, veuillez vous reconnecter.";
    exit;
}

if (isset($_POST['submitA']) && !empty(trim($_POST['tache']))) {
    $tache = mysqli_real_escape_string($conect, $_POST['tache']);
    $insert = "INSERT INTO tache (todo, iduser) VALUES ('$tache', '$id')";
    if ($conect->query($insert)) {
        header("Location: todo.php");
        exit;
    } else {
        echo "Une erreur est survenue lors de l'ajout de la tâche.";
    }
}
?>

<!doctype html>
<html>
<head>
	<title>Task List</title>
    <style>
        .button {
            display: inline-block;
            padding: 5px 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            background-color: #f9f9f9;
        }
        .button:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
	<header>
		<h1>Task List</h1>
		<form action="todo.php" method="POST">
			<input type="text" name="tache" id="new-task-input" placeholder="Saisir votre tâche" required>
			<input type="submit" name="submitA" id="new-task-submit" value="Add task" class="button">
		</form>
	</header>
	<main>
		<section class="task-list">
			<h2>Tasks</h2>
            <?php 
            $R = $conect->query("SELECT idtache, todo FROM tache WHERE iduser = '$id' ");
            if ($R && $R->num_rows > 0) {
                while($T = $R->fetch_assoc()){
                    echo '<div>';
                    echo '<span>' . htmlspecialchars($T['todo']) . '</span>';
                    echo ' <a href="modifier.php?editid='.$T['idtache'].'" class="button">Modifier</a>';
                    echo ' <a href="supprimer.php?deletid='.$T['idtache'].'" class="button">Supprimer</a>';
                    echo '</div>';
                }
            } else {
                echo 'Aucune tâche à afficher.';
            }
            ?>
		</section>
	</main>

</body>

</html>

?>