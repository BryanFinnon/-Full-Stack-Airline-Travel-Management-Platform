<?php

class Flight
{
    public function __construct(private PDO $db)
    {
    }

    public function search(string $origin, string $destination, ?string $date = null): array
    {
        $sql = "
            SELECT
                f.id AS flight_id,
                f.flight_number,
                f.airline_name,
                f.origin,
                f.destination,
                f.duration_minutes,
                f.base_price,
                f.capacity,
                s.id AS schedule_id,
                s.departure_time,
                s.arrival_time,
                s.status,
                s.available_seats,
                s.gate,
                s.terminal
            FROM flights f
            INNER JOIN schedules s ON f.id = s.flight_id
            WHERE f.origin LIKE :origin
              AND f.destination LIKE :destination
              AND s.status != 'cancelled'
        ";

        if ($date) {
            $sql .= " AND DATE(s.departure_time) = :travel_date ";
        }

        $sql .= " ORDER BY s.departure_time ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":origin", $origin);
        $stmt->bindValue(":destination", $destination);

        if ($date) {
            $stmt->bindValue(":travel_date", $date);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCityOptions(): array
    {
        $stmt = $this->db->query("
            SELECT origin AS city FROM flights
            UNION
            SELECT destination AS city FROM flights
            ORDER BY city ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM flights WHERE id = :id");
        $stmt->execute([":id" => $id]);
        $flight = $stmt->fetch();

        return $flight ?: null;
    }

    public function findScheduleById(int $scheduleId): ?array
    {
        $sql = "
            SELECT s.*, f.flight_number, f.airline_name, f.origin, f.destination, f.base_price
            FROM schedules s
            INNER JOIN flights f ON s.flight_id = f.id
            WHERE s.id = :schedule_id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":schedule_id" => $scheduleId]);

        $schedule = $stmt->fetch();
        return $schedule ?: null;
    }

    public function decrementAvailableSeats(int $scheduleId): void
    {
        $stmt = $this->db->prepare("
            UPDATE schedules
            SET available_seats = available_seats - 1
            WHERE id = :schedule_id AND available_seats > 0
        ");
        $stmt->execute([":schedule_id" => $scheduleId]);

        if ($stmt->rowCount() === 0) {
            throw new RuntimeException("No seats available for this schedule.");
        }
    }
}