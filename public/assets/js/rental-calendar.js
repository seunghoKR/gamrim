document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('rental-calendar');
    var selectEl = document.getElementById('facility-select');
    
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'ko',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listMonth'
            },
            height: 'auto',
            // Dummy events for design
            events: [
                { title: '[대성전] 청년 수련회', start: '2026-09-10', end: '2026-09-12', color: '#3b82f6' },
                { title: '[벧엘] 세미나', start: '2026-09-15', color: '#22c55e' }
            ],
            // events: function(info, successCallback, failureCallback) {
            //     var facilityId = selectEl ? selectEl.value : 'all';
            //     fetch('/rental/events-api?start=' + info.startStr + '&end=' + info.endStr + '&facility_id=' + facilityId)
            //         .then(res => res.json())
            //         .then(data => successCallback(data))
            //         .catch(err => failureCallback(err));
            // },
            selectable: true,
            select: function(info) {
                // Redirect to apply page with selected date
                var facilityId = selectEl ? selectEl.value : '';
                var facParam = (facilityId && facilityId !== 'all') ? '&facility=' + facilityId : '';
                window.location.href = '/rental/apply?date=' + info.startStr + ' to ' + info.endStr + facParam;
            }
        });
        
        calendar.render();

        if (selectEl) {
            selectEl.addEventListener('change', function() {
                // Re-fetch events when facility changes
                calendar.refetchEvents();
            });
        }
    }
});
