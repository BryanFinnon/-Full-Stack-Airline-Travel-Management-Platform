# Airline Travel Management Platform

A full-stack airline travel management platform built with **React + PHP + MySQL**.

## What this project does

This platform lets a user:

- search flights with filters
- book a flight
- view reservation history
- track itinerary details
- manage schedules through REST APIs

## Tech stack

- **Frontend:** React
- **Backend:** PHP 8+ with REST-style endpoints
- **Database:** MySQL / MariaDB
- **Communication:** JSON over HTTP

## Project structure

```text
airline-travel-management-platform/
├── frontend/
│   ├── public/
│   └── src/
│       ├── components/
│       ├── services/
│       ├── App.js
│       ├── index.js
│       └── styles.css
├── backend/
│   ├── api/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   ├── utils/
│   └── index.php
├── database/
│   ├── schema.sql
│   └── seed.sql
└── README.md
```

## Functional overview

### Main entities

- `users`
- `passengers`
- `flights`
- `schedules`
- `reservations`
- `itineraries`

### Main frontend flows

1. Search flight  
2. Show matching results  
3. Select a flight  
4. Book for a passenger  
5. View itinerary / reservations  

## Database design

### 1. users
Stores account information.

### 2. passengers
Stores traveler profile data.

### 3. flights
Stores the route, code, capacity and base pricing.

### 4. schedules
Stores departure and arrival timestamps for a flight.

### 5. reservations
Stores booking records linking passenger and schedule.

### 6. itineraries
Stores itinerary status and generated travel reference.

## API endpoints

### Flights
- `GET /backend/index.php?route=flights/search&origin=Montreal&destination=Paris&date=2026-05-18`
- `GET /backend/index.php?route=flights/:id`

### Reservations
- `POST /backend/index.php?route=reservations`
- `GET /backend/index.php?route=reservations`
- `GET /backend/index.php?route=reservations/:id`

### Itineraries
- `GET /backend/index.php?route=itineraries/reservation/:reservationId`

## Business rules implemented

- you cannot book if no seats remain
- booking reduces available seats
- itinerary is generated automatically after reservation creation
- reservation uses a status workflow
- schedule links a concrete departure to a reusable flight definition

## How to run

## 1. Database

Create a MySQL database, for example:

```sql
CREATE DATABASE airline_platform;
```

Then import:

```bash
mysql -u root -p airline_platform < database/schema.sql
mysql -u root -p airline_platform < database/seed.sql
```

## 2. Backend

Place the `backend/` folder inside your PHP server root.

Example with PHP built-in server:

```bash
cd backend
php -S localhost:8000
```

Then access:

```text
http://localhost:8000/index.php?route=health
```

## 3. Frontend

```bash
cd frontend
npm install
npm start
```

The React app runs on `http://localhost:3000`.

## 4. Configure API URL

In `frontend/src/services/api.js`, update:

```js
const API_BASE_URL = "http://localhost:8000/index.php?route=";
```

## Learning roadmap

### Step 1. SQL
Learn:
- tables
- primary keys
- foreign keys
- joins
- one-to-many relationships

### Step 2. PHP backend
Learn:
- routing
- controllers
- models
- PDO
- JSON responses
- transaction handling

### Step 3. React frontend
Learn:
- components
- props
- state
- hooks
- forms
- API calls with `fetch`

### Step 4. Full-stack integration
Learn:
- request/response cycle
- CORS
- validation
- frontend/backend contracts

## Suggested improvements

- authentication with JWT
- admin dashboard
- seat maps
- payment integration
- email confirmation
- cancellation and refund flow
- role-based access control

## Educational notes

This project is intentionally structured like a junior full-stack portfolio project:

- readable enough to learn from
- modular enough to extend
- realistic enough to discuss in interviews

## Interview-ready explanation

> I built a full-stack airline travel management platform using React, PHP and MySQL.  
> I designed a relational schema for flights, schedules, passengers, reservations and itineraries, created REST-style endpoints for flight search and booking, and built a responsive React interface for the full booking flow.  
> I also implemented business rules such as seat validation, automatic itinerary generation and reservation status handling.

