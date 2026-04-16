<?php

class ItineraryController
{
    public function __construct(private Itinerary $itineraryModel)
    {
    }

    public function showByReservation(int $reservationId): void
    {
        $itinerary = $this->itineraryModel->findByReservationId($reservationId);

        if (!$itinerary) {
            Response::json([
                "success" => false,
                "message" => "Itinerary not found for this reservation"
            ], 404);
        }

        Response::json([
            "success" => true,
            "data" => $itinerary
        ]);
    }
}
