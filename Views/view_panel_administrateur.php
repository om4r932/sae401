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

<link rel="stylesheet" type="text/css" href="Content/css/admin.css">

<div class="container">
            <div class="container-trending">
                <div class="container-headline">
                    <span class="material-symbols-outlined">
                        add_moderator
                        </span>
                    Administrateur
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
                        <button class="tablinks" onclick="openCity(event, 'Activités')">Activités</button>
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
                    <th>Prenom</th>
                    <th>Formations</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($formateurs as $formateur) { ?>
                    <tr>
                        <td><?php echo $formateur['nom']; ?></td>
                        <td><?php echo $formateur['prenom']; ?></td>
                        <td>
                            <?php if ($formateur['est_moderateur']) { ?>
                                <a href="?controller=panel&action=manage_moderator&id=<?php echo $formateur['id_utilisateur']; ?>&manage=demote">
                                    <button class="butto">
                                        <span>Rétrograder</span>
                                    </button>
                                </a>
                            <?php } else { ?>
                                <a href="?controller=panel&action=manage_moderator&id=<?php echo $formateur['id_utilisateur']; ?>&manage=promote">
                                    <button class="butto">
                                        <span>Promouvoir</span>
                                    </button>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="#">Show All</a>
    </div>
</div>

              


              <div id="Activités" class="tabcontent no">
                <div class="recent-orders">
                 
                 <center>
                    <form action="?controller=panel&action=add_activity" method="post" enctype="multipart/form-data">
                        <label for="name">Nom:</label>
                        <input type="text" id="name" name="name" required>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required></textarea>

                        <label for="photo">Photo:</label>
                        <input type="file" id="photo" name="photo" accept="image/*" required>

                        <button class="button1" type="submit">Soumettre</button>
                    </form>
                </center>
                  </div>
                          </div>
              
              
                          


                      


              
            </div>
        </div>
        <script src="Content/script/admin.js"></script>


<?php require "view_end.php"; ?>