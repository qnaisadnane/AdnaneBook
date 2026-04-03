# 📚 ADNANE BOOKS

> Plateforme e-commerce de vente de livres en ligne — développée avec Laravel

---

## 📌 Présentation

**ADNANE BOOKS** est une application web e-commerce permettant la vente de livres en ligne. La plateforme permet aux utilisateurs de consulter des livres, passer des commandes et suivre leurs achats. Elle offre également aux administrateurs et aux employés des outils pour gérer les livres, les stocks, les commandes et les utilisateurs.

**Durée du projet :** 8 à 10 semaines

### Objectifs

- Gérer un catalogue de livres
- Gérer les auteurs et les catégories
- Gérer les commandes et suivre les stocks
- Simuler un paiement
- Visualiser des statistiques de vente

---

## 🛠️ Technologies

| Couche | Technologies |
|--------|-------------|
| **Frontend** | HTML5, Tailwind CSS, JavaScript, Blade |
| **Backend** | Laravel (PHP) — Routes, Controllers, Models (Eloquent ORM), Middleware |
| **Base de données** | MySQL |
| **Sécurité** | bcrypt, CSRF, validation des formulaires, authentification Laravel |

---

## 👥 Utilisateurs du Système

### 🔴 Administrateur — *Super Admin*
Accès complet : gérer utilisateurs, livres, catégories, auteurs, stocks, commandes, statistiques.

### 🟠 Gestionnaire de Stock — *Gestion du catalogue*
Ajouter / modifier des livres, gérer les stocks, associer des auteurs aux livres.

### 🟡 Agent Commercial — *Gestion des commandes*
Voir, créer et modifier le statut des commandes. Consulter les livres.
> ⚠️ L'agent ne gère pas les clients.

### 🟢 Client — *Acheteur*
Consulter et rechercher des livres, ajouter au panier, passer une commande, voir ses commandes.

---

## 🔐 Matrice des Permissions

| Action | Client | Agent | Gestionnaire | Admin |
|--------|:------:|:-----:|:------------:|:-----:|
| Voir livres | ✅ | ✅ | ✅ | ✅ |
| Ajouter livre | ❌ | ❌ | ✅ | ✅ |
| Modifier livre | ❌ | ❌ | ✅ | ✅ |
| Gérer stock | ❌ | ❌ | ✅ | ✅ |
| Créer commande | ✅ | ✅ | ❌ | ✅ |
| Voir commandes | Ses commandes | ✅ | ❌ | ✅ |
| Gérer clients | ❌ | ❌ | ❌ | ✅ |
| Gérer utilisateurs | ❌ | ❌ | ❌ | ✅ |
| Voir statistiques | ❌ | ❌ | ❌ | ✅ |

---

## ⚙️ Règles Métier

### Utilisateurs
- `RB-001` Chaque utilisateur possède un seul rôle
- `RB-002` L'email doit être unique
- `RB-003` Les mots de passe sont hashés (bcrypt)
- `RB-004` L'administrateur possède toutes les permissions

### Livres
- `RB-005` Le stock d'un livre est toujours ≥ 0
- `RB-006` Le prix doit être supérieur à 0
- `RB-007` Un livre appartient à une seule catégorie
- `RB-008` L'ISBN est unique
- `RB-009` Un livre peut avoir plusieurs auteurs

### Catégories
- `RB-010` Une catégorie possède un nom et une couleur

### Commandes
- `RB-011` Une commande appartient à un seul client
- `RB-012` Une commande contient au moins un livre
- `RB-013` Le stock est décrémenté après validation
- `RB-014` Impossible de commander si le stock est insuffisant
- `RB-015` Cycle de statut : `pending` → `paid` → `shipped` → `delivered`

### Paiement
- `RB-016` Une commande payée ne peut plus être modifiée
- `RB-017` Le paiement est simulé

---

## ✨ Fonctionnalités

### 📖 Gestion des Livres
- **Ajouter** : titre, ISBN, prix, stock, catégorie, auteurs, description, image
- **Modifier** : prix, stock, catégorie, auteurs, description
- **Lister** : recherche par titre, filtres par catégorie / prix / disponibilité

### ✍️ Gestion des Auteurs
CRUD complet — ajouter, modifier, supprimer, lister

### 🏷️ Gestion des Catégories
CRUD complet — chaque catégorie possède un nom et une couleur d'affichage

### 🛒 Gestion des Commandes
- Sélection de livres avec quantité
- Calcul automatique : `Total = prix × quantité`
- Décrémentation du stock à la validation
- Paiement simulé : clic sur **Payer** → statut passe à `paid`
- Historique des commandes (statut + livres commandés)

### 📊 Statistiques Admin
- Nombre total de commandes et de clients
- Livres les plus vendus
- Revenus totaux
- Répartition des commandes par statut

---

## 🗃️ Base de Données

### Schéma des tables

```
users         — id, name, email, password, role (admin|manager|agent|client)
categories    — id, name, color
authors       — id, name, nationality
books         — id, title, isbn, price, stock, category_id, description, image
author_book   — author_id, book_id  ← pivot Many-to-Many
orders        — id, user_id, total_price, status (pending|paid|shipped|delivered)
order_items   — id, order_id, book_id, quantity, price
```

### Relations

```
users      (1) ──< orders
orders     (1) ──< order_items
books      (1) ──< order_items
categories (1) ──< books
books      (N) ──< author_book >── (N) authors
```

---

## 📋 User Stories

| ID | Catégorie | Story |
|----|-----------|-------|
| US1 | Auth | Un utilisateur peut s'inscrire |
| US2 | Auth | Un utilisateur peut se connecter |
| US3 | Auth | Un utilisateur peut se déconnecter |
| US4 | Catalogue | Voir la liste des livres |
| US5 | Catalogue | Rechercher un livre |
| US6 | Catalogue | Voir les détails d'un livre |
| US7 | Commandes | Ajouter un livre au panier |
| US8 | Commandes | Passer une commande |
| US9 | Commandes | Payer une commande |
| US10 | Commandes | Voir ses commandes |
| US11 | Admin | Ajouter un livre |
| US12 | Admin | Modifier un livre |
| US13 | Admin | Supprimer un livre |
| US14 | Admin | Gérer les auteurs |
| US15 | Admin | Gérer les catégories |
| US16 | Admin | Voir toutes les commandes |
| US17 | Admin | Voir les statistiques |

---

## 🗓️ Planning (8 semaines)

| Semaines | Tâches |
|----------|--------|
| **S1 – S2** | Installation Laravel, création de la base de données, migrations, authentification |
| **S3** | Gestion des rôles, CRUD catégories, CRUD auteurs |
| **S4** | CRUD livres, association livres ↔ auteurs |
| **S5** | Catalogue livres, recherche et filtres |
| **S6** | Panier, création de commandes |
| **S7** | Paiement simulé, gestion des commandes |
| **S8** | Dashboard statistiques, tests, correction bugs, préparation présentation |

---

## 🚀 Installation

```bash
# Cloner le projet
git clone https://github.com/votre-compte/adnane-books.git
cd adnane-books

# Installer les dépendances PHP et JS
composer install
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Configurer DB_DATABASE, DB_USERNAME, DB_PASSWORD dans .env puis :
php artisan migrate --seed

# Lancer le serveur
php artisan serve
npm run dev
```

---

## 📄 Licence

Projet académique — tous droits réservés © ADNANE BOOKS
