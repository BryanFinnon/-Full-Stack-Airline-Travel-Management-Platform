<?php

class FlightController
{
    public function __construct(private Flight $flightModel)
    {
    }

    public function search(): void
    {
        $origin = $_GET["origin"] ?? "";
        $destination = $_GET["destination"] ?? "";
        $date = $_GET["date"] ?? null;

        if (!$origin || !$destination) {
            Response::json([
                "success" => false,
                "message" => "origin and destination are required"
            ], 422);
        }

        $results = $this->flightModel->search($origin, $destination, $date);

        Response::json([
            "success" => true,
            "count" => count($results),
            "data" => $results
        ]);
    }

    public function cityOptions(): void
    {
        $cities = $this->flightModel->getCityOptions();

        Response::json([
            "success" => true,
            "count" => count($cities),
            "data" => $cities
        ]);
    }
}