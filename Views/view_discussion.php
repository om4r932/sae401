<?php require "view_begin.php"; ?>
<?php require "view_menu.php"; ?>

<link rel="stylesheet" href="Content/css/messages.css">


<div class="chat-global">

    <div class="nav-top">
        <div class="location">
            <a href="?controller=discussion">
                <img src="Content/img/left-chevron.svg">
            </a>
        </div>

        <div class="utilisateur">
            <p><?= $nom_receiver ?></p>
            <p><?= $prenom_receiver ?></p>
        </div>

        <div class="logos-call">
           
        </div>
    </div>
    
    <div class="conversation">
        <?php foreach ($messages as $message): ?>
            <?php
                $isSender = ($message['id_utilisateur'] == $user_id);
                $talkClass = $isSender ? 'right' : 'left';
                $avatar = $isSender ? $photo_de_profil : $photo_receiver;

                // Vérifie si le message nécessite une validation et si l'utilisateur est l'expéditeur
                $requiresValidation = (!$message['validation_moderation'] && $isSender);

                // Détermine la couleur du texte en fonction de la validation et de l'expéditeur
                $textColor = ($requiresValidation) ? 'yellow' : ($isSender ? 'white' : 'black');

                // Si l'utilisateur est modérateur, ignore la vérification
                if ($isModo) {
                    $requiresValidation = false;
                }

                if (!$isModo && (!$message['validation_moderation'] && !$isSender)) {
                    continue;
                }
            ?>
            <div class="talk <?= $talkClass ?>">
                <?php if ($talkClass === 'left'): ?>
                    <img src="Content/img/<?= $avatar ?>" alt="User Photo">
                <?php endif; ?>
                <p style="color: <?= $textColor; ?>;"><?= $message['texte'] ?></p>
                <?php if ($isModo && !$message['validation_moderation']): ?>
                    <a href="?controller=discussion&action=validate_message&id_message=<?= $message['id_message'] ?>">Valider</a>
                <?php endif; ?>
                <?php if ($talkClass === 'right'): ?>
                    <img src="Content/img/<?= $avatar ?>" alt="User Photo">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>







    <form class="chat-form" method="post" action="?controller=discussion&action=envoi_message">

        <div class="container-inputs-stuffs">

           <input type="hidden" name="discussionId" value="<?= $_GET['id'] ?>">

            <div class="files-logo-cont">
            </div>

            <div class="group-inp">
                <textarea name="texte_message" placeholder="Enter your message here" minlength="1" maxlength="1500"></textarea>
            </div>
            <button class="submit-msg-btn">
                <img src="Content/img/send.svg">
            </button>
        </div>

    </form>
</div>

<?php require "view_end.php"; ?>