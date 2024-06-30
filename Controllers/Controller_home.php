<?php

/**
 * @file
 * @brief Ce fichier contient la classe Controller_home qui gère les actions pour la page d'accueil et les activités.
 */

/**
 * Class Controller_home
 *
 * @brief Cette classe gère les actions du contrôleur "home" pour la page d'accueil et l'affichage des activités.
 * Elle hérite de la classe de base Controller et définit des actions spécifiques
 * pour l'affichage de la page d'accueil et des détails des activités.
 */

class Controller_home extends Controller
{

    /**
     * @brief Action par défaut du contrôleur.
     *
     * Cette méthode est appelée lorsque aucune action spécifique n'est définie.
     * Elle redirige vers l'action `action_home` pour afficher la page d'accueil.
     */
    public function action_default()
    {
        $this->action_home();
    }


    /**
     * @brief Affiche la page d'accueil avec la liste des activités.
     *
     * Cette méthode récupère la liste des activités via le modèle et rend la vue `home` 
     * en passant les données des activités.
     */
    public function action_home(){

        $model = Model::getModel();

        $data = [
            'activites' => $model->getActivitiesList()
        ];

        $this->render('home', $data);

    }

    /**
     * @brief Affiche les détails d'une activité spécifique.
     *
     * Cette méthode vérifie si un identifiant d'activité est fourni dans les paramètres de l'URL.
     * Si oui, elle récupère les détails de l'activité correspondante via le modèle et rend la vue `activite`.
     * Sinon, elle affiche la liste des activités.
     */
    public function action_activite(){

        $model = Model::getModel();

        $id_activite = isset($_GET['id']) ? e($_GET['id']) : null;
        if(!$id_activite){
            $data = [
                'activites' => $model->getActivitiesList()
            ];
            $this->render('home', $data);
            return;
        }

        $data = [
            'activite' => $model->getActivityById($id_activite)
        ];

        $this->render('activite', $data);

    }

}
