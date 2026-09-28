<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La cabanne des 5 éléments</title>
  <link rel="icon" href="images\la-cabane-des-5-elements-Logo.png">
  <link rel="stylesheet" href="view/css/styleMainPage.css">
  <script src="view/JS/menuBurger.js"></script>
</head>

<body>
    <header id="home">
      <!-- Icône du menu burger (☰)
         Quand on clique dessus, le menu latéral s’ouvre ou se ferme -->
        <div class="burger" onclick="toggleMenu()">☰</div>
    </header>
  
    <aside class="sidebar" id="sidebar">
      <nav>
        <ul class="nav-links">
          <li><a href="#home">Accueil</a></li>
          <li><a href="#about">Qui suis-je ?</a></li>
          <li><a href="#path">Mon parcours professionnel</a></li>
          <li><a href="#offers">Prestations</a></li>  
          <li><a href="#prix">Tarifs</a></li>
          <!--<li><a href="index.php?action=RDV">Prendre un rendez-vous</a></li>-->    <!--permet d'acceder à un formulaire reactive pour prise de Rdv-->
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
    </aside>

  <!-- ===================== -->
  <!-- SECTION ACCUEIL -->
  <!-- ===================== -->

 <!-- Première section visible à l’arrivée sur le site -->
<section id="home" class="accueil">
  <!-- Couche visuelle (fond sombre, transparence, etc.) -->
  <div class="accueil-overlay">
    <div class="accueil-content">
      <h1>La main du cœur</h1>
      <p class="accueil-slogan">
        à l’écoute de l’équilibre énergétique du corps
      </p>
    </div>
  </div>
  
  <!-- Indicateur visuel invitant à faire défiler la page -->
  <div class="scroll-indicator-chevron">
    <span></span>
    <span></span>
  </div>
</section>

  <!-- ===================== -->
  <!-- SECTION PRESENTATION -->
  <!-- ===================== -->

<section id="about" class="presentation">
    <h2>Présentation</h2>
    <div class="columns">

    <!-- Colonne gauche -->
    <div class="column">
      <img src="images/cgay.jpg">
      <h2>Caroline Gay</h2>

      <p>
        Praticienne en shiatsu et en réflexologie plantaire, je propose des soins
        issus de la Médecine Traditionnelle Chinoise et des pratiques énergétiques.
      </p>

      <p>
        À travers le toucher, j’écoute ce que le corps exprime : tensions,
        fatigues, émotions retenues.
      </p>

      <p>
        Mon approche vise à rétablir l’équilibre énergétique et à soulager
        différentes manifestations : douleurs, stress, troubles du sommeil,
        migraines, inflammations.
      </p>

      <p>
        La Médecine Traditionnelle Chinoise repose sur une vision globale de la
        personne, où émotions, terrain énergétique et circulation du Qi dans
        les méridiens sont intimement liés.
      </p>
    </div>

    <!-- Colonne droite -->
    <div class="column">
      <div class="images-row">
        <img src="images/cabane.jpg">
      </div>
      <h2>Le lieu de soin</h2>

      <p>
        Je vous accueille dans mon cabinet, un espace singulier construit autour
        d’un chêne-liège, pensé comme un refuge où le corps peut se déposer et où
        l’esprit retrouve de la clarté.
      </p>

      <p>
        Calme et chaleureux, ce lieu invite naturellement à la détente, à la
        respiration et au retour à soi.
      </p>
    </div>

    </div>
</section>

  <!-- ===================== -->
  <!-- SECTION PARCOURS -->
  <!-- ===================== -->

