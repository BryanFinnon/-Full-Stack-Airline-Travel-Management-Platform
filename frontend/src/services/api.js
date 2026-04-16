const API_BASE_URL = "http://localhost:8000/index.php?route=";

async function request(route, options = {}) {
  const response = await fetch(`${API_BASE_URL}${route}`, {
    headers: {
      "Content-Type": "application/json",
      ...(options.headers || {})
    },
    ...options
  });

  const data = await response.json();

  if (!response.ok) {
    throw new Error(data.message || "Request failed");
  }

  return data;
}

export async function searchFlights({ origin, destination, date }) {
  const params = new URLSearchParams({
    origin,
    destination,
    ...(date ? { date } : {})
  });

  return request(`flights/search&${params.toString()}`);
}

export async function getFlightCities() {
  return request("flights/cities");
}

export async function createReservation(payload) {
  return request("reservations", {
    method: "POST",
    body: JSON.stringify(payload)
  });
}

export async function getReservations() {
  return request("reservations");
}

export async function getItineraryByReservation(reservationId) {
  return request(`itineraries/reservation/${reservationId}`);
}