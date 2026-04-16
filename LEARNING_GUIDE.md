# Learning Guide

This file explains the project as if you are learning it step by step.

## 1. Full-stack thinking

A full-stack app has 3 main layers:

- **Frontend:** what the user sees
- **Backend:** the server logic
- **Database:** the stored data

In this project:

- React = frontend
- PHP = backend
- MySQL = database

## 2. Data flow

A typical booking flow is:

1. user searches for flights in React
2. React sends an HTTP request to PHP
3. PHP queries MySQL
4. MySQL returns matching rows
5. PHP sends JSON back
6. React displays the results

## 3. Why relational SQL is a good fit here

Airline systems have connected entities:

- one flight can have many schedules
- one passenger can have many reservations
- one reservation has one itinerary

That is why **foreign keys** matter.

## 4. Important SQL notions used

### Primary key
A unique identifier for each row.

Example:
```sql
id INT AUTO_INCREMENT PRIMARY KEY
```

### Foreign key
A reference to another table.

Example:
```sql
flight_id INT NOT NULL,
FOREIGN KEY (flight_id) REFERENCES flights(id)
```

### One-to-many example
One `flight` can have many `schedules`.

## 5. Why we separated flights and schedules

A route like `Montreal -> Paris` is the flight definition.

But it can happen on many dates and times.

So:

- `flights` = reusable route info
- `schedules` = actual occurrence in time

This is good backend design.

## 6. PHP backend architecture

We separated concerns:

- **models** talk to the database
- **controllers** handle request logic
- **index.php** routes the request

This is important because it keeps code maintainable.

## 7. Business logic example

When a reservation is created:

- validate input
- make sure the schedule exists
- check remaining seats
- create or reuse passenger
- decrement available seats
- create reservation
- create itinerary

This is wrapped in a **transaction**, so if something fails, the database is rolled back.

## 8. React notions used

### useState
Stores changing data in a component.

### useEffect
Runs logic on component load.

### props
Lets one component pass data or functions to another.

### controlled inputs
The form values are stored in state.

## 9. REST thinking

REST-style APIs expose resources:

- `/flights/search`
- `/reservations`
- `/itineraries/reservation/:id`

Frontend calls these endpoints.

## 10. How to explain this project in an interview

You can say:

> I designed a full-stack airline booking platform with a React frontend, PHP backend and MySQL database. I modeled normalized relational tables for flights, schedules, passengers, reservations and itineraries. I built REST-style endpoints for flight search and booking, implemented booking validation and seat management, and connected the frontend to the backend through JSON APIs.

## 11. Next coding exercises for you

After you understand this version, add:

1. user login/register
2. cancel reservation
3. admin add flight
4. delay/cancel schedule update
5. pagination and sorting
6. better form validation
7. JWT authentication
8. Docker support

## 12. Best learning method

Work in this order:

1. read the database schema
2. test API endpoints in Postman
3. read `backend/index.php`
4. read controllers
5. read models
6. run frontend
7. trace one request from button click to database

That is how you become comfortable with full-stack systems.
