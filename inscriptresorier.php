<?php

require_once'config.php';




// if (!isset($_SESSION['form_data'])) {
//   $_SESSION['form_data'] = array(
//       'IDmenbre' => '',
//       'Nom' => '',
//       'Prenom' => '',
//       'DateNaissance' => '',
//       'AnneeAdhe' => '',
//       'Sexe' => '',
//       'Télephone' => '',
//       'Email' => '',
//       'Password' => '',
//       'confirmPassword' => ''
//   );
// }


if(isset($_POST['submit']))
{


  
    if(!empty($_POST['IDmembre'])  AND !empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Prenom']) AND !empty($_POST['DateNaissance']) AND !empty($_POST['AnneeAdhe']) AND !empty($_POST['Sexe']) AND !empty($_POST['Télephone']) AND !empty($_POST['Email']) AND !empty($_POST['Password']) AND !empty($_POST['confirmPassword']) )
    {   
        
        $ident = $_POST['IDmembre'];
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
        
        // $ident_length=strlen($ident);

        // $_SESSION['form_data']['IDmenbre'] = $_POST['IDmenbre'];
        // $_SESSION['form_data']['Nom'] = $_POST['Nom'];
        // $_SESSION['form_data']['Prenom'] = $_POST['Prenom'];
        // $_SESSION['form_data']['DateNaissance'] = $_POST['DateNaissance'];
        // $_SESSION['form_data']['AnneeAdhe'] = $_POST['AnneeAdhe'];
        // $_SESSION['form_data']['Sexe'] = $_POST['Sexe'];
        // $_SESSION['form_data']['Télephone'] = $_POST['Télephone'];
        // $_SESSION['form_data']['Email'] = $_POST['Email'];
        // $_SESSION['form_data']['Password'] = $_POST['Password'];
        // $_SESSION['form_data']['confirmPassword'] = $_POST['confirmPassword'];



        // $ident = $_SESSION['form_data']['IDmenbre'];
        // $nom = $_SESSION['form_data']['Nom'];
        // $prenom = $_SESSION['form_data']['Prenom'];
        // $date_nais = $_SESSION['form_data']['DateNaissance'];
        // $annee_adh = $_SESSION['form_data']['AnneeAdhe'];
        // $sexe = $_SESSION['form_data']['Sexe'];
        // $tel = $_SESSION['form_data']['Télephone'];
        // $email = $_SESSION['form_data']['Email'];
        // $password = $_SESSION['form_data']['Password'];
        // $password_retype = $_SESSION['form_data']['confirmPassword'];
        
        $ident_length=strlen($ident);

        if ($tof['error'] == 0 && getimagesize($tof['tmp_name']) !== false) 
        {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($tof['name']);

            if($ident_length<=8)
            {
                
                    $verifident = $bdd->prepare("SELECT * FROM membre WHERE idMembre = ?");
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
                                'photo' => $tof
                                
                            ));
                            $enreg = $bdd->prepare("INSERT INTO fonction(codeFonction,libelle,idMembre) VALUES(:libelle,:idMembre)");
                            $enreg->execute(array(
                            'libelle' => "Tresorier",
                            'idMembre' => $ident                                                      
                            ));
                            $_SESSION['user']=$nom;
                            unset($_SESSION['form_data']);
                            header('Location: admin_index.php?reg_err=success');
                        }
                        else
                        {
                            header('Location: inscriptresorier.php?reg_err=password');
                        }
                    }
                    else
                    {
                        header('Location: inscriptresorier.php?reg_err=already');
                    }
              
                  }
                  else
                  {
                      header('Location: inscriptresorier.php?reg_err=ident_length');
                  }
          }
          else
          {
              header('Location: inscriptresorier.php?reg_err=tof');
          } 
     
      }
      else
      {
          header('Location: inscriptresorier.php?reg_err=remplir'); 
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
  <title>inscription secretaire</title>
</head>

<body>

<div class="loader">
        <img src="loader.gif" alt="Loader"> 
    </div>


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
            <li><a href="connect.php"><button type="button" class="btn btn-outline-dark"
                style="margin-top:15px ;margin-right: 60px ;">CONNEXION</button></a></li>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>


  <section class="container-fluid">
    <div class="row text-center">
      <form class="for1" action="" method="post" enctype="multipart/form-data">
        
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


                        case 'tof':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> photo non valide
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
                <h1 style="text-align: center; ">President <div style="color: red; text-transform:uppercase;" ><?php echo $_SESSION['user']?></div></h1><br>
        <form action="" method="post" enctype="multipart/form-data">
        <br> <span style="text-align: center;">
          <img class="im" type="file" id="imageAffichee" name="ima" src="./image/util.png" alt="">
        </span>

        

        <br>
        <br>

        <input type="file" id="image" name="image" onchange="showImage()">
        <br>
        <img id="imageAffichee">
        <p class="description">
        Veuillez Saisir les Informations du <a onclick="alert('celui ci est chargé de gerer les differentes requetes de depot d\'argent et pret')" href="">Tresorier</a> ensuite vous serez rediriger vers la page d'administration de votre tontine
        </p><br>
        
          <div class="col-lg-10">
            <label for="" class="col-lg-6">Id Membre</label>
            <input type="text" class="col-sx-10" id="IDmenbre" value="<?php //if(isset($_SESSION['form_data'])) {echo "$ident";}?>"  name="IDmembre" placeholder=""><br><br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Nom</label>
            <input type="text" class="col-sx-10" id="Nom" value="<?php //echo "$nom";?>"  name = "Nom" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Prenom</label>
            <input type="text" class="col-sx-10" id="Prenom" value="<?php //echo "$prenom";?> "name="Prenom" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Date de naissance</label>
            <input type="date" class="col-sx-10" id="DateNaissance" value="<?php //echo "$date_nais";?> "name="DateNaissance" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Annee d'adhesion</label>
            <input type="text" class="col-sx-10" id="AnneeAdhe" value="<?php //echo "$annee_adh";?> "name="AnneeAdhe" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Sexe</label>
            <input type="text" class="col-sx-10" id="Sexe" value="<?php //echo "$sexe";?> "name="Sexe" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Télephone</label>
            <input type="text" class="col-sx-10" id="Télephone" value="<?php //echo "$tel";?> "name="Télephone" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Email</label>
            <input type="mail" class="col-sx-10" id="Email" value="<?php //echo "$email";?> "name="Email" placeholder=""><br> <br>
          </div>  
          <div class="col-lg-10">
            <label for="" class="col-sm-6">Mot de passe</label>
            <input type="password" class="col-sx-10" id="Password" value="" name="Password" placeholder=""><br> <br>
          </div>
          <div class="col-lg-10">
            <label for="" class="col-sm-6 ">confirmation du mot de passe</label>
            <input type="password" class="col-sx-10" id="confirmPassword" value="" name="confirmPassword" placeholder=""><br>
            <br>
          </div>

          <button type="submit" name ="submit" class="btn btn-outline-dark" style="margin-top:15px ;margin-right: 60px ;">
            CONTINUER
          </button>
        </form>


    </div>

    </div>






  </section>





  <script src="./js/doc.js"></script>


</body>

</html>