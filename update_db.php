<?php
require_once 'config/db.php';

try {
    // Lire le fichier SQL
    $sql = file_get_contents(__DIR__ . '/sql/update_products_table.sql');
    
    // Exécuter les requêtes SQL
    if ($conn->multi_query($sql)) {
        do {
            // Traiter tous les résultats
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());
        
        echo "Table products mise à jour avec succès";
    }
} catch (Exception $e) {
    die("Erreur lors de la mise à jour : " . $e->getMessage());
}
