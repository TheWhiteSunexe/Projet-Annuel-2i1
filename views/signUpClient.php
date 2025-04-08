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
          <h1 class="display-4">Inscription <br> Entreprise<br></h1>
          <small><font color="red">*</font> Ces données sont obligatoires pour l'inscription.</small>

          <form id="signupForm-client">
            <div class="form-group">
              <label for="company_name"><font color="red">*</font> Nom de l'entreprise :</label>
              <input type="text" id="company_name-client" name="company_name-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="siret_number"><font color="red">*</font> Numéro de SIRET :</label>
              <input type="text" id="siret_number-client" name="siret_number-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="legal_form">Forme juridique :</label>
              <input type="text" id="legal_form-client" name="legal_form-client" class="form-control">
            </div>

            <div class="form-group">
              <label for="activity_sector">Secteur d'activité :</label>
              <input type="text" id="activity_sector-client" name="activity_sector-client" class="form-control">
            </div>

            <div class="form-group">
              <label for="representative_lastname"><font color="red">*</font> Nom du représentant légal :</label>
              <input type="text" id="representative_lastname-client" name="representative_lastname-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="representative_firstname"><font color="red">*</font> Prénom du représentant légal :</label>
              <input type="text" id="representative_firstname-client" name="representative_firstname-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="contact_email"><font color="red">*</font> Email de contact :</label>
              <input type="email" id="contact_email-client" name="contact_email-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="contact_phone"><font color="red">*</font> Téléphone de contact :</label>
              <input type="text" id="contact_phone-client" name="contact_phone-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="company_website">Site Web de l'entreprise :</label>
              <input type="url" id="company_website-client" name="company_website-client" class="form-control">
            </div>

            <div class="form-group">
              <label for="billing_address"><font color="red">*</font> Adresse de facturation :</label>
              <input type="text" id="billing_address-client" name="billing_address-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="postal_code"><font color="red">*</font> Code postal :</label>
              <input type="text" id="postal_code-client" name="postal_code-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="country"><font color="red">*</font> Pays :</label>
              <input type="text" id="country-client" name="country-client" required class="form-control">
            </div>

            <div class="form-group">
              <label for="password"><font color="red">*</font> Mot de passe :</label>
              <input type="password" id="password-client" name="password" required class="form-control">
            </div>

            <div class="form-group">
              <label for="confirm_password"><font color="red">*</font> Confirmer le mot de passe :</label>
              <input type="password" id="confirm_password-client" name="confirm_password" required class="form-control">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>

            <div id="error_message" style="color: red;"></div>
          </form>
          <script src="public/js/signUpClient.js"></script>
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