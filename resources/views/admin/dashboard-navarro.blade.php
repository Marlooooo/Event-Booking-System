@extends('layouts.admin-navarro')
@section('title', 'Admin Dashboard')
@section('content')

<div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px; margin-bottom:6px;">
    <div>
        <h1>Admin Dashboard</h1>
        <p class="subtitle" style="margin:0;">Welcome back, {{ auth()->user()->name }}. Stats update every 30 seconds.</p>
    </div>
    <div style="display:flex;gap:8px;">
        <a class="btn btn-outline" href="{{ route('admin.bookings.navarro') }}">All Bookings</a>
        <a class="btn" href="{{ route('events-rooms.create') }}">+ Add Venue</a>
    </div>
</div>

{{-- Stats --}}
<div class="stat-grid" style="margin-top:20px;">
    <div class="stat-card">
        <div class="stat-number" id="stat-total">{{ $stats['total'] }}</div>
        <div class="stat-label">Total Bookings</div>
    </div>
    <div class="stat-card" style="border-color:#6366f1;">
        <div class="stat-number" id="stat-users">{{ $stats['users'] }}</div>
        <div class="stat-label">Total Users</div>
    </div>
    <div class="stat-card pending">
        <div class="stat-number" id="stat-pending">{{ $stats['pending'] }}</div>
        <div class="stat-label">Pending</div>
    </div>
    <div class="stat-card accepted">
        <div class="stat-number" id="stat-accepted">{{ $stats['accepted'] }}</div>
        <div class="stat-label">Accepted</div>
    </div>
    <div class="stat-card rejected">
        <div class="stat-number" id="stat-rejected">{{ $stats['rejected'] }}</div>
        <div class="stat-label">Rejected</div>
    </div>
</div>

{{-- Calendar --}}
<div style="margin-top:32px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; flex-wrap:wrap; gap:10px;">
        <div style="display:flex; align-items:center; gap:12px;">
            <h2 style="font-size:17px; font-weight:800; color:#0f172a; margin:0;" id="cal-title"></h2>
            <span id="live-badge" style="font-size:11px;color:#16a34a;font-weight:700;background:#dcfce7;padding:3px 12px;border-radius:20px;">Live</span>
        </div>
        <div style="display:flex; align-items:center; gap:8px;">
            <button onclick="prevPeriod()" style="width:32px;height:32px;border-radius:8px;border:1.5px solid #e2e8f0;background:#fff;cursor:pointer;font-size:16px;color:#374151;display:flex;align-items:center;justify-content:center;">&#8249;</button>
            <button onclick="nextPeriod()" style="width:32px;height:32px;border-radius:8px;border:1.5px solid #e2e8f0;background:#fff;cursor:pointer;font-size:16px;color:#374151;display:flex;align-items:center;justify-content:center;">&#8250;</button>
            <div style="display:flex;background:#f1f5f9;border-radius:9px;padding:3px;gap:2px;">
                <button onclick="setView('month')" id="btn-month" class="view-btn active-view">Month</button>
                <button onclick="setView('week')"  id="btn-week"  class="view-btn">Week</button>
                <button onclick="setView('day')"   id="btn-day"   class="view-btn">Day</button>
            </div>
        </div>
    </div>

    {{-- Legend --}}
    <div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:14px;font-size:12px;font-weight:600;color:#6b7280;">
        <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#e0e7ff;border:1px solid #a5b4fc;margin-right:5px;"></span>Pending</span>
        <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#dcfce7;border:1px solid #86efac;margin-right:5px;"></span>Accepted</span>
        <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#fee2e2;border:1px solid #fca5a5;margin-right:5px;"></span>Rejected</span>
    </div>

    {{-- Calendar grid --}}
    <div id="calendar-container" style="background:#fff;border-radius:16px;border:1.5px solid #e5e7eb;overflow-x:auto;overflow-y:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.04);">
        <div id="calendar-inner"></div>
    </div>

    {{-- Event detail popup --}}
    <div id="event-popup" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);background:#fff;border-radius:16px;padding:24px;box-shadow:0 20px 60px rgba(0,0,0,0.18);z-index:9999;min-width:300px;max-width:360px;">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:14px;">
            <div id="popup-badge" style="padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;"></div>
            <button onclick="closePopup()" style="background:none;border:none;cursor:pointer;font-size:20px;color:#9ca3af;line-height:1;">&times;</button>
        </div>
        <div id="popup-title"    style="font-size:17px;font-weight:800;color:#0f172a;margin-bottom:2px;"></div>
        <div id="popup-venue"    style="font-size:13px;color:#6b7280;margin-bottom:4px;"></div>
        <div id="popup-customer" style="font-size:13px;color:#4f46e5;font-weight:600;margin-bottom:12px;"></div>
        <div style="display:flex;flex-direction:column;gap:7px;font-size:13px;">
            <div style="display:flex;justify-content:space-between;">
                <span style="color:#9ca3af;font-weight:600;">Date</span>
                <span id="popup-date" style="font-weight:600;color:#1f2937;"></span>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <span style="color:#9ca3af;font-weight:600;">Booking ID</span>
                <span id="popup-bid" style="font-weight:700;color:#4f46e5;font-family:monospace;"></span>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <span style="color:#9ca3af;font-weight:600;">Persons</span>
                <span id="popup-persons" style="font-weight:600;color:#1f2937;"></span>
            </div>
        </div>
        <div style="margin-top:16px;display:flex;gap:8px;">
            <a id="popup-view" href="#" class="btn btn-outline" style="flex:1;text-align:center;padding:9px 0;font-size:13px;">View</a>
            <a id="popup-accept" href="#" class="btn" style="flex:1;padding:9px 0;font-size:13px;justify-content:center;background:linear-gradient(135deg,#16a34a,#15803d);">Accept</a>
        </div>
    </div>
    <div id="popup-overlay" onclick="closePopup()" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.25);z-index:9998;"></div>
