<?php require "view_begin.php"; ?>
<?php //require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/activite.css">

<header>
    <div class="container header__container ">
        <h1 class="header__title">Perform Vision<br/><?= e($activite['nom_activite']) ?></h1>
        <p class="lead"><?= e($activite['description']) ?></p>
    </div>
</header>

<?php require "view_end.php"; ?>