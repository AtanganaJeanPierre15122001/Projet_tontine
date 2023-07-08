
<?php
require_once 'config.php';

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
        $id_reuinion = $_SESSION['idR'];
        // $butr = $_POST['But_et_regles'];
        // $nom_reuinion= $_POST['Nom_reuinion'];
        // $nbMax= $_POST['Nb_max'];
        // $montind= $_POST['Montant_individuel'];
        // $jourdepart= $_POST['jour_depart'];
        // $montver= $_POST['montant_ver'];

        
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
                            
                            // $enreg = $bdd->prepare("INSERT INTO reuinion(Id_reunion,But_et_regles,Nom_reuinion,Nb_max,Montant_individuel,jour_depart,montant_ver) VALUES(:Id_reunion,:But_et_regles,:Nom_reuinion,:Nb_max,:Montant_individuel,:jour_depart,:montant_ver)");
                            // $enreg->execute(array(
                            //     'Id_reunion' => $id_reuinion,
                            //     'But_et_regles' => $butr,
                            //     'Nom_reuinion' => $nom_reuinion,
                            //     'Nb_max' => $nbMax,
                            //     'Montant_individuel' => $montind,
                            //     'jour_depart' => $jourdepart,
                            //     'montant_ver' => $montver
                            // ));

                            $enreg1 = $bdd->prepare("INSERT INTO membre(idMembre,nom,prenom,dateNais,anneeEntree,password,sexe,telephone1,email,photo,Id_reunion) VALUES(:idMembre,:nom,:prenom,:dateNais,:anneeEntree,:password,:sexe,:telephone1,:email,:photo,:Id_reunion)");
                            $enreg1->execute(array(
                                'idMembre' => $ident,
                                'nom' => $nom,
                                'prenom' => $prenom,
                                'dateNais' => $date_nais,
                                'anneeEntree' => $annee_adh,
                                'password' => $password,
                                'sexe' => $sexe,
                                'telephone1' => $tel,
                                'email' => $email,
                                'photo' => $tof,
                                'Id_reunion' => $id_reuinion
                                
                            ));

                            $enreg2 = $bdd->prepare("INSERT INTO fonction(codeFonction,libelle,idMembre) VALUES(:codeFonction,:libelle,:idMembre)");
                            $enreg2->execute(array(
                            'codeFonction' => 'Mem'.$ident,
                            'libelle' => "Membre",
                            'idMembre' => $ident
                                                                                  
                            ));

                            // $_SESSION['user']=$nom;
                            // $_SESSION['idR']=$id_reuinion;
                            // $_SESSION['ident']=$ident;
                            // $_SESSION['montind']=$montind;
                            // $_SESSION['montver']=$montver;
                            unset($_SESSION['form_data']);
                            header('Location: secretaire_ajout_membre.php?reg_err=success');
                        }
                        else
                        {
                            header('Location: secretaire_ajout_membre.php?reg_err=password');
                        }
                    }
                    else
                    {
                        header('Location: secretaire_ajout_membre.php?reg_err=already');
                    }
              
                  }
                  else
                  {
                      header('Location: secretaire_ajout_membre.php?reg_err=ident_length');
                  }
          }
          else
          {
              header('Location: secretaire_ajout_membre.php?reg_err=tof');
          } 
     
      }
      else
      {
          header('Location: secretaire_ajout_membre.php?reg_err=remplir'); 
      }
}


?>








<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Secretaire</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;  
            -moz-user-select: none;
            user-select: none;
        }

        .yo {
            margin-top: 25px;
        }

        .scrollto {
            background-color: #ffc107;
        }

        .scrollto:hover {
            background-color: #f3a005;
        }

        .act {
            background-color: #ebd5ac;
        }

        .me-0 {
            color: #1b1005;
            font-weight: bold;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="./assets/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/style2.css">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
</head>

<body>

    <header class="navbar navbar-dark bg-warning sticky-top flex-md-nowrap p-0 shadow" style=" margin:top 0%;">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="gestion.html">KOTIS.</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex w-100 justify-content-center" style="padding: 1%; margin-top:0%;">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#" class="btn btn-light" aria-current="page"><i class="bx bx-home"></i>Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark"><i class="bx bx-user"></i>Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark"><i class="bx bx-file-blank"></i>Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-dark"><i class="bx bx-server"></i>About</a></li>
                <li class="nav-item"><a href="#" class="btn btn-secondary">Sign out</a></li>
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">

                <div class="profile">
                    <img src="./assets/img/favicon.png" alt="" class="img-fluid rounded-circle">
                    <h1 class="text-light"><a href="index.html"><?php echo $_SESSION['user']; ?></a></h1> 
                    <div class="mt-3 text-center">
                        <a href="#" class="btn btn-primary">Editer le profil</a>
                    </div>
                </div>

                <nav id="navbar" class="nav-menu navbar">
                    <ul class="w-100 lol">
                        <!-- <li><a href="./admin_index.php" class="nav-link scrollto text-light"><span>Repondre aux requetes</span></a></li> -->
                        <li><a href="./secretaire_gestion.php" class="nav-link scrollto text-light "><span>Avoir la liste des <br> membres</span></a></li>
                        <hr>
                        <li><a href="" class="nav-link scrollto text-light act"><span>Ajouter des membres</span></a></li>
                        <!-- <li><a href="./admin_etat_membre.php" class="nav-link scrollto text-light"><span>Consulter l'etat des <br> membres</span></a></li> -->
                    </ul>
                </nav><!-- .nav-menu -->

                <!-- <div style="padding: 2%;">
                    <a href="#" class="btn btn-primary w-100">Afficher la liste des membres</a>
                </div> -->
                <hr style="background-color: white; height: 6px;">
                <div style="padding: 2%;">
                    <a href="./deconnexion.php" class="btn btn-danger w-100">Deconnexion</a>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {

                        
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> Nouveau etudiant enregistrer!
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
        <form class="for1" action="" method="post" enctype="multipart/form-data">
            <br> <span style="text-align: center;">
            <img class="im" type="file" id="imageAffichee" name="ima" src="./image/util.png" alt="">
            </span>
        

            <br>
            <br>

        <input type="file" id="image" name="image" onchange="showImage()">
        <br>
        <img id="imageAffichee">
        <!-- <p class="description">
          Veuillez Saisir Vos Informations de <a onclick="alert('Vous etes chargé de controler le bon deroulement de la tontine et d\'accepter les requetes')" href="">President</a>
        </p><br> -->
        
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
          </div><br><br>
          
          

          
          

          <button type="submit" name ="submit" class="btn btn-outline-dark" style="margin-top:15px ;margin-right: 60px ;">
            CONTINUER
          </button>
        </form>

            </main>
        </div>
    </div>


    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./js/doc.js"></script>
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="./assets/js/dashboard.js"></script>
</body>

</html>