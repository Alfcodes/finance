# Personal Finance API Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication
All endpoints require authentication via Sanctum token.

**Headers:**
```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

## Get Authentication Token

### Register
```http
POST /register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### Login
```http
POST /login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password"
}
```

Response includes `token` to use in future requests.

---

## 📊 Dashboard Stats

### Get Overall Statistics
```http
GET /stats
```

**Response:**
```json
{
  "income": 5000.00,
  "total_expenses": 1500.00,
  "total_savings": 2000.00,
  "total_giving": 200.00,
  "total_family": 300.00,
  "total_income_entries": 5000.00,
  "remaining": 3500.00,
  "savings_rate": 0.4,
  "giving_rate": 0.04,
  "budget_utilization": 0.3,
  "health_score": 70.5
}
```

---

## 🛒 Expenses

### List All Expenses
```http
GET /expenses
```

**Response:**
```json
[
  {
    "id": "550e8400-e29b-41d4-a716-446655440000",
    "user_id": 1,
    "date": "2026-06-29",
    "description": "Groceries",
    "category": "Food",
    "amount": "75.50",
    "method": "Cash",
    "vendor": "Melcom",
    "notes": "Weekly groceries",
    "created_at": "2026-06-29T10:30:00Z",
    "updated_at": "2026-06-29T10:30:00Z"
  }
]
```

### Create Expense
```http
POST /expenses
Content-Type: application/json

{
  "date": "2026-06-29",
  "description": "Groceries",
  "category": "Food",
  "amount": 75.50,
  "method": "Cash",
  "vendor": "Melcom",
  "notes": "Weekly groceries"
}
```

**Response:** `201 Created`
```json
{
  "message": "Expense created",
  "data": { /* expense object */ }
}
```

### Update Expense
```http
PUT /expenses/{id}
Content-Type: application/json

{
  "date": "2026-06-29",
  "description": "Updated description",
  "amount": 80.00,
  ...
}
```

### Delete Expense
```http
DELETE /expenses/{id}
```

**Response:** `200 OK`
```json
{
  "message": "Expense deleted"
}
```

---

## 💵 Income

### List Income Entries
```http
GET /income
```

### Create Income Entry
```http
POST /income
Content-Type: application/json

{
  "date": "2026-06-29",
  "source": "Monthly Salary",
  "type": "Salary",
  "amount": 5000.00,
  "notes": "Regular monthly income"
}
```

### Update Income Entry
```http
PUT /income/{id}
Content-Type: application/json

{
  "amount": 5500.00,
  ...
}
```

### Delete Income Entry
```http
DELETE /income/{id}
```

---

## 📈 Savings

### List Savings Goals
```http
GET /savings
```

### Create Savings Goal
```http
POST /savings
Content-Type: application/json

{
  "name": "Emergency Fund",
  "type": "Savings",
  "opening": 500.00,
  "contribution": 100.00,
  "current": 600.00,
  "target": 5000.00
}
```

### Update Savings Goal
```http
PUT /savings/{id}
Content-Type: application/json

{
  "current": 700.00,
  ...
}
```

### Delete Savings Goal
```http
DELETE /savings/{id}
```

---

## 🙏 Giving

### List Giving Records
```http
GET /giving
```

### Create Giving Record
```http
POST /giving
Content-Type: application/json

{
  "date": "2026-06-29",
  "recipient": "Church",
  "type": "Tithe",
  "amount": 200.00,
  "method": "Cash",
  "purpose": "Sunday tithe"
}
```

### Delete Giving Record
```http
DELETE /giving/{id}
```

---

## 👨‍👩‍👧 Family Support

### List Family Support Records
```http
GET /family
```

### Create Family Support Record
```http
POST /family
Content-Type: application/json

{
  "date": "2026-06-29",
  "recipient": "Mother",
  "relationship": "Parent",
  "amount": 500.00,
  "method": "Transfer",
  "purpose": "Monthly support"
}
```

### Delete Family Support Record
```http
DELETE /family/{id}
```

---

## 🎯 Goals

### List Financial Goals
```http
GET /goals
```

### Create Financial Goal
```http
POST /goals
Content-Type: application/json

{
  "name": "Vacation Fund",
  "target": 2000.00,
  "current": 500.00,
  "deadline": "2026-12-31",
  "category": "Travel"
}
```

### Update Financial Goal
```http
PUT /goals/{id}
Content-Type: application/json

{
  "current": 750.00,
  ...
}
```

### Delete Financial Goal
```http
DELETE /goals/{id}
```

---

## Error Responses

### Validation Error
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "amount": ["The amount field is required."],
    "date": ["The date field is required."]
  }
}
```

### Unauthorized
```json
{
  "message": "Unauthenticated."
}
```

### Not Found
```json
{
  "message": "Not found."
}
```

### Forbidden (User doesn't own resource)
```json
{
  "message": "This action is unauthorized."
}
```

---

## Common Status Codes

| Code | Meaning |
|------|---------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 500 | Server Error |

---

## Example Mobile App Integration

### Login and Get Token
```javascript
const response = await fetch('http://localhost:8000/api/login', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    email: 'user@example.com',
    password: 'password'
  })
});
const { token } = await response.json();
```

### Fetch Dashboard Stats
```javascript
const response = await fetch('http://localhost:8000/api/stats', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Accept': 'application/json'
  }
});
const stats = await response.json();
```

### Add Expense
```javascript
const response = await fetch('http://localhost:8000/api/expenses', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    date: '2026-06-29',
    description: 'Lunch',
    category: 'Food',
    amount: 25.00,
    method: 'Cash'
  })
});
const newExpense = await response.json();
```

---

## Rate Limiting

No rate limiting currently implemented. Consider adding if deploying to production.

## CORS

Ensure CORS is properly configured for mobile app domains in `config/cors.php`.

