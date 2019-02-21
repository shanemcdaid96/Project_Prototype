$(function(){
    var $select = $("#age-range");
    for (i=0;i<=99;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
    
    $("#age-range").change(function(){
        var val = parseInt($("#age-range").val());
        $("#second").html("");
        for(i=val+1; i<=60; i++) {
        	$("#second").append("<option value='" + i + "'>"+i+"</option>");
        }
    });
});