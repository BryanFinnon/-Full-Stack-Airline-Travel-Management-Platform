# Airline Travel Management Platform

A full-stack portfolio project implementing flight search, reservations and itinerary management with a React client, PHP REST API and MySQL database.

## Features

- Search flights by origin, destination and date
- Browse available departure and arrival cities
- Create and retrieve reservations
- Generate itinerary records for bookings
- Seed a relational database with demonstration data
- Configure API and database connections through environment variables

## Architecture

```text
React frontend  →  PHP REST API  →  MySQL database
frontend/          backend/         database/
```

## Technology

React 18 · JavaScript · PHP 8 · PDO · MySQL · REST APIs

## Local setup

### 1. Database

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p airline_platform < database/seed.sql
```

Set the backend configuration:

```bash
export DB_HOST=127.0.0.1
export DB_NAME=airline_platform
export DB_USER=root
export DB_PASSWORD=your_password
```

### 2. API

From the repository root:

```bash
php -S localhost:8000 -t backend
```

### 3. Frontend

```bash
cd frontend
npm install
npm start
```

The client uses `http://localhost:8000/index.php?route=` by default. Override it with `REACT_APP_API_BASE_URL` when required.

## Scope

This repository demonstrates application architecture and core travel-management workflows. Authentication, payments, automated end-to-end tests and production deployment are outside the current scope.
