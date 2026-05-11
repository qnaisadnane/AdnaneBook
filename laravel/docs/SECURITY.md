# Sécurité - ADNANE BOOKS

## Authentification
- Utilisation de Laravel Breeze/Sanctum
- Mots de passe hashés avec bcrypt
- Sessions sécurisées

## Protection CSRF
- Tokens CSRF sur tous les formulaires
- Validation automatique par Laravel

## Validation des Données
- Validation côté serveur obligatoire
- Règles de validation strictes
- Sanitization des inputs

## Gestion des Rôles
- Middleware pour vérifier les permissions
- Séparation admin/client
- Routes protégées

## Base de Données
- Prepared statements (Eloquent ORM)
- Protection contre SQL injection
- Pas de requêtes brutes non sécurisées

## Fichiers Uploadés
- Validation du type MIME
- Limitation de taille
- Stockage sécurisé

## Variables d'Environnement
- Fichier .env non versionné
- Clés secrètes protégées
- Configuration sensible isolée
