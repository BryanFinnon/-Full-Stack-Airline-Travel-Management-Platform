<?php

class ReservationController
{
    public function __construct(
        private PDO $db,
        private Passenger $passengerModel,
        private Flight $flightModel,
        private Reservation $reservationModel,
        private Itinerary $itineraryModel
    ) {
    }

    public function index(): void
    {
        $reservations = $this->reservationModel->findAll();

        Response::json([
            "success" => true,
            "data" => $reservations
        ]);
    }

    public function show(int $reservationId): void
    {
        $reservation = $this->reservationModel->findById($reservationId);

        if (!$reservation) {
            Response::json([
                "success" => false,
                "message" => "Reservation not found"
            ], 404);
        }

        Response::json([
            "success" => true,
            "data" => $reservation
        ]);
    }

    public function store(): void
    {
        $payload = json_decode(file_get_contents("php://input"), true);

        if (!$payload) {
            Response::json([
                "success" => false,
                "message" => "Invalid JSON payload"
            ], 400);
        }

        $requiredFields = ["schedule_id", "first_name", "last_name", "email", "passport_number"];
        foreach ($requiredFields as $field) {
            if (empty($payload[$field])) {
                Response::json([
                    "success" => false,
                    "message" => "Missing required field: {$field}"
                ], 422);
            }
        }

        $schedule = $this->flightModel->findScheduleById((int) $payload["schedule_id"]);

        if (!$schedule) {
            Response::json([
                "success" => false,
                "message" => "Schedule not found"
            ], 404);
        }

        if ((int) $schedule["available_seats"] <= 0) {
            Response::json([
                "success" => false,
                "message" => "No seats available"
            ], 409);
        }

        try {
            $this->db->beginTransaction();

            $existingPassenger = $this->passengerModel->findExistingByPassport($payload["passport_number"]);
            $passengerId = $existingPassenger
                ? (int) $existingPassenger["id"]
                : $this->passengerModel->create($payload);

            $this->flightModel->decrementAvailableSeats((int) $payload["schedule_id"]);

            $reservationId = $this->reservationModel->create([
                "passenger_id" => $passengerId,
                "schedule_id" => (int) $payload["schedule_id"],
                "booking_reference" => $this->generateBookingReference(),
                "reservation_status" => "confirmed",
                "total_price" => (float) $schedule["base_price"],
                "seat_number" => $payload["seat_number"] ?? null,
            ]);

            $this->itineraryModel->create([
                "reservation_id" => $reservationId,
                "itinerary_code" => $this->generateItineraryCode(),
                "journey_status" => "upcoming",
                "notes" => "Please arrive 3 hours before departure for international travel."
            ]);

            $this->db->commit();

            $reservation = $this->reservationModel->findById($reservationId);

            Response::json([
                "success" => true,
                "message" => "Reservation created successfully",
                "data" => $reservation
            ], 201);
        } catch (Throwable $exception) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            Response::json([
                "success" => false,
                "message" => $exception->getMessage()
            ], 500);
        }
    }

    private function generateBookingReference(): string
    {
        return "BK-" . date("Y") . "-" . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
    }

    private function generateItineraryCode(): string
    {
        return "ITI-" . date("Y") . "-" . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
    }
}
