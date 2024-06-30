<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Red+Hat+Display&display=swap"
            rel="stylesheet"
            type='text/css'
        >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<link rel="stylesheet" type="text/css" href="Content/css/modo.css">

<div class="container">
            <div class="container-trending">
                <div class="container-headline">
                    <span class="material-symbols-outlined">
                        add_moderator
                        </span>
                    Moderation
                </div>
                <div class="container-description">
                  À modérer avec modération
                </div>
            </div>





            


            <header>
                <div class="tabs">
                    <a id="tab1" name="all" href="#tab1">
                       <button class="tablinks" onclick="openCity(event, 'Formateurs')">Formateurs</button>
                    </a>
                    <a id="tab2" name="developer" href="#tab2">
                        <button class="tablinks" onclick="openCity(event, 'Discussions')">Discussions</button>
                    </a>
                    <a id="tab3" name="productivity" href="#tab3">
                        <button class="tablinks" onclick="openCity(event, 'Utilisateurs')">Utilisateurs</button>
                    </a>
                    
                </div>
            </header>
            <div class="tab-content-wrapper">


                


<div id="Formateurs" class="tabcontent">
    <div class="recent-orders">
        <table>
          <thead>
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Formations</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>Trizo</td>
                <td>Mike</td>
                <td>5</td>
                <td><button class="butto">
                  <span>Compétences</span>
                </button></td>
          
            </tr>
             

            <tr>
              <td>Grobide</td>
              <td>Ravi</td>
              <td>12</td>
              <td><button class="butto">
                  <span>Compétences</span>
                </button></td>
        
          </tr>

          <tr>
              <td>Settings</td>
              <td>Tony</td>
              <td>8</td>
              <td><button class="butto">
                  <span>Compétences</span>
                </button></td>
        
          </tr>
          </tbody>
        </table>

        <a href="#">Tout voir</a>
      </div>
              </div>
              
              <div id="Discussions" class="tabcontent no">
    <div class="recent-orders">
        <table>
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Formateur</th>
                    <th>ID Discussion</th>
                    <th>Voir</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <tr>
                                    <td>Settings</td>
                                    <td>Tony</td>
                                    <td>8</td>
                                    <td><button class="butto bu">
                                        <span>Voir les discussions</span>
                                      </button></td>
                              
                                </tr>
                <?php

                if ($discussions) {
                    foreach ($discussions as $discussion) {
                        echo '<tr>';
                        echo '<td>' . $discussion['nom_client'] . ' ' . $discussion['prenom_client'] . '</td>';
                        echo '<td>' . $discussion['nom_formateur'] . ' ' . $discussion['prenom_formateur'] . '</td>';
                        echo '<td>' . $discussion['id_discussion'] . '</td>';
                        echo '<td><a href="?controller=discussion&action=discussion&id=' . $discussion['id_discussion'] . '"><button class="butto bu"><span>Voir les discussions</span></button></a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">Aucune discussion disponible.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="#">Tout voir</a>
    </div>
</div>

              
<div id="Utilisateurs" class="tabcontent no">
    <div class="recent-orders">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>ID Utilisateur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($utilisateurs) {
                    foreach ($utilisateurs as $utilisateur) {
                        echo '<tr>';
                        echo '<td>' . $utilisateur['nom'] . '</td>';
                        echo '<td>' . $utilisateur['prenom'] . '</td>';
                        echo '<td>' . $utilisateur['id_utilisateur'] . '</td>';
                        echo '<td><button class="but"><a href="?controller=panel&action=add_affranchi&id=' . $utilisateur['id_utilisateur'] . '"><span>Affranchir</span></a></button></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Aucun utilisateur non affranchi disponible.</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="#">Tout voir</a>
    </div>
</div>



                      


              
            </div>
        </div>
        <script src="Content/script/modo.js"></script>

<?php require "view_end.php"; ?>