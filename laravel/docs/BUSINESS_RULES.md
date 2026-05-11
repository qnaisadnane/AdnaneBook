# Règles Métier - ADNANE BOOKS

## Utilisateurs
- **RB-001** : Chaque utilisateur possède un seul rôle
- **RB-002** : L'email doit être unique
- **RB-003** : Les mots de passe sont hashés (bcrypt)
- **RB-004** : L'administrateur possède toutes les permissions

## Livres
- **RB-005** : Le stock d'un livre est toujours ≥ 0
- **RB-006** : Le prix doit être supérieur à 0
- **RB-007** : Un livre appartient à une seule catégorie
- **RB-008** : L'ISBN est unique
- **RB-009** : Un livre peut avoir plusieurs auteurs

## Catégories
- **RB-010** : Une catégorie possède un nom et une couleur

## Commandes
- **RB-011** : Une commande appartient à un seul client
- **RB-012** : Une commande contient au moins un livre
- **RB-013** : Le stock est décrémenté après validation
- **RB-014** : Impossible de commander si le stock est insuffisant
- **RB-015** : Cycle de statut : `pending` → `paid` → `shipped` → `delivered`

## Paiement
- **RB-016** : Une commande payée ne peut plus être modifiée
- **RB-017** : Le paiement est simulé
