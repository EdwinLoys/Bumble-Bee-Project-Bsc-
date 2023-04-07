
       $(document).ready(function(){
         load_cart_data()
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
         function load_cart_data()
         {
           $.ajax({
            url:"../FRONTEND/cart_fetch.php",
            method:"POST",
            // dataType:"JSON",
            success:function(data)
            {
             $('#cart_details').html(data);

           }
           });
         }



            $(document).on('click', '#add-cart', function(event){
           event.preventDefault();
           var product_id = $('#id').val();
           var product_name = $('#name').val();
           var product_price = $('#price').val();
           var product_size = $('#size').val();
           var product_img = $('#img').val();
           var product_flavour = $('#flavour').val();
           var product_quantity = $('#quantity').val();
           var action = 'add-to-cart';

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
                 quantity:product_quantity,
                 action:action
               },
               success:function()
               {
                 load_cart_data()
                  checkout_btn()
                 swal({
                   title: "Shopping cart",
                   text: "New item has been added to shopping cart",
                   icon: "success",
                 });

               }
             })

         });

            $(document).on('click', '.dir_addtocart', function(event){
           event.preventDefault();
           console.log('here');
           var product_id = $(this).attr("id");
           var product_name = $('#name'+product_id).val();
           var product_price = $('#price'+product_id).val();
           var product_size = $('#size'+product_id).val();
           var product_img = $('#img'+product_id).val();
           var product_flavour = $('#flavour'+product_id).val();
           var product_quantity = $('#quantity').val();
           var action = 'add-to-cart';

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
                 quantity:product_quantity,
                 action:action
               },
               success:function()
               {
                 load_cart_data()
                  checkout_btn()
                 swal({
                   title: "Shopping cart",
                   text: "New item has been added to shopping cart",
                   icon: "success",
                 });

               }
             })

         });
         });
