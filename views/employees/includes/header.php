<header>
        <div class="container-xl">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="home.php">
                <img width="40" height="40" src="../../assets/images/logoSmall.png" alt="Small Logo">
                    Business Care</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="calendar.php">Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chatbot.php">Chatbot</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="advice.php">Conseils</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="teams.php">Associations & Gestion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="event.php">Evènements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="forum.php">Communautés</a>
                        </li>
                        
                    </ul>
                </div>
                <div>
                    
                    <?php
                    
                    if (isset($_SESSION['role'])) {
                        // echo '<a href="/Projet-Annuel-2i1/PA2i1/views/logout.php" onclick="logout()"><button class="btn btn-round btn-danger">Se déconnecter</button></a>';
                        
                        echo '
                            <img src="/Projet-Annuel-2i1/PA2i1/uploads/' . (isset($result['image']) ? $result['image'] : 'default.jpg') . '" alt="" class="user-pic user-pic-background" onclick="toggleMenu()">';
                        echo '<div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img src="/Projet-Annuel-2i1/PA2i1/uploads/' . (isset($result['image']) ? $result['image'] : 'default.jpg') . '" class="user-pic-background" alt="">
                                    <h2>Settings</h2>
                                </div>
                                <hr>
                                <a href="profil.php" class="sub-menu-link"><i class="bi alarm-fille"></i>
                                    <p>Profil</p>
                                    <span>></span>
                                </a>
                                <a href="/Projet-Annuel-2i1/PA2i1/views/logout.php" onclick="logout()" class="sub-menu-link"><i class="bi alarm-fille"></i>
                                    <p>Se déconnecter</p>
                                    <span>></span>
                                </a>
                            </div>';
                    } else {
                        echo '<a href="/login"><button class="btn btn-round btn-success">Se connecter</button></a>';
                    }
                    ?>



                    <script>
                        let subMenu = document.getElementById("subMenu");

                        function toggleMenu(){
                            subMenu.classList.toggle("open-menu");
                        }

                    </script>
                </div>
          </nav>
        </div>
      </header>