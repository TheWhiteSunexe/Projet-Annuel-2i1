<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/styles/bootstrap-4.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/header.css">
    
    <link rel="stylesheet" href="../assets/styles/login.css">
    <link rel="stylesheet" href="../assets/styles/payment.css">
    
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
<div class="container bg-light d-md-flex align-items-center">
  <div class="card box1 shadow-sm p-md-5 p-4">
    <div class="fw-bolder mb-4">
      <span class="fas fa-dollar-sign"></span>
      <span class="ps-1">599,00</span>
    </div>
    <div class="d-flex flex-column">
      <div class="d-flex align-items-center justify-content-between text">
        <span>Commission</span>
        <span class="fas fa-dollar-sign">
          <span class="ps-1">1.99</span>
        </span>
      </div>
      <div class="d-flex align-items-center justify-content-between text mb-4">
        <span>Total</span>
        <span class="fas fa-dollar-sign">
          <span class="ps-1">600.99</span>
        </span>
      </div>
      <div class="border-bottom mb-4"></div>
      <div class="d-flex flex-column mb-4">
        <span class="far fa-file-alt text">
          <span class="ps-2">Invoice ID:</span>
        </span>
        <span class="ps-3">SN8478042099</span>
      </div>
      <div class="d-flex flex-column mb-5">
        <span class="far fa-calendar-alt text">
          <span class="ps-2">Next payment:</span>
        </span>
        <span class="ps-3">22 july, 2018</span>
      </div>
      <div class="d-flex align-items-center justify-content-between text mt-5">
        <div class="d-flex flex-column text">
          <span>Customer Support:</span>
          <span>online chat 24/7</span>
        </div>
        <div class="btn btn-primary rounded-circle">
          <span class="fas fa-comment-alt"></span>
        </div>
      </div>
    </div>
  </div>

  <div class="card box2 shadow-sm">
    <div class="d-flex align-items-center justify-content-between p-md-5 p-4">
      <span class="h5 fw-bold m-0">Payment methods</span>
    </div>

    <ul class="nav nav-tabs mb-3 px-md-4 px-2">
      <li class="nav-item">
        <a class="nav-link px-2 active" aria-current="page" href="#">Credit Card</a>
      </li>
    </ul>

    <form action="">
      <div class="row">
        <div class="col-12">
          <div class="d-flex flex-column px-md-5 px-4 mb-4">
            <span>Credit Card</span>
            <div class="inputWithIcon">
              <input class="form-control" type="text" value="5136 1845 5468 3894">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4" style="padding-left: 3rem !important;">
            <span>Expiration<span class="ps-1">Date</span></span>
            <div class="inputWithIcon">
              <input type="text" class="form-control" value="05/20">
              <span class="fas fa-calendar-alt"></span>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4" >
            <span>Code CVV</span>
            <div class="inputWithIcon">
              <input type="password" class="form-control" value="123">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="d-flex flex-column px-md-5 px-4 mb-4">
            <span>Name</span>
            <div class="inputWithIcon">
              <input class="form-control text-uppercase" type="text" value="valdimir berezovkiy">
              <span class="far fa-user"></span>
            </div>
          </div>
        </div>

        <div class="col-12 px-md-5 px-4 mt-3">
          <div class="btn btn-primary w-100">Pay $599.00</div>
        </div>
      </div>
    </form>
  </div>
</div>

</main>
</body>
</html>