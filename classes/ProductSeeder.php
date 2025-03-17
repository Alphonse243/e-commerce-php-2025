<?php
class ProductSeeder {
    private PDO $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }

    private function createSlug($text) {
        // Convertir en minuscules
        $text = strtolower($text);
        // Remplacer les caractères spéciaux par des tirets
        $text = preg_replace('/[^a-z0-9\-]/', '-', $text);
        // Supprimer les tirets multiples
        $text = preg_replace('/-+/', '-', $text);
        // Supprimer les tirets au début et à la fin
        return trim($text, '-');
    }

    public function seed(): void {
        $this->db->exec("TRUNCATE TABLE products");
        echo "Table vidée.<br>";

        $products = [
            [
                'brand' => 'Nike',
                'baseName' => 'Air Max',
                'image' => 'p1.jpg',
                'basePrice' => 129.99,
                'type' => 'Running'
            ],
            [
                'brand' => 'Adidas',
                'baseName' => 'Ultra Boost',
                'image' => 'p2.jpg',
                'basePrice' => 159.99,
                'type' => 'Running'
            ],
            [
                'brand' => 'Nike',
                'baseName' => 'Jordan',
                'image' => 'p3.jpg',
                'basePrice' => 199.99,
                'type' => 'Basketball'
            ],
            [
                'brand' => 'Puma',
                'baseName' => 'RS-X',
                'image' => 'p4.jpg',
                'basePrice' => 109.99,
                'type' => 'Lifestyle'
            ],
            [
                'brand' => 'New Balance',
                'baseName' => '574',
                'image' => 'p5.jpg',
                'basePrice' => 89.99,
                'type' => 'Casual'
            ]
        ];

        $colors = ['Black', 'White', 'Red', 'Blue', 'Grey', 'Navy', 'Green', 'Purple', 'Orange', 'Pink'];
        $features = [
            "Breathable mesh upper",
            "Responsive cushioning",
            "Durable rubber outsole",
            "Enhanced stability",
            "Lightweight design",
            "Moisture-wicking lining",
            "Padded collar and tongue",
            "Reflective details",
            "Removable insole",
            "Secure lacing system"
        ];

        $seededProducts = [];
        
        // Générer 50 produits en variant les modèles de base
        for ($i = 0; $i < 50; $i++) {
            $baseProduct = $products[$i % count($products)];
            $color = $colors[array_rand($colors)];
            $basePrice = $baseProduct['basePrice'] + rand(-20, 20);
            $name = "{$baseProduct['brand']} {$baseProduct['baseName']} {$color} Edition";
            
            // Sélectionner 3-5 features aléatoires
            $productFeatures = array_rand(array_flip($features), rand(3, 5));
            
            $specs = [
                'weight' => rand(200, 400) . 'g',
                'dimensions' => rand(5, 15) . 'cm x ' . rand(10, 20) . 'cm x ' . rand(20, 30) . 'cm',
                'material' => ['Mesh', 'Synthetic', 'Leather', 'Canvas'][array_rand(['Mesh', 'Synthetic', 'Leather', 'Canvas'])],
                'color' => $color,
                'sizeRange' => '36-46 EU'
            ];

            // Conversion explicite des booléens en entiers (0 ou 1)
            $seededProducts[] = [
                'name' => $name,
                'slug' => $this->createSlug($name) . '-' . uniqid(),
                'description' => sprintf(
                    "Experience ultimate comfort and style with the %s. Engineered for %s performance, featuring innovative technology and premium materials.",
                    $name,
                    strtolower($baseProduct['type'])
                ),
                'price' => $basePrice,
                'original_price' => (rand(0, 1)) ? $basePrice * 1.2 : null,
                'category' => $baseProduct['type'],
                'brand' => $baseProduct['brand'],
                'stock' => rand(0, 100),
                'rating' => rand(35, 50) / 10,
                'image' => 'img/product/' . $baseProduct['image'],
                'image2' => null,
                'image3' => null,
                'specs' => json_encode($specs),
                'features' => implode("\n", $productFeatures),
                'is_featured' => (int)(rand(0, 10) > 8), // Conversion en int
                'is_new' => (int)(rand(0, 10) > 7),      // Conversion en int
                'is_sale' => (int)(rand(0, 10) > 8)      // Conversion en int
            ];
        }

        $sql = "INSERT INTO products (name, slug, description, price, original_price, category, brand, stock, 
                rating, image, image2, image3, specs, features, is_featured, is_new, is_sale) 
                VALUES (:name, :slug, :description, :price, :original_price, :category, :brand, :stock, 
                :rating, :image, :image2, :image3, :specs, :features, :is_featured, :is_new, :is_sale)";
        
        $stmt = $this->db->prepare($sql);
        
        $successful = 0;
        foreach ($seededProducts as $product) {
            try {
                $stmt->execute($product);
                $successful++;
            } catch (PDOException $e) {
                echo "Erreur lors de l'insertion : " . $e->getMessage() . "<br>";
            }
        }
        
        echo "$successful produits insérés sur " . count($seededProducts) . " tentatives.<br>";
    }
}
