$(".remove").click(function(){
    var id = $(this).parents("tr").attr("id");


    if(confirm('Are you sure to cancel this appointment ?'))
    {
        $.ajax({
           url: './remove.php',
           type: 'GET',
           data: {id: id},
           error: function() {
              alert('Something is wrong');
           },
           success: function(data) {
                $("#"+id).remove();
           }
        });
    }
});