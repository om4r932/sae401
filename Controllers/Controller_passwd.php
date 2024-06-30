<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_passwd qui gère les opérations de réinitialisation de mot de passe.
 */

/**
 * Class Controller_passwd
 *
 * @brief Cette classe gère les actions liées à la réinitialisation de mot de passe, y compris l'affichage du formulaire et l'envoi des e-mails de réinitialisation.
 */

class Controller_passwd extends Controller {

     /**
     * @brief Affiche le formulaire de réinitialisation de mot de passe.
     *
     * Cette méthode rend la vue `passwd` qui affiche le formulaire pour demander la réinitialisation du mot de passe.
     */
    public function action_passwd() {
        $this->render("passwd", []);
    }

    /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode redirige vers `action_passwd` pour afficher le formulaire de réinitialisation de mot de passe.
     */
    public function action_default() {
        $this->action_passwd();
    }

    /**
     * @brief Gère la demande de réinitialisation de mot de passe.
     *
     * Cette méthode vérifie si une requête POST est reçue avec une adresse e-mail. Si c'est le cas, elle génère un token de réinitialisation, le stocke dans la base de données, et envoie un e-mail avec un lien pour réinitialiser le mot de passe.
     *
     * @note Cette méthode vérifie si l'adresse e-mail est fournie et valide. Si aucune adresse n'est trouvée, elle informe l'utilisateur.
     *
     * @note Le lien de réinitialisation de mot de passe est envoyé à l'adresse e-mail fournie si elle existe dans la base de données.
     */
    public function action_forget() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            if ($email) {
                $model = Model::getModel();
                $token = bin2hex(random_bytes(50)); // génére un token secure
                $model->storeResetToken($email, $token); // stocke le token dans la base de données

                // envoie un email avec le lien de réinitialisation
                $resetLink = "https://jupyter.univ-paris13.fr/~12200964/?controller=reset&action=reset&token=" . urlencode($token);
                $subject = "Réinitialisation de mot de passe";
                $message = "<p>Bonjour,</p><p>Pour réinitialiser votre mot de passe, cliquez sur le lien suivant :</p><p><a href='$resetLink'>Réinitialiser mon mot de passe</a></p>";
                EmailSender::sendVerificationEmail($email, $subject, $message);
                echo "Un e-mail de réinitialisation de mot de passe a été envoyé à votre adresse e-mail.";
            } else {
                echo "Aucun utilisateur trouvé avec cet e-mail.";
            }
        } else {
            $this->render("passwd", []);
        }
}
}

?>




