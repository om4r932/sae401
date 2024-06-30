<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/competence.css">

</br> </br>

    <div id="post">
        <div>
          <span> <h1> MES DISCUSSIONS</h1> </span>
        </div>
    </div>

    </br>

    <?php foreach ($discussions as $discussionItem): ?>
        <div class="formateurs-container">
            <a href="?controller=discussion&action=discussion&id=<?= $discussionItem['discussion_id']; ?>" class="card-link">
                <article class="card">
                    <div class='background'>
                        <img src="Content/img/<?= $discussionItem['photo_interlocuteur']; ?>" alt="Profil de l'interlocuteur" class="profile-image">
                    </div>
                    <div class='content'>
                        <div class="card-header">
                            <div class="latest-article">
                                Vos discussions
                            </div>
                        </div>
                        <div class="card-content">
                            <h2><?= $discussionItem['prenom_interlocuteur'] . ' ' . $discussionItem['nom_interlocuteur']; ?></h2>
                            <?php if ($discussionItem['unread_messages']): ?>
                                <p>
                                    Vous avez des messages non lus.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            </a>
        </div>
    <?php endforeach; ?>


<?php require "view_end.php"; ?>