<?php require("user.php"); ?>
<?php require("programme.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/identification.css">
    <title>Identification</title>
</head>

<body>
    <!-- HEADER -->
    <div class="page">
        <header>
            <div class="container">
                <nav class="menu-bar">

                    <!--TITRE-->

                    <div class="logo">
                        <ul class="titre">
                            <li class="name">
                                <a>
                                    <h1>Fitness<span class="tld">.php</span></h1>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--MENU DROIT-->

                    <div class="menu">
                        <ul class="right">
                            <li><b><a href="#">Decouvrir</a></li></b>
                            <li><b><a href="conseil.php">Conseil</a></li></b>
                            <li><b><a href="apropos.php">A propos</a></li></b>
                            <li><b><a href="identification.php">S'identifier</a></li></b>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </nav>
        </header>
    </div>
    </div>
    <!-- FIN HEADER -->
    <!-- Formulaire d'inscription -->
    <div class="form1">
        <h2>Inscription</h2>
        <form action="identification.php" method="POST">
            <label>Identifiant :</label>
            <input type="text" name="username" required />
            <p></p>
            <label>Mot de passe :</label>
            <input type="password" name="password" required />
            <p></p>
            <label>Confirmez le mot de passe :</label>
            <input type="password" name="password2" required />
            <p></p>
            <input type="submit"></input>
        </form>
        <p></p>
    </div>

    <?php
            

            try 
            {
                $Base =  new PDO('mysql:host=localhost; dbname=base_sportive; charset=utf8', 'root', '');
            }
            catch(Exception $erreurs) 
            {
            
                echo "erreur à la base impossible";
            } 
            
            
            if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password2']))
            {
                if($_POST['password'] == $_POST['password2'])
                {
                    //les valeurs post sont bonnes mais l'instanciation ne marche pas ?
                    
                    $user1 = new user($_POST['username'],$_POST['password']); //les mots de passe sont corrects, on crée l'objet user
                    $user1->getPseudo();
                    echo "inscription réussie";
                    
                }

                ?> 
                <div class="form1">
                    <h3>Veuillez saisir votre taille et votre poids</h3>
                    
                    <form action="identification.php" method="POST">
                        <label>Taille :</label>
                        <input type="text" name="taille" required />
                        <p></p>
                        <label>Poids :</label>
                        <input type="text" name="poids" required />
                        <p></p>
                        <input type="submit"></input>
                    </form>

                    <p></p>
                </div>
                <?php 
                    
                        

                        	
            }

            if(isset($_POST['taille'])&&isset($_POST['poids']))
            {
                        $imc = $_POST['poids']/($_POST['taille']*$_POST['taille']); //calcul de l'imc OK
                    
                        ?> <form action="identification.php" method="post"> <?php
                    
                            if($imc>=25 && $imc<=30)     
                            { ?>
                                <input type="checkbox" id="tonic1" name="prog[]" value="1">
                                <label for="coding">Tonic</label> <?php
                            } ?>

                        <p></p>
                      <?php	if($imc>=18.35 && $imc<27)
                            { ?>
                                <input type="checkbox" id="intensif1" name="prog[]" value="2">
                                <label for="coding">Intensif</label> <?php
                      	    } ?>
                        <p></p>

                      <?php if($imc>=16.5 && $imc<26)
                            { ?>
                                <input type="checkbox" id="forme1" name="prog[]" value="3">
                                <label for="coding">Forme</label>
                            <?php		    
                            }
                            ?>
                            <input type="submit" value="Envoyer"></input>
                            </form> 
                            <?php
            }
            
            
                if(isset($_POST['prog']))
                {
                    echo "c bon"; //c pas bon
                    foreach($_POST['prog'] as $idprog)
                    {
                        echo $idprog;
                        $user1->ajouteidprog($idprog); //on ajoute dans la valeur de la case cochée dans l'attribut idprog du user1    
                        $user1->metenbase($Base);
                    }
                }
            
            
    ?>
          


    

    <!-- Formulaire de connexion -->
    <div class="form2">
        <h2>Connexion</h2>
        <form action="identification.php" method="POST">
            <p></p>
            <label>Identifiant :</label>
            <input type="text" name="username" required />
            <p></p>
            <label>Mot de passe :</label>
            <input type="password" name="password" required />
            <p></p>
            <input type="submit" />
        </form>
    </div>

    

</body>
</html>