
<?php
require_once 'config.php';
$verifident = $bdd->prepare("SELECT photo FROM membre WHERE idMembre = ?");
$verifident->execute(array($_SESSION['ident']));

$row = $verifident->fetch(PDO::FETCH_ASSOC);
$tof = $row['photo'];

$imageData = base64_encode($tof);
$src = 'data:image/jpg;base64,' . $imageData;
// echo '<img src="'.$src.'" alt="Photo">';

// header('Content-Type: image/jpg');

$insert1 = $bdd->prepare("SELECT Montant_individuel FROM reuinion where Id_reunion = ? ");
$insert1->execute(array( $_SESSION['idR']));

$i=0;
$j=0;
$k=0;
$m=0;
$l=0;


$insert2 = $bdd->prepare("SELECT montant_Ver FROM versementcotis");
$insert2->execute();


$insert3 = $bdd->prepare("SELECT deux_vers FROM versementcotis");
$insert3->execute();

$insert4 = $bdd->prepare("SELECT date_cotis FROM cotise");
$insert4->execute();

$insert5 = $bdd->prepare("SELECT montant_Ver FROM versementcotis");
$insert5->execute();

$insert6 = $bdd->prepare("SELECT deux_vers FROM versementcotis");
$insert6->execute();

while ($mv = $insert2->fetch()) { 
  
  
  $i = $i + $mv['montant_Ver'];


}

while ($dv = $insert3->fetch()) { 
  
  
  $j = $j + $dv['deux_vers'];


}

while ($mv2 = $insert5->fetch()) { 
  
  $k=0;
  $k = $k + $mv2['montant_Ver'];


}

while ($dv2 = $insert6->fetch()) { 
  
  $l=0;
  $l = $l + $dv2['deux_vers'];


}

while ($d = $insert4->fetch()) { 
  
  $m='';
  $m = $d['date_cotis'];


}

$mc = $insert1->fetch();
  


// $insert2 = $bdd->prepare("SELECT STATUS FROM requete");
// $insert2->execute();
// $insert3 = $bdd->prepare("SELECT membre.nom FROM membre INNER JOIN requete 
//                     ON requete.idMembre = membre.idMembre");
// $insert3->execute();
// $insert4 = $bdd->prepare("SELECT * FROM requete");
// $insert4->execute();

?>







<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Doc</title>

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

      .yo{
        margin-top: 25px;
      }

      .ya{
        font-size: 50px;
        color: grey;
      }

      .yya1{
        border-left: green 5px solid;
      }
      .yya2{
        border-left: red 5px solid;
      }
      .yya3{
        border-left: yellow 5px solid;
      }
      .yya4{
        border-left: violet 5px solid;
      }

      .scrollto{
        background-color: #ffc107;
      }

      .scrollto:hover{
        background-color: #f3a005;
      }

      .act{
        background-color: #ebd5ac;
      }

      .me-0{
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
          <h1 class="text-light"><a href="index.html">Alex Smith</a></h1>
          <div class="mt-3 text-center">
            <a href="#" class="btn btn-primary">Editer le profil</a>
          </div>
        </div>
  
        <nav id="navbar" class="nav-menu navbar">
          <ul class="w-100 lol">
            <li><a href="./admin_index.php" class="nav-link scrollto text-light"><span>Repondre aux requetes</span></a></li>
            
            <hr>
            <li><a href="#" class="nav-link scrollto text-light act"><span>Consulter l'etat des <br> caisses</span></a></li>
            
          </ul>
        </nav><!-- .nav-menu -->

          <div style="padding: 2%;">
            <a href="./admin_liste_membre.php" class="btn btn-primary w-100">Afficher la liste des membres</a>
        </div>
        <hr style="background-color: white; height: 6px;">
        <div style="padding: 2%;">
          <a href="./deconnexion.php" class="btn btn-danger w-100">Deconnexion</a>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="section-title">
            <h2>ETAT DES CAISSES</h2>
          </div>
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card yya1 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Montant de la cotisation </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php {echo $mc['Montant_individuel'];} ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-calendar ya"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card yya2 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Cotisation total</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php {echo $i;} ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-coin ya"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card yya3 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Ma dete</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-clipboard ya"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card yya4 shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                     Montant Caisse Epargne </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php {echo $j;} ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bx bx-archive ya"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <div class="table-responsive">
            <table class="table table-striped table-sm" id="list">
              <thead>
                <tr>
                  <th scope="col">Caisses</th>
                  <th scope="col">Derniere mise a jour</th>
                  <th scope="col">valeur du dernier versement</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="No">caisses principale</td>
                  <td>
                    <?php echo $m;?>
                  </td>
                  <td>
                    <?php echo $k; ?>
                  </td>
                </tr>
                <tr>
                  <td class="No">caisse Epargne</td>
                  <td>
                    <?php echo $m; ?>
                  </td>
                  <td>
                    <?php echo $l; ?>
                  </td>
                </tr>
                              </tbody>
            </table>
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
