import React from "react";

function FlightResults({ flights, onSelectFlight }) {
  return (
    <section className="card">
      <h2>Available flights</h2>
      {flights.length === 0 ? (
        <p>No flights found. Try another route or date.</p>
      ) : (
        <div className="list">
          {flights.map((flight) => (
            <div className="flight-row" key={flight.schedule_id}>
              <div>
                <strong>{flight.airline_name}</strong>
                <p>{flight.flight_number}</p>
                <p>
                  {flight.origin} → {flight.destination}
                </p>
              </div>
              <div>
                <p>Departure: {new Date(flight.departure_time).toLocaleString()}</p>
                <p>Arrival: {new Date(flight.arrival_time).toLocaleString()}</p>
                <p>Seats: {flight.available_seats}</p>
              </div>
              <div>
                <p>${Number(flight.base_price).toFixed(2)}</p>
                <button onClick={() => onSelectFlight(flight)}>Book</button>
              </div>
            </div>
          ))}
        </div>
      )}
    </section>
  );
}

export default FlightResults;
