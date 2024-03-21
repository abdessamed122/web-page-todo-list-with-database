<?php
//http://localhost/web_site_tp/sign.php
session_start();
include("connection.php"); //connecté avec base des données.


if (isset($_POST['submit'])) {
    $username = $_POST['nom'];
    $password = $_POST['mdp'];
    $cpassword = $_POST['mdp_confirmation'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];

    $sql = "SELECT * FROM user WHERE email = '$email' ";
    $result = $conect->query($sql);

    if ($result->num_rows  > 0) {
        echo "<span> Email existe déja.  </span>";
    } elseif ($password != $cpassword && $password != "") { //mdp == non vide ,et = à confirmation_mdp
        echo "<span> Vérifié votre mot de passe.  </span>";

    }else{
        $insert = "INSERT INTO user (nom, email, mdp, sexe) 
                   VALUES 
                   ('$username', '$email', '$password', '$sexe')";
        $conect->query($insert);
        header('location: login.php');
    }

}

?>


<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">

    <body>
        <form action="" method="POST">
            
                  <!-- *==> required -->
            <input class="mdf" type="text" name="nom" required placeholder="nom d'utilisateur*">
            <br>
            <input class="mdf" type="email" name="email" required placeholder="Email*">
            <br >
            <input class="mdf" type="password" name="mdp" required placeholder="Mot de passe*">
            <br>
            <input class="mdf" type="password" name="mdp_confirmation" required placeholder="Confirme Mot de passe*">
            <br>
            *Sexe:
            <select name="sexe" required >
                <option value="Homme"> Homme </option>
                <option value="Femme"> Femme </option>
            </select>
            <br> <br>
            <input  type="submit" id="sub" name="submit" value=" Créer un compte ">
            <p><a href="login.php">J'ai un compte</a></p>

        </form>
    </body>
</html>