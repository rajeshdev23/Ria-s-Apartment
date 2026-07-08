jQuery(document).ready(function ($) {
    if (typeof MPHB !== 'undefined' && typeof MPHB.SearchCheckOutDatepicker !== 'undefined') {

        MPHB.SearchCheckOutDatepicker.prototype.updateCheckOutLimitations = function (checkInDate) {
            if (!checkInDate) {
                this.minCheckOutDateForSelection = null;
                this.maxCheckOutDateForSelection = null;
                this.minStayDateAfterCheckIn = null;
                this.maxStayDateAfterCheckIn = null;
                return;
            }

            var roomTypeCalendarData = MPHB.ajaxApiHelper.getLoadedRoomTypeCalendarData(0);
            var result = MPHB.calendarHelper.calculateMinMaxCheckOutDateForSelection(checkInDate, roomTypeCalendarData);
            this.minCheckOutDateForSelection = result.minCheckOutDateForSelection;
            this.maxCheckOutDateForSelection = result.maxCheckOutDateForSelection;
            this.minStayDateAfterCheckIn = result.minStayDateAfterCheckIn;
            this.maxStayDateAfterCheckIn = result.maxStayDateAfterCheckIn;

            // OVERRIDE: Removed the automatic setDate logic here
            // if (!this.getDate() || this.getDate() <= checkInDate) {
            //   this.setDate(this.minCheckOutDateForSelection);
            // }

            // Ensure the calendar opens in the correct month (Date of check-in or min checkout)
            // without actually selecting the date value.
            var defaultDate = this.minCheckOutDateForSelection ? this.minCheckOutDateForSelection : checkInDate;
            this.element.datepick('option', 'defaultDate', defaultDate);
        };

        // Also override for specific room type booking if needed, though user asked for "search form" (SearchCheckOutDatepicker)
        // If they need it for Single Room pages too, we might need to override MPHB.RoomTypeCheckOutDatepicker as well.
        // The request said "home page search form", which usually uses SearchCheckOutDatepicker.

    }
});
