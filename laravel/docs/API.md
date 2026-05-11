# API Routes - ADNANE BOOKS

## Public Routes

### Books
- `GET /books` - Liste des livres
- `GET /books/{id}` - Détails d'un livre
- `GET /books/search?q={query}` - Recherche de livres

### Categories
- `GET /categories` - Liste des catégories

### Authors
- `GET /authors` - Liste des auteurs

## Authenticated Routes (Client)

### Cart & Orders
- `POST /cart/add` - Ajouter au panier
- `GET /cart` - Voir le panier
- `POST /orders` - Créer une commande
- `GET /orders` - Mes commandes
- `POST /orders/{id}/pay` - Payer une commande

## Admin Routes

### Books Management
- `POST /admin/books` - Créer un livre
- `PUT /admin/books/{id}` - Modifier un livre
- `DELETE /admin/books/{id}` - Supprimer un livre

### Categories Management
- `POST /admin/categories` - Créer une catégorie
- `PUT /admin/categories/{id}` - Modifier une catégorie
- `DELETE /admin/categories/{id}` - Supprimer une catégorie

### Authors Management
- `POST /admin/authors` - Créer un auteur
- `PUT /admin/authors/{id}` - Modifier un auteur
- `DELETE /admin/authors/{id}` - Supprimer un auteur

### Orders Management
- `GET /admin/orders` - Toutes les commandes
- `PUT /admin/orders/{id}/status` - Changer le statut

### Statistics
- `GET /admin/stats` - Statistiques globales
