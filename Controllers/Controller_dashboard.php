<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_dashboard qui gère les actions pour le tableau de bord des utilisateurs.
 */

/**
 * Class Controller_dashboard
 *
 * @brief Cette classe gère les actions pour l'affichage du tableau de bord des utilisateurs.
 * Le tableau de bord affiche les discussions récentes de l'utilisateur connecté.
 */

class Controller_dashboard extends Controller
{
    /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode est appelée lorsque aucune action spécifique n'est définie.
     * Elle redirige vers l'action `action_dashboard` pour afficher le tableau de bord.
     */

    public function action_default()
    {
        $this->action_dashboard();
    }

    /**
     * @brief Affiche le tableau de bord de l'utilisateur.
     *
     * Cette méthode vérifie si l'utilisateur est connecté. Si oui, elle récupère les discussions récentes
     * de l'utilisateur connecté et les affiche sur le tableau de bord.
     * Si l'utilisateur n'est pas connecté, il est redirigé vers la page de connexion.
     */
    public function action_dashboard(){

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        $discussions = $model->recupererDiscussion($user['id_utilisateur']);

        $discussionList = [];

        foreach ($discussions as $discussion) {
            $interlocuteurId = ($role === 'Client') ? $discussion['id_utilisateur_1'] : $discussion['id_utilisateur'];
            $interlocuteur = $model->getUserById($interlocuteurId);
    
            if (!$interlocuteur) {
                continue;
            }
    
            $lastMessage = $model->getLastMessageInfo($interlocuteurId, $discussion['id_discussion']);
    
            $discussionList[] = [
                'discussion_id' => $discussion['id_discussion'],
                'nom_interlocuteur' => $interlocuteur['nom'],
                'prenom_interlocuteur' => $interlocuteur['prenom'],
                'photo_interlocuteur' => $interlocuteur['photo_de_profil'],
                'lastMessage' => $lastMessage,
            ];
        }

        $this->render('dashboard', [
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo_de_profil' => $user['photo_de_profil'],
            'role' => $role,
            'discussions' => $discussionList
        ]);

    }
}
