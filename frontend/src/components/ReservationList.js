import React from "react";

function ReservationList({ reservations, onSelectReservation }) {
  return (
    <section className="card">
      <h2>Reservations</h2>
      {reservations.length === 0 ? (
        <p>No reservations yet.</p>
      ) : (
        <div className="list">
          {reservations.map((reservation) => (
            <div className="reservation-row" key={reservation.id}>
              <div>
                <strong>{reservation.booking_reference}</strong>
                <p>
                  {reservation.first_name} {reservation.last_name}
                </p>
                <p>
                  {reservation.origin} → {reservation.destination}
                </p>
              </div>
              <div>
                <p>{reservation.flight_number}</p>
                <p>{new Date(reservation.departure_time).toLocaleString()}</p>
              </div>
              <div>
                <button onClick={() => onSelectReservation(reservation.id)}>
                  Track itinerary
                </button>
              </div>
            </div>
          ))}
        </div>
      )}
    </section>
  );
}

export default ReservationList;
