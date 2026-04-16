import React, { useEffect, useState } from "react";

function FlightSearchForm({ onSearch, loading, cities }) {
  const [form, setForm] = useState({
    origin: "Montreal",
    destination: "Paris",
    date: "2026-05-18"
  });

  useEffect(() => {
    if (cities.length === 0) {
      return;
    }

    setForm((prev) => ({
      ...prev,
      origin: cities.includes(prev.origin) ? prev.origin : cities[0],
      destination: cities.includes(prev.destination) ? prev.destination : cities[0]
    }));
  }, [cities]);

  const handleChange = (event) => {
    setForm((prev) => ({
      ...prev,
      [event.target.name]: event.target.value
    }));
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    onSearch(form);
  };

  return (
    <section className="card">
      <h2>Search flights</h2>
      <form className="grid-form" onSubmit={handleSubmit}>
        <select
          name="origin"
          value={form.origin}
          onChange={handleChange}
          disabled={cities.length === 0}
          required
        >
          {cities.length === 0 && <option value="">Loading cities...</option>}
          {cities.map((city) => (
            <option key={`origin-${city}`} value={city}>
              {city}
            </option>
          ))}
        </select>
        <select
          name="destination"
          value={form.destination}
          onChange={handleChange}
          disabled={cities.length === 0}
          required
        >
          {cities.length === 0 && <option value="">Loading cities...</option>}
          {cities.map((city) => (
            <option key={`destination-${city}`} value={city}>
              {city}
            </option>
          ))}
        </select>
        <input
          name="date"
          type="date"
          value={form.date}
          onChange={handleChange}
        />
        <button type="submit" disabled={loading || cities.length === 0}>
          {loading ? "Searching..." : "Search"}
        </button>
      </form>
    </section>
  );
}

export default FlightSearchForm;