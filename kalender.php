<style>
.calendar-container {
  padding: 0.5rem;
  max-width: 100%;
  margin: 1rem auto;
  border-radius: 10px;
  background-color: #fff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #3f5f3e;
  color: white;
  padding: 0.8rem 1rem;
  font-size: 1rem;
  border-radius: 10px 10px 0 0;
}

.calendar-header button {
  background: none;
  border: none;
  color: white;
  font-size: 1.2rem;
  cursor: pointer;
  transition: transform 0.2s ease;
  padding: 0 0.5rem;
}

.calendar-header button:hover {
  transform: scale(1.2);
}

.calendar-weekdays,
.calendar-days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  text-align: center;
}

.calendar-weekdays div {
  padding: 0.5rem;
  background-color: #f1f3f5;
  font-weight: 500;
  font-size: 0.8rem;
  border-bottom: 1px solid #dee2e6;
}

.calendar-days div {
  padding: 0.5rem 0;
  border: 1px solid #f1f1f1;
  min-height: 2.5rem;
  font-size: 0.9rem;
  transition: background-color 0.2s;
  position: relative;
}

.calendar-days div:hover {
  background-color: #e8f0fe;
  cursor: pointer;
}

.today {
  background-color: #4c866d !important;
  color: #fff !important;
  font-weight: bold;
  border-radius: 20%;
  width: 1.8rem;
  height: 1.8rem;
  line-height: 1.8rem;
  margin: auto;
}

.bg-danger {
  background-color: #dc3545 !important;
  color: white !important;
  border-radius: 50%;
}

.bg-warning {
  background-color: #ffc107 !important;
  color: #212529 !important;
  border-radius: 25%;
  width: 1.8rem;
  height: 1.8rem;
  margin: auto;
}

.legend {
  text-align: center;
  margin-top: 0.8rem;
  font-size: 0.8rem;
}

</style>

      <!-- Kalender -->
      <div class="col-lg-5 col-md-6 mb-4">
        <div class="calendar-container">
          <h2 class="text-center mb-2">Selamat Datang di Soulpict.u</h2>
          <h4 class="playfair text-center mb-3">Capture How Amazing You Are✨</h4>
          <div class="calendar-header">
            <button id="prev-month">‹</button>
            <div id="month-year"></div>
            <button id="next-month">›</button>
          </div>
          <div class="calendar-weekdays">
            <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
          </div>
          <div class="calendar-days" id="calendar-days"></div>
        </div>
      </div>

    
<script>
const daysContainer = document.getElementById("calendar-days");
const monthYear = document.getElementById("month-year");
const prevBtn = document.getElementById("prev-month");
const nextBtn = document.getElementById("next-month");

let currentDate = new Date();
let bookings = {};

function fetchBookings(callback) {
  fetch('get_bookings.php') // pastikan path ini benar
    .then(res => res.json())
    .then(data => {
      console.log(data);
      bookings = data; // bookings akan berisi { "2025-07-10": 2, "2025-07-15": 5, ... }
      callback(currentDate);
    });
}



function renderCalendar(date) {
  const year = date.getFullYear();
  const month = date.getMonth();
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const startDay = firstDay.getDay();
  const totalDays = lastDay.getDate();
  const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

  monthYear.textContent = `${monthNames[month]} ${year}`;
  daysContainer.innerHTML = "";

  const today = new Date();
  const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;

  for (let i = 0; i < startDay; i++) {
    daysContainer.innerHTML += `<div></div>`;
  }

  for (let i = 1; i <= totalDays; i++) {
    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
    const total = bookings[dateStr] || 0;

    let bgClass = "";
    if (total >= 5) {
      bgClass = "bg-danger text-white";
    }else if (total >= 4) {
      bgClass = "bg-warning text-white";
    }else if (total >= 3) {
      bgClass = "bg-success text-white";
    }else if (total >= 2) {
      bgClass = "bg-primary text-white";
    }
     else if (total > 0) {
      bgClass = "bg-info";
    }

    const isToday = isCurrentMonth && i === today.getDate() ? "today" : "";
    daysContainer.innerHTML += `<div class="${bgClass} ${isToday}">${i}</div>`;
  }
  

}

prevBtn.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  fetchBookings(renderCalendar);
});

nextBtn.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  fetchBookings(renderCalendar);
});

fetchBookings(renderCalendar);
</script>
