INSERT INTO users (full_name, email, password_hash) VALUES
('Alice Martin', 'alice@example.com', '$2y$10$demo.hash'),
('Brian Lopez', 'brian@example.com', '$2y$10$demo.hash');

INSERT INTO passengers (user_id, first_name, last_name, email, phone, passport_number, nationality) VALUES
(1, 'Alice', 'Martin', 'alice@example.com', '+1-514-222-3333', 'P1234567', 'Canadian'),
(2, 'Brian', 'Lopez', 'brian@example.com', '+1-438-555-1111', 'P7654321', 'French');

INSERT INTO flights (flight_number, airline_name, origin, destination, duration_minutes, base_price, capacity) VALUES
('AT101', 'Sky Atlantic', 'Montreal', 'Paris', 420, 699.99, 220),
('AT205', 'Sky Atlantic', 'Montreal', 'London', 390, 549.99, 180),
('AT330', 'Sky Atlantic', 'Toronto', 'Paris', 435, 679.99, 200),
('AT415', 'Sky Atlantic', 'New York', 'Montreal', 90, 199.99, 140);

INSERT INTO schedules (flight_id, departure_time, arrival_time, status, available_seats, gate, terminal) VALUES
(1, '2026-05-18 19:30:00', '2026-05-19 08:30:00', 'scheduled', 120, 'A4', '1'),
(1, '2026-05-19 19:30:00', '2026-05-20 08:30:00', 'scheduled', 118, 'A5', '1'),
(2, '2026-05-18 18:00:00', '2026-05-19 05:30:00', 'scheduled', 90, 'B2', '2'),
(3, '2026-05-20 20:15:00', '2026-05-21 09:30:00', 'scheduled', 150, 'C1', '1'),
(4, '2026-05-18 09:15:00', '2026-05-18 10:45:00', 'scheduled', 60, 'D7', '3');

INSERT INTO reservations (passenger_id, schedule_id, booking_reference, reservation_status, total_price, seat_number) VALUES
(1, 1, 'BK-2026-0001', 'confirmed', 699.99, '12A'),
(2, 3, 'BK-2026-0002', 'confirmed', 549.99, '18C');

INSERT INTO itineraries (reservation_id, itinerary_code, journey_status, notes) VALUES
(1, 'ITI-2026-0001', 'upcoming', 'Arrive at least 3 hours before departure.'),
(2, 'ITI-2026-0002', 'upcoming', 'International baggage rules apply.');
