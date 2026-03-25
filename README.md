# 🎫 Airline Travel Management Platform

> Full-stack airline booking system for flight search, reservation management, and itinerary tracking.

---

## 📖 Overview

This project implements a **complete airline travel management platform** that allows users to search for flights, manage reservations, and track itineraries.

It combines a structured backend, relational database design, and a responsive frontend to simulate real-world booking systems.

---

## 🚀 Key Features

- ✈️ Flight search and filtering  
- 🎫 Reservation and booking management  
- 🧾 Itinerary tracking  
- 🔄 REST API integration  
- 📱 Responsive user interface  

---

## 📈 Key Stats

- **Architecture:** Full-stack (Frontend + Backend + Database)
- **Database:** 5+ relational tables
- **Frontend Components:** 4+ UI modules
- **Core Features:** Search, booking, tracking
- **API Type:** RESTful architecture

---

## 🧠 System Design

### 1. Backend
- Handles business logic and API endpoints  
- Manages booking workflows and data processing  

### 2. Database Design
Relational schema including:
- flights  
- passengers  
- reservations  
- itineraries  
- schedules  

### 3. Frontend
- Built with React  
- Responsive UI for booking and search  
- Dynamic interaction with backend APIs  

---

## ⚙️ Tech Stack

- **React**
- **PHP**
- **SQL**
- **REST APIs**

---

## ⚙️ Workflow

1. User searches for available flights  
2. Backend queries database  
3. Results displayed via frontend  
4. User books a flight  
5. Reservation stored and tracked  
6. Itinerary updated dynamically  

---

## 📊 Example Use Case

**User Action:**
- Search: Montreal → Paris  
- Select flight  
- Confirm booking  

**System Output:**
- Reservation created  
- Itinerary generated  
- Booking stored in database  

---

## 📂 Project Structure

```bash
.
├── frontend/
│   ├── src/
│   ├── components/
│   └── App.js
│
├── backend/
│   ├── api/
│   ├── controllers/
│   ├── models/
│   └── routes/
│
├── database/
│   ├── schema.sql
│   └── seed.sql
│
├── README.md
