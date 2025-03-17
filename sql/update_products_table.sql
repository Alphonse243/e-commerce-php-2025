-- Sauvegarder les données existantes
CREATE TEMPORARY TABLE temp_products AS SELECT * FROM products;

-- Supprimer l'ancienne table
DROP TABLE IF EXISTS products;

-- Recréer la table avec la structure combinée
CREATE TABLE products (
    -- Colonnes existantes
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    original_price DECIMAL(10,2),
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Nouvelles colonnes
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    category VARCHAR(100),
    stock INT DEFAULT 0,
    brand VARCHAR(100),
    rating DECIMAL(3,2) DEFAULT 0,
    image2 VARCHAR(255),
    image3 VARCHAR(255),
    specs JSON,
    features TEXT,
    is_featured BOOLEAN DEFAULT FALSE,
    is_new BOOLEAN DEFAULT FALSE,
    is_sale BOOLEAN DEFAULT FALSE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Index de recherche
    FULLTEXT KEY products_search (name, description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Restaurer les données existantes
INSERT INTO products (id, name, price, original_price, image, created_at)
SELECT id, name, price, original_price, image, created_at
FROM temp_products;

-- Générer les slugs pour les entrées existantes
UPDATE products 
SET slug = CONCAT(
    LOWER(
        REPLACE(
            REPLACE(
                REPLACE(
                    name, 
                    ' ', 
                    '-'
                ),
                '.', 
                ''
            ),
            ',', 
            ''
        )
    ),
    '-',
    id
);

-- Supprimer la table temporaire
DROP TEMPORARY TABLE IF EXISTS temp_products;
