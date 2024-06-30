<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_profile qui gère les actions liées à la gestion du profil utilisateur.
 */

/**
 * Class Controller_profile
 *
 * @brief Cette classe gère les opérations de consultation et de modification des profils utilisateurs, en fonction de leur rôle (Client ou Formateur).
 */

class Controller_profile extends Controller
{
     /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode redirige vers `action_profile` pour afficher le profil de l'utilisateur.
     */
    public function action_default()
    {
        $this->action_profile();
    }

     /**
     * @brief Affiche le profil de l'utilisateur.
     *
     * Cette méthode vérifie l'accès de l'utilisateur et affiche son profil en fonction de son rôle. Elle charge les données spécifiques du client ou du formateur à partir du modèle.
     *
     * @note Si l'utilisateur n'est pas authentifié, il est redirigé vers la page d'authentification.
     */
    public function action_profile()
    {

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        $data = [
            'mail' => $user['mail'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo_de_profil' => $user['photo_de_profil'],
            'role' => $role
        ];

        if ($role === 'Client') {
            $data['societe'] = $model->getClientById($user['id_utilisateur']);
            $this->render('monprofilclient', $data);
        } elseif ($role === 'Formateur') {
            $data['formateur'] = $model->getFormateurById($user['id_utilisateur']);
            $data['competences'] = $model->getCompetencesFormateurById($user['id_utilisateur']);
            $this->render('monprofilformateur', $data);
        } else {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }
    }

    /**
     * @brief Affiche le formulaire pour modifier le profil de l'utilisateur.
     *
     * Cette méthode vérifie l'accès de l'utilisateur et affiche un formulaire de modification de profil en fonction de son rôle. Elle charge les données spécifiques du client ou du formateur à partir du modèle.
     *
     * @note Si l'utilisateur n'est pas authentifié, il est redirigé vers la page d'authentification.
     */
    public function action_modifier()
    {

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        $data = [
            'mail' => $user['mail'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo_de_profil' => $user['photo_de_profil'],
            'role' => $role
        ];

        if ($role === 'Client') {
            $data['societe'] = $model->getClientById($user['id_utilisateur']);
            $this->render('modifiermonprofilClient', $data);
        } elseif ($role === 'Formateur') {
            $data['formateur'] = $model->getFormateurById($user['id_utilisateur']);
            $data['competences'] = $model->getCompetencesFormateurById($user['id_utilisateur']);
            $this->render('modifiermonprofilformateur', $data);
        } else {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }
    }

    /**
     * @brief Met à jour les informations de profil de l'utilisateur.
     *
     * Cette méthode traite les données soumises par le formulaire de modification du profil et met à jour les informations de l'utilisateur dans la base de données. Elle permet de mettre à jour l'e-mail, le mot de passe, la société (pour les clients), le LinkedIn et le CV (pour les formateurs).
     *
     * @note Seuls les utilisateurs authentifiés peuvent accéder à cette action.
     */
    public function action_modifier_info(){

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=profile');
            exit();
        }

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        if (isset($_POST['nouvelle_email']) && !empty($_POST['nouvelle_email']) && $_POST['nouvelle_email'] !== $user['mail'] && filter_var($_POST['nouvelle_email'], FILTER_VALIDATE_EMAIL)) {
            $nouvelle_email = $_POST['nouvelle_email'];
            $model->updateEmail($user['id_utilisateur'], $nouvelle_email);
        }

        if (isset($_POST['nouveau_mot_de_passe']) && !empty($_POST['nouveau_mot_de_passe'])) {
            $nouveau_mot_de_passe = e(trim($_POST['nouveau_mot_de_passe']));
            if (strlen($nouveau_mot_de_passe) <= 256) {
                $model->updatePassword($user['id_utilisateur'], $nouveau_mot_de_passe);
            }
        }

        if (isset($_POST['nouvelle_societe'])) {
            $nouvelle_societe = e(trim($_POST['nouvelle_societe']));
            if (!empty($nouvelle_societe) && $nouvelle_societe !== $model->getClientById($user['id_utilisateur'])['societe']) {
                $model->updateSociete($user['id_utilisateur'], $nouvelle_societe);
            }
        }

        if (isset($_POST['nouveau_linkedin'])) {
            $nouveau_linkedin = e(trim($_POST['nouveau_linkedin']));
            $ancien_linkedin = $model->getFormateurById($user['id_utilisateur'])['linkedin'];
        
            if (!empty($nouveau_linkedin) && $nouveau_linkedin !== $ancien_linkedin) {
                $model->updateLinkedIn($user['id_utilisateur'], $nouveau_linkedin);
            }
        }
        
        if (isset($_POST['nouveau_cv'])) {
            $nouveau_cv = e(trim($_POST['nouveau_cv']));
            $ancien_cv = $model->getFormateurById($user['id_utilisateur'])['cv'];
        
            if (!empty($nouveau_cv) && $nouveau_cv !== $ancien_cv) {
                $model->updateCV($user['id_utilisateur'], $nouveau_cv);
            }
        }

        header('Location: ?controller=profile');
        exit();

    }

}
