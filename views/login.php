<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/styles/bootstrap-4.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/header.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
    
    <title>Business Care</title>
      <link rel="icon" type="image/png" href="../assets/images/logoSmall.png">
  </head>
  <body>

      <header>
        <div class="container-xl">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="index.php">
                <img width="40" height="40" src="../assets/images/logoSmall.png" alt="Small Logo">

                    Business Care</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="aaaa">Associations</a>
                        <!-- </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/download">Télécharger</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/prices">Devis</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="aaaa" id="navbardrop" data-toggle="dropdown">Langue</a>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" onclick="language(&#39;FR&#39;)">🇫🇷 FR</button>
                              <button class="dropdown-item" onclick="language(&#39;EN&#39;)">🇬🇧 EN</button>
                            </div>
                        </li> -->
                    </ul>
                </div>
                <a href="login.php"><button class="btn btn-round btn-success my-2 my-sm-0">Se connecter</button></a>
          </nav>
        </div>
      </header>
    <main>
      
<section id="heroBanner-login">
  <div class="container-xl">
    <div class="row">
      <div class="col-lg">

        <div class="jumbotron bg-white">
          <h1 class="display-4">Votre <br> espace<br></h1>

          <form onsubmit="loginToApi(event)">
            <div class="form-group row">
              <div class="col-sm-10">
                <input 
                  type="text" 
                  class="form-control" 
                  id="inputLogin" 
                  name="username" 
                  placeholder="Email / nom d'utilisateur" 
                  required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-10">
                <input 
                  type="password" 
                  class="form-control" 
                  id="inputPwd" 
                  name="password" 
                  placeholder="Mot de passe" 
                  required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-10">
                <button 
                  type="submit" 
                  class="btn btn-round" 
                  style="background-color: #06668C; color: white;">
                  Se connecter
                </button>
              </div>
            </div>

            <div id="wrong" style="color: red; margin-top: 10px;"></div>

            <div class="form-group row">
              <div class="col-sm-10">
                <small class="form-text text-muted">
                  <a href="reset.php">Vous avez oublié votre mot de passe ?</a>
                </small>
              </div>
            </div>
          </form>
        </div>

      </div>

      <div class="col-7">
        <img class="d-lg-block mx-auto" src="" >
      </div>
    </div>
  </div>
</section>

<section id="signup-links" style="background-color: #679436;">
  <div class="container-xl">
    <div class="row">

      <!--
      <div class="col-lg">
        <img class="d-lg-block mx-auto" src="" alt="package">
      </div>-->

      <div class="col-lg" >
        <div class="jumbotron bg-transparent">
          <h1 class="display-4 text-white">Je m'inscris !</h1>

          <a href="signUpClient.php?">
            <div class="input-group input-group-lg mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Je suis une entreprise</span>
              </div>
              <div class="input-group-append">
                <button class="btn " style="background-color: #06668C; color: white;" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#EBF2FA" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                  </svg>
                </button>
              </div>
            </div>
          </a>

          <a href="signUpProvider.php?">
            <div class="input-group input-group-lg mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Je suis un prestataire</span>
              </div>
              <div class="input-group-append">
                <button class="btn " style="background-color: #06668C; color: white;" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#EBF2FA" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                  </svg>
                </button>
              </div>
            </div>
          </a>

        </div>

      </div>
    </div>
  </div>

</section>
    </main>
    <script src="../api/ApiHelpers.js"></script>
</body>
</html>