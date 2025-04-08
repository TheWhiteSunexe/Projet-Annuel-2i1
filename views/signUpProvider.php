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
                <a class="navbar-brand" href="login.php">
                <img width="40" height="40" src="../assets/images/logoSmall.png" alt="Small Logo">

                    Business Care</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="aaaa">À propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/download">Télécharger</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/prices">Tarifs</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="aaaa" id="navbardrop" data-toggle="dropdown">Langue</a>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" onclick="language(&#39;FR&#39;)">🇫🇷 FR</button>
                              <button class="dropdown-item" onclick="language(&#39;EN&#39;)">🇬🇧 EN</button>
                            </div>
                        </li>
                    </ul>
                </div>
                <a href="login.php"><button class="btn btn-round btn-success my-2 my-sm-0">Se connecter</button></a>
          </nav>
        </div>
      </header>
    <main>
      
<section id="heroBanner-login">
  <div class="container-xl">
    <div class="row" style="width: 1000px;">
      <div class="col-lg">

        <div class="jumbotron bg-white">
          
    <h1 class="display-4">Inscription <br> Prestataire<br></h1>
<small><font color="red">*</font>Ces données sont obligatoires pour l'inscription.</small>
<form id="signupForm-provider">

    <div class="form-group">
        <label for="lastname"><font color="red">*</font>Nom :</label>
        <input type="text" id="lastname-provider" name="lastname" required class="form-control">
    </div>
    <div class="form-group">
        <label for="firstname"><font color="red">*</font>Prénom :</label>
        <input type="text" id="firstname-provider" name="firstname" required class="form-control">
    </div>
    <div class="form-group">
        <label for="email"><font color="red">*</font>Email :</label>
        <input type="email" id="email-provider" name="email" required class="form-control">
    </div>
    <div class="form-group">
        <label for="phone"><font color="red">*</font>Téléphone :</label>
        <input type="text" id="phone-provider" name="phone" required class="form-control">
    </div>
    <div class="form-group">
        <label for="service_type"><font color="red">*</font>Type de services :</label>
        <input type="text" id="service_type-provider" name="service_type" required class="form-control">
    </div>
    <div class="form-group">
        <label for="service_description"><font color="red">*</font>Description des services :</label>
        <input type="text" id="service_description-provider" name="service_description" required class="form-control">
    </div>
    <div class="form-group">
        <label for="billing_address"><font color="red">*</font>Adresse de facturation :</label>
        <input type="text" id="billing_address-provider" name="billing_address" required class="form-control">
    </div>
    <div class="form-group">
        <label for="postal_code"><font color="red">*</font>Code postal :</label>
        <input type="text" id="postal_code-provider" name="postal_code" required class="form-control">
    </div>
    <div class="form-group">
        <label for="country"><font color="red">*</font>Pays :</label>
        <input type="text" id="country-provider" name="country" required class="form-control">
    </div>

    <h4>Dans le cas où vous avez une entreprise :</h4><br>
    <div class="form-group">
        <label for="company_name">Nom de l'entreprise :</label>
        <input type="text" id="company_name-provider" name="company_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="siret">Numéro de SIRET :</label>
        <input type="text" id="siret-provider" name="siret" class="form-control">
    </div>
    <div class="form-group">
        <label for="vat_number">Numéro de TVA :</label>
        <input type="text" id="vat_number-provider" name="vat_number" class="form-control">
    </div>
    <div class="form-group">
        <label for="website">Site Web ou lien utile :</label>
        <input type="url" id="website-provider" name="website" class="form-control">
    </div>

    <div class="form-group">
        <label for="password"><font color="red">*</font>Mot de passe :</label>
        <input type="password" id="password-provider" name="password" required class="form-control">
    </div>
    <div class="form-group">
        <label for="confirm_password"><font color="red">*</font>Confirmer le mot de passe :</label>
        <input type="password" id="confirm_password-provider" name="confirm_password" required class="form-control">
    </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">S'inscrire</button>
  </div>


</form>
<script src="public/js/signUpProvider.js"></script>


        </div>

      </div>

      <!-- <div class="col-7">
        <img class="d-lg-block mx-auto" src="" >
      </div> -->
    </div>
  </div>
</section>

    </main>

</body>
</html>