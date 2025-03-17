<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/includes/init.php';

try {
    echo "Début du seeding...<br>";
    
    // Tester la connexion à la base de données
    $db = Database::getInstance();
    echo "Connexion à la base de données réussie.<br>";
    
    // Vérifier si la table existe
    $tables = $db->query("SHOW TABLES LIKE 'products'")->fetchAll();
    if (empty($tables)) {
        // Créer la table si elle n'existe pas
        $db->exec("CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL UNIQUE,
            description TEXT,
            price DECIMAL(10,2) NOT NULL,
            original_price DECIMAL(10,2),
            category VARCHAR(100),
            stock INT DEFAULT 0,
            brand VARCHAR(100),
            rating DECIMAL(3,2) DEFAULT 0,
            image VARCHAR(255),
            image2 VARCHAR(255),
            image3 VARCHAR(255),
            specs JSON,
            features TEXT,
            is_featured BOOLEAN DEFAULT FALSE,
            is_new BOOLEAN DEFAULT FALSE,
            is_sale BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FULLTEXT KEY products_search (name, description)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        echo "Table 'products' créée.<br>";
    }
    
    $seeder = new ProductSeeder();
    $seeder->seed();
    echo "Seeding terminé avec succès!";
    
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage() . "<br>Fichier : " . $e->getFile() . "<br>Ligne : " . le->getLine());
}
