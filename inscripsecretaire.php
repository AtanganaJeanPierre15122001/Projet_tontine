<?php

require_once'config.php';

if(isset($_POST['submit']))
{
    if(!empty($_POST['IDmenbre'])  AND !empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Prenom']) AND !empty($_POST['DateNaissance']) AND !empty($_POST['AnneeAdhe']) AND !empty($_POST['Sexe']) AND !empty($_POST['Télephone']) AND !empty($_POST['Email']) AND !empty($_POST['Password']) AND !empty($_POST['confirmPassword']) )
    {   
        
        $ident = $_POST['IDmenbre'];
        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['Prenom']);
        $date_nais = $_POST['DateNaissance'];
        $annee_adh = $_POST['AnneeAdhe'];
        $sexe = $_POST['Sexe'];
        $tel = $_POST['Télephone'];
        $email = $_POST['Email'];
        $tof = $_FILES['image'];
        $password = sha1($_POST['Password']);
        $password_retype = sha1($_POST['confirmPassword']);
        
        $ident_length=strlen($ident);

        if($ident_length<=8)
        {
            if(filter_var($ident))
            {
                $verifident = $bdd->prepare("SELECT * FROM membre WHERE idMenbre = ?");
                $verifident->execute(array($ident));
                $identexist = $verifident->rowCount();
                if($identexist == 0)
                {
                    if($password == $password_retype)
                    {
                        
                        $enreg = $bdd->prepare("INSERT INTO membre(idMembre,nom,prenom,DateNaissance,anneeEntree,password,sexe,telephone1,email,photo) VALUES(:idMembre,:nom,:prenom,:DateNaissance,:anneeEntree,:password,:sexe,:telephone1,:email,:photo)");
                        $enreg->execute(array(
                            'idMembre' => $ident,
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'DateNaissance' => $date_nais,
                            'anneeEntree' => $annee_adh,
                            'password' => $password,
                            'sexe' => $sexe,
                            'telephone1' => $tel,
                            'email' => $email,
                            'photo' => $tof,
                            
                        ));
                        $_SESSION['user']=$nom;
                        header('Location: landing1.php?reg_err=success');
                    }
                    else
                    {
                        header('Location: inscription.php?reg_err=password');
                    }
                }
                else
                {
                    header('Location: inscription.php?reg_err=already');
                }
            }
            else
            {
                header('Location: inscription.php?reg_err=ident');
            }
        }
        else
        {
            header('Location: inscription.php?reg_err=ident_length');
        }
    }
    else
    {
        header('Location: inscription.php?reg_err=remplir'); 
    }
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <title>inscription</title>
</head>

<body>
  <header>

    <div class="container-fluid">
      <nav class="navbar navbar-expand-md  navbar-dark fixed-top ">
        <a class="navbar-brand text-uppercase fw-bold" id="logo" href="gestion.html"> KOTIS.
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="#"><img src="image/Accueil.png" alt="Accueil.png"
                  style="height: 40px; width: 40px;" /><span class="entete">
                  Accueil</span></a></li>
            <li><a class="nav-link" href="#fonc"><img src="image/Analytics.png" alt="Analytics.png"
                  style="height: 40px; width: 40px;" /> <span class="entete">Fonctionnalite</span></a>
            </li>
            <li><a class="nav-link" href="#"><img src="image/Calculatrice.png" alt="Calculatrice.png"
                  style="height: 40px; width: 40px;" /><span class="entete">Gestion</span></a></li>
            <li><a class="nav-link" href="#"><img src="image/cash.png" alt="cash.png"
                  style="height: 40px; width: 40px;" /> <span class="entete">Money</span></a></li>
            <li><button type="button" class="btn btn-outline-dark"
                style="margin-top:15px ;margin-right: 60px ;">CONNEXION</button></li>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {

                        
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'ident':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> identifiant non valide
                            </div>
                        <?php
                        break;

                        case 'ident_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> ident trop long
                            </div>
                        <?php 
                        break;
                        
                        
                        case 'remplir':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> remplissez tous les champs
                            </div>
                        <?php
                        break;


                        case 'nom_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> nom trop long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>

  <section class="container-fluid">
    <div class="row text-center">
      <form class="for1" action="" method="post" enctype="multipart/form-data">
        <h1 style="text-align: center;">CONNEXION</h1>
        <br> <span style="text-align: center;">
          <img class="im" id="imageAffichee" src="./image/util.png" alt="">
        </span>

        <br>
        <br>

        <input type="file" id="image" name="image" onchange="showImage()">
        <br>
        <img id="imageAffichee">
        <p class="description">
          Veuillez Saisir Vos Informations
        </p><br>
        <form action="" method="post">
          <div class="col-lg-10">
            <label for="" class="col-lg-6">Id Membre</label>
            <input type="text" class="col-sx-10" id="IDmenbre" name="IDmenbre" placeholder=""><br><br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Nom</label>
            <input type="text" class="col-sx-10" id="Nom" name="Nom" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Prenom</label>
            <input type="text" class="col-sx-10" id="Prenom" name="Prenom" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Date de naissance</label>
            <input type="date" class="col-sx-10" id="DateNaissance" name="DateNaissance" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Annee d'adhesion</label>
            <input type="text" class="col-sx-10" id="AnneeAdhe" name="AnneeAdhe" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Sexe</label>
            <input type="text" class="col-sx-10" id="Sexe" name="Sexe" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Télephone</label>
            <input type="text" class="col-sx-10" id="Télephone" name="Télephone" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Email</label>
            <input type="mail" class="col-sx-10" id="Email" name="Email" placeholder=""><br> <br>
          </div>  
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Mot de passe</label>
            <input type="password" class="col-sx-10" id="Password" name="Password" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6 ">confirmation du mot de passe</label>
            <input type="password" class="col-sx-10" id="confirmPassword" name="confirmPassword" placeholder=""><br>
            <br>
          </div>

          <button type="submit" class="btn btn-outline-dark" style="margin-top:15px ;margin-right: 60px ;">
            CONNEXION
          </button>
        </form>


    </div>

    </div>






  </section>





  <script>
    function showImage() {
      const input = document.getElementById('image');
      const img = document.getElementById('imageAffichee');
      const file = input.files[0];
      const reader = new FileReader();

      reader.onload = function (e) {
        img.src = e.target.result;
      };

      reader.readAsDataURL(file);
    }
  </script>
















</body>

</html>