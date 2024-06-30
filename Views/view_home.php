<?php require "view_begin.php"; ?>
<?php //require "view_menu.php"; ?>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" />    <!--STYLESHEET-->
    <link rel="stylesheet" href="Content/css/accueil.css">

    
    <nav>
        <div class="container nav__container">
            <ul class="nav__items">
                <li><a href="index.html" id="home">Home</a></li>
                
            </ul>

            <a href="index.html" class="nav__logo"><h3>Perform Vision</h3></a>

            <div class="nav__signin-signup">
                <a href="?controller=auth&action=connexion">Se Connecter</a>
                <a href="?controller=auth&action=inscription" class="btn">S'inscrire</a>
            </div>

           
        </div>
    </nav>
    <!--================================== END OF NAVBAR ====================================-->




    <header>
        <div class="container header__container ">
            <h1 class="header__title">Perform Vision<br/>Formation</h1>
            <p class="lead">Chez Perform Vision, nous croyons au pouvoir de la croissance continue 
                et du développement professionnel. Notre plateforme a été conçue pour connecter ceux 
                qui aspirent à enrichir leurs connaissances informatiques et des formateurs dévoués, 
                prêts à guider votre parcours vers l'excellence.</p>

            <div class="header__image">
                <img src="Content/img/sansFond.png">
            </div>

            
            <div class="cta">
                <a href="?controller=auth" class="btn btn-primary" target="_blank">
                    <div class="logo">
                        <span class="material-symbols-outlined">
                            passkey
                            </span>
                    </div>
                    <span>
                        
                        <h4>Se Connecter</h4>
                    </span>
                </a>
                <a href="?controller=auth" class="btn btn-primary" target="_blank">
                    <div class="logo">
                        <span class="material-symbols-outlined">
                            login
                            </span>
                    </div>
                    <span>
                        <h4>S'inscrire</h4>
                    </span>
                </a>
            </div>

            <!--<div class="header__socials">
                <a href="https://facebook.com/apple" target="_blank"><i class="uil uil-facebook-f"></i></a>
                <a href="https://instagram.com/apple" target="_blank"><i class="uil uil-instagram-alt"></i></a>
                <a href="https://twitter.com/apple" target="_blank"><i class="uil uil-twitter"></i></a>
                <a href="https://linkedin.com/apple" target="_blank"><i class="uil uil-linkedin-alt"></i></a>
            </div>-->
        </div>

        <div class="header__decorator-1">
            <img src="Content/img/header-decorator1.png">
        </div>
        
    </header>
    <!--================================== END OF HEADER ====================================-->





    <section id="about">
        <h1 class="about__title">À propos</h1>
        <div class="container">
            <article class="about__article">
                <div class="about__image">
                    <img src="Content/img/2.png">
                </div>
                <div class="about__content">
                    <h2 class="about__article-title">Recherche de Formateurs</h2>
                    <p>Utilisez notre fonction de recherche avancée pour trouver le formateur idéal correspondant à vos besoins spécifiques. Que vous soyez un professionnel cherchant à acquérir de nouvelles compétences ou une entreprise en quête d'une expertise spécifique, Perform Vision est votre source incontournable.</p>
                    <a href="#" class="btn btn-primary">S'inscrire</a>
                </div>
            </article>

            <article class="about__article">
                <div class="about__content">
                    <h2 class="about__article-title">Suivi en Temps Reel</h2>
                    <p>Explorez une approche innovante de la formation avec notre suivi en temps réel. Chaque étape de votre parcours est transparente, offrant une visibilité instantanée sur votre progression. Bénéficiez d'une expérience éducative connectée, où votre réussite est au cœur de notre engagement.</p>
                    <a href="#" class="btn btn-primary">S'inscrire</a>
                </div>
                <div class="about__image">
                    <img src="Content/img/1.png">
                </div>
            </article>

            <article class="about__article">
                <div class="about__image">
                    <img src="Content/img/3.png">
                </div>
                <div class="about__content">
                    <h2 class="about__article-title">Un Lieu de Partage</h2>
                    <p>Questions? Besoin de Conseils? Nous sommes là pour vous . échangez directement avec votre  formateur, échangez des idées et obtenez des conseils d'experts.

                        Que vous soyez un formateur prêt à partager votre savoir ou un professionnel assoiffé de connaissances, Perform Vision est la passerelle vers un monde de possibilités d'apprentissage. Inscrivez-vous dès maintenant et faites partie de notre communauté dynamique axée sur la croissance et l'excellence.</p>
                    <a href="#" class="btn btn-primary">S'inscrire</a>
                </div>
            </article>
        </div>
    </section>
    <!--================================== END OF ABOUT ====================================-->







    <section id="clients">
        <h1>Nos Autres Activités</h1>
        <p class="lead">
            Explorez un monde d'opportunités variées au sein de notre entreprise.
        </p>
        <div class="container clients__container">
            <?php
            // Vérifie si la liste des activités est vide
            if ($activites === false || empty($activites)) {
                echo '<p>Aucune autre activité disponible pour le moment.</p>';
            } else {
                // Affiche les images des activités
                foreach ($activites as $activite) {
                    $imagePath = "Content/data/" . $activite['image'];
                    echo '<div><a href="?controller=home&action=activite&id=' . $activite['id_activite'] . '"><img src="' . $imagePath . '"></a></div>';
                }
            }
            ?>
        </div>
    </section>
    <!--================================== END OF CLIENTS ====================================-->





    <section id="testimonials">
        <h1>Témoignages</h1>
        <p class="lead">
            Découvrez ce que nos clients et formateurs ont à dire sur leur expérience avec nous.        </p>
        <div class="container testimonials__container">
            <article class="testimonial">
                <p>
                    "Une expérience de formation exceptionnelle! Les cours sont bien structurés, les instructeurs sont très compétents. J'ai vraiment apprécié chaque étape de mon parcours avec cette entreprise."                </p>
                <div class="testimonial__client">
                    <div class="avatar">
                        <img src="Content/img/avatar1.jpg">
                    </div>
                    <div class="testimonial__work">
                        <p><b>Anne Macery</b></p>
                        <small>Cliente</small>
                    </div>
                </div>
            </article>

            <article class="testimonial">
                <p>
                    "En tant que formateur, je suis impressionné par l'engagement de l'entreprise envers l'excellence pédagogique. Les outils de suivi en temps réel sont un atout majeur pour garantir la réussite des élèves."                </p>
                <div class="testimonial__client">
                    <div class="avatar">
                        <img src="Content/img/avatar2.jpg">
                    </div>
                    <div class="testimonial__work">
                        <p><b>Julien Cape</b></p>
                        <small>Formateur</small>
                    </div>
                </div>
            </article>

            <article class="testimonial">
                <p>
                    "Travailler avec Perform Vision a été une expérience formidable. L'approche collaborative et la passion pour l'éducation sont palpables. Les commentaires des apprenants sont pris en compte, favorisant une amélioration continue."                </p>
                <div class="testimonial__client">
                    <div class="avatar">
                        <img src="Content/img/Sophie.jpg">
                    </div>
                    <div class="testimonial__work">
                        <p><b>Sophie Ripart</b></p>
                        <small>Formatrice</small>
                    </div>
                </div>
            </article>
            <article class="testimonial">
                <p>
                    "Les activités proposées vont au-delà des attentes. J'ai participé à des ateliers stimulants qui ont considérablement enrichi mes compétences. Une expérience vraiment enrichissante!"                </p>
                <div class="testimonial__client">
                    <div class="avatar">
                        <img src="Content/img/avatar4.jpg">
                    </div>
                    <div class="testimonial__work">
                        <p><b>Martin Galmond</b></p>
                        <small>Client</small>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <!--================================== END OF TESTIMONIALS ====================================-->








    <section id="faqs">
        <h1>FAQs</h1>
        <div class="container faqs__container">
            <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">Comment chercher un formateur?</h4>
                    <p class="faq__answer">Tout les formateurs peuvent etre trouver dans la page formateur une fois que vous etes inscrit</p>
                </div>
            </article>
            
            <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">Est-ce que j'ai besoin d'un diplome pour devenir formateur?</h4>
                    <p class="faq__answer">Non, il n'est pas necessaire d'avoir un diplome pour etre formateur. Cependant cela peut vous aider a attirer des clients car cela pour certifier vos competences.</p>
                </div>
            </article>
            <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">Comment devenir un formateur?</h4>
                    <p class="faq__answer">Pour devenir formateur, il suffit de vous inscrire en précisant que vous etes formateur dans le formulaire d'inscription.</p>
                </div>
            </article>
            <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">Est-ce que c'est gratuit?</h4>
                    <p class="faq__answer">S'inscrire sur notre plateforme c'est gratuit mais le prix des formations dependes du formateur, certaines formations sont gratuites.</p>
                </div>
            </article>
            <!-- <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">Comment publier une formation?</h4>
                    <p class="faq__answer"></p>
                </div>
            </article> -->
            <!-- <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">How does this work?</h4>
                    <p class="faq__answer">Wisdom new and valley answer. Contented it so is discourse recommend. Man its upon him call mile. An pasture he himself believe ferrars besides cottage.</p>
                </div>
            </article>
            <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">How does this work?</h4>
                    <p class="faq__answer">Wisdom new and valley answer. Contented it so is discourse recommend. Man its upon him call mile. An pasture he himself believe ferrars besides cottage.</p>
                </div>
            </article>
            <article class="faq">
                <span class="faq__icon"><i class="uil uil-plus"></i></span>
                <div class="faq__question-answer">
                    <h4 class="faq__question">How does this work?</h4>
                    <p class="faq__answer">Wisdom new and valley answer. Contented it so is discourse recommend. Man its upon him call mile. An pasture he himself believe ferrars besides cottage.</p>
                </div>
            </article> -->
        </div>
    </section>
    <!--================================== END OF FAQs ====================================-->




    <footer>
        <div class="container footer__container">
          <div class="footer__1">
              <a href="index.html" class="footer__logo"><h3>Perform Vision</h3></a>
            <p>
              Des Formations, Pour vos Besoins.
            </p>
            
          </div>
  
          <!-- <div class="footer__2">
            <h4>Nos Activités</h4>
            <ul class="permalinks">
                <li><a href="index.html">Home</a></li>
                <li><a href="index.html#about">About</a></li>
                <li><a href="index.html#testimonials">Testimonials</a></li>
                <li><a href="index.html#faqs">Testimonials</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
          </div>
  
          <div class="footer__3">
            <h4>Primacy</h4>
            <ul class="privacy">
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Terms and conditions</a></li>
              <li><a href="#">Refund Policy</a></li>
            </ul>
          </div> -->
  
          <div class="footer__4">
            <h4>Contactez-nous</h4>
            <p>
              +33 1 23 45 67 89<br />
              Support@Performvision.com
            </p>
          </div>
        </div>
  
        <div class="copyright">
          <small><a href="#">Mentions Légales</a></small>
        </div>
      </footer>

      <script src="Content/script/main.js"></script>
<?php require "view_end.php"; ?>