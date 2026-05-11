# Architecture Base de Données - ADNANE BOOKS

## Tables Principales

### users
- id (PK)
- name
- email (unique)
- password (hashed)
- role (admin|client)
- timestamps

### categories
- id (PK)
- name
- color
- timestamps

### authors
- id (PK)
- name
- nationality
- timestamps

### books
- id (PK)
- title
- isbn (unique)
- price
- stock
- category_id (FK → categories)
- description
- image
- timestamps

### author_book (pivot)
- author_id (FK → authors)
- book_id (FK → books)

### orders
- id (PK)
- user_id (FK → users)
- total_price
- status (pending|paid|shipped|delivered)
- timestamps

### order_items
- id (PK)
- order_id (FK → orders)
- book_id (FK → books)
- quantity
- price
- timestamps

## Relations

```
users (1) ──< orders
orders (1) ──< order_items
books (1) ──< order_items
categories (1) ──< books
books (N) ──< author_book >── (N) authors
```
