<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["name"])){
    header("Location: connexion.php");
    exit(); 
  }
  $user = $_SESSION['name'];
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/stylesheet.css" />

</head>

<body>
    <?php
require('config.php');
if (isset($_REQUEST['date_dep'], $_REQUEST['date_arr'], $_REQUEST['pays_dep'], $_REQUEST['pays_arr'])){
  // récupérer la date de départ et supprimer les antislashes ajoutés par le formulaire
  $datedep = stripslashes($_REQUEST['date_dep']);
  $datedep = mysqli_real_escape_string($conn, $datedep); 
  // récupérer la date d'arrivée et supprimer les antislashes ajoutés par le formulaire
  $datearr = stripslashes($_REQUEST['date_arr']);
  $datearr = mysqli_real_escape_string($conn, $datearr);
  // récupérer le pays de départ et supprimer les antislashes ajoutés par le formulaire
  $paysdep = stripslashes($_REQUEST['pays_dep']);
  $paysdep = mysqli_real_escape_string($conn, $paysdep);
  // récuperer le pays d'arrivée et supprimer les antislashes ajoutés par le formulaire
  $paysarr= stripslashes($_REQUEST['pays_arr']);
  $paysarr= mysqli_real_escape_string($conn, $paysarr);

  //requéte SQL pour ajouter les données
  //$query = "INSERT into `users` where name = $user (date_depart, date_arrivee, pays_dep, pays_arr) VALUES ('$datedep', '$datearr', '$paysdep', '$paysarr')";
  //$query = "UPDATE users SET date_depart =".$datedep." WHERE name = ".$user;

  $query = "UPDATE users SET date_depart='$datedep', date_arrivee='$datearr' , pays_dep='$paysdep' , pays_arr='$paysarr' WHERE name = '$user'";

  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>" .$user."
             <h3>la reservation a bien été enregistré.</h3>
             <p>Cliquez ici pour aller <a href='index.html'>D'accueil</a></p>
       </div>";
    }
}else{
?>


    <div class="sucess">
        <form class="box" action="" method="post">
            <h1 class="box-title" style="color : blue; font-size : 45px">Réservation</h1>
            <label for="date_dep" style="color : black; float : left; padding-top : 10px; padding-bottom : 10px">Date
                départ</label>
            <input type="text" value="" name="date_dep" class="box-input" placeholder="05/12/2022" />

            <label for="date_arr" style="color : black; float : left; padding-top : 10px; padding-bottom : 10px">Date
                d'arrivée</label>
            <input type="text" value="" name="date_arr" class="box-input" placeholder="05/01/2022" />


            <label for="pays_dep" style="color : black; float : left; padding-top : 10px; padding-bottom : 10px">Pays de
                départ</label>
            <input type="text" value="" name="pays_dep" class="box-input" placeholder="Dakar" />

            <label for="pays_arr" style="color : black; float : left; padding-top : 10px; padding-bottom : 10px">Pays
                d'arrivé</label>
            <input type="text" value="" name="pays_arr" class="box-input" placeholder="Luxemburg" />
            <input type="submit" value="Réserver" name="reserver" class="box-button" />
        </form>
        <a href="deconnexion.php">Déconnexion</a>
    </div>
    <?php } ?>
</body>

</html>