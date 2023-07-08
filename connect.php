<?php 

require_once'config.php';

if(isset($_POST['submit']))
{
    if(!empty($_POST['idMembre']) AND !empty($_POST['password']))
    {   
        
        $ident = $_POST['idMembre']; 
        $password = sha1($_POST['password']);
        $president = "President";
        $secretaire = "Secretaire";
        $tresorier = "Tresorier";
        $membre = "Membre";

        
        
        $ident_length=strlen($ident);
        if($ident_length<=11)
        {
            if(filter_var($ident))
            {
                $verifident = $bdd->prepare("SELECT * FROM membre WHERE idMembre = ? AND password =?");
                $verifident->execute(array($ident,$password));
                $identexist = $verifident->rowCount();

                $verifident2 = $bdd->prepare("SELECT * FROM fonction WHERE idMembre = ? AND libelle =?");
                $verifident2->execute(array($ident,$president));
                $identexist2 = $verifident2->rowCount();

                $verifident3 = $bdd->prepare("SELECT * FROM fonction WHERE idMembre = ? AND libelle =?");
                $verifident3->execute(array($ident,$tresorier));
                $identexist3 = $verifident3->rowCount();

                $verifident4 = $bdd->prepare("SELECT * FROM fonction WHERE idMembre = ? AND libelle =?");
                $verifident4->execute(array($ident,$secretaire));
                $identexist4 = $verifident4->rowCount();

                $verifident5 = $bdd->prepare("SELECT * FROM fonction WHERE idMembre = ? AND libelle =?");
                $verifident5->execute(array($ident,$membre));
                $identexist5 = $verifident5->rowCount();

                $verifident5 = $bdd->prepare("SELECT * FROM membre WHERE idMembre = ? ");
                $verifident5->execute(array($ident));
                $identexist = $verifident5->rowCount();


                if($identexist == 1)



                {
                    
                    
                    $userinfo = $verifident5->fetch();
                    $_SESSION['ident']=$ident;
                    $_SESSION['idR']=$userinfo['Id_reunion'];
                    $_SESSION['user']=$userinfo['nom'];
                    $_SESSION['photo']=$userinfo['photo'];;
                    if($identexist2==1)
                    {
                      header('Location: admin_index.php?reg_err=success');
                    }

                    if($identexist3==1)
                    {
                      header('Location: tresorier_gestion.php?reg_err=success');
                    }

                    if($identexist4==1)
                    {
                      header('Location: secretaire_gestion.php?reg_err=success');
                    }

                    if($identexist5==1)
                    {
                      header('Location: membre_gestion.php?reg_err=success');
                    }

                    
                
                   
                }
                else
                {
                    header('Location: connect.php?reg_err=already');
                }
            }
            else
            {
                header('Location: connect.php?reg_err=ident');
            }
        }
        else
        {
            header('Location: connect.php?reg_err=ident_length');
        }
    }
    else
    {
        header('Location: connect.php?reg_err=remplir'); 
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
  <title>connection</title>

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
            <li><button type="button" class="btn btn-outline-dark"
                style="margin-top:15px ;margin-right: 60px ;">CONNEXION</button></li>
            </li>
          </ul>
        </div>
      </nav>



    </div>
  </header>
  <section>

    <div class="row text-center">
      <form class="for1" action="" method="post">
        <h1 style="text-align: center;">CONNEXION</h1>
        <br> <span   style="text-align: center;">
          <img class="im" src="./image/util.png" alt="">
        </span>
        <br>
        <br>
        <p class="description">
          Veuillez Saisir Vos Informations
        </p><br>
        <form style="text-align: center;">
            <div class="col-lg-10">
              <label for="inputPassword" class="col-sm-2 col-form-label">identifiant</label>
              <input type="password" class="col-sx-10" name="idMembre" id="idMembre" placeholder=""><br><br>
            </div>
            <!-- <div class="col-lg-10">
              <label for="inputPassword" class="col-sm-2 col-form-label">identifiant de la reuinion</label>
              <input type="text" class="col-sx-10" name="idR" id="idR" placeholder=""><br><br>
            </div> -->
            <div class="col-lg-10">
              <label for="inputPassword" class="col-sm-2 col-form-label">Mot de Passe</label>
              <input type="password" class="col-sx-10" name="password" id="password" placeholder=""><br> <br>
            </div>
            
          
          <button type="submit" name="submit" class="btn btn-outline-dark"
            style="margin-top:15px ;margin-right: 60px ;">CONNEXION</button>
        </form>


      </div>

    </div>





  </section>






  <script src="./js/doc.js"></script>


</body>

</html>