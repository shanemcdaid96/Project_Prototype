$( function() {
    $("#datepicker").datepicker({ minDate:0, maxDate: "+2M ", beforeShowDay: $.datepicker.noWeekends });
  //  $("#datepicker").datepicker({ minDate:0, maxDate: "+2M "});
});
