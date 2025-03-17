# E-commerce PHP 2025

## Description

Ce projet est un site de commerce électronique développé en utilisant HTML, CSS et JavaScript pour le frontend, et PHP pour le backend sans utiliser de framework. Il permet aux utilisateurs de parcourir les produits, d'ajouter des articles au panier, et de passer des commandes.

## Fonctionnalités

- Parcourir les produits
- Ajouter des produits au panier
- Passer des commandes
- Authentification des utilisateurs (connexion et inscription)
- Gestion des produits pour les administrateurs (ajout, modification, suppression)
- **Nouvelles fonctionnalités modernes :**
  - Recherche avancée de produits avec filtres
  - Système de recommandations de produits
  - Avis et évaluations des utilisateurs
  - Historique des commandes pour les utilisateurs
  - Notifications en temps réel pour les offres et promotions
  - Intégration de passerelles de paiement sécurisées
  - Support multilingue et multidevise
  - Gestion des stocks en temps réel
  - Fonctionnalité de liste de souhaits

## Structure du Projet

### Pages Principales
- `index.php` : Page d'accueil du site avec carrousel et produits vedettes
- `products.php` : Catalogue des produits avec filtres et pagination
- `product-details.php` : Page détaillée d'un produit avec images, description et avis
- `cart.php` : Gestion du panier avec mise à jour en temps réel
- `checkout.php` : Processus de paiement multi-étapes
- `wishlist.php` : Liste des souhaits de l'utilisateur
- `profile.php` : Profil utilisateur et historique des commandes

### Authentification
- `login.php` : Connexion avec options de récupération de mot de passe
- `register.php` : Inscription avec validation par email
- `forgot-password.php` : Réinitialisation du mot de passe
- `verify-email.php` : Vérification de l'email

### Administration
- `admin/` : Zone d'administration sécurisée
  - `index.php` : Tableau de bord avec statistiques et graphiques
  - `products/` : Gestion des produits
    - `list.php` : Liste des produits avec filtres
    - `add.php` : Ajout de produit
    - `edit.php` : Modification de produit
    - `categories.php` : Gestion des catégories
  - `orders/` : Gestion des commandes
    - `list.php` : Liste des commandes
    - `view.php` : Détails d'une commande
  - `users/` : Gestion des utilisateurs
    - `list.php` : Liste des utilisateurs
    - `roles.php` : Gestion des rôles

### Assets
- `assets/` : Ressources statiques
  - `css/` : Styles CSS
    - `style.css` : Styles principaux
    - `admin.css` : Styles de l'administration
    - `responsive.css` : Styles responsives
  - `js/` : Scripts JavaScript
    - `main.js` : Scripts principaux
    - `cart.js` : Logique du panier
    - `validation.js` : Validation des formulaires
  - `images/` : Images du site
    - `products/` : Photos des produits
    - `banners/` : Bannières et promotions
    - `icons/` : Icônes du site

### Include & Config
- `includes/` : Composants réutilisables
  - `header.php` : En-tête avec navigation
  - `footer.php` : Pied de page avec newsletter
  - `db.php` : Configuration de la base de données
  - `functions.php` : Fonctions utilitaires
  - `auth.php` : Fonctions d'authentification
  - `cart-functions.php` : Fonctions du panier
  - `email-templates/` : Templates d'emails

### Base de données
- `db/` : Scripts de base de données
  - `karma-master-db.sql` : Structure et données initiales
  - `migrations/` : Scripts de mise à jour
  - `backups/` : Sauvegardes automatiques

## Installation

1. Clonez le dépôt sur votre machine locale :
   ```bash
   git clone https://github.com/Alphonse243/e-commerce-php-2025.git
   ```

2. Configuration de la base de données :
   - Créez une nouvelle base de données MySQL nommée "karma_master"
   - Importez le fichier `db/karma-master-db.sql` dans votre base de données :
     ```bash
     mysql -u votre_utilisateur -p karma_master < db/karma-master-db.sql
     ```
   - Modifiez le fichier `includes/db.php` avec vos informations de connexion :
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'votre_utilisateur');
     define('DB_PASS', 'votre_mot_de_passe');
     define('DB_NAME', 'karma_master');
     ```

3. Configurez votre serveur web (Apache/Nginx) pour pointer vers le répertoire du projet

4. Accédez au site via votre navigateur : http://localhost/karma-master