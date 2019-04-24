// Add Record
function addDentistRecord() {

  if($('#patient').val() == "")  
  {  
       alert("Patient is required");  
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
  var user_id = $("#user_ID").val();
  var patient = $("#patient").val();
  var service_id = $("#services").val();
  var appTime = $("#time").val();
  var appDate = $("#datepicker").val();
  var payment = $("#payment").val();

  // Add record
  $.post("../ajax/addDentistRecord.php", {
      user_id: user_id,
      patient: patient,
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
       $("#patient").val("");
       $("#services").val("");
       $("#time").val("");
       $("#datepicker").val("");
  });
}
}
function DeleteDentist(app_ID) {
  var conf = confirm("Are you sure, do you really want to delete this Appointment?");
  if (conf == true) {
      $.post("../ajax/deleteUser.php", {
              app_ID: app_ID
          },
          function (data, status) {
              // reload Users by using readRecords();
              readRecords();
          }
      );
  }
}

function GetDentistDetails(id) {
  // Add User ID to the hidden field for furture usage
  $("#app_ID").val(id);
  $.post("../ajax/readDentistDetails.php", {
          id: id
      },
     function (data, status) {
          // PARSE json data
        var app = JSON.parse(data);
          // Assing existing values to the modal popup fields
          $("#update_patient").val(app.userID);
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

$(document).ready(function(){
    $("#patient").keyup(function(){
      var query = $(this).val();
        $.ajax({
                url: 'query.php',
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
                  $('#patientResult').html(data);
                  $('#patientResults').css('display', 'block');
                    $("#patient").focusout(function(){
                        $('#patientResult').css('display', 'block');
                    });
                    $("#patient").focusin(function(){
                        $('#patientResult').css('display', 'block');
                    });
                }
        });
    });
  });

  $(document).ready(function(){
    $("#patients").keyup(function(){
      var query = $(this).val();
        $.ajax({
                url: 'query2.php',
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
                  $('#patientResult').html(data);
                  $('#patientResults').css('display', 'block');
                    $("#patients").focusout(function(){
                        $('#patientResult').css('display', 'block');
                    });
                    $("#patients").focusin(function(){
                        $('#patientResult').css('display', 'block');
                    });
                }
        });
    });
  });


  $(document).ready(function(){
    $("#update_patient").keyup(function(){
      var query = $(this).val();
        $.ajax({
                url: 'query.php',
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
                  $('#update_patientResult').html(data);
                  $('#update_patientResult').css('display', 'block');
                    $("#upate_patient").focusout(function(){
                        $('#update_patientResult').css('display', 'block');
                    });
                    $("#update_patient").focusin(function(){
                        $('#update_patientResult').css('display', 'block');
                    });
                }
        });
    });
  });

  // READ records
function readRecords() {
  $.get("../ajax/readDentistRecords.php", {}, function (data, status) {
      $(".records_content").html(data);
  });
}
function viewDentistDetails(id){
  $("#app_ID").val(id);
  if(id != '')  
  {  
       $.ajax({  
            url:"../ajax/selectDentist.php",  
            method:"POST",  
            data:{id:id},  
            success:function(data){  
                 $('#appointment_detail').html(data);  
                 $('#dataModal').modal('show');  
            }  
       });  
  } 
}


function UpdateDentistDetails() {
  // get values
  var patient = $("#update_patient").val();
  var service_id = $("#update_services").val();
  var appTime = $("#update_time").val();
  var appDate = $("#updatedatepicker").val();
  var payment = $("#update_payment").val();



  // get hidden field value
  var id = $("#app_ID").val();


  // Update the details by requesting to the server using ajax
  $.post("../ajax/updateDentistDetails.php", {
          id: id,
          patient: patient,
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
$(document).ready(function(){
  $('#datepicker,#time').on('change', function() {
      console.log('Date Changed');
      var appTime = $("#time").val();
      var appDate = $("#datepicker").val();
      //ajax request
     $.ajax({
          url: "booking_check.php",
          data: {
              appDate : appDate,
              appTime : appTime
          },
          dataType: 'json',
          success:function(data) {
              if(data > 0) {
                  alert('You already have an appointment booked for this time - Choose an alternative Time & Date');
              }
              else {
              }
          },
          error: function(data){
              //error
          }
      });
  });
  });

  $(document).ready(function(){
      $('#updatedatepicker,#update_time').on('change', function() {
          console.log('Date Changed');
          var appTime = $("#update_time").val();
          var appDate = $("#updatedatepicker").val();
          //ajax request
         $.ajax({
              url: "booking_check.php",
              data: {
                  appDate : appDate,
                  appTime : appTime
              },
              dataType: 'json',
              success:function(data) {
                  if(data > 0) {
                    alert('You already have an appointment booked for this time - Choose an alternative Time & Date');
                  }
                  else {
                  }
              },
              error: function(data){
                  //error
              }
          });
      });
      });

$(document).ready(function () {
  // READ recods on page load
  readRecords(); // calling function
});

$('[name=time] option').filter(function(){
  return this.value == '11:30'
}).remove();
$('[name=time] option').filter(function(){
  return this.value == '12:00'
}).remove();
$('[name=time] option').filter(function(){
  return this.value == '12:30'
}).remove();