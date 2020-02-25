<?php
require("user.php"); 
require("programme.php");
session_start(); 


    try {
        $Base =  new PDO('mysql:host=localhost; dbname=base_sportive; charset=utf8', 'root', '');
    } catch (Exception $erreurs) {

        echo "erreur à la base impossible";
    }


    if (isset($_POST['username'], $_POST['password'], $_POST['taille'], $_POST['poids'])) {

        $MdpUser =  $_POST['password']; //les valeurs post sont bonnes mais l'instanciation ne marche pas ?*
        $IdentifiantUser = $_POST['username'];
        $Taille = $_POST['taille'];
        $Poids = $_POST['poids'];
        $User = new user();
        $User->register($Base,$IdentifiantUser, $MdpUser, $Taille, $Poids);
        $_SESSION['id'] = $User->GetId();
    
    }
$IdUser = $_SESSION['id'];

   $Data =  $Base->query('SELECT * from user WHERE id_user ='.$IdUser);
   $TabData = $Data->fetch();
   $Poids = $TabData['poids']; 
   $Taille = $TabData['taille'];

$imc = $Poids / ($Taille * $Taille); //calcul de l'imc OK
?>


<form action="" method="post"> <?php

                                                    if ($imc >= 25 && $imc <= 30) { ?>
        <input type="radio" id="tonic1" name="prog[]" value="1">
        <label for="coding">Tonic</label> <?php
                                                    } ?>

    <p></p>
    <?php if ($imc >= 18.35 && $imc < 27) { ?>
        <input type="radio" id="intensif1" name="prog[]" value="2">
        <label for="coding">Intensif</label> <?php
                                            } ?>
    <p></p>

    <?php if ($imc >= 16.5 && $imc < 26) { ?>
        <input type="radio" id="forme1" name="prog[]" value="3">
        <label for="coding">Forme</label>
    <?php
    }
    ?>
    <input type="submit" value="Envoyer"></input>
</form>


<?php
    
if (isset($_POST['prog']) && isset($IdUser)) {
    foreach ($_POST['prog'] as $idprog) {
         $IdProgramme = $idprog;
         echo "<div> l'id du programme est :".$IdProgramme."</div>";
    }
$user1 = new user();
$user1->AjoutProgramme($IdProgramme, $Base, $IdUser);

}?> 