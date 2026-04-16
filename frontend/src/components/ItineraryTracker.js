import React from "react";

function ItineraryTracker({ itinerary }) {
  return (
    <section className="card">
      <h2>Itinerary tracker</h2>
      {!itinerary ? (
        <p>Select a reservation to view itinerary details.</p>
      ) : (
        <div className="itinerary-box">
          <p><strong>Itinerary:</strong> {itinerary.itinerary_code}</p>
          <p><strong>Booking reference:</strong> {itinerary.booking_reference}</p>
          <p><strong>Passenger:</strong> {itinerary.first_name} {itinerary.last_name}</p>
          <p><strong>Route:</strong> {itinerary.origin} → {itinerary.destination}</p>
          <p><strong>Flight:</strong> {itinerary.flight_number}</p>
          <p><strong>Status:</strong> {itinerary.journey_status}</p>
          <p><strong>Departure:</strong> {new Date(itinerary.departure_time).toLocaleString()}</p>
          <p><strong>Arrival:</strong> {new Date(itinerary.arrival_time).toLocaleString()}</p>
          <p><strong>Terminal:</strong> {itinerary.terminal}</p>
          <p><strong>Gate:</strong> {itinerary.gate}</p>
          <p><strong>Notes:</strong> {itinerary.notes}</p>
        </div>
      )}
    </section>
  );
}

export default ItineraryTracker;
