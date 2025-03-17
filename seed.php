<?php
// Configuration des erreurs PHP pour le débogage
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Chargement des dépendances
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/init.php';
require_once __DIR__ . '/database/seeding/ProductSeeder.php';

/**
 * Interface utilisateur pour le seeding
 * Affiche un formulaire de confirmation avant de lancer le processus
 */
if (!isset($_POST['start_seeding'])) {
    echo <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <title>Database Seeding</title>
        <style>
            .warning { color: orange; margin-bottom: 20px; }
            .btn { 
                padding: 10px 20px;
                background-color: #ff6c00;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .btn:hover { background-color: #ff8533; }
        </style>
    </head>
    <body>
        <p class="warning">Cette action va ajouter 50 nouveaux produits à la table products.</p>
        <form method="POST">
            <input type="submit" name="start_seeding" value="Ajouter les Produits" class="btn">
        </form>
    </body>
    </html>
    HTML;
    exit;
}

try {
    echo "Début de l'ajout des produits...<br>";
    
    // Initialisation de la connexion à la base de données
    $db = Database::getInstance();
    echo "Connexion à la base de données réussie.<br>";
    
    // Exécution du seeding
    $seeder = new Database\Seeding\ProductSeeder();
    $seeder->seed(); // Génère 50 produits par défaut
    echo "Ajout des produits terminé avec succès!";
    
} catch (Exception $e) {
    // Gestion des erreurs avec affichage détaillé
    die("Erreur : " . $e->getMessage() . "<br>Fichier : " . $e->getFile() . "<br>Ligne : " . $e->getLine());
}
