$('.services').change(function(){
    var price = $(this).find('option:selected').attr('data-price');
    $('.price').text(' €'+price);
    });