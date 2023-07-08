
<?php
require_once 'config.php';

$idR=$_SESSION['idR'];
$insert1 = $bdd->prepare("SELECT * FROM membre ");
$insert1->execute();

$insert2 = $bdd->prepare("SELECT nom FROM membre");
$insert2->execute();

$insert3 = $bdd->prepare("SELECT prenom FROM membre");
$insert3->execute();

$insert4 = $bdd->prepare("SELECT anneeEntree FROM membre");
$insert4->execute();

$insert5 = $bdd->prepare("SELECT sexe FROM membre");
$insert5->execute();

$insert6 = $bdd->prepare("SELECT telephone1 FROM membre");
$insert6->execute();

// $insert7 = $bdd->prepare("SELECT * FROM membre");
// $insert7->execute();



?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    
    <title>Membre</title>

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

    <header class="navbar navbar-dark bg-warning sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="gestion.html">KOTIS.</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex w-100 justify-content-center" style="padding: 1%;">
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
                        <li><a href="#" class="nav-link scrollto text-light act"><span>Avoir la liste des <br> membres</span></a></li>
                        <hr>
                        <li><a href="./membre_cotise.php" class="nav-link scrollto text-light"><span>Cotiser</span></a></li>
                        <hr>
                        <li><a href="./membre_requete.php" class="nav-link scrollto text-light"><span>Effectuer une requete</span></a></li>
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
                <div class="section-title">
                    <h2>LISTE DES MEMBRES</h2>
                </div>
                <div class="w-100 ca"><?php  while ($req = $insert1->fetch()) { 
                                                  $nom = $insert2->fetch();
                                                  $prenom = $insert3->fetch();
                                                  $annee = $insert4->fetch();
                                                  $sexe = $insert5->fetch();
                                                  $tel = $insert6->fetch();
                                                 ?>
                    

                    <div class="card">
                        <div class="card-header">
                            <img src="./image/util.png" alt="Profile Image" class="profile-img">
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                
                                <li><strong>Nom:</strong> <?php {echo $nom['nom'];} ?></li>
                                <li><strong>Prénom:</strong> <?php {echo $prenom['prenom'];} ?></li>
                                <li><strong>Année</strong><?php {echo $annee['anneeEntree'];} ?></li>
                                <li><strong>Sexe</strong><?php {echo $sexe['sexe'];} ?></li>
                                <li><strong>Tel:</strong><?php {echo $tel['telephone1'];} ?></li>
                            </ul>
                            <img src="" alt="">
                        </div>

                        <div class="card-footer">
                            <a href="#" class="btn btn-warning">Deconnexion</a>
                        </div>
                        
                    </div>
                    <?php }?>
                </div>

            </main>
        </div>
    </div>


    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="./assets/js/dashboard.js"></script>
</body>

</html>