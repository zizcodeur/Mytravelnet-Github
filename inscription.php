<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/stylesheet.css" />
</head>

<body>
    <?php
require('config.php');
if (isset($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['mdp'], $_REQUEST['cni'])){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $name = stripslashes($_REQUEST['name']);
  $name = mysqli_real_escape_string($conn, $name); 
  // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $mdp = stripslashes($_REQUEST['mdp']);
  $mdp = mysqli_real_escape_string($conn, $mdp);
  // récuperer le cni etles antislashes ajoutés par le formulaire
  $cni= stripslashes($_REQUEST['cni']);
  $cni= mysqli_real_escape_string($conn, $cni);

  //requéte SQL + mot de passe crypté
    $query = "INSERT into `users` (name, email, mdp, cni)
              VALUES ('$name', '$email', '".hash('sha256', $mdp)."', '$cni')";
  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if($res){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='connexion.php'>connecter</a></p>
       </div>";
    }
}else{
?>
    <form class="box" action="" method="post">
        <h1 class="box-title">S'inscrire</h1>
        <input type="text" class="box-input" name="name" placeholder="Nom d'utilisateur" required />
        <input type="text" class="box-input" name="email" placeholder="Email" required />
        <input type="password" class="box-input" name="mdp" placeholder="Mot de passe" required />
        <input type="number" class="box-input" name="cni" placeholder="CNI" required />
        <input type="submit" name="submit" value="S'inscrire" class="box-button" />
        <p class="box-register">Déjà inscrit? <a href="connexion.php">Connectez-vous ici</a></p>
    </form>
    <?php } ?>
</body>

</html>