import React, { useEffect, useState } from "react";
import FlightSearchForm from "./components/FlightSearchForm";
import FlightResults from "./components/FlightResults";
import BookingForm from "./components/BookingForm";
import ReservationList from "./components/ReservationList";
import ItineraryTracker from "./components/ItineraryTracker";
import {
  createReservation,
  getFlightCities,
  getItineraryByReservation,
  getReservations,
  searchFlights
} from "./services/api";

function App() {
  const [flights, setFlights] = useState([]);
  const [reservations, setReservations] = useState([]);
  const [selectedFlight, setSelectedFlight] = useState(null);
  const [selectedItinerary, setSelectedItinerary] = useState(null);
  const [cities, setCities] = useState([]);
  const [loading, setLoading] = useState(false);
  const [bookingLoading, setBookingLoading] = useState(false);
  const [error, setError] = useState("");
  const [successMessage, setSuccessMessage] = useState("");

  async function loadReservations() {
    try {
      const response = await getReservations();
      setReservations(response.data);
    } catch (err) {
      setError(err.message);
    }
  }

  useEffect(() => {
    loadReservations();
  }, []);

  useEffect(() => {
    async function loadCities() {
      try {
        const response = await getFlightCities();
        setCities(response.data);
      } catch (err) {
        setError(err.message);
      }
    }

    loadCities();
  }, []);

  async function handleSearch(criteria) {
    try {
      setLoading(true);
      setError("");
      setSuccessMessage("");
      const response = await searchFlights(criteria);
      setFlights(response.data);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  }

  async function handleBook(payload) {
    try {
      setBookingLoading(true);
      setError("");
      setSuccessMessage("");
      const response = await createReservation(payload);
      setSuccessMessage(`Reservation created: ${response.data.booking_reference}`);
      await loadReservations();
      const itinerary = await getItineraryByReservation(response.data.id);
      setSelectedItinerary(itinerary.data);
      setSelectedFlight(null);
    } catch (err) {
      setError(err.message);
    } finally {
      setBookingLoading(false);
    }
  }

  async function handleTrackReservation(reservationId) {
    try {
      setError("");
      const response = await getItineraryByReservation(reservationId);
      setSelectedItinerary(response.data);
    } catch (err) {
      setError(err.message);
    }
  }

  return (
    <main className="app-shell">
      <header className="hero">
        <h1>Airline Travel Management Platform</h1>
        <p>Search, book and track itineraries in one full-stack application.</p>
      </header>

      {error && <div className="alert error">{error}</div>}
      {successMessage && <div className="alert success">{successMessage}</div>}

      <div className="layout">
        <div className="left-column">
          <FlightSearchForm onSearch={handleSearch} loading={loading} cities={cities} />
          <FlightResults flights={flights} onSelectFlight={setSelectedFlight} />
          <BookingForm selectedFlight={selectedFlight} onBook={handleBook} bookingLoading={bookingLoading} />
        </div>

        <div className="right-column">
          <ReservationList reservations={reservations} onSelectReservation={handleTrackReservation} />
          <ItineraryTracker itinerary={selectedItinerary} />
        </div>
      </div>
    </main>
  );
}

export default App;