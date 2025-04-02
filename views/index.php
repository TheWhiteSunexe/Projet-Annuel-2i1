<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Business Care - Accueil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/styles/index.css">
  <title>Business Care</title>
      <link rel="icon" type="image/png" href="../assets/images/logoSmall.png">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="../assets/images/logoSmall.png" alt="Logo">
      <strong>Business Care</strong>
    </a>
    <div class="ms-auto">
      <a href="login.php" class="btn btn-success">Se connecter</a>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <h1>Investissez dans le bien-être de vos équipes</h1>
    <p>Nous vous aidons à bâtir une culture d'entreprise forte, humaine et engagée, où chaque collaborateur peut s’épanouir durablement.</p>
    <a href="#services" class="btn btn-primary mt-4 px-4 py-2">Découvrir nos services</a>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <h2 class="text-center section-title mb-4">Notre vision du bien-être au travail</h2>
    <p class="lead text-center">
      Chez Business Care, nous croyons que le bien-être n’est pas un luxe, mais une condition essentielle à la performance durable.
      En créant des environnements de travail plus sains et plus humains, nous aidons les entreprises à révéler tout leur potentiel.
      Nous plaçons les collaborateurs au cœur de la démarche. Nos actions sont conçues pour améliorer leur qualité de vie, renforcer l'écoute interne et créer un climat de confiance durable.

      Ateliers, accompagnement personnalisé, outils numériques, événements fédérateurs : nous combinons expertise terrain et innovation pour répondre aux besoins réels des entreprises.
    </p>
  </div>
</section>

<section id="services" class="py-5 section-alt">
  <div class="container">
    <h2 class="text-center section-title mb-5">Nos Services</h2>
    <div class="row g-4 text-center">
      <div class="col-md-4">
        <div class="card service-card h-100">
          <i class="bi bi-heart-pulse"></i>
          <h5 class="card-title mt-3">Santé mentale</h5>
          <p class="card-text">Séances individuelles, ateliers collectifs, accès à des praticiens spécialisés, signalement confidentiel.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card service-card h-100">
          <i class="bi bi-people"></i>
          <h5 class="card-title mt-3">Cohésion & événements</h5>
          <p class="card-text">Yoga, sport, conférences, team building, newsletters bien-être et événements personnalisés.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card service-card h-100">
          <i class="bi bi-hand-thumbs-up"></i>
          <h5 class="card-title mt-3">Engagement solidaire</h5>
          <p class="card-text">Recyclage, dons, partenariats associatifs, actions citoyennes et programmes RSE sur mesure.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="text-center py-5 section-alt">
  <div class="container">
    <h2 class="section-title mb-4" style="font-size: 2.3rem; font-weight: 800; letter-spacing: 0.5px;">
      <i class="bi bi-chat-quote me-2 text-primary"></i>Ils nous font confiance
    </h2>
    <p class="text-muted mb-5" style="max-width: 700px; margin: auto;">Découvrez ce que nos partenaires pensent de Business Care et comment nous les aidons à transformer le bien-être en entreprise.</p>

    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <div class="card mx-auto shadow p-4" style="max-width: 700px; border-radius: 15px;">
            <div class="mb-3">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </div>
            <p class="fs-5 fst-italic">"Une équipe réactive et des services de qualité. Nos salariés attendent chaque événement avec impatience."</p>
            <div class="mt-3">
              <strong>Julie B.</strong><br>
              <span class="text-muted">Responsable RH - Dynapro</span>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="card mx-auto shadow p-4" style="max-width: 700px; border-radius: 15px;">
            <div class="mb-3">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </div>
            <p class="fs-5 fst-italic">"Grâce à Business Care, nous avons vu une réelle amélioration du bien-être général dans l’entreprise."</p>
            <div class="mt-3">
              <strong>Marc D.</strong><br>
              <span class="text-muted">CEO - NextWorld</span>
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="card mx-auto shadow p-4" style="max-width: 700px; border-radius: 15px;">
            <div class="mb-3">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star text-warning"></i>
            </div>
            <p class="fs-5 fst-italic">"Un accompagnement sur-mesure, des intervenants humains et efficaces. Je recommande vivement."</p>
            <div class="mt-3">
              <strong>Sophie L.</strong><br>
              <span class="text-muted">DRH - HumanSoft</span>
            </div>
          </div>
        </div>

      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
        <span class="visually-hidden">Précédent</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
        <span class="visually-hidden">Suivant</span>
      </button>
    </div>
  </div>
</section>

      <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
      </button>

    </div>
  </div>
</section>

<section class="text-center py-5 bg-light">
  <div class="container">
    <h3 class="fw-bold">Et si on transformait votre entreprise ensemble ?</h3>
    <p class="mb-4">Faites un premier pas : demandez un devis ou connectez-vous à votre espace sécurisé.</p>
    <a href="login.php" class="btn btn-success me-2 px-4 py-2">Se connecter</a>
    <a href="signUpClient.php?" class="btn btn-outline-primary px-4 py-2">Demander un devis</a>
  </div>
</section>

<footer>
  <div class="container text-center">
    <div class="row mb-3">
      <div class="col-md-4">
        <h5>Business Care</h5>
        <p>110, rue de Rivoli, Paris</p>
      </div>
      <div class="col-md-4">
        <h5>Navigation</h5>
        <a href="#">Accueil</a> | 
        <a href="#services">Services</a> | 
        <a href="login.php">Connexion</a>
      </div>
      <div class="col-md-4">
        <h5>Contact</h5>
        <p>contact@businesscare.fr<br>+33 1 23 45 67 89</p>
        <div class="social-icons mt-2">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
          <a href="#"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>
    </div>
    <p class="mb-0">&copy; 2025 Business Care — Tous droits réservés. <a href="#">Mentions légales</a></p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>