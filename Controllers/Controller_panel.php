<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_panel qui gère les opérations du panneau d'administration et de modération.
 */

/**
 * Class Controller_panel
 *
 * @brief Cette classe gère les actions du panneau d'administration et de modération, y compris la gestion des activités, des modérateurs et l'affranchissement des utilisateurs.
 */

class Controller_panel extends Controller
{   
    /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode est appelée lorsque aucune action spécifique n'est définie. Elle redirige vers `action_panel` pour afficher le panneau de gestion.
     */
    public function action_default()
    {
        $this->action_panel();
    }

    /**
     * @brief Affiche le panneau de gestion en fonction du rôle de l'utilisateur.
     *
     * Cette méthode vérifie le rôle de l'utilisateur (admin ou modérateur) et affiche le panneau approprié avec les données pertinentes.
     *
     * @note Cette méthode vérifie l'accès de l'utilisateur et affiche un message d'erreur si l'accès est non autorisé.
     */
    public function action_panel()
    {

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        $isAdmin = $model->verifAdmin($user['id_utilisateur']);
        $isModo = $model->verifModerateur($user['id_utilisateur']);

        $data = [
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'photo_de_profil' => $user['photo_de_profil'],
            'role' => $role
        ];

        if (!$isAdmin && !$isModo) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        } elseif ($isModo) {

            //liste formateur qui veulent valider
            //liste discussion
            //liste utilisateur pour affranchir
            $data['discussions'] = $model->recupererToutesDiscussions();
            $data['utilisateurs'] = $model->recupererUtilisateursNonAffranchis();
            $this->render('panel_moderateur', $data);
        } else {
            $data['formateurs'] = $model->listeFormateursAvecStatutModerateur();
            $this->render('panel_administrateur', $data);
        }
    }

     /**
     * @brief Gère la promotion ou la rétrogradation des modérateurs.
     *
     * Cette méthode permet aux administrateurs de promouvoir un utilisateur au rang de modérateur ou de le rétrograder.
     * 
     * @note Cette méthode vérifie l'accès de l'utilisateur et affiche un message d'erreur si l'accès est non autorisé.
     */
    public function action_manage_moderator(){

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: ?controller=panel');
            exit();
        }

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        $formateurId = isset($_GET['id']) ? e($_GET['id']) : null;
        if(!$formateurId){
            header('Location: ?controller=panel');
            exit();
        }

        $isAdmin = $model->verifAdmin($user['id_utilisateur']);

        if (!$isAdmin) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }

        $manage = isset($_GET['manage']) ? strtolower(trim(e($_GET['manage']))) : '';


        if ($manage === 'promote') {
            $model->addModerator($user['id_utilisateur'], $formateurId);
        } elseif ($manage === 'demote') {
            $model->removeModerator($formateurId);
        } else {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }

        header('Location: ?controller=panel');
        exit();

    }

    /**
     * @brief Ajoute une nouvelle activité.
     *
     * Cette méthode permet aux administrateurs d'ajouter une nouvelle activité avec un nom, une description et une image. 
     * 
     * @note Cette méthode vérifie l'accès de l'utilisateur et affiche un message d'erreur si l'accès est non autorisé.
     */
    public function action_add_activity(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?controller=discussion');
            exit();
        }
    
        $user = checkUserAccess();
    
        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }
    
        $role = getUserRole($user);
    
        $model = Model::getModel();
    
        $isAdmin = $model->verifAdmin($user['id_utilisateur']);
    
        if (!$isAdmin) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }
    
        // Retrieve data from the POST request
        $nom_activite = isset($_POST['name']) ? e($_POST['name']) : null;
        $description = isset($_POST['description']) ? e($_POST['description']) : null;
    
        // Handle image upload
        $image = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'Content/data/';
            $uploadPath = $uploadDir . basename($_FILES['photo']['name']);
    
            // Ensure the 'data/img/' directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
                $image = $_FILES['photo']['name'];
            } else {
                // Handle upload failure if needed
                echo "Image upload failed.";
                exit();
            }
        }
    
        // Call the addActivity method with the retrieved data
        $model->addActivity($nom_activite, $image, $description, $user['id_utilisateur']);
    
        header('Location: ?controller=panel');
        exit();
    }

    /**
     * @brief Affranchit un utilisateur.
     *
     * Cette méthode permet aux modérateurs d'affranchir un utilisateur, ce qui peut lui accorder des privilèges supplémentaires.
     * 
     * @note Cette méthode vérifie l'accès de l'utilisateur et affiche un message d'erreur si l'accès est non autorisé.
     */
    public function action_add_affranchi(){

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: ?controller=panel');
            exit();
        }

        $user = checkUserAccess();

        if (!$user) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }

        $role = getUserRole($user);

        $model = Model::getModel();

        $userId = isset($_GET['id']) ? e($_GET['id']) : null;
        if(!$userId){
            header('Location: ?controller=panel');
            exit();
        }

        $isModo = $model->verifModerateur($user['id_utilisateur']);

        if (!$isModo) {
            echo "Accès non autorisé.";
            $this->render('auth', []);
            return;
        }

        $model->affranchirUtilisateur($user['id_utilisateur'], $userId);

        header('Location: ?controller=panel');
        exit();

    }

}
