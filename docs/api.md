# Inventory System API v1
Base URL: `http://localhost:8000/api/v1`

## Autentikasi
- POST /register
  Body: { name, email, password, password_confirmation }
  Response: 201 Created { "status": "success", "data": { "user": ..., "token": ... }, "message": "User registered" }

- POST /login
  Body: { email, password }
  Response: 200 OK { "status": "success", "data": { "user": ..., "token": ... }, "message": "Login successful" }

## Kategori Barang (Categories)
- GET /categories
- POST /categories 
  Body: { name }
- GET /categories/{id}
- PUT /categories/{id} 
  Body: { name }
- DELETE /categories/{id} (Admin only)

## Barang (Items)
- GET /items
- POST /items 
  Body: { name, quantity, price, category_id }
- GET /items/{id}
- PUT /items/{id} 
  Body: { name, quantity, price, category_id }
- DELETE /items/{id} (Admin only)