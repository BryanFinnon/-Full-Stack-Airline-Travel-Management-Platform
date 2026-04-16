<?php

class Reservation
{
    public function __construct(private PDO $db)
    {
    }

    public function create(array $data): int
    {
        $sql = "
            INSERT INTO reservations (passenger_id, schedule_id, booking_reference, reservation_status, total_price, seat_number)
            VALUES (:passenger_id, :schedule_id, :booking_reference, :reservation_status, :total_price, :seat_number)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":passenger_id" => $data["passenger_id"],
            ":schedule_id" => $data["schedule_id"],
            ":booking_reference" => $data["booking_reference"],
            ":reservation_status" => $data["reservation_status"],
            ":total_price" => $data["total_price"],
            ":seat_number" => $data["seat_number"] ?? null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function findAll(): array
    {
        $sql = "
            SELECT
                r.id,
                r.booking_reference,
                r.reservation_status,
                r.total_price,
                r.seat_number,
                r.booking_date,
                p.first_name,
                p.last_name,
                p.passport_number,
                f.flight_number,
                f.origin,
                f.destination,
                s.departure_time,
                s.arrival_time
            FROM reservations r
            INNER JOIN passengers p ON r.passenger_id = p.id
            INNER JOIN schedules s ON r.schedule_id = s.id
            INNER JOIN flights f ON s.flight_id = f.id
            ORDER BY r.booking_date DESC
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function findById(int $reservationId): ?array
    {
        $sql = "
            SELECT
                r.*,
                p.first_name,
                p.last_name,
                p.email AS passenger_email,
                p.passport_number,
                f.flight_number,
                f.airline_name,
                f.origin,
                f.destination,
                s.departure_time,
                s.arrival_time,
                s.gate,
                s.terminal
            FROM reservations r
            INNER JOIN passengers p ON r.passenger_id = p.id
            INNER JOIN schedules s ON r.schedule_id = s.id
            INNER JOIN flights f ON s.flight_id = f.id
            WHERE r.id = :reservation_id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":reservation_id" => $reservationId]);
        $reservation = $stmt->fetch();

        return $reservation ?: null;
    }
}
