<?php

use Faker\Factory;

class ProductSeeder {
    private $faker;
    private $db;

    public function __construct() {
        $this->faker = Factory::create();
        $this->db = Database::getInstance();
    }

    public function seed($count = 50) {
        $categories = ['Shoes', 'Electronics', 'Clothing', 'Accessories', 'Sports'];
        $brands = ['Nike', 'Adidas', 'Samsung', 'Apple', 'Sony', 'Puma'];

        for ($i = 0; $i < $count; $i++) {
            $name = $this->faker->productName;
            $price = $this->faker->randomFloat(2, 10, 1000);
            
            $data = [
                'name' => $name,
                'slug' => strtolower(str_replace(' ', '-', $name)),
                'description' => $this->faker->paragraph(3),
                'price' => $price,
                'original_price' => $this->faker->optional(0.7)->randomFloat(2, $price, $price * 1.5),
                'category' => $this->faker->randomElement($categories),
                'stock' => $this->faker->numberBetween(0, 100),
                'brand' => $this->faker->randomElement($brands),
                'rating' => $this->faker->randomFloat(1, 0, 5),
                'image' => 'img/product/p' . $this->faker->numberBetween(1, 9) . '.jpg',
                'specs' => json_encode(['weight' => $this->faker->numberBetween(100, 1000) . 'g']),
                'features' => $this->faker->text(),
                'is_featured' => $this->faker->boolean(20),
                'is_new' => $this->faker->boolean(30),
                'is_sale' => $this->faker->boolean(25)
            ];

            $columns = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));
            
            $stmt = $this->db->prepare("INSERT INTO products ($columns) VALUES ($values)");
            $stmt->execute(array_values($data));
        }
    }
}
