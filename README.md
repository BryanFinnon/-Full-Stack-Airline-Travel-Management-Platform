# Full-Stack Airline Travel Management Platform

A portfolio project demonstrating an end-to-end airline booking workflow with a React frontend, PHP REST API, and MySQL database.

## Features

- Search flights by origin, destination, and date
- Create and list reservations
- Retrieve itinerary details
- Seeded relational database for local demonstration
- Responsive React interface
- Environment-based frontend and database configuration

## Architecture

```text
React client  →  PHP REST API  →  MySQL
 frontend/         backend/       database/
```

## Repository structure

- `frontend/` — React application and API client
- `backend/` — PHP controllers, models, and response utilities
- `database/` — schema and seed data
- `LEARNING_GUIDE.md` — implementation notes and learning guide

## Local setup

### Database

Create a MySQL database and import the schema and seed data:

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p airline_platform < database/seed.sql
```

Configure the backend with environment variables:

```bash
export DB_HOST=127.0.0.1
export DB_NAME=airline_platform
export DB_USER=root
export DB_PASSWORD=your_password
```

Start the PHP API from the repository root:

```bash
php -S localhost:8000 -t backend
```

### Frontend

```bash
cd frontend
cp ../.env.example .env
npm ci
npm start
```

By default the client calls `http://localhost:8000/index.php?route=`. Override it with `REACT_APP_API_BASE_URL`.

## Engineering notes

Generated dependencies and production builds are intentionally excluded from Git. Use `npm ci` to reproduce the frontend from `package-lock.json`.

## Limitations

This is a local portfolio prototype. Authentication, payment processing, production deployment, rate limiting, and automated end-to-end tests are not included.

## Author

Bryan Finnon — MSc Computer Science (Distinction), focused on applied AI and software engineering.
