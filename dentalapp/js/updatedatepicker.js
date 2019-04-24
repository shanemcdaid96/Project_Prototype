$( function() {
     //display calender of next 2 months with no weekends 
    $("#updatedatepicker").datepicker({ minDate:0, maxDate: "+2M ", beforeShowDay: $.datepicker.noWeekends });
});
