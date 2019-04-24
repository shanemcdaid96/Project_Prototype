$('.services').change(function(){
    var price = $(this).find('option:selected').attr('data-price');
    $('.price').text(' €'+price);
    });

    function readServices() {
        $.get("../ajax/readServices.php", {}, function (data, status) {
            $(".service_content").html(data);
            console.log(data);
        });
    }

    function readAlerts() {
        $.get("../ajax/readAlerts.php", {}, function (data, status) {
            $(".alerts").html(data);
            console.log(data);
        });
    }


    // Add Record
function addService() {
    if($('#addservice').val() == "")  
    {  
         alert("Service is required");  
    }  
    else if($('#addprice').val() == '')  
    {  
         alert("Price is required");  
    }  
    else{
    // get values
    var service = $("#addservice").val();
    var price = $("#addprice").val();
    console.log(service);
    console.log(price);

    // Add record
    $.post("../ajax/addService.php", {
        service: service,
        price: price
    }, function (data, status) {
        // close the popup
        $("#addModal").modal("hide");

        // read records again
        readServices();

        // clear fields from the popup
         $("#addservice").val("");
         $("#addprice").val("");
    });
}
}

function addAlert() {
    if($('#comment').val() == "")  
    {  
         alert("Comment is required");  
    }  
    else if($('#second').val() == '')  
    {  
         alert("Max Age is required");  
    } 
    else if($('#age_range').val() == '')  
    {  
         alert("Min Age is required");  
    }
    else{
    // get values
    var message = $("#comment").val();
    var min = $("#age-range").val();
    var max = $("#second").val();
    var service = $("#services").val();



    // Add record
    $.post("../ajax/addAlert.php", {
        message: message,
        min: min,
        max: max,
        service: service
    }, 
    function (data, status) {

        // read records again
        readAlerts();

        // clear fields from the popup
         $("#comment").val("");
         $("#age-range").val("");
         $("#second").val("");
    });
}
}

function DeleteService(id) {
    var conf = confirm("Are you sure, do you really want to delete this Service?");
    if (conf == true) {
        $.post("../ajax/deleteService.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readServices();
            }
        );
    }
}

function DeleteAlert(id) {
    var conf = confirm("Are you sure, do you really want to delete this Alert?");
    if (conf == true) {
        $.post("../ajax/deleteAlert.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readAlerts();
            }
        );
    }
}

function GetService(id) {
    // Add User ID to the hidden field for furture usage
    $("#service_id").val(id);
    console.log(id);
    $.post("../ajax/readServiceDetails.php", {
            id: id
        },
       function (data, status) {
            // PARSE json data
          var app = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#updateservice").val(app.service_type);
            $("#updateprice").val(app.price);
        
       }
    );
    // Open modal popup
    $("#updateModal").modal("show");
}

function UpdateService() {
    // get values
    var service = $("#updateservice").val();
    var price = $("#updateprice").val();


    // get hidden field value
    var id = $("#service_id").val();


    // Update the details by requesting to the server using ajax
    $.post("../ajax/updateService.php", {
            id: id,
            service: service,
            price: price
        },
        function (data, status) {
            // hide modal popup
            $("#updateModal").modal("hide");
            // reload Users by using readRecords();
            readServices();
        }
    );
}
    
    $(document).ready(function () {
        readServices(); // calling function
        readAlerts();
    });