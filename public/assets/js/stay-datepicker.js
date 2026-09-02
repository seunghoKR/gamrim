document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('stay-date-range');
    const checkinHidden = document.getElementById('checkin_val');
    const checkoutHidden = document.getElementById('checkout_val');

    if (dateInput) {
        flatpickr(dateInput, {
            mode: "range",
            minDate: "today",
            locale: "ko",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    // format dates and set to hidden inputs
                    const fp = instance;
                    checkinHidden.value = fp.formatDate(selectedDates[0], "Y-m-d");
                    checkoutHidden.value = fp.formatDate(selectedDates[1], "Y-m-d");
                } else {
                    checkinHidden.value = "";
                    checkoutHidden.value = "";
                }
            }
        });
    }
});
