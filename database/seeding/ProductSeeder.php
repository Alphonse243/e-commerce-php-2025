<?php

namespace Database\Seeding;

use Faker\Factory;
use Database;

/**
 * Classe responsable de la génération des données factices pour la table products
 */
class ProductSeeder {
    /** @var \Faker\Generator Instance de Faker pour générer des données aléatoires */
    private $faker;
    
    /** @var \PDO Instance de connexion à la base de données */
    private $db;

    public function __construct() {
        // Initialisation de Faker avec la locale en_US pour plus de cohérence
        $this->faker = Factory::create('en_US');
        $this->db = Database::getInstance();
    }

    /**
     * Génère et insère un nombre spécifié de produits dans la base de données
     * @param int $count Nombre de produits à générer (50 par défaut)
     */
    public function seed($count = 50) {
        // Définition des valeurs possibles pour les catégories et marques
        $categories = ['Shoes', 'Electronics', 'Clothing', 'Accessories', 'Sports'];
        $brands = ['Nike', 'Adidas', 'Samsung', 'Apple', 'Sony', 'Puma'];

        for ($i = 0; $i < $count; $i++) {
            // Génération du nom et du prix de base
            $name = $this->faker->words(3, true);
            $price = $this->faker->randomFloat(2, 10, 1000);
            
            // Préparation des données du produit
            $data = [
                'name' => ucwords($name), // Capitalisation du nom
                'slug' => strtolower(str_replace(' ', '-', $name)), // Création d'une URL conviviale
                'description' => $this->faker->paragraph(3), // Description aléatoire
                'price' => $price,
                // Prix original optionnel (70% de chance d'avoir un prix original)
                'original_price' => $this->faker->optional(0.7)->randomFloat(2, $price, $price * 1.5),
                'category' => $this->faker->randomElement($categories),
                'stock' => $this->faker->numberBetween(0, 100), // Stock entre 0 et 100
                'brand' => $this->faker->randomElement($brands),
                'rating' => $this->faker->randomFloat(1, 0, 5), // Note entre 0 et 5
                'image' => 'img/product/p' . $this->faker->numberBetween(1, 9) . '.jpg', // Image aléatoire
                // Spécifications techniques en JSON
                'specs' => json_encode(['weight' => $this->faker->numberBetween(100, 1000) . 'g']),
                'features' => $this->faker->text(),
                // Flags booléens avec différentes probabilités
                'is_featured' => $this->faker->boolean(20) ? 1 : 0, // 20% de chance d'être mis en avant
                'is_new' => $this->faker->boolean(30) ? 1 : 0,     // 30% de chance d'être nouveau
                'is_sale' => $this->faker->boolean(25) ? 1 : 0     // 25% de chance d'être en solde
            ];

            // Préparation de la requête SQL
            $columns = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));
            
            // Insertion dans la base de données avec requête préparée
            $stmt = $this->db->prepare("INSERT INTO products ($columns) VALUES ($values)");
            $stmt->execute(array_values($data));
        }
    }
}