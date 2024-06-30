<?php

// Informations de connexion à la base de données PostgreSQL
define('DB_HOST', '127.0.0.1');      // L'hôte de la base de données (généralement localhost)
define('DB_NAME', 'sae_audit'); // Le nom de votre base de données PostgreSQL
define('DB_USER', 'postgres'); // Votre nom d'utilisateur PostgreSQL
define('DB_PASSWORD', '486205'); // Votre mot de passe PostgreSQL

$dsn = "pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$login = DB_USER;
$mdp = DB_PASSWORD;

?>