<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create account</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="..//CSS/loginandReg.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">

    function checkPasswordStrength() {
      var number = /([0-9])/;
      var alphabets = /([a-zA-Z])/;
      var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
      if($('#password').val().length<6) {
        $('#password-strength-status').removeClass();
        $('#password-strength-status').addClass('weak-password');
        $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
      } else {
        if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
          $('#password-strength-status').removeClass();
          $('#password-strength-status').addClass('strong-password');
          $('#password-strength-status').html("Strong")
        } else {
          $('#password-strength-status').removeClass();
          $('#password-strength-status').addClass('medium-password');
          $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
        }}}



        $(document).ready(function(){

          $("#password").focus(function(){
            $("span").css("display", "inline");
          });
          $("#password").focusout(function(){
            $("span").css("display", "none");
          });


          $("#btn-register").click(function(event){
            event.preventDefault();
            $.ajax({
              url: "../PHP/register.php",
              method: "POST",
              data: $('#register-form').serialize(),

              success:function(strMessage){

                  $('#message').text(strMessage)

                // }

              }
            });

          });



          $("#btn-login").click(function(event){
            event.preventDefault();
            $.ajax({
              url: "../PHP/login.php",
              method: "POST",
              data: $('#login-form').serialize(),
              success:function(Message){
                $('#Logmessage').text(Message)
                
                if (Message == 'log in success') {
                  window.location.href = "../FRONTEND/newhomepage.php";
                  
                }
                
              }
            });

          });
        });
    </script>
</head>
<body>
<?php
	 	require '../Includes/navbar1.php';
	 ?>

  	<div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<p>Login here!</p>
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>

		<div class="register-info-box">
			<h2>New to Fashion Boys?</h2>
			<p>Create an account in a few steps to explore wide range of shirts and trousers</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>

		<div class="white-panel">
			<div class="login-show">
				<h2>LOGIN</h2>
        <p id="Logmessage"></p>
        <form class="" action="" method="post" id="login-form">
          <input type="text" name="cust-email" placeholder="Email">
          <input type="password" name="cust-password" placeholder="Password">
          <button type="submit" name="btn-login"  id="btn-login">Login</button>
         
        </form>
			</div>
			<div class="register-show">
				<h2>REGISTER</h2>
        <p id="message"></p>
        <form class="" action="" method="post" id="register-form">
          <input type="text" name="customer-fname" placeholder="Firstname">
          <input type="text" name="customer-lname" placeholder="Lastname">
          <input type="text" name="customer-city" placeholder="City" style=" display: inline; width: 40%; ">
          <input type="text" name="customer-street" placeholder="Street or appartment" style="height:70px">
          <input type="text" name="customer-email" placeholder="Email">
          <input type="password" name="customer-password" placeholder="Password" id="password" onKeyUp="checkPasswordStrength();">
          <input type="password" name="customer-confirm-pass" placeholder="Confirm Password">
          <div id="password-strength-status"></div>
          <button type="submit" name="btn-register" id="btn-register">Register</button>
        </form>
			</div>
		</div>
	</div>

  <script>
    $(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});


$('.login-reg-panel input[type="radio"]').on('change', function() {
    if($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut();
        $('.login-info-box').fadeIn();

        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');

    }
    else if($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();

        $('.white-panel').removeClass('right-log');

        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});

</script>
</body>
</html>