<section id="path" class="parcours">
   <h2>Mon parcours · Mon histoire</h2> 
   <!-- INTRO (hors timeline) -->
     <div class="parcours-intro">
       <p> Aller mieux, prendre soin de soi, apprendre à écouter son corps,
        reconnaître les signaux qu’ils nous envoient chaque jour… C’est souvent le point de départ d’un véritable mieux-être.
        Mon approche s’inscrit dans une prise en charge globale, pour vous aider à vous remettre sur pied et avancer vers une vie plus douce, 
        plus consciente, plus à l’écoute de vous-même et de vos besoins. </p> 
        
        <p> J’ai envie de vous présenter ces approches — qui m’ont personnellement beaucoup apporté — et qui, 
          en complément d’un suivi médical (et jamais en remplacement), peuvent vous soutenir dans votre quotidien. </p>
    </div> 
    <!-- TIMELINE --> 
     <div class="timeline"> 
      <div class="timeline-item"> 
        <span class="timeline-dot"></span> 
        <div class="timeline-content"> 
          <h3>Les premiers élans</h3> 
          <p> Avant de poser mes mains sur les corps, 
            j’ai posé des mots dans des salles de classe. 
            Dix-sept années d’enseignement au lycée professionnel, 
            puis quinze années d’expatriation qui ont ouvert mes horizons et mon cœur. </p> 
            
          <p> C’est loin de chez moi, dans d’autres cultures, 
            que j’ai découvert que le toucher pouvait devenir un langage. </p> 
        </div> 
      </div> 
      
      <div class="timeline-item"> 
        <span class="timeline-dot"></span> 
        <div class="timeline-content"> 
          <h3>Réflexologie – Johannesburg (2007–2009)</h3> 
          <p> Ma troisième grossesse en Afrique du Sud a été une initiation. 
            Une réflexologue m’a accompagnée, 
            et mon corps a répondu avec une fluidité inattendue, 
            aucun désagrément (pas de rétention d'eau, pas de constipation, 
            un sommeil profond ...). </p> 
            
            <p> Ce fut un signe, un appel. 
              J’ai alors étudié la réflexologie plantaire à l’International Academy of Reflexology and Meridian Therapy de 2007 à 2009. </p>
              
            <p> Là, j’ai compris que les pieds sont des portes, des chemins, des mémoires. </p> 
          
        </div> 
      </div> 
      
      <div class="timeline-item"> 
        <span class="timeline-dot"></span> 
        <div class="timeline-content"> 
          <h3>Sei Shiatsu Dō – Paris (2011–2017)</h3> 
          <p> De 2011 à 2017 à L'EST Paris, Bernard Bouheret, 
            j’ai plongé dans le Sei Shiatsu Dō, la voie du shiatsu sincère. </p> 
            
          <p> Un art du silence, du souffle, du geste juste. Un dialogue avec les méridiens, 
            avec les tensions qui cherchent à se dire, avec l’énergie qui veut circuler. </p> 
            
          <p> Cet apprentissage a façonné ma manière d’être autant que ma manière de soigner. </p> 
        </div> 
      </div> 
      
      <div class="timeline-item"> 
        <span class="timeline-dot"></span> 
        <div class="timeline-content"> 
          <h3>Bioénergie moderne quantique</h3> 
          <p> Depuis 2018, je marche sur les sentiers plus subtils de la bioénergie moderne quantique. 
            Une exploration de l’invisible, des vibrations, des champs qui entourent et traversent l’être. </p> 
        
          <p> Et parce que l’on ne peut accompagner l’autre sans se rencontrer soi-même, 
            j’ai entrepris un travail psycho-émotionnel profond avec Mme Saccuci. 
            Ce travail m’a appris la clarté, la neutralité, la présence juste. 
            Il m’a appris à accueillir sans me perdre, à écouter sans absorber, 
            à être là, simplement. </p> 
        </div> 
      </div> 
      
      <div class="timeline-item">
       <span class="timeline-dot"></span> 
        <div class="timeline-content">
         <h3>MUNZ FLOOR® – Janvier 2026</h3> 
         <p> Janvier 2026 : diplômée de la méthode MUNZ FLOOR, physio 1. </p> 
         <p> Mon travail est guidé par une conviction : Le corps sait, le corps parle, 
          le corps peut se réparer lorsqu’on lui offre les bonnes conditions. </p> 
         <p> La méthode MUNZ FLOOR® s’est imposée comme une évidence dans ma pratique, 
          car elle réunit ce que j’aime profondément : </p> 
          
        <ul> 
          <li>la lenteur qui apaise</li> 
          <li>le mouvement qui libère</li> 
          <li>la spirale qui réorganise</li> 
          <li>la présence qui transforme</li> 
          <li>la régénération des fascias, au cœur de mon approche thérapeutique</li> 
        </ul> 
        
        <p> Elle complète naturellement mes soins en shiatsu, réflexologie, 
          bio énergie quantique et travail des fascias, 
          en offrant une continuité entre le soin reçu et l’autonomie du corps en mouvement. </p> 
      </div> 
    </div> 
    
    <img class="munz-logo" src="images/munzFloor.jpg"> 
    
    <div class="timeline-item"> 
      <span class="timeline-dot"></span> 
      <div class="timeline-content"> 
        <h3>Aujourd’hui</h3> 
        <p> Mon chemin m’a menée de Johannesburg à Paris, de Dar es Salaam à Tarnos. 
          Aujourd’hui, je vous accueille dans un cabanon construit autour d’un chêne-liège, 
          un lieu vivant, enraciné, où la nature accompagne chaque soin. </p> 
        
        <p> Un lieu où l’on vient pour se retrouver. </p> 
      
      </div> 
    </div> 
  </div> 
