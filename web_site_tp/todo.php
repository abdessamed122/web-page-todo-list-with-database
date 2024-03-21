<?php 
session_start();
include("connection.php"); //connecté avec base des données.

if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) { //pour sucurisé, il faut s'inscrir pour entre à ce page.
    echo "Connectez vous d'abord, svp.";
}else{
$email = $_SESSION['email'];

$resultat = $conect->query("SELECT iduser FROM user WHERE email='$email' ");//pour garder iduser
$i = $resultat->fetch_assoc(); //$i['iduser']==> باه نحفضو لكل مستعمل معلوماته
$id = $i['iduser'];

if (isset($_POST['submitA']) && $_POST['tache'] != ""){ //submitA ==> nom de le champ input
$tache = $_POST['tache'];

$insert = "INSERT INTO tache (todo, iduser) VALUES ('$tache', '$id')";
           $conect->query($insert); //pour exécuter
}
?>

<!doctype html>
<html>
   
<head>
	<title>Task List</title>
    <button class="deconneter"><a href="sortir.php">Se déconnecter</a></button>
    <style>
       .copy{font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        display: flex;
        justify-content: end;
        text-align:end;
    }
    .deconneter{
        margin-right:10px;
        border-radius: 10px;
        border: none;
    }
    .deconneter:hover{
        background-color: #868181;
    }
    </style>


</head>
<style>
    .task-list{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .h22{
         display: flex;
        justify-content: center;
        align-items: center;
    }
    .buttons{
        display: flex	;
        justify-content:center;
        align-items:center;
        margin: 10px;
        border-radius: 50px;
    }
    

/* CSS */
.button-24 {
    margin: 5px;
  background: #FF4742;
  border: 1px solid #FF4742;
  border-radius: 6px;
  box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
  box-sizing: border-box;
  color: #000000;
  cursor: pointer;
  display: inline-block;
  font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
  font-size: 10px;
  font-weight: 800;
  line-height: 10px;
  min-height: 35px;
  outline: 0;
  text-align: center;
  text-rendering: geometricprecision;
  text-transform: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
}

.button-24:hover,
.button-24:active {
  background-color: initial;
  background-position: 0 0;
  color: #FF4742;
}

.button-24:active {
  opacity: .5;
}
.button-25 {
    margin: 5px;
  background: #01ff14;
  border: 1px solid #01ff14;
  color: #000000;
  border-radius: 6px;
  box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
  box-sizing: border-box;
  color: #000000;
  cursor: pointer;
  display: inline-block;
  font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
  font-size: 10px;
  font-weight: 800;
  line-height: 10px;
  min-height: 35px;
  outline: 0;
  text-align: center;
  text-rendering: geometricprecision;
  text-transform: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
}

.button-25:hover,
.button-25:active {
  background-color: initial;
  background-position: 0 0;
  color: #FF4742;
}

.button-25:active {
  opacity: .5;
}
   

</style>
<body>
	
	<header>
        <div></div>
		<h1>Task List</h1>
		<form action="todo.php" method="POST">
			<input type="text" name="tache" id="new-task-input" placeholder="Saisir votre tâche" >
			<input type="submit" name="submitA" id="new-task-submit" value="Add task" >
		</form>
	</header>
	<main>
		
			<h2 class="h22">Tasks</h2>
            <hr>
            <section class="task-list">
    
       <?php 
                    $R = $conect->query("SELECT idtache, todo FROM tache WHERE iduser = '$id' "); //pour affiche les tache d'utilisateur
           while($T = $R->fetch_assoc()){
                
                echo '<td>'. $T['todo'].' </td>

                <div class= "buttons">  
                <button class="button-25"><a href="modifier.php?editid='.$T['idtache'].'" >Modifier</a></button>
                <button class="button-24"><a href="supprimer.php?deletid='.$T['idtache'].'" >Supprimer</a></button><br>
                </div>';
            }

            ?>
            
		</section>
	</main>
    <p class="copy">&copy;ABDESSAMED_AHMED</p>

</body>

</html>

<?php } ?>

<!-- ---- --> 
 <!doctype html>
<html>
<head>
	<title>Task List</title>
    <style>
        hr{
            color: #000000;
            border-color: #000000;
        }
        input{
            margin-top:10px ;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            padding: 0;
            background-color: #a9d4f1;
        }
        header {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            border-radius: 20px;
            margin-top: 5px;
        }
        form {
            margin: 0 auto;
            width: 50%;
        }
        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin-right: 5px;
        }
        input[type="submit"] {
            width: 15%;
            padding: 10px;
        }
        .task-list {
            list-style: none;
            margin-bottom: 10px;
            padding: 0;
            display: grid;
            justify-content: center;
            align-items: center;
            background-color: #f1f1f1;
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
            border-radius: 20px;


        }
        .task-list li {
            background-color: #f1f1f1;
            border-bottom: 1px solid #ddd;
            margin: 0;
            padding: 10px;
        }
        .task-list li:last-child {
            border-bottom: none;
        }
        .task-list a {
            color: #000000;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
