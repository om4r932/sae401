<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/profiles.css">

<script>
    function annulerModification() {
        window.location.href = '?controller=profile';
    }
</script>

<form action="?controller=profile&action=modifier_info" method="POST">
    <div class="card2 shadow">
        <div class="texte">
            <div class="titre">
                <div class="text-container h1"><h1>Modifier votre profil</h1> </div>
            </div>
        </div>
        <div class="texte">
            <div class="cercle">
                <img class="cercle" src="Content/img/<?= $data['photo_de_profil'] ?>" alt="Photo de profil">
            </div>
            <div class="information">
                <div class="sous-titre">
                    <div class="text-container h2">Nom Prénom</div>
                    <div class="text-container p"><p><?php echo $nom . ' ' . $prenom ?></p></div> 
                </div>
                <div class="sous-titre">Adresse e-mail</div>
                <input class="encadrer" type="email" name="nouvelle_email" value="<?= $mail ?>" required>
                <div class="sous-titre">Nouveau mot de passe</div>
                <input class="encadrer" type="password" name="nouveau_mot_de_passe">
                <div class="sous-titre">Société principale</div>
                <input class="encadrer" type="text" name="nouvelle_societe" value="<?= (isset($societe) && $societe !== false) ? $societe['societe'] : ""; ?>" required>
            </div>
            <br>
            <button type="button" id="btnannuler" onclick="annulerModification()"> Annuler</button>
            <button type="submit" id="btnenregistrer"> Enregistrer</button>
        </div>
    </div>
</form>

<?php require "view_end.php"; ?>