</section>

  <!-- ===================== -->
  <!-- SECTION PRESTATIONS -->
  <!-- ===================== -->

<section id="offers" class="prestations" >

  <h2>Prestations</h2>


  <h3>Qu’est-ce que la réflexologie plantaire&nbsp;?</h3>

  <p>
    La réflexologie plantaire est une technique naturelle et manuelle qui stimule
    les capacités d’auto-régulation du corps.
  </p>

  <p>
    Elle repose sur un principe simple&nbsp;: le pied est une représentation miniature
    du corps humain. Chaque zone réflexe correspond à un organe, une glande ou une
    partie spécifique du corps.
  </p>

  <p>
    En appliquant des pressions rythmées sur ces zones, il est possible de localiser
    les tensions et de rétablir l’équilibre dans les régions concernées.
  </p>

  <p>
    Pratique ancestrale, la réflexologie fait partie des techniques naturelles et
    s’inscrit en lien direct avec la Médecine Traditionnelle Chinoise. Elle permet
    d’établir un diagnostic énergétique, dont l’objectif est de réharmoniser
    l’ensemble du corps.
  </p>

  <p>
    Elle peut être particulièrement intéressante en cas de&nbsp;:
  </p>

  <ul>
    <li>migraines</li>
    <li>troubles digestifs ou constipation</li>
    <li>difficultés respiratoires</li>
    <li>troubles gynécologiques</li>
    <li>eczéma, zona, acné…</li>
  </ul>

  <p>
    Cette technique est également ressourçante, car elle relance l’énergie du Rein,
    pilier fondamental en Médecine Traditionnelle Chinoise.
  </p>



  <h3>Qu’est-ce que le Shiatsu ?</h3>
  <p>
    Le shiatsu est avant tout une synthèse de techniques manuelles inspirées de la Chine,
    de la Médecine Traditionnelle Chinoise et de ses exercices de santé.
  </p>
  <p>
    Le Shiatsu (<strong>SHI</strong> = doigts, <strong>ATSU</strong> = pression) est une technique énergétique
    et corporelle non invasive japonaise issue de la Médecine Traditionnelle Chinoise (M.T.C.).
    Il n’existe pas une seule manière de le pratiquer. Dans mon cabinet, j’exerce le
    <em>Sei Shiatsu Dō</em>, la « voie du Shiatsu sincère ».
  </p>
  <p>
    Le Shiatsu s’appuie sur les mêmes principes que l’acupuncture. Le praticien effectue
    des pressions avec les pouces, les doigts ou les paumes afin de stimuler des points
    d’acupuncture et de favoriser la circulation de l’énergie. Il agit principalement
    sur les déséquilibres énergétiques.
  </p>
  
  <img src="images/massage.png" class="image-prestation">

  <h3>Contre-indications</h3>

  <ul>
    <li>blessures ouvertes</li>
    <li>ulcères</li>
    <li>phlébite</li>
    <li>problèmes cardiaques importants OU récents</li>
    <li>grossesse (à signaler, certains points ne doivent pas être stimulés)</li>
    <li>signes d’occlusion intestinale</li>
    <li>fractures</li>
  </ul>
  <div class="note">
    Un avis médical est recommandé avant toute séance.
  </div>

  <h3>Effets secondaires possibles</h3>
  <p>
    Il peut exister quelques effets indésirables durant les 2 à 3 jours suivant la séance :
  </p>
  <ul>
    <li>fatigue ou sensation d’être « lessivé »</li>
    <li>besoin de repos</li>
    <li>
      libération émotionnelle, le travail se fait en profondeur sur les tissus et les organes, chacun étant associé
      à une émotion
    </li>
  </ul>
  <p>
    Ces réactions sont normales et témoignent du travail énergétique en cours.
  </p>

  <h3>Massage Gua Sha</h3>
  <p>
    Le massage au Gua Sha est une pratique ancienne issue de la médecine chinoise. Il consiste
    à appliquer une légère pression sur la peau à l’aide d’une pierre plate, après application
    d’une huile.
  </p>
  <p>
    Cette technique permet de réduire l’inflammation, stimuler la circulation sanguine
    et favoriser le drainage lymphatique.
  </p>
  <p>
    Le rituel de massage Gua Sha du visage stimule la circulation sanguine du visage et du cou.
    Il active les points d’acupuncture du visage et du cou, agissant ainsi sur l’ensemble
    du corps.
  </p>
  <p>
    Cinq minutes de massage Gua Sha du visage sont intégrées à chaque séance. Ce geste doux
    complète la séance et favorise une détente profonde.
  </p>

</section>

  <!-- ===================== -->
  <!-- SECTION TARIFS -->
  <!-- ===================== -->
