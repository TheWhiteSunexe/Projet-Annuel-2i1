<?php
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE HTML>

<html>

<head>
    <title>Guepstar Formation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device, initial-scale">
    <meta name="description" content="Site permettant de se former sur l'informatique">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
    if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
        echo '<link rel="stylesheet" type="text/css" href="css/style_nightmode.css">';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
    }
    ?>
</head>

    <body>
        
      <?php include('includes/header.php'); ?>

        <main>
            <?php
            // Connexion à la base de données
            include('includes/db.php');

            // Récupérer les informations de l'utilisateur depuis la base de données
            $stmt = $bdd->prepare("SELECT nom, prenom, numero_telephone, adresse, code_postal, ville, email, pays FROM users WHERE email=:email");
            $stmt->execute([':email' => $_SESSION['email']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(isset($_SESSION['id'])){
                include('includes/db.php');
                $q = 'SELECT image FROM users WHERE id = :id';
                $req = $bdd->prepare($q);
                $req->execute([
                    'id' => $_SESSION['id']
                ]);

                $result = $req->fetch(PDO::FETCH_ASSOC);}

            // Vérifie si les informations de l'utilisateur ont été trouvées
            if($user) {
                // Affiche les informations de l'utilisateur dans les champs de saisie
                $nom = $user['nom'];
                $prenom = $user['prenom'];
                $numero_telephone = $user['numero_telephone'];
                $adresse = $user['adresse'];
                $code_postal = $user['code_postal'];
                $ville = $user['ville'];
                $email = $user['email'];
                $pays = $user['pays'];
            }
            $q = 'SELECT image FROM users WHERE id = :id';
            $req = $bdd->prepare($q);
            $req->execute([
                'id' => $_SESSION['id']
            ]);
        
            $result = $req->fetch(PDO::FETCH_ASSOC);
            ?>

        
        <form action="modif_profil.php" method="post" enctype="multipart/form-data">
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="uploads/<?php echo isset($result['image']) ? $result['image'] : 'default.jpg'; ?>"><span class="font-weight-bold"></span><span class="text-black-50"></span><span> </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Paramètres du profil :</h4>
                            </div>

                                <div role="alert">
                                <?php include('includes/message.php'); ?>
                                </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels">Nom</label><input type="text" name="nom" class="form-control" placeholder="entrer votre nom" value="<?php echo $nom; ?>"></div>
                                <div class="col-md-6"><label class="labels">Prénom</label><input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>" placeholder="entrer votre prénom"></div>
                                <div class="col-md-12"><label class="labels">Email</label><input type="text" name="email" class="form-control" placeholder="entrer votre email" value="<?php echo $email; ?>"></div>
                                <div class="col-md-12"><label class="labels">Mot de passe</label><input type="text" name="password" class="form-control" placeholder="entrer votre mot de passe"></div>
			    </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Numéro de téléphone</label><input type="text" name="numero_telephone" class="form-control" placeholder="entrer votre numéro de téléphone" value="<?php echo $numero_telephone; ?>"></div>
                                <div class="col-md-12"><label class="labels">Adresse</label><input type="text" name="adresse" class="form-control" placeholder="entrer votre adresse" value="<?php echo $adresse; ?>"></div>
                                
                                <div class="col-md-12"><label class="labels">Code postal</label><input type="text" name="code_postal" class="form-control" placeholder="entrer votre code postal" value="<?php echo $code_postal; ?>"></div>
                                <div class="col-md-12"><label class="labels">Ville</label><input type="text" name="ville" class="form-control" placeholder="entrer votre ville" value="<?php echo $ville; ?>"></div>
                                
                               
                                
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Pays</label><input type="text" name="pays" class="form-control" placeholder="Pays" value="<?php echo $pays; ?>"></div>
                                <div class="col-md-6"><label class="labels">Région</label>
                                
                               
                                <select name="region" class="form-control" >
                                    <option value="">Choisissez une région</option>
                                    <option value="Auvergne-Rhône-Alpes">Auvergne-Rhône-Alpes</option>
                                    <option value="Bourgogne-Franche-Comté">Bourgogne-Franche-Comté</option>
                                    <option value="Bretagne">Bretagne</option>
                                    <option value="Centre-Val de Loire">Centre-Val de Loire</option>
                                    <option value="Corse">Corse</option>
                                    <option value="Grand Est">Grand Est</option>
                                    <option value="Hauts-de-France">Hauts-de-France</option>
                                    <option value="Île-de-France">Île-de-France</option>
                                    <option value="Normandie">Normandie</option>
                                    <option value="Nouvelle-Aquitaine">Nouvelle-Aquitaine</option>
                                    <option value="Occitanie">Occitanie</option>
                                    <option value="Pays de la Loire">Pays de la Loire</option>
                                    <option value="Provence-Alpes-Côte d'Azur">Provence-Alpes-Côte d'Azur</option>
                                </select></div>
                            </div>
                            <div class="mt-5 text-center"><input class="btn btn-primary profile-button" type="submit" value="Save Profile"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                            </form> 
                            <form action="modif_pp.php" method="post" enctype="multipart/form-data">
                                <div class="col-md-12"><label class="labels">Modification photo de profil</label><input type="file" name="image" class="form-control" accept="image/jpeg, image/gif, image/png" value="uploads/<?php echo isset($result['image']) ? $result['image'] : 'default.jpg'; ?>"></div> <br>
                                <button  class="btn btn-primary profile-button" type="submit">Changer</button>
                            </form> 
                            <?php
                            if(isset($_COOKIE['nm']) && $_COOKIE['nm'] === 'actif') {
                                echo '<form action="verification.php" method="post">
                                <button class="profil" value="inactif" type="submit" name="nm">Désactiver le mode nuit</button>
                                </form>';
                            } else {
                                echo '<form action="verification.php" method="post">
                                <button class="profil" value="actif" type="submit" name="nm">Activer le mode nuit</button>
                                </form>';
                            }
                            ?>
                            <div>
                            <label class="labels">Choississez votre langue :</label>
                                <form action="verification.php" method="post" >
                                    <select name="langue" class="form-control">
                                        <option value="fr">Français</option>
                                        <option value="en">English</option>
                                        <option value="es">Español</option>
                                        <option value="ch">Chinois</option>
                                    </select>
                                    <button  class="btn btn-primary profile-button" type="submit">Changer</button>
                                </form>
                                <form action="download.php" method="post">
                                    <button class="btn btn-primary profile-button" type="submit">Télécharger mes données</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              
    </div>
    </div>

        </main>

        <?php include('includes/footer.php'); ?>
    </body>

</html>