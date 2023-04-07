<?php
  require '../Includes/connection.php';
  session_start();
 ?>
<?php
  if (isset($_SESSION['customer_id'])) {
    
    if (isset($_GET['action'])) {
      if ($_GET['action']=="view") {
        $id = $_GET['id'];
       

      

        $u_order="SELECT * FROM order_details INNER JOIN orders_tbl ON order_details.order_id = orders_tbl.Order_id WHERE CID=".$id;
        $output=mysqli_query($conn, $u_order);
        $num_orders=mysqli_num_rows($output);
        $user_orders = [];
        while ($result = mysqli_fetch_array($output)) {
          $user_details = array(
            'oid' => $result['order_id'],
            'date' => $result['DateOfOrder'],
            'product_id' => $result['product_id'],
            'product_size' => $result['p_size'],
            'product_quantity' => $result['p_quantity']
          );

        }



        $sql="SELECT * FROM customers_tbl WHERE CustomerID=".$id;
        $user_details = [];
        $res=mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($res)) {
          $user_details = array(
            'u_id' => $id,
            'u_mail' => $row['Email'],
            'u_fname' => $row['Firstname'],
            'u_lname' => $row['Lastname'],
            'u_city' => $row['City'],
            'u_streetAdd' => $row['StreetAddress'],
          );
        }




        ?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $user_details['u_fname'].' '.$user_details['u_lname'] ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
       $(document).ready(function(){
          //reset Password
         $(document).on('click', '#reset-password', function(event){
             event.preventDefault();
           var current_pwd = $("#currentPass").val();
           var new_pwd = $('#newPass').val();
           var newRe_pwd = $('#confirmNewPass').val();
           var u_id = $('#userid').val();
           var action = 'update-password';

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
                   url:"../PHP/user_reset_password.php",
                   method:"POST",
                   data:{
                     current_password:current_pwd ,
                     new_password: new_pwd,
                     confirm_password: newRe_pwd,
                     user_id: u_id,
                     action:action
                   },
                   success:function(response)
                   {
                     var output= JSON.parse(response)
                     console.log(response);
                     swal(output.title, output.message , output.response, {
                       button: "okay",
                     });
                   }
                 });

             } else {
               swal("Cool");
             }

         });

       });

       //Logout
       $(document).on('click', '#cust-logout', function(){
         var action = 'logout';
         $.ajax({
           url:"../Includes/Logout.php",
           method:"POST",
           data:{action},
           success:function(result)
           {

             swal({title: "Logged out", text: "You have been logged!", icon:
             "success"}).then(function(){
              window.location.href = "javascript:history.go(-1)";

             }
           );


           }
         });
       });

       // update user details
       $(document).on('click', '#update-udetails', function(event){
           event.preventDefault();
         var u_id = $("#cust_id").val();
         var u_mail = $('#input-email').val();
         var u_fname = $('#input-first-name').val();
         var u_lname = $('#input-last-name').val();
         var u_city = $('#input-city').val();
         var u_streetAdd = $('#input-address').val();
         var action = 'update-details';

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
                 url:"../PHP/update_user_details.php",
                 method:"POST",
                 data:{
                   id: u_id,
                   mail_: u_mail,
                   fname_: u_fname,
                   lname_: u_lname,
                   city_: u_city,
                   StreetAddress_: u_streetAdd,
                   action:action
                 },
                 success:function(result)
                 {
                   var res= JSON.parse(result)
                   console.log(result);
                   swal(res.title, res.message , res.response, {
                     button: "okay",
                   });
                 }
               });

           } else {
             swal("Cool");
           }

       });

     });

       });
</script>

	    <!-- Favicon -->
<!-- <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png"> -->

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../assets/css/argon.css" rel="stylesheet">
</head>

<body>


	 <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 100px; background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php echo $user_details['u_fname'] ; ?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can view order history and your account details</p>
            <a href="javascript:history.go(-1)" class="btn btn-warning">Go Back</a>
          </div>
        </div>
      </div>
    </div>
	<div class="main-content">
    <!-- Top navbar -->

    <!-- Header -->

    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <!-- <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../images/download.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div> -->
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <!-- <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div> -->
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                    <div>
                      <span class="heading"><?php echo $num_orders; ?></span>
                      <span class="description">Orders</span><br><br>
                      <span><button class="logout-btn"name="cust-logout" id="cust-logout">Log out</button></span>
                      <!-- <span><a href="#" class="btn btn-sm btn-default float-right">View all</a></span> -->
                    </div>

                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $user_details['u_fname'].' '.$user_details['u_lname']; ?></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>
                  <?php echo $user_details['u_mail'] ?>
                </div>
                <!-- <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Computer Science
                </div> -->
                <hr class="my-4" />
                <p><?php echo $user_details['u_city']; ?><span class="font-weight-light"><?php echo ' ,<br>'; echo $user_details['u_streetAdd']; ?></span></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>

                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-form" >Reset password</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form id="update-user-details" method="post">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <button type="submit" class="btn btn-info" id="update-udetails">Edit profile</a>
                          <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $user_details['u_id'] ?>">

                        <!-- <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="doggy.doggy"> -->
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="<?php echo $user_details['u_mail'] ; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="<?php echo $user_details['u_fname'] ; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="<?php echo $user_details['u_lname'] ; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <textarea id="input-address" class="form-control form-control-alternative" placeholder="Home Address"><?php echo $user_details['u_streetAdd'] ; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="<?php echo $user_details['u_city'] ; ?>">
                      </div>
                    </div>

                  </div>
                </div>
                <!-- <hr class="my-4" /> -->
                <!-- Description -->
                <!-- <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">Born and raised at icbt</textarea>
                  </div>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>


		<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">


<div class="card bg-secondary shadow border-0">

    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-center text-muted mb-4">
            <small>Reset password</small>
        </div>
        <form role="form" id="reset-password-form" method="post">
            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Enter Old Password" type="password" id="currentPass">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Enter New Password" type="password" id="newPass">
                </div>
            </div>
			      <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Re-Enter New Password" type="password" id="confirmNewPass">
                </div>
            </div>

            <div class="text-center">
              <input type="hidden" name="cust_id" id="userid" value="<?php echo $user_details['u_id'] ?>">
                <button type="button" class="btn btn-primary my-4" id="reset-password">Reset password</button>
            </div>
        </form>
    </div>
</div>




            </div>

        </div>
    </div>
</div>

      <!-- Footer -->

    </div>
  </div>

<?php
}
}else {
  header("Location:HomePage.php");
}
}



 ?>


<!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Argon JS -->
<script src="../assets/js/argon.min.js"></script>
</body>
</html>
