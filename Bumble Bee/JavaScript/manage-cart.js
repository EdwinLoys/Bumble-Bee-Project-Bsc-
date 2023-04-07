   $(document).ready(function(){

     checkout_btn()

   function checkout_btn(){
     $.ajax({
       url: "../Includes/size_of_session.php",
       type: "GET",
       contentType: "application/json;",
       dataType: "json",
       success: function (data) {
         console.log(data);

           if (data.status=="true" && data.size=="true") {

               $('#checkout-btn').prop('disabled', false);
               $('#checkout-btn').css( 'cursor', 'pointer' );
               $(document).on('click', '#checkout-btn', function(event){
                 event.preventDefault();
                 $.ajax({
                   url: "../FRONTEND/Checkout_products.php",
                   success:function(){
                     window.location.href = "../FRONTEND/Checkout_products.php";
                   }
                 });
               });

           }else {
             $('#checkout-btn').prop('disabled', true);
             $('#checkout-btn').css( 'cursor', 'no-drop' );


           }
       },
       error: function (data) {
         console.log(data);
       }
     });

   }

   
     load_cart_data()







     function load_cart_data()
     {
       $.ajax({
        url:"../FRONTEND/cart_fetch.php",
        method:"POST",
        // dataType:"JSON",
        success:function(data)
        {
         $('#cart_details').html(data);
          checkout_btn()
       }
       });
     }
$(document).on('click', '.remove', function(){
    event.preventDefault();
  var product_id = $(this).attr("id");
  var product_name = $('#name'+product_id+'').val();
  var product_price = $('#price'+product_id+'').val();
  var product_size = $('#size'+product_id).val();
  var product_img = $('#img'+product_id).val();
  var product_flavour = $('#flavour'+product_id).val();
  var action = 'remove';
  if(confirm("Are you sure you want to remove this product?"))
  {
    $.ajax({
      url:"../PHP/cart.php",
      method:"POST",
      data:{
        id:product_id,
        size:product_size,
        name:product_name,
        flavour:product_flavour,
        price:product_price,
        img:product_img,
        action:action
      },
      success:function()
      {
        load_cart_data()
         checkout_btn()

      }
    })
  }
  else
  {
    return false;
  }
});

$(document).on('click', '.add', function(event){
  event.preventDefault();
  var product_id = $(this).attr("id");
  var product_name = $('#name'+product_id+'').val();
  var product_price = $('#price'+product_id+'').val();
  var product_size = $('#size'+product_id).val();
  var product_img = $('#img'+product_id).val();
  var product_flavour = $('#flavour'+product_id).val();
  var action = 'inc';

    $.ajax({
      url:"../PHP/cart.php",
      method:"POST",
      data:{
        id:product_id,
        size:product_size,
        name:product_name,
        flavour:product_flavour,
        price:product_price,
        img:product_img,
        action:action
      },
      success:function()
      {
        load_cart_data()
         checkout_btn()

      }
    })

});

$(document).on('click', '.delete', function(event){
  event.preventDefault();
  var action = 'delete';
  var product_id = $(this).attr("id");

  swal({
    title: "Are you sure?",
    text: "Do you really want to make these changes?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url:"../PHP/cart.php",
        method:"POST",
        data:{
          id:product_id,
          action:action},
          success:function()
          {
            load_cart_data();
             checkout_btn();
            swal({
              title: "Your Cart",
              text: "Your Cart has been clear",
              icon: "info",
              button: "OK",
            });

          }
        });

    } else {
      swal("Cool");
    }

});

});


});
