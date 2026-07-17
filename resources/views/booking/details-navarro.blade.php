@extends('layouts.app-navarro')
@section('title', 'Booking Details')
@section('step1class', 'done')
@section('step2class', 'active')
@section('content')

<h1>Booking Details</h1>
<p class="subtitle">Choose your venue and the type of event.</p>

<form method="POST" action="{{ route('booking.details.store') }}">
    @csrf

    {{-- Customer Name --}}
    <label>Customer Name</label>
    <input type="text" value="{{ $customerName }}" readonly>

    {{-- Venue --}}
    <label>Venue</label>
    <select name="event_room_navarro_id" id="venue-select" required style="width:100%;padding:12px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14.5px;background:#fafafa;font-family:inherit;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 14px center;cursor:pointer;">
        <option value="">— Select a venue —</option>
        @foreach ($venues as $venue)
            <option value="{{ $venue->id }}"
                data-capacity="{{ $venue->capacity }}"
                data-booked-url="{{ route('booking.booked-dates', $venue->id) }}"
                {{ old('event_room_navarro_id', $old['event_room_navarro_id'] ?? '') == $venue->id ? 'selected' : '' }}>
                {{ $venue->name }} ({{ $venue->location ?? 'No location' }} — max {{ $venue->capacity }} pax)
            </option>
        @endforeach
    </select>
    @error('event_room_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

    {{-- Event Type --}}
    <label>Event Type</label>
    <select name="event_navarro_id" required style="width:100%;padding:12px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14.5px;background:#fafafa;font-family:inherit;appearance:none;background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E\");background-repeat:no-repeat;background-position:right 14px center;cursor:pointer;">
        <option value="">— Select an event —</option>
        @foreach ($events as $event)
            <option value="{{ $event->id }}"
                {{ old('event_navarro_id', $old['event_navarro_id'] ?? '') == $event->id ? 'selected' : '' }}>
                {{ $event->name }}
            </option>
        @endforeach
    </select>
    @error('event_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

    {{-- Booking Date — hidden field only, calendar drives it --}}
    <input type="hidden" name="booking_date" id="booking_date"
           value="{{ old('booking_date', $old['booking_date'] ?? '') }}">

    <label>Booking Date</label>
    @error('booking_date')<div class="field-error" style="margin-bottom:8px;">{{ $message }}</div>@enderror

    {{-- Calendar widget --}}
    <div id="cal-widget" style="border:1.5px solid #e5e7eb;border-radius:14px;overflow:hidden;margin-bottom:6px;box-shadow:0 2px 12px rgba(0,0,0,0.05);">

        {{-- Calendar header --}}
        <div style="display:flex;justify-content:space-between;align-items:center;padding:14px 18px;background:linear-gradient(135deg,#4f46e5,#7c3aed);">
            <button type="button" id="cal-prev"
                style="width:32px;height:32px;border-radius:8px;border:none;background:rgba(255,255,255,0.15);color:#fff;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;transition:background .15s;">
                &#8249;
            </button>
            <span id="cal-month-label" style="color:#fff;font-weight:800;font-size:15px;letter-spacing:-0.2px;"></span>
            <button type="button" id="cal-next"
                style="width:32px;height:32px;border-radius:8px;border:none;background:rgba(255,255,255,0.15);color:#fff;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;transition:background .15s;">
                &#8250;
            </button>
        </div>

        {{-- Day name headers --}}
        <div style="display:grid;grid-template-columns:repeat(7,1fr);background:#f8faff;border-bottom:1.5px solid #e5e7eb;">
            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d)
                <div style="padding:10px 0;text-align:center;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.5px;">{{ $d }}</div>
            @endforeach
        </div>

        {{-- Selected date display --}}
        <div id="cal-selected-display"
            style="padding:10px 18px;background:#f8faff;border-bottom:1.5px solid #e5e7eb;font-size:13px;font-weight:600;color:#6b7280;min-height:40px;display:flex;align-items:center;gap:8px;">
            <span style="width:8px;height:8px;border-radius:50%;background:#c4c9d4;display:inline-block;flex-shrink:0;"></span>
            No date selected — click an available date below
        </div>

        {{-- Legend --}}
        <div style="display:flex;gap:18px;padding:10px 18px;background:#fff;border-bottom:1.5px solid #f1f5f9;flex-wrap:wrap;">
            <span style="display:flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;color:#6b7280;">
                <span style="width:10px;height:10px;border-radius:3px;background:#f0fdf4;border:1.5px solid #86efac;display:inline-block;"></span>
                Available
            </span>
            <span style="display:flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;color:#6b7280;">
                <span style="width:10px;height:10px;border-radius:3px;background:#fee2e2;border:1.5px solid #fca5a5;display:inline-block;"></span>
                Booked
            </span>
            <span style="display:flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;color:#6b7280;">
                <span style="width:10px;height:10px;border-radius:3px;background:#4f46e5;border:1.5px solid #4f46e5;display:inline-block;"></span>
                Selected
            </span>
            <span style="display:flex;align-items:center;gap:6px;font-size:11.5px;font-weight:600;color:#6b7280;">
                <span style="width:10px;height:10px;border-radius:3px;background:#f3f4f6;border:1.5px solid #d1d5db;display:inline-block;"></span>
                Unavailable
            </span>
        </div>

        {{-- Grid --}}
        <div id="cal-grid" style="display:grid;grid-template-columns:repeat(7,1fr);gap:1px;background:#e5e7eb;"></div>

        {{-- Loading state --}}
        <div id="cal-loading" style="display:none;padding:24px;text-align:center;background:#fff;font-size:13px;color:#94a3b8;font-weight:600;letter-spacing:0.2px;">
            Loading available dates...
        </div>

    </div>

    {{-- Number of Persons --}}
    <label>
        Number of Persons
        <span id="capacity-label" style="font-size:12px;color:#94a3b8;font-weight:500;">
            (Select a venue)
        </span>
    </label>
    <input type="number"
        id="num_persons"
        name="num_persons"
        min="1"
        value="{{ old('num_persons', $old['num_persons'] ?? '') }}"
        placeholder="e.g. 20">
    @error('num_persons')<div class="field-error">{{ $message }}</div>@enderror

    <div class="btn-row" style="margin-top:24px;">
        <a class="btn btn-outline" href="{{ route('customer.dashboard.navarro') }}">&#8592; Dashboard</a>
        <a class="btn btn-outline" href="{{ route('booking.start') }}">&#8592; Back</a>
        <button type="submit">Continue &#8594;</button>
    </div>

</form>

<style>
    .cal-cell {
        background: #fff;
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13.5px;
        font-weight: 600;
        cursor: default;
        position: relative;
        transition: background .12s;
        user-select: none;
    }
    .cal-cell.empty {
        background: #fafafa;
    }
    .cal-cell.past {
        background: #f9fafb;
        color: #d1d5db;
        cursor: not-allowed;
    }
    .cal-cell.booked {
        background: #fff5f5;
        color: #fca5a5;
        cursor: not-allowed;
        text-decoration: line-through;
        text-decoration-color: #fca5a5;
    }
    .cal-cell.available {
        background: #f0fdf4;
        color: #166534;
        cursor: pointer;
    }
    .cal-cell.available:hover {
        background: #dcfce7;
        transform: scale(1.05);
        z-index: 1;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(22,163,74,0.2);
    }
    .cal-cell.selected {
        background: #4f46e5 !important;
        color: #fff !important;
        cursor: pointer;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(79,70,229,0.35);
        transform: scale(1.05);
        z-index: 2;
    }
    .cal-cell.today-ring {
        outline: 2px solid #a5b4fc;
        outline-offset: -2px;
        border-radius: 4px;
    }
    .cal-cell.selected.today-ring {
        outline: 2px solid rgba(255,255,255,0.5);
    }
</style>

<script>
    const bookedDatesEndpoint = "{{ route('booking.booked-dates', ['eventRoomNavarro' => 0]) }}".replace('/0', '/');
    const venueSelect = document.getElementById('venue-select');
    const hiddenInput = document.getElementById('booking_date');
    const display = document.getElementById('cal-selected-display');
    const grid = document.getElementById('cal-grid');
    const loading = document.getElementById('cal-loading');
    const monthLabel = document.getElementById('cal-month-label');
    const form = document.querySelector('form');
    const personsInput = document.getElementById('num_persons');
    const capacityLabel = document.getElementById('capacity-label');

    function updateCapacity() {

        const selected = venueSelect.options[venueSelect.selectedIndex];

        if (!selected.value) {
            personsInput.removeAttribute('max');
            capacityLabel.textContent = '(Select a venue)';
            return;
        }

        const capacity = selected.dataset.capacity;

        personsInput.max = capacity;
        capacityLabel.textContent = `(max ${capacity})`;

        if (personsInput.value && parseInt(personsInput.value) > parseInt(capacity)) {
            personsInput.value = capacity;
        }
    }

    let bookedDates = [];
    let selectedDate = hiddenInput.value || null;

    const now = new Date();
    now.setHours(0,0,0,0);
    let viewYear = now.getFullYear();
    let viewMonth = now.getMonth();

    const MONTHS = ['January','February','March','April','May','June',
                    'July','August','September','October','November','December'];

    function pad(n) {
        return String(n).padStart(2,'0');
    }

    function toYMD(y, m, d) {
        return `${y}-${pad(m+1)}-${pad(d)}`;
    }

    function renderCalendar() {
        grid.innerHTML = '';
        monthLabel.textContent = `${MONTHS[viewMonth]} ${viewYear}`;

        const firstDay = new Date(viewYear, viewMonth, 1).getDay();
        const daysInMonth = new Date(viewYear, viewMonth + 1, 0).getDate();
        const prevDays = new Date(viewYear, viewMonth, 0).getDate();

        for (let i = firstDay - 1; i >= 0; i--) {
            const cell = document.createElement('div');
            cell.className = 'cal-cell empty';
            cell.style.color = '#e2e8f0';
            cell.textContent = prevDays - i;
            grid.appendChild(cell);
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const ymd = toYMD(viewYear, viewMonth, d);
            const date = new Date(viewYear, viewMonth, d);
            const cell = document.createElement('div');

            cell.textContent = d;
            cell.className = 'cal-cell';

            const isToday = date.getTime() === now.getTime();
            const isPast = date < now;
            const isBooked = bookedDates.includes(ymd);
            const isSelected = ymd === selectedDate;

            if (isToday) cell.classList.add('today-ring');

            if (isSelected) {
                cell.classList.add('selected');
            } else if (isPast) {
                cell.classList.add('past');
            } else if (isBooked) {
                cell.classList.add('booked');
            } else {
                cell.classList.add('available');
                cell.addEventListener('click', () => pickDate(ymd));
            }

            grid.appendChild(cell);
        }

        const total = firstDay + daysInMonth;
        const remaining = total % 7 === 0 ? 0 : 7 - (total % 7);

        for (let d = 1; d <= remaining; d++) {
            const cell = document.createElement('div');
            cell.className = 'cal-cell empty';
            cell.style.color = '#e2e8f0';
            cell.textContent = d;
            grid.appendChild(cell);
        }
    }

    function pickDate(ymd) {
        selectedDate = ymd;
        hiddenInput.value = ymd;

        const [y,m,d] = ymd.split('-');

        display.innerHTML = `
            <span style="width:8px;height:8px;border-radius:50%;background:#4f46e5;display:inline-block;"></span>
            Selected:
            <strong>${new Date(y,m-1,d).toDateString()}</strong>
        `;

        renderCalendar();
    }

    function loadBookedDates(venueId) {

        if (!venueId) {
            bookedDates = [];
            renderCalendar();
            return;
        }

        loading.style.display = 'block';

        fetch(bookedDatesEndpoint + venueId)
            .then(r => r.json())
            .then(data => {
                bookedDates = data;
                loading.style.display = 'none';
                renderCalendar();
            })
            .catch(() => {
                loading.style.display = 'none';
                renderCalendar();
            });
    }

    document.getElementById('cal-prev').addEventListener('click', () => {
        viewMonth--;
        if (viewMonth < 0) {
            viewMonth = 11;
            viewYear--;
        }

        if (
            viewYear < now.getFullYear() ||
            (viewYear === now.getFullYear() && viewMonth < now.getMonth())
        ) {
            viewYear = now.getFullYear();
            viewMonth = now.getMonth();
        }

        renderCalendar();
    });

    document.getElementById('cal-next').addEventListener('click', () => {
        viewMonth++;
        if (viewMonth > 11) {
            viewMonth = 0;
            viewYear++;
        }

        renderCalendar();
    });

    venueSelect.addEventListener('change', () => {
        selectedDate = null;
        hiddenInput.value = '';

        display.innerHTML = `
            <span style="width:8px;height:8px;border-radius:50%;background:#c4c9d4;display:inline-block;"></span>
            No date selected
        `;

        updateCapacity();
        loadBookedDates(venueSelect.value);
    });

    form.addEventListener('submit', function(e) {

        const eventType = document.querySelector('[name="event_navarro_id"]').value;
        const persons = document.querySelector('[name="num_persons"]').value;
        const maxCapacity = parseInt(personsInput.max || 0);

        if (persons && maxCapacity && parseInt(persons) > maxCapacity) {
            e.preventDefault();
            alert(`The selected venue only allows ${maxCapacity} persons.`);
            return;
        }

        if (
            venueSelect.value === "" ||
            eventType === "" ||
            hiddenInput.value === "" ||
            persons === ""
        ) {
            e.preventDefault();
            alert("Please fill in all required fields before continuing.");
            return;
        }
    });

    updateCapacity();
    loadBookedDates(venueSelect.value);
</script>

@endsection