$( function() {
    //display calender of next 2 months with no weekends 
    $("#datepicker").datepicker({ minDate:0, maxDate: "+2M ", beforeShowDay: $.datepicker.noWeekends });
});
