<header>
        <div class="container-xl">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="login.php">
                <img width="40" height="40" src="../../assets/images/logoSmall.png" alt="Small Logo">
                    Business Care</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="contracts.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="stripe.php">Chatbot</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="employeesManagment.php">Conseils</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="devis.php">Associations & Gestion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="devis.php">Communautés</a>
                        </li>
                        
                    </ul>
                </div>
                <div>
                    
                    <?php
                    
                    if (isset($_SESSION['role'])) {
                        echo '<a href="/Projet-Annuel-2i1/PA2i1/views/logout.php" onclick="logout()"><button class="btn btn-round btn-danger">Se déconnecter</button></a>';
                    } else {
                        echo '<a href="/login"><button class="btn btn-round btn-success">Se connecter</button></a>';
                    }
                    ?>
                </div>
          </nav>
        </div>
      </header>