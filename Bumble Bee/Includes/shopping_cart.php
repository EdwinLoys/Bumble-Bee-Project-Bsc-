
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link type="text/css" rel="stylesheet" href="../CSS/cartstyle.css">

     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="../JavaScript/add_to_cart.js"></script>
     <script src="../JavaScript/manage-cart.js"></script>
     <script type="text/javascript">
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

       $(document).on('click', '#checkout-btn', function(event){
         event.preventDefault();
         $.ajax({
           url: "../FRONTEND/Checkout_products.php",
           success:function(){
             window.location.href = "../FRONTEND/Checkout_products.php";
           }
         });
       });
       });

     </script>
   </head>
   <body>

     <nav>
      <button type="button" name="button" class="cart-close"><i class="fa fa-times"style="font-size:13px" aria-hidden="true"></i></button>
      <ul>
        <div class="cart">
          <div class="your-cart">
            <h1>Your cart</h1>
          </div>
          <span  id="cart_details">

          </span>
          </div>
    </ul>
     </nav>
     <script src="../JavaScript/cart.js"></script>
   </body>
 </html>
