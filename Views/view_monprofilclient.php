<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/profiles.css">

    <form action="?controller=profile&action=modifier" method="POST">
        <div class="card2 shadow">
            <div class="texte">
                <div class="titre">
                    <div class="text-container h1"><h1>Mon profil</h1></div>
                </div>
            </div>
            <div class="texte">
                <div class="cercle">
                    <img class="cercle" src="Content/img/<?= $data['photo_de_profil'] ?>" alt="Photo de profil">
                </div>
                <div class="information">
                    <div class="sous-titre">
                        <div class="text-container h2">Nom Prénom</div>
                        <div class="text-container p"><p><?= $nom ?> <?= $prenom ?></p></div> 
                    </div>
                    <div class="sous-titre">Adresse mail</div>
                    <div class="encadrermonprofil"><div class="txt-encadrer"><?= $mail ?></div></div>
                    <div class="sous-titre">Mot de passe</div>
                    <div class="encadrermonprofil"><div class="txt-encadrer">***********</div></div>
                    <div class="sous-titre">Société principale</div>
                    <div class="encadrermonprofil">
                        <div class="txt-encadrer">
                            <?php if (isset($societe) && $societe !== false) {
                                echo $societe['societe'];
                            } else {
                                echo "Aucune société";
                            } ?>
                        </div>
                    </div>
                </div>
                <button type="submit" id="btnmodifier"> Modifier</button>
            </div>
        </div>
    </form>

<?php require "view_end.php"; ?>