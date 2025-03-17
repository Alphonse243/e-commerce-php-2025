CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    rating DECIMAL(3,2) NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Ajouter quelques reviews de test
INSERT INTO reviews (product_id, user_name, rating, comment) VALUES
(1, 'John Doe', 4.5, 'Excellent produit, très confortable !'),
(1, 'Jane Smith', 5.0, 'Parfait pour la course à pied'),
(2, 'Mike Johnson', 4.0, 'Bon rapport qualité-prix');