<section id="prix" class="tarifs">
  <h2>Tarifs</h2>

  <p class="offre">
    Pour chaque soin, 5 minutes de massage Gua Sha sont offertes.
  </p>

  <table>
    <tr>
      <th>Soin</th>
      <th class="prix">Tarif</th>
    </tr>
    <tr>
      <td>Réflexologie plantaire</td>
      <td class="prix">45 €</td>
    </tr>
    <tr>
      <td>Réflexologie plantaire et palmaire</td>
      <td class="prix">45 €</td>
    </tr>
    <tr>
      <td>Massage spécial crânien &amp; Gua Sha</td>
      <td class="prix">45 €</td>
    </tr>
    <tr>
      <td>Réflexologie plantaire, palmaire et crânienne</td>
      <td class="prix">60 €</td>
    </tr>
    <tr>
      <td>Shiatsu</td>
      <td class="prix">60 €</td>
    </tr>
    <tr>
      <td>
        Soin « La Cabane des 5 éléments »
        <div class="details">
          Soin signature mêlant réflexologie plantaire, shiatsu et harmonisation énergétique
        </div>
      </td>
      <td class="prix">70 €</td>
    </tr>
    <tr>
  <td>
    Séance individuelle MUNZ FLOOR ®
    <div class="details">
      Durée : 1h15 à 1h30
    </div>
  </td>
  <td class="prix">30 €</td>
  </tr>

  <tr>
  <td>
    Pack « La Cabane des 5 éléments » – 1 mois
    <div class="details">
      1 soin signature et 3 séances individuelles MUNZ FLOOR ®<br>
      Accompagnement complet pour libérer les tensions du dos,
      réhydrater les fascias et retrouver une mobilité durable.
      Travail approfondi, régénérant et anti-inflammatoire,
      complémentaire aux soins manuels, favorisant autonomie et continuité.
    </div>
  </td>
  <td class="prix">145 €</td>
  </tr>
 
  </table>

  <div class="note">
    Tarifs étudiants pratiqués — me consulter.
  </div>
</section>

  <!-- ===================== -->
  <!-- SECTION CONTACT -->
  <!-- ===================== -->
<section id="contact" class="contact">
    <h2>Contact</h2>
    <div class="info-grid">
    
    <!-- Bloc infos -->
    <div class="info-box-social">
      <div class="icon"><img src="images/email.png"></div>
      <h3>Email</h3>
      <p>carolinegay.reflexologue@gmail.com</p>
    </div>

    <div class="info-box-social">
      <div class="icon"><img src="images/pin.png"></div>
      <h3>Localisation</h3>
      <p>12 All. des Érables, 40220 Tarnos</p>
    </div>

    <div class="info-box-social">
      <div class="icon"><img src="images/tel.png"></div>
      <h3>Téléphone</h3>
      <p>06 15 07 04 95</p>
    </div>

    <!-- Bloc réseaux sociaux -->
    <div class="info-box social">
      <a href="https://www.instagram.com/caroline_gay_/" target="_blank">
        <img src="images/instagram.svg" alt="">
      </a>
      <h3>Compte professionnel</h3>
    </div>

    <div class="info-box social">
      <a href="https://www.facebook.com/CarolineCarolinegay/" target="_blank">
        <img src="images/facebook.webp" alt="">
      </a>
      <h3>Facebook</h3>
    </div>
  </div>

  <div class="contact-content">
    <div class="left">
      <h1>Des questions ?</h1>
      <p class="subtitle"></p>

      <div class="hours">
        <h3>Horaires d'ouverture</h3>
        <p> Lun : 10h30 - 18h00 <br>
            Mar : 10h30 - 13h30 / 15h30 - 19h30 <br>
            Mer : 10h00 - 14h00 <br>
            jeu : fermé <br>
            ven : 10h30 - 19h00 <br>
            sam : 10h00 - 14h00 
        </p>
      </div>
    </div>

    <div class="right">
      <!-- Formulaire de contact -->
    <form class="contact-form" action="view/contact.php" method="POST">
      <!-- Les données sont envoyées vers contact.php -->

        <label for="name">Nom</label>
        <input type="text" name="name" placeholder="Entrer votre nom" required>

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Entrer votre adresse mail" required>

        <label for="message">Message</label>
        <textarea name="message" rows="4" placeholder="Entrer votre message" required></textarea>

        <button type="submit">SOUMETTRE</button>
      </form>

    </div>
  </section>

</body>

<!-- 
<footer désactivé pour le moment.
Peut être réactivé plus tard si besoin.
-->
<!--
<footer>
  <p>&copy; 2025 - MARTIN Robin</p>
</footer>
-->
  
</html>
