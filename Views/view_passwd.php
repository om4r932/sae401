<?php require "view_begin.php"; ?>

<link rel="stylesheet" href="Content/css/passwd.css"/>

    <div class="container">
        <h2>Mot de passe oublié</h2>
        <form action="?controller=passwd&action=forget" method="POST">
            <input type="email" name="email" placeholder="Entrez votre email" required>
            <button type="submit">Envoyer</button>
        </form>
    </div>

<?php require "view_end.php"; ?>