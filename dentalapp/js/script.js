// Add Record
function addRecord() {

    if($('#dentist').val() == "")  
    {  
         alert("Dentist is required");  
    }  
    else if($('#services').val() == '')  
    {  
         alert("Appointment Type is required");  
    }  
    else if($('#payment').val() == '')  
    {  
         alert("Payment Method is required");  
    }  
    else if($('#time').val() == '')  
    {  
         alert("Time is required");  
    }  
    else if($('#datepicker').val() == '')  
    {  
         alert("Date is required");  
    } 
    else{
    // get values
   // var first_name = $("#first_name").val();
   var user_id=12;
    var dentist_id = $("#dentist").val();
    var service_id = $("#services").val();
    var appTime = $("#time").val();
    var appDate = $("#datepicker").val();
    var payment = $("#payment").val();

    // Add record
    $.post("ajax/addRecord.php", {
        user_id: user_id,
        dentist_id: dentist_id,
        service_id: service_id,
        appTime: appTime,
        appDate: appDate,
        payment: payment
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
         $("#dentist").val("");
         $("#services").val("");
         $("#time").val("");
         $("#datepicker").val("");
    });
}
}

// READ records
function readRecords() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteUser(app_ID) {
    var conf = confirm("Are you sure, do you really want to delete this Appointment?");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
                app_ID: app_ID
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}
function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#app_ID").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
       function (data, status) {
            // PARSE json data
          var app = JSON.parse(data);
            // Assing existing values to the modal popup fields
            //$("#update_name").val(app.userID);
            $("#update_dentist").val(app.Full_Title);
            $("#update_services").val(app.service_type);
           $("#update_time").val(app.appTime);
            $("#updatedatepicker").val(app.appDate);
            $("#update_payment").val(app.paymentMethod);
            //console.log($("#time").val(app.appTime));
        
       }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}
function viewUserDetails(id){
    $("#app_ID").val(id);
    if(id != '')  
    {  
         $.ajax({  
              url:"ajax/select.php",  
              method:"POST",  
              data:{id:id},  
              success:function(data){  
                   $('#appointment_detail').html(data);  
                   $('#dataModal').modal('show');  
              }  
         });  
    } 
}

function UpdateUserDetails() {
    // get values
    var dentist_id = $("#update_dentist").val();
    var service_id = $("#update_services").val();
    var appTime = $("#update_time").val();
    var appDate = $("#updatedatepicker").val();
    var payment = $("#update_payment").val();



    // get hidden field value
    var id = $("#app_ID").val();


    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            dentist_id: dentist_id,
            service_id: service_id,
            appTime: appTime,
            appDate:appDate,
            payment: payment
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});