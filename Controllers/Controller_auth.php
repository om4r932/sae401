<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_auth qui gère l'authentification des utilisateurs.
 */

/**
 * Class Controller_auth
 *
 * @brief Cette classe gère les actions liées à l'authentification des utilisateurs, y compris l'affichage des formulaires de connexion et d'inscription, la gestion de la connexion, l'inscription, la vérification des emails et la déconnexion.
 */

class Controller_auth extends Controller
{
     /**
     * @brief Affiche le formulaire d'authentification.
     *
     * Cette méthode affiche la page d'authentification où les utilisateurs peuvent entrer leurs informations de connexion.
     */
    public function action_auth()
    {
        $this->render("auth", []);
    }

    /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode est appelée lorsque aucune action spécifique n'est définie.
     * Elle redirige vers l'action `action_auth` pour afficher le formulaire d'authentification.
     */
    public function action_default()
    {
        $this->action_auth();
    }

    /**
     * @brief Gère la connexion de l'utilisateur.
     *
     * Cette méthode traite les informations de connexion soumises par l'utilisateur. 
     * Elle vérifie les identifiants et, si validés, crée une session pour l'utilisateur et le redirige vers le tableau de bord.
     * 
     * @note Cette méthode affiche à nouveau le formulaire de connexion si les identifiants sont incorrects ou en cas d'erreur.
     */
    public function action_login()
    {
        $model = Model::getModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Vérifie si les champs email et password sont valides
            if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = e(trim($_POST['email']));
                $password = e(trim($_POST['password']));

                // Vérifie la longueur des champs email et password
                if (strlen($password) <= 256 && strlen($email) <= 128) {

                    // Vérifie si l'email a un format valide
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        // Récupère l'utilisateur avec les informations
                        $user = Model::getModel()->getUserByCredentials($email, $password);

                        if ($user) {
                            if ($model->isMailVerified($_POST['email'])) {

                                var_dump($user);

                                //créer une session et stocker le token
                                session_start();

                                // Stocke les informations de l'utilisateur dans la session
                                $_SESSION['user_id'] = $user['id_utilisateur'];
                                $_SESSION['user_token'] = $user['token'];
                                $_SESSION['expire_time'] = time() + (30 * 60); // 30 minutes d'expiration

                                // Redirection vers le dashboard
                                header("Location: ?controller=dashboard");
                                exit();
                            // Affichage si il y a une erreur lors d'une des étapes
                            } else {
                                echo "Email non vérifié.";
                            }

                        } else {
                            echo "Identifiants incorrects.";
                        }

                    } else {
                        echo "Format d'email invalide.";
                    }
                } else {
                    echo "Les données saisies dépassent les limites autorisées.";
                }
            } else {
                echo "Veuillez remplir tous les champs requis.";
            }
        } else {
            echo "Accès non autorisé.";
        }

        // Affiche à nouveau le formulaire d'authentification en cas d'erreur
        $this->render("auth", []);
    }

    /**
     * @brief Gère l'inscription de l'utilisateur.
     *
     * Cette méthode traite les informations d'inscription soumises par l'utilisateur. 
     * Elle vérifie les données saisies, crée un nouvel utilisateur et envoie un email de vérification.
     * 
     * @note Cette méthode affiche à nouveau le formulaire d'inscription en cas d'erreur.
     */
    public function action_register() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifie si tous les champs requis sont valide
            if (
                isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['tabs'])
                && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])
            ) {
                $nom = e(trim($_POST['nom']));
                $prenom = e(trim($_POST['prenom']));
                $email = e(trim($_POST['email']));
                $password = e(trim($_POST['password']));

                // Vérifie la longueur de nom, prenom, password
                if (strlen($nom) <= 64 && strlen($prenom) <= 64 && strlen($password) <= 256 && strlen($email) <= 128) {

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        // Vérifie si le nom et le prénom contiennent uniquement des lettres et des tirets
                        if (preg_match('/^[a-zA-Z\-]+$/', $nom) && preg_match('/^[a-zA-Z\-]+$/', $prenom)) {

                            $role = isset($_POST['tabs']) ? ($_POST['tabs'] === 'client' ? 'client' : ($_POST['tabs'] === 'formateur' ? 'formateur' : '')) : '';

                            if ($role !== '') {
                                // Crée un nouvel utilisateur
                                $result = Model::getModel()->creationUtilisateur($nom, $prenom, $password, $email, $role);

                                if ($result) {
                                    echo "Inscription réussie!<br>";

                                    $verificationToken = Model::getModel()->getTokenUtilisateur($email);
                                    $verificationLink = 'https://jupyter.univ-paris13.fr/~12200964/?controller=auth&action=valide_email'. '&token=' . urlencode($verificationToken);

                                    // Envoie un email de vérification
                                    EmailSender::sendVerificationEmail($email, 'Vérification de l\'adresse e-mail', 'Cliquez sur le lien suivant pour vérifier votre adresse e-mail: ' . $verificationLink);

                                    echo "<br> Un e-mail de vérification a été envoyé à votre adresse. <br>";
                                // Affichage si il y a une erreur lors d'une des étapes

                                } else {
                                    echo "Erreur lors de l'inscription.";
                                }
                            } else {
                                echo "Rôle invalide.";
                            }
                        } else {
                            echo "Le nom et le prénom ne doivent contenir que des lettres et des tirets.";
                        }
                    } else {
                        echo "Format d'email invalide.";
                    }
                } else {
                    echo "Les données saisies dépassent les limites autorisées.";
                }
            } else {
                echo "Veuillez remplir tous les champs requis.";
            }
        } else {
            echo "Accès non autorisé.";
        }

        // Affiche à nouveau le formulaire d'inscription en cas d'erreur
        $this->render("auth", []);

    }

     /**
     * @brief Valide l'email de l'utilisateur.
     *
     * Cette méthode valide l'email de l'utilisateur en vérifiant le token fourni dans l'URL. 
     * Si le token est valide, l'email est marqué comme vérifié.
     */
    public function action_valide_email() {
        // Récupérer le token depuis les paramètres de l'URL
        $token = isset($_GET['token']) ? $_GET['token'] : '';

        // Valider le token en appelant une fonction du modèle
        $validationResult = Model::getModel()->validerTokenUtilisateur($token);

        if ($validationResult) {
            echo "Adresse e-mail vérifiée avec succès!";
        } else {
            echo "Erreur lors de la vérification de l'adresse e-mail. Le lien peut avoir expiré ou être invalide.";
        }

        // Affiche la page d'authentification après la vérification
        $this->render("auth", []);
    }

    /**
     * @brief Gère la déconnexion de l'utilisateur.
     *
     * Cette méthode détruit la session actuelle et redirige l'utilisateur vers la page d'authentification.
     */
    public function action_logout(){
        session_destroy();
        // Redirige vers la page d'authentification
        header("Location: index.php?controller=auth");
    }
}
?>
