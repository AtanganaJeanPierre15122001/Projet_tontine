
<?php

require_once'config.php';

$requete = $bdd->prepare("SELECT * FROM requete");
$requete->execute();



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>TERSORERIER</title>

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

    .image-depot
    {
      max-width: 500px;
      max-height: 500px;
      height: 100%;
      width: 100%;
    }
     
    tr
    {
      width: 100%;
    }

    table{
      margin-top: 0px;
      padding-top: 0px;
      height: 100%;
      width: 100%;
    }

    .deroule
    {
      max-width: 1000px;
      margin: auto;
      /* margin: -150px 50px 50px 50px; */
      width: 100%;
      height: 100%;
    }
    .section-title{
      padding-bottom: 0px;
      margin-bottom: 0px; 
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
              <h1 class="text-light"><a href="index.html">Alex Smith</a></h1>
              <div class="mt-3 text-center">
                <a href="#" class="btn btn-primary">Editer le profil</a>
              </div>
            </div>
      
            <nav id="navbar" class="nav-menu navbar">
              <ul class="w-100 lol">
                <!-- <li><a href="./tresorier_index.php" class="nav-link scrollto act"><span>Repondre aux requetes</span></a></li>
                <hr> -->
                <li><a href="#" class="nav-link scrollto text-light"><span> GERER <br> COTISATION </span></a></li>
                <hr>
                <li><a href="./tresorier_pret.php" class="nav-link scrollto text-light"><span> GERER <br> PRET </span></a></li>
                <hr>
                <li><a href="./tresorier_aide.php" class="nav-link scrollto text-light"><span> GERER <br> AIDE </span></a></li>
              </ul>
            </nav><!-- .nav-menu -->

              <div style="padding: 2%;">
                <a href="#" class="btn btn-primary w-100">Afficher la liste des membres</a>
            </div>
            <hr style="background-color: white; height: 6px;">
            <div style="padding: 2%;">
              <a href="#" class="btn btn-danger w-100">Deconnexion</a>
          </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
          <div class="section-title">
            <h2>LISTE DES MEMBRES</h2>
          </div>
          <div class="w-100 ca">

            <div class="card">
                <div class="card-header">
                    <img src="./assets/img/about.jpg" alt="Profile Image" class="profile-img">
                    <br>
                    <p class="name">dfdffghhhg</p>
                  </div>
                <div class="card-body">
                        <div class="deroule">

                            <h3>details</h3>
                          
                          <hr>
                          <div class="table-responsive">
                            <table class="table table-striped table-sm" id="list" style="width: 100%">
                              
                              <tbody>
                                <tr>
                                  <td><label for="">NOM</label></td>
                                    <td>Tatsambon</td>
                                </tr>
                                <tr>
                                    <td><label for="">NUMERO</label></td>
                                    <td>655211240</td>
                                </tr>
                                <tr>
                                    <td><label for="">MONTANT</label></td>
                                    <td>5000</td>
                                </tr>
                                <tr>
                                    <td><label for="">MOTIF</label></td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, accusamus aperiam maiores rem quibusdam commodi officiis quae ea molestiae sequi cumque et est error doloribus explicabo, harum vel similique laborum.</td>
                                </tr>
                                <tr>
                                    <td><label for="">DATE</label></td>
                                    <td>01/70/2023</td>
                                </tr>
                                <tr >
                                    <td ><img class="image-depot" src="./image/tats.jpeg" alt=""></td>
                                    <td ><img class="image-depot" src="./image/tats.jpeg" alt=""></td>
                                </tr>
                                <tr>
                                    <td><label for="">image depot</label></td>
                                    <td><label for="">image depot recu</label></td>
                                </tr>
                                <tr>
                                    <td><button type='submit' name='delete_btn' class="btn btn-dark btn-sm w-50" style="border-radius: 20px;">Approuver</button></td>
                                    <td><button type='submit' name='delete_btn' class="btn btn-danger btn-sm w-50" style="border-radius: 20px;">Rejeter</button></td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                    </div>
                </div>
        
                <div class="card-footer element-a-derouler">
                    <a href="#" class="btn">VOIR</a>
                </div>
            </div>

            
        
            <!-- <div class="card">
                <div class="card-header">
                    <img src="./assets/img/about.jpg" alt="Profile Image" class="profile-img">
                </div>
                <div class="card-body">
                    <p class="name">Your Name</p>
                    <a href="#" class="mail">(+237)699999999</a>
                    <p class="job">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit magni voluptatum itaque eaque vel in exercitationem velit excepturi nihil et corporis vitae enim molestias aspernatur, porro, harum incidunt maxime distinctio?</p>
                </div>
        
                <div class="card-footer">
                    <a href="#" class="btn btn-warning">Deconnexion</a>
                </div>
            </div> -->
          </div>
        </main>
      </div>
    </div>


    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
      <script src="./node_modules/jquery/dist/jquery.min.js"></script> 
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="./assets/js/dashboard.js"></script>
      <script>
      $(document).ready(function(){
        $('.element-a-derouler').click(function() {
      // Sélectionner la div à dérouler
      var divADerouler = $(this).prev('.card-body');

      // Vérifier si la div est actuellement masquée
      if (divADerouler.is(':hidden')) {
        // Afficher la div en utilisant un effet de déroulement
        divADerouler.slideDown();
      } else {
        // Masquer la div en utilisant un effet de repliement
        divADerouler.slideUp();
      }
      });   
      })
      </script>
    
  </body>
</html>
