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

$insert1 = $bdd->prepare("SELECT Motif FROM requete");
$insert1->execute();
$insert2 = $bdd->prepare("SELECT STATUS FROM requete");
$insert2->execute();
$insert3 = $bdd->prepare("SELECT membre.nom FROM membre INNER JOIN requete 
                    ON requete.idMembre = membre.idMembre");
$insert3->execute();
$insert4 = $bdd->prepare("SELECT * FROM requete");
$insert4->execute();


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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <link href="./assets/css/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/style2.css">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Include Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


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
          <img src="<?php echo $src; ?>" alt="img" class="img-fluid rounded-circle">
          <h1 class="text-light"><a href="index.html"><?php echo $_SESSION['user']; ?></a></h1>
          <div class="mt-3 text-center">
            <a href="#" class="btn btn-primary">Editer le profil</a>
          </div>
        </div>

        <nav id="navbar" class="nav-menu navbar">
          <ul class="w-100 lol">
            <li><a href="#" class="nav-link scrollto act"><span>Repondre aux requetes</span></a></li>
            <li><a href="./admin_liste_membre.php" class="nav-link scrollto text-light"><span>Avoir la liste des <br> membres</span></a></li>
            <hr>
            <li><a href="./admin_caisse.php" class="nav-link scrollto text-light"><span>Consulter l'etat des <br> caisses</span></a></li>
            <li><a href="./admin_etat_membre.php" class="nav-link scrollto text-light"><span>Consulter l'etat des <br> membres</span></a></li>
          </ul>
        </nav><!-- .nav-menu -->

        <div style="padding: 2%;">
          <a href="#" class="btn btn-primary w-100">Afficher la liste des membres</a>
        </div>
        <hr style="background-color: white; height: 6px;">
        <div style="padding: 2%;">
          <a href="deconnexion.php" class="btn btn-danger w-100">Deconnexion</a>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="section-title">
          <h2>VOS REQUETES</h2>
        </div>
        <h2 class="text-center yo">03/11/17</h2>
        <hr>
        <!-- <div class="table-responsive">
        <table class="table table-striped table-sm" id="list">
          <thead>
            <tr>
              <th scope="col">Requete</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="No">random</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
            <tr>
              <td class="No">placeholder</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
            <tr>
              <td class="No">data</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
            <tr>
              <td class="No">random</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table> 
        
      </div> -->
        <div class="container">
          <div class="row justify-content-center"><?php while ($req = $insert4->fetch()) { $mot = $insert1->fetch();
                                                  $sta = $insert2->fetch();
                                                  $nom = $insert3->fetch();?>
              <div class="col-lg-4 col-sm-6 mb-4">
                <a class="px-4 py-5 bg-white shadow text-center d-block match-height">
                  <h3 class="mb-3 mt-0"> Membre: <?php {echo $nom['nom'];} ?></h3>
                  <p class="mb-0"> Motif :<?php echo $mot['Motif']; ?> </p>
                  <p class="mb-0">Status :<?php echo $sta['STATUS']; ?> </p>
                </a>

              </div>
            <?php } ?>


            <!-- <div class="col-lg-4 col-sm-6 mb-4">
              <a class="px-4 py-5 bg-white shadow text-center d-block match-height">
                <h3 class="mb-3 mt-0">Requete 2</h3>
                <p class="mb-0"> 	</p>
              </a>
            </div>
      
      <div class="col-lg-4 col-sm-6 mb-4">
              <a class="px-4 py-5 bg-white shadow text-center d-block match-height">
                <h3 class="mb-3 mt-0">Requete 3</h3>
                <p class="mb-0"> 	</p>
              </a>
            </div>
      
      <div class="col-lg-4 col-sm-6 mb-4">
              <a class="px-4 py-5 bg-white shadow text-center d-block match-height">
                <h3 class="mb-3 mt-0">Requete 4</h3>
                <p class="mb-0"> 	</p>
              </a>
            </div> -->

          </div>
        </div>

        <!-- <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Collapsible Group 1</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Collapsible Group 2</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Collapsible Group 3</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div> -->

        <!-- <h2 class="text-center yo">07/11/17</h2>
      <hr>
      <div class="table-responsive">
        <table class="table table-striped table-sm" id="list">
          <thead>
            <tr>
              <th scope="col">Requete</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="No">random</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
            <tr>
              <td class="No">placeholder</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
            <tr>
              <td class="No">data</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
            <tr>
              <td class="No">random</td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button>
                </form>
              </td>
              <td>
                <form action="" method='post'>
                  <input type='hidden' name='delete_id' value='$a1'>
                  <button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <!-- <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="./bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="./assets/jquery/jquery-1.12.4.js"></script> -->
        <script src="./assets/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        <script src="./assets/js/dashboard.js"></script>

</body>

</html>