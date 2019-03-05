$(document).ready(function(){  
    $('#add').click(function(){  
          $('#insert').val("Insert");  
          $('#insert_form')[0].reset();  
     });  
     $(document).on('click', '.edit_data', function(){  
          var app_ID = $(this).attr("id"); 
        //  console.log(app_ID); 
          $.ajax({  
               url:"fetch.php",  
               method:"POST",  
               data:{app_ID:app_ID},  
               dataType:"json",  
               success:function(data){  
                    $('#dentist').val(data.Full_Title);  
                    $('#services').val(data.service_type);  
                    $('#payment').val(data.paymentMethod);  
                    $('#time').val(data.appTime);  
                    $('#datepicker').val(data.appDate);  
                    $('#app_ID').val(data.app_ID);  
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
               }  
          });  
     });  
     $('#insert_form').on("submit", function(event){  
          event.preventDefault();  
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
          else  
          {  
               $.ajax({  
                    url:"insert.php",  
                    method:"POST",  
                    data:$('#insert_form').serialize(),  
                    beforeSend:function(){  
                         $('#insert').val("Inserting");  
                    },  
                    success:function(data){  
                         $('#insert_form')[0].reset();  
                         $('#add_data_Modal').modal('hide');  
                         $('#employee_table').html(data);  
                    }  
               });  
          }  
     });  
     $(document).on('click', '.view_data', function(){  
          var app_ID = $(this).attr("id");  
          if(app_ID != '')  
          {  
               $.ajax({  
                    url:"select.php",  
                    method:"POST",  
                    data:{app_ID:app_ID},  
                    success:function(data){  
                         $('#employee_detail').html(data);  
                         $('#dataModal').modal('show');  
                    }  
               });  
          }            
     });  

          $(document).on('click', '.delete_data', function(){  
          var app_ID = $(this).attr("id");  
          var $ele = $(this).parent().parent();
          if(confirm('Are you sure to cancel this appointment ?'))
   {
       $.ajax({
          url: './remove.php',
          type: 'GET',
          data: {app_ID: app_ID},
          error: function() {
             alert('Something is wrong');
          },
          success: function(data) {
            //   $("#"+app_ID).remove();
            $ele.fadeOut().remove();
            console.log('Appointment Deleted');
   
            
          }
       });
   }
             
     });  


   
}); 