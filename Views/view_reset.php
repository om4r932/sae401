<?php require "view_begin.php"; ?>

<link rel="stylesheet" href="Content/css/passwd.css" />

<div class="container">
    <h2>Mot de passe oublié</h2>
    <form action="?controller=reset&action=update" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>" />
        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
        <button type="submit">Envoyer</button>
    </form>
</div>

<?php require "view_end.php"; ?>
