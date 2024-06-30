<?php


/**
 * @file
 * @brief Ce fichier contient la classe Controller_reset qui gère les actions liées à la réinitialisation des mots de passe.
 */

/**
 * Class Controller_reset
 *
 * @brief Cette classe gère les opérations de réinitialisation de mot de passe à l'aide de jetons de réinitialisation envoyés par email.
 */

class Controller_reset extends Controller {

     /**
     * @brief Affiche le formulaire de réinitialisation de mot de passe.
     *
     * Cette méthode récupère le jeton de réinitialisation depuis l'URL et affiche le formulaire permettant de définir un nouveau mot de passe.
     * 
     * @note Cette action est généralement déclenchée lorsqu'un utilisateur clique sur un lien de réinitialisation de mot de passe dans un email.
     */
    public function action_reset() {
        $token = isset($_GET['token']) ? $_GET['token'] : null;
        $this->render("reset", ['token' => $token]); // 
    }

     /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode redirige vers `action_reset` pour afficher le formulaire de réinitialisation de mot de passe.
     */
    public function action_default() {
        $this->action_reset();
    }

     /**
     * @brief Met à jour le mot de passe de l'utilisateur.
     *
     * Cette méthode vérifie la requête POST pour récupérer le jeton de réinitialisation et le nouveau mot de passe. 
     * Elle valide le jeton, puis met à jour le mot de passe associé à l'adresse email trouvée pour ce jeton dans la base de données.
     * 
     * @note Si le jeton ou le mot de passe est manquant ou invalide, la méthode renvoie un message d'erreur.
     * 
     * @throws Exception Si la requête n'est pas valide ou si le jeton est invalide.
     */
    public function action_update() {
        $model = Model::getModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = isset($_POST['token']) ? $_POST['token'] : null;
            $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : null;
            if ($token && $newPassword) {
                // on cherche l'email associé au token qu'on a stocké
                $user = $model->getEmailByToken($token);
                if ($user) {
                    $email = $user['mail'];
                    $model->updatePasswordByEmail($email, $newPassword);
                    echo "Votre mot de passe a été réinitialisé avec succès.";
                } else {
                    echo "Token invalide.";
                }
            } else {
                echo "Token ou nouveau mot de passe manquant.";
            }
        } else {
            echo "Requête non valide.";
        }
    }
}

?>
