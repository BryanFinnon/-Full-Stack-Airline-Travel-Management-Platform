<?php

class Itinerary
{
    public function __construct(private PDO $db)
    {
    }

    public function create(array $data): int
    {
        $sql = "
            INSERT INTO itineraries (reservation_id, itinerary_code, journey_status, notes)
            VALUES (:reservation_id, :itinerary_code, :journey_status, :notes)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":reservation_id" => $data["reservation_id"],
            ":itinerary_code" => $data["itinerary_code"],
            ":journey_status" => $data["journey_status"],
            ":notes" => $data["notes"] ?? null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function findByReservationId(int $reservationId): ?array
    {
        $sql = "
            SELECT
                i.*,
                r.booking_reference,
                r.reservation_status,
                r.total_price,
                p.first_name,
                p.last_name,
                f.flight_number,
                f.origin,
                f.destination,
                s.departure_time,
                s.arrival_time,
                s.gate,
                s.terminal
            FROM itineraries i
            INNER JOIN reservations r ON i.reservation_id = r.id
            INNER JOIN passengers p ON r.passenger_id = p.id
            INNER JOIN schedules s ON r.schedule_id = s.id
            INNER JOIN flights f ON s.flight_id = f.id
            WHERE i.reservation_id = :reservation_id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":reservation_id" => $reservationId]);
        $itinerary = $stmt->fetch();

        return $itinerary ?: null;
    }
}
