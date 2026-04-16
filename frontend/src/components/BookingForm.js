import React, { useState } from "react";
import { COUNTRY_OPTIONS } from "../data/countries";

function BookingForm({ selectedFlight, onBook, bookingLoading }) {
  const [form, setForm] = useState({
    first_name: "",
    last_name: "",
    email: "",
    phone_country_code: "+1",
    phone_number: "",
    passport_number: "",
    nationality: "",
    seat_number: ""
  });

  if (!selectedFlight) {
    return (
      <section className="card">
        <h2>Booking form</h2>
        <p>Select a flight to continue.</p>
      </section>
    );
  }

  const handleChange = (event) => {
    setForm((prev) => ({
      ...prev,
      [event.target.name]: event.target.value
    }));
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    onBook({
      schedule_id: selectedFlight.schedule_id,
      first_name: form.first_name,
      last_name: form.last_name,
      email: form.email,
      phone: form.phone_number ? `${form.phone_country_code} ${form.phone_number}` : "",
      passport_number: form.passport_number,
      nationality: form.nationality,
      seat_number: form.seat_number
    });
  };

  return (
    <section className="card">
      <h2>Book selected flight</h2>
      <p>
        <strong>{selectedFlight.flight_number}</strong> | {selectedFlight.origin} to {selectedFlight.destination}
      </p>
      <form className="grid-form" onSubmit={handleSubmit}>
        <input name="first_name" placeholder="First name" value={form.first_name} onChange={handleChange} required />
        <input name="last_name" placeholder="Last name" value={form.last_name} onChange={handleChange} required />
        <input name="email" type="email" placeholder="Email" value={form.email} onChange={handleChange} required />
        <select
          name="phone_country_code"
          value={form.phone_country_code}
          onChange={handleChange}
          aria-label="Phone country code"
        >
          {COUNTRY_OPTIONS.map((country) => (
            <option key={`${country.name}-${country.dialCode}`} value={country.dialCode}>
              {country.name} ({country.dialCode})
            </option>
          ))}
        </select>
        <input
          name="phone_number"
          placeholder="Phone number"
          value={form.phone_number}
          onChange={handleChange}
          inputMode="tel"
        />
        <input name="passport_number" placeholder="Passport number" value={form.passport_number} onChange={handleChange} required />
        <select name="nationality" value={form.nationality} onChange={handleChange}>
          <option value="">Select nationality</option>
          {COUNTRY_OPTIONS.map((country) => (
            <option key={country.name} value={country.name}>
              {country.name}
            </option>
          ))}
        </select>
        <input name="seat_number" placeholder="Preferred seat (optional)" value={form.seat_number} onChange={handleChange} />
        <button type="submit" disabled={bookingLoading}>
          {bookingLoading ? "Booking..." : "Confirm booking"}
        </button>
      </form>
    </section>
  );
}

export default BookingForm;