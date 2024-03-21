<?php
session_start();

include("connection.php");//Connect base des données.

if (isset($_POST['submit'])){

    $_SESSION['email'] = $_POST['email']; 
    $_SESSION['password'] = $_POST['mdp'];

    $email = $_POST['email'];
    $password = $_POST['mdp'];
    $sql = "SELECT * FROM user WHERE email = '$email' AND mdp = '$password' ";
    $result = $conect->query($sql);
    
    if ($result->num_rows  > 0){
        header('location: todo.php');
        
    }else{
        echo " email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">

    <body>
        <form action="login.php" method="post">
            
            <input class="mdf" name="email" type="email" placeholder="Email*">
            <br >
            <input class="mdf" name="mdp" type="password" placeholder="Mot de passe*">
            <br> <br>
            <input id="sub" type="submit" name="submit" value=" Se connecter ">
            <p><a href="sign.php">Créer un nouveau compte</a></p>
        </form>
    </body>
</html>