</div>

<style>
    .view-btn {
        padding: 5px 14px;
        border-radius: 7px;
        border: none;
        background: transparent;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        font-family: inherit;
        transition: background .15s, color .15s;
    }
    .active-view {
        background: #fff;
        color: #4f46e5;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .cal-day-header {
        padding: 10px 0;
        text-align: center;
        font-size: 11.5px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8faff;
        border-bottom: 1.5px solid #e5e7eb;
    }
    .cal-cell {
        min-height: 100px;
        padding: 6px 5px;
        border-right: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        background: #fff;
        vertical-align: top;
        position: relative;
    }
    .cal-cell:hover { background: #fafbff; }
    .cal-cell.other-month { background: #fafafa; }
    .cal-cell.today-cell  { background: #f5f3ff; }
    .cal-date-num {
        font-size: 12.5px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 4px;
        display: inline-block;
        width: 26px;
        height: 26px;
        line-height: 26px;
        text-align: center;
        border-radius: 50%;
    }
    .today-num { background: #4f46e5; color: #fff !important; }
    .event-chip {
        display: block;
        padding: 3px 7px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 3px;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        border-left: 3px solid transparent;
        transition: opacity .15s, transform .1s;
    }
    .event-chip:hover { opacity: .85; transform: translateX(1px); }
</style>

<script>
    const calEventsUrl  = "{{ route('booking.calendar-events') }}";
    const viewBaseUrl   = "{{ route('admin.booking.show.navarro', '__ID__') }}";
    const acceptBaseUrl = "{{ route('admin.booking.accept.navarro', '__ID__') }}";

    let allEvents   = [];
    let currentView = 'month';
    let currentDate = new Date();

    const todayYMD = (() => {
        const t = new Date();
        return `${t.getFullYear()}-${pad(t.getMonth()+1)}-${pad(t.getDate())}`;
    })();

    function pad(n) { return String(n).padStart(2,'0'); }
    function toYMD(d) { return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`; }
    function eventsOn(ymd) { return allEvents.filter(e => e.date === ymd); }
    function monthName(m) {
        return ['January','February','March','April','May','June',
                'July','August','September','October','November','December'][m];
    }
    function shortDay(d) { return ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'][d]; }

    function chipHTML(ev) {
        const customer = ev.customer ? ` — ${ev.customer}` : '';
        return `<span class="event-chip"
                    style="background:${ev.bg};color:${ev.text};border-color:${ev.border};"
                    onclick="openPopup(${ev.id})"
                    title="${ev.title}${customer}">
                    ${ev.title}${customer}
                </span>`;
    }

    function fetchEvents(cb) {
        fetch(calEventsUrl)
            .then(r => r.json())
            .then(data => { allEvents = data; cb(); });
    }

    function setView(v) {
        currentView = v;
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active-view'));
        document.getElementById('btn-' + v).classList.add('active-view');
        render();
    }

    function prevPeriod() {
        if (currentView === 'month') currentDate.setMonth(currentDate.getMonth() - 1);
        else if (currentView === 'week') currentDate.setDate(currentDate.getDate() - 7);
        else currentDate.setDate(currentDate.getDate() - 1);
        render();
    }

    function nextPeriod() {
        if (currentView === 'month') currentDate.setMonth(currentDate.getMonth() + 1);
        else if (currentView === 'week') currentDate.setDate(currentDate.getDate() + 7);
        else currentDate.setDate(currentDate.getDate() + 1);
        render();
    }

    function render() {
        if (currentView === 'month') renderMonth();
        else if (currentView === 'week') renderWeek();
        else renderDay();
    }

    function renderMonth() {
        const y = currentDate.getFullYear();
        const m = currentDate.getMonth();
        document.getElementById('cal-title').textContent = `${monthName(m)} ${y}`;

        const firstDay    = new Date(y, m, 1).getDay();
        const daysInMonth = new Date(y, m + 1, 0).getDate();
        const prevDays    = new Date(y, m, 0).getDate();

        let html = `<div style="display:grid;grid-template-columns:repeat(7,1fr);">`;
        ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'].forEach(d => {
            html += `<div class="cal-day-header">${d}</div>`;
        });

        for (let i = firstDay - 1; i >= 0; i--) {
            html += `<div class="cal-cell other-month">
                        <span class="cal-date-num" style="color:#d1d5db;">${prevDays - i}</span>
                    </div>`;
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const ymd = `${y}-${pad(m+1)}-${pad(d)}`;
            const isToday = ymd === todayYMD;
            const dayEvents = eventsOn(ymd);
            html += `<div class="cal-cell ${isToday ? 'today-cell' : ''}">
                        <span class="cal-date-num ${isToday ? 'today-num' : ''}">${d}</span>
                        ${dayEvents.slice(0, 2).map(e => chipHTML(e)).join('')}
                        ${dayEvents.length > 2 ? `<span style="font-size:10.5px;color:#6b7280;font-weight:600;padding:2px 4px;">+${dayEvents.length - 2} more</span>` : ''}
                    </div>`;
        }

        const totalCells = firstDay + daysInMonth;
        const remaining  = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
        for (let d = 1; d <= remaining; d++) {
            html += `<div class="cal-cell other-month">
                        <span class="cal-date-num" style="color:#d1d5db;">${d}</span>
                    </div>`;
        }

        html += `</div>`;
        document.getElementById('calendar-inner').innerHTML = html;
    }

    function renderWeek() {
        const startOfWeek = new Date(currentDate);
        startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay());

        const days = [];
        for (let i = 0; i < 7; i++) {
            const d = new Date(startOfWeek);
            d.setDate(startOfWeek.getDate() + i);
            days.push(d);
        }

        const s = days[0], e = days[6];
        document.getElementById('cal-title').textContent =
            `${s.getDate()} ${monthName(s.getMonth()).slice(0,3)} ${s.getFullYear()} — ${e.getDate()} ${monthName(e.getMonth()).slice(0,3)} ${e.getFullYear()}`;

        let html = `<div style="display:flex;border-bottom:1.5px solid #e5e7eb;background:#f8faff;">
            <div style="width:52px;flex-shrink:0;border-right:1.5px solid #e5e7eb;height:44px;"></div>`;

        days.forEach(d => {
            const isToday = toYMD(d) === todayYMD;
            html += `<div style="flex:1;text-align:center;padding:8px 4px;border-right:1px solid #f1f5f9;">
                        <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.5px;">${shortDay(d.getDay())}</div>
                        <div style="font-size:18px;font-weight:800;margin-top:2px;
                            width:32px;height:32px;line-height:32px;border-radius:50%;
                            display:inline-flex;align-items:center;justify-content:center;
                            ${isToday ? 'background:#4f46e5;color:#fff;' : 'color:#0f172a;'}">
                            ${d.getDate()}
                        </div>
                    </div>`;
        });

        html += `</div><div style="display:flex;">
            <div style="width:52px;flex-shrink:0;border-right:1.5px solid #e5e7eb;"></div>`;

        days.forEach(d => {
            const ymd = toYMD(d);
            const dayEvents = eventsOn(ymd);
            const isToday = ymd === todayYMD;
            html += `<div style="flex:1;border-right:1px solid #f1f5f9;min-height:120px;padding:8px 5px;${isToday ? 'background:#f5f3ff;' : ''}">
                        ${dayEvents.map(e => chipHTML(e)).join('')}
                    </div>`;
        });

        html += `</div>`;
        document.getElementById('calendar-inner').innerHTML = html;
    }

    function renderDay() {
        const ymd = toYMD(currentDate);
        const dayEvents = eventsOn(ymd);
        const label = currentDate.toLocaleDateString('en-US', {weekday:'long',year:'numeric',month:'long',day:'numeric'});
        document.getElementById('cal-title').textContent = label;

        let html = `<div style="padding:20px 24px;">`;
        if (dayEvents.length === 0) {
            html += `<div style="text-align:center;padding:48px 0;color:#9ca3af;font-size:14px;font-weight:600;">No bookings on this day.</div>`;
        } else {
            dayEvents.forEach(e => {
                html += `<div style="display:flex;gap:14px;align-items:flex-start;padding:14px 16px;
                            border-radius:12px;margin-bottom:10px;cursor:pointer;
                            background:${e.bg};border-left:4px solid ${e.border};"
                            onclick="openPopup(${e.id})">
                            <div style="flex:1;">
                                <div style="font-size:14.5px;font-weight:800;color:${e.text};">${e.title}</div>
                                <div style="font-size:12.5px;color:${e.text};opacity:.8;margin-top:2px;">${e.venue}</div>
                                <div style="font-size:12px;color:${e.text};opacity:.7;margin-top:2px;font-weight:600;">${e.customer}</div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-size:11px;font-weight:700;color:${e.text};opacity:.7;text-transform:uppercase;letter-spacing:0.5px;">${e.status}</div>
                                <div style="font-size:12px;color:${e.text};margin-top:2px;">${e.num_persons} pax</div>
                            </div>
                        </div>`;
            });
        }
        html += `</div>`;
        document.getElementById('calendar-inner').innerHTML = html;
    }

    function openPopup(id) {
        const ev = allEvents.find(e => e.id === id);
        if (!ev) return;

        const statusLabels = { pending:'Pending', accepted:'Accepted', rejected:'Rejected' };
        document.getElementById('popup-badge').textContent = statusLabels[ev.status] ?? ev.status;
        document.getElementById('popup-badge').style.cssText =
            `padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700;background:${ev.bg};color:${ev.text};`;
        document.getElementById('popup-title').textContent    = ev.title;
        document.getElementById('popup-venue').textContent    = ev.venue;
        document.getElementById('popup-customer').textContent = 'Customer: ' + ev.customer;
        document.getElementById('popup-date').textContent     = new Date(ev.date + 'T00:00:00')
            .toLocaleDateString('en-US', {year:'numeric', month:'long', day:'numeric'});
        document.getElementById('popup-bid').textContent      = ev.booking_id;
        document.getElementById('popup-persons').textContent  = ev.num_persons + ' persons';
        document.getElementById('popup-view').href            = viewBaseUrl.replace('__ID__', id);

        const acceptForm = document.getElementById('popup-accept');
        if (ev.status === 'pending') {
            acceptForm.style.display = 'block';
            acceptForm.href = '#';
            acceptForm.onclick = function(e) {
                e.preventDefault();
                const f = document.createElement('form');
                f.method = 'POST';
                f.action = acceptBaseUrl.replace('__ID__', id);
                f.innerHTML = `@csrf @method('PATCH')`;
                document.body.appendChild(f);
                f.submit();
            };
        } else {
            acceptForm.style.display = 'none';
        }

        document.getElementById('event-popup').style.display   = 'block';
        document.getElementById('popup-overlay').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('event-popup').style.display   = 'none';
        document.getElementById('popup-overlay').style.display = 'none';
    }

    function animateCount(el, newVal) {
        if (!el) return;
        const current = parseInt(el.textContent) || 0;
        if (current === newVal) return;
        const step = newVal > current ? 1 : -1;
        let val = current;
        const t = setInterval(() => {
            val += step; el.textContent = val;
            if (val === newVal) clearInterval(t);
        }, 40);
    }

    function refreshStats() {
        fetch('{{ route('stats.live.navarro') }}')
            .then(r => r.json())
            .then(data => {
                animateCount(document.getElementById('stat-total'),    data.total_bookings);
                animateCount(document.getElementById('stat-users'),    data.total_users);
                animateCount(document.getElementById('stat-pending'),  data.pending);
                animateCount(document.getElementById('stat-accepted'), data.accepted);
                animateCount(document.getElementById('stat-rejected'), data.rejected);
                const badge = document.getElementById('live-badge');
                badge.textContent = 'Updated';
                setTimeout(() => badge.textContent = 'Live', 1500);
            });
    }

    fetchEvents(() => render());
    setInterval(() => { fetchEvents(() => render()); refreshStats(); }, 30000);
</script>

@endsection