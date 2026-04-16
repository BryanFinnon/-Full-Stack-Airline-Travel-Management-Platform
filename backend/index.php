<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/utils/Response.php";
require_once __DIR__ . "/models/Flight.php";
require_once __DIR__ . "/models/Passenger.php";
require_once __DIR__ . "/models/Reservation.php";
require_once __DIR__ . "/models/Itinerary.php";
require_once __DIR__ . "/controllers/FlightController.php";
require_once __DIR__ . "/controllers/ReservationController.php";
require_once __DIR__ . "/controllers/ItineraryController.php";

$route = $_GET["route"] ?? "health";

$db = (new Database())->connect();

$flightModel = new Flight($db);
$passengerModel = new Passenger($db);
$reservationModel = new Reservation($db);
$itineraryModel = new Itinerary($db);

$flightController = new FlightController($flightModel);
$reservationController = new ReservationController($db, $passengerModel, $flightModel, $reservationModel, $itineraryModel);
$itineraryController = new ItineraryController($itineraryModel);

switch (true) {
    case $route === "health":
        Response::json([
            "success" => true,
            "message" => "API is running"
        ]);
        break;

    case $route === "flights/search" && $_SERVER["REQUEST_METHOD"] === "GET":
        $flightController->search();
        break;

    case $route === "flights/cities" && $_SERVER["REQUEST_METHOD"] === "GET":
        $flightController->cityOptions();
        break;

    case $route === "reservations" && $_SERVER["REQUEST_METHOD"] === "GET":
        $reservationController->index();
        break;

    case $route === "reservations" && $_SERVER["REQUEST_METHOD"] === "POST":
        $reservationController->store();
        break;

    case preg_match("#^reservations/(\d+)$#", $route, $matches) && $_SERVER["REQUEST_METHOD"] === "GET":
        $reservationController->show((int) $matches[1]);
        break;

    case preg_match("#^itineraries/reservation/(\d+)$#", $route, $matches) && $_SERVER["REQUEST_METHOD"] === "GET":
        $itineraryController->showByReservation((int) $matches[1]);
        break;

    default:
        Response::json([
            "success" => false,
            "message" => "Route not found"
        ], 404);
}