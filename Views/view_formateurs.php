<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/ravi_index.css" />
<link rel="stylesheet" href="Content/css/ravi_style.css">

<form method="post" action="?controller=formateurs">

    <div id="search-container">

        <select id="search-input" name="select-options">
            <option value="0">Choisissez la compétence</option>
            <?php
            foreach ($categories as $category) {
                $selected = ($category['id_categorie'] == $selectedCategoryId) ? "selected" : "";
                echo "<option value='" . $category['id_categorie'] . "' $selected>" . $category['nom_categorie'] . "</option>";
            }
            ?>
        </select>
  
        <button id="search-button" type="submit">Rechercher</button>
    </div>
    
    </br>

    <div id="checkbox-container">
        <?php
        // Assuming $themes is an array of themes, and $selectedThemes is an array of selected theme IDs or null
        if ($themes !== null) {
            foreach ($themes as $theme) {
                $isChecked = ($selectedThemes !== null && in_array($theme['id_theme'], $selectedThemes)) ? 'checked' : '';

                echo '<div class="checkbox-item">';
                echo '<label for="theme-checkbox-' . $theme['id_theme'] . '">' . $theme['nom_theme'] . '</label>';
                echo '<input type="checkbox" id="theme-checkbox-' . $theme['id_theme'] . '" name="selected-themes[]" value="' . $theme['id_theme'] . '" ' . $isChecked . '>';
                echo '</div>';
            }
        }
        ?>
    </div>



</form>



<!-- <form method="post" action="?controller=formateurs">
    <div id="search-container">
        <input type="text" id="search-input" name="search" placeholder="Rechercher...">
        <button id="search-button" type="submit">Rechercher</button>
    </div>
</form> -->

</br></br>

<div id="post">
    <div>
        <span>Perform Vision : </span>
        <span>Illuminer le chemin de tes objectifs, notre expertise est là pour t'aider à voir plus loin</span>
    </div>
</div>

<hr />

<div id="centerCont">
    <div>
        <div id="feed">Formateurs</div>
        <div>Nouveau</div>
    </div>
</div>

<?php if ($formateurs !== null) : ?>
    <?php foreach ($formateurs as $formateur) : ?>
        <div class="formateurs-container">
            <article class="card">
                <div class='background'>
                    <img src="Content/img/<?= $formateur['photo_de_profil'] ?>" alt="Formateur Preview Image">
                </div>
                <div class='content'>
                    <div class="card-header">
                        <div class="card-type">
                            <?= $formateur['category_name'] ?>
                        </div>
                        <div class="latest-article">
                            <?= $formateur['theme_names'] ?>
                        </div>
                    </div>

                    <div class="card-content">
                        <h2><?= $formateur['prenom'] . ' ' . $formateur['nom'] ?></h2>
                        <p><?= $formateur['expertise_comment'] ?></p>
                    </div>
                    <br>
                    <a class="go-to-article-button" href="?controller=formateurs&action=details&id=<?= $formateur['id_utilisateur'] ?>" title="Details">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M15 16l4 -4" />
                            <path d="M15 8l4 4" />
                        </svg>
                    </a>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="listePages">
    <p> Pages: </p>
    <?php if ($active > 1) : ?>
        <a class="lienStart prev" href="?controller=formateurs&page=<?= e($active) - 1 ?>"> <img class="icone" src="Content/img/previous-icon.png" alt="Previous" /> </a>
    <?php endif ?>

    <?php for($p = $debut; $p <= $fin; $p++): ?>

        <a class="<?= $p == $active ? "lienStart active" : "lienStart" ?>" href="?controller=formateurs&page=<?= $p ?>"> <?= $p ?> </a>
    <?php endfor ?> 

    <?php if ($active < $nb_total_pages) : ?>
        <a class="lienStart next" href="?controller=formateurs&page=<?= e($active) + 1 ?>"> <img class="icone" src="Content/img/next-icon.png" alt="Next" /> </a>
    <?php endif ?>

</div>

</br></br>

<?php require "view_end.php"; ?>
