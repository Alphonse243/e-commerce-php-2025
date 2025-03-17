<?php
require_once 'config/db.php';

try {
    // Lire le fichier SQL
    $sql = file_get_contents(__DIR__ . '/sql/drop_table.sql');
    
    // Exécuter la requête SQL
    if ($conn->query($sql)) {
        echo "Table products supprimée avec succès";
    }
} catch (Exception $e) {
    die("Erreur lors de la suppression : " . $e->getMessage());
}
