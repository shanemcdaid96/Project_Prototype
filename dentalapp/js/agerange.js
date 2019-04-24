$(function(){
    var $select = $("#age-range");
    //set first dropdown range between 0-75
    for (i=0;i<=75;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
    
    $("#age-range").change(function(){
        var val = parseInt($("#age-range").val());
        $("#second").html("");
        //set second dropdown range between the selected value of the first and 99
        for(i=val+1; i<=99; i++) {
        	$("#second").append("<option value='" + i + "'>"+i+"</option>");
        }
    });
});