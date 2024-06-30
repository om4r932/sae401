<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_discussion qui gère les actions liées aux discussions entre utilisateurs.
 */

/**
 * Class Controller_discussion
 *
 * @brief Cette classe gère les actions pour l'affichage, l'envoi de messages, et la création de discussions entre utilisateurs.
 */

class Controller_discussion extends Controller
{
     /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode est appelée lorsque aucune action spécifique n'est définie.
     * Elle redirige vers l'action `action_list` pour afficher la liste des discussions.
     */
    public function action_default()
    {
        $this->action_list();
    }

    public function action_list()
    {

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
    
            $unreadMessages = $model->countUnreadMessages($interlocuteurId, $discussion['id_discussion']);
    
            $discussionList[] = [
                'discussion_id' => $discussion['id_discussion'],
                'nom_interlocuteur' => $interlocuteur['nom'],
                'prenom_interlocuteur' => $interlocuteur['prenom'],
                'photo_interlocuteur' => $interlocuteur['photo_de_profil'],
                'unread_messages' => ($unreadMessages > 0),
            ];
        }

        $data = [
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo_de_profil' => $user['photo_de_profil'],
            'role' => $role,
            'discussions' => $discussionList
        ];

        $this->render('discussion_list', $data);
    }

     /**
     * @brief Affiche une discussion spécifique.
     *
     * Cette méthode affiche les messages d'une discussion spécifique. Elle vérifie d'abord si l'utilisateur
     * est connecté et s'il a accès à cette discussion. Sinon, elle redirige vers la liste des discussions.
     */
    public function action_discussion()
    {

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        $model = Model::getModel();

        $discussionId = isset($_GET['id']) ? e($_GET['id']) : null;

        if (!$discussionId) {
            header('Location: ?controller=discussion');
            exit();
        }

        $isModo = $model->verifModerateur($user['id_utilisateur']);

        $discussion = $model->getDiscussionById($discussionId);

        if (!$discussion || !($isModo || isUserInDiscussion($user['id_utilisateur'], $discussion))) {
            header('Location: ?controller=discussion');
            exit();
        }        

        $role = getUserRole($user);
        $receiverId = ($role === 'Client') ? $discussion['id_utilisateur_1'] : $discussion['id_utilisateur'];
        $receiver = $model->getUserById($receiverId);
    
        if (!$receiver) {
            header('Location: ?controller=discussion');
            exit();
        }
        
        $messages = $model->messagesDiscussion($discussionId);

        $data = [
            'nom_receiver' => $receiver['nom'],
            'prenom_receiver' => $receiver['prenom'],
            'photo_receiver' => $receiver['photo_de_profil'],
            'messages' => $messages,
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo_de_profil' => $user['photo_de_profil'],
            'role' => $role,
            'user_id' => $user['id_utilisateur'],
            'isModo' => $isModo
        ];

        $this->render('discussion', $data);
    }

     /**
     * @brief Envoie un message dans une discussion spécifique.
     *
     * Cette méthode vérifie si l'utilisateur est connecté et s'il a le droit d'envoyer un message
     * dans la discussion. Si oui, le message est ajouté à la discussion.
     */
    public function action_envoi_message()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=discussion');
            exit();
        }

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        $model = Model::getModel();

        $discussionId = isset($_POST['discussionId']) ? e($_POST['discussionId']) : null;

        if (!$discussionId) {
            header('Location: ?controller=discussion');
            exit();
        }

        $discussion = $model->getDiscussionById($discussionId);

        if (!$discussion || !isUserInDiscussion($user['id_utilisateur'], $discussion)) {
            header('Location: ?controller=discussion');
            exit();
        }

        $texteMessage = isset($_POST['texte_message']) ? e($_POST['texte_message']) : '';

        $isAdmin = $model->verifAdmin($user['id_utilisateur']);
        $isModo = $model->verifModerateur($user['id_utilisateur']);
        $isAffranchi = $model->verifAffranchiModerateur($user['id_utilisateur']);

        $validation_moderation = ($isAdmin || $isModo || $isAffranchi);

        $result = $model->addMessageToDiscussion($texteMessage, $discussion['id_utilisateur'], $discussion['id_utilisateur_1'], $discussionId, $validation_moderation, $user['id_utilisateur']);

        header('Location: ?controller=discussion&action=discussion&id=' . $discussionId);
        exit();
    }

     /**
     * @brief Démarre une nouvelle discussion.
     *
     * Cette méthode vérifie si l'utilisateur est connecté et démarre une nouvelle discussion
     * avec un formateur spécifié.
     */
    public function action_start_discussion() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=discussion');
            exit();
        }

        $user = checkUserAccess();
    
        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }
    
        $model = Model::getModel();

        $id_client = $user['id_utilisateur'];

        $id_formateur = isset($_POST['id_formateur']) ? e($_POST['id_formateur']) : null;

        $discussion_id = $model->startDiscussion($id_client, $id_formateur);
        if(!$discussion_id){
            header('Location: ?controller=discussion');
            exit();
        }
    
        header('Location: ?controller=discussion&action=discussion&id=' . $discussion_id);
        exit();
    }

    public function action_validate_message()
    {
        // Vérifie si l'utilisateur a accès à cette fonctionnalité
        $user = checkUserAccess();

        if (!$user) {
            // Si l'utilisateur n'est pas autorisé, affiche un message et redirige vers la page d'authentification
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        // Obtient une instance du modèle
        $model = Model::getModel();

        // Vérifie si l'utilisateur est un modérateur
        $isModo = $model->verifModerateur($user['id_utilisateur']);
        if (!$isModo) {
            // Si l'utilisateur n'est pas modérateur, affiche un message et redirige vers la page d'authentification
            echo "Accès non autorisé.";
            $this->render('auth', []);
        }

        // Récupère l'id du message à valider depuis la requête GET
        $id_message = isset($_GET['id_message']) ? e($_GET['id_message']) : null;

        if (!$id_message) {
            // Si l'id du message n'est pas fourni, redirige vers la page de discussion
            header('Location: ?controller=discussion');
            exit();
        }

        // Appelle la fonction du modèle pour valider le message
        $discussion_id = $model->validateMessage($id_message);

        if (!$discussion_id) {
            // Si une erreur se produit lors de la validation du message, affiche un message d'erreur
            echo "Erreur lors de la validation du message.";
            exit();
        }

        // Redirige vers la discussion contenant le message validé
        header('Location: ?controller=discussion&action=discussion&id=' . $discussion_id);
        exit();
    }




}
