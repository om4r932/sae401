<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/profiles.css">

<script>
        function ajouterCompetence() {
    // Récupérer les valeurs du formulaire
    var skillName = document.getElementById("skillName").value;
    var skillSpecialty = document.getElementById("skillSpecialty").value;
    var skillLevel = document.getElementById("skillLevel").value;

    // Créer un nouvel élément li pour la nouvelle compétence
    var newSkillItem = document.createElement("li");
    newSkillItem.innerHTML =  skillName + ' (' + skillSpecialty + ',niveau : ' + skillLevel +")" ;

    // Ajouter la nouvelle compétence à la liste des compétences
    document.getElementById("competencesList").appendChild(newSkillItem);

    // Effacer les champs du formulaire après l'ajout
    document.getElementById("skillName").value = "";
    document.getElementById("skillSpecialty").value = "POO";
    document.getElementById("skillLevel").value = "debutant";
}
    
    
            
    </script>
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
                <div class="text-container p">
                    <p><?php echo $nom . ' ' . $prenom ?></p>
                </div> 
            </div>
            <div class="sous-titre">Adresse e-mail</div>
            <input class="encadrer" type="email" name="nouvelle_email" value="<?= $mail ?>" required>
            <div class="sous-titre">Nouveau mot de passe</div>
            <input class="encadrer" type="password" name="nouveau_mot_de_passe">
            <div class="sous-titre">LinkedIn</div>
            <input class="encadrer" type="text" name="nouveau_linkedin" value="<?php echo $formateur['linkedin']; ?>" >
            <div class="sous-titre">CV</div>
            <input class="encadrer" type="text" name="nouveau_cv" value="<?php echo $formateur['cv']; ?>" >
<div class="sous-titre">
    <div class="text-container h2">Mes compétences</div>
</div>
<div class="competences-container">
    
    <!-- Formulaire pour ajouter une compétence -->
    <form id="skillsForm" style="display: inline;position: relative;right: 100px;background-color:blue;">
        <label for="skillName">Compétence:</label>
        <input type="text" id="skillName" name="skillName" placeholder="Nom de la compétence">

        <label for="skillLevel">spécialité:</label>
        <select id="skillSpecialty">
            <option value="POO">POO</option>
            <option value="Web">Web</option>
            <option value="autre">Autre</option>
        </select>
        <label for="skillLevel">Niveau:</label>
        <select id="skillLevel" name="skillLevel">
            <option value="debutant">Débutant</option>
            <option value="avance">Avancé</option>
            <option value="expert">Expert</option>
        </select>

        <button type="button" onclick="ajouterCompetence()">Ajouter</button>
    <br>
    <ul id="competencesList">
        <!-- La liste des compétences sera affichée ici -->
    </ul>
</div>
</form>

<br>
            <button type="button" id="btnannuler" onclick="annulerModification()"> Annuler</button>
            <button type="submit" id="btnenregistrer"> Enregistrer</button>
        </div>
        </div>
    </div>
</form>

<script src="Content/script/modifiermonprofilformateur.js"></script>

<?php require "view_end.php"; ?>
