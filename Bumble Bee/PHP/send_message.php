<?php

  include("../Includes/connection.php");
if (isset($_POST['action']) && $_POST['action']=="send_message") {

      $sender_firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
      $sender_lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
      $sender_mail=mysqli_real_escape_string($conn,$_POST['email']);
      $sender_msg=mysqli_real_escape_string($conn,$_POST['message']);



      if (!empty($sender_firstname) && !empty($sender_lastname) && !empty($sender_mail) && !empty($sender_msg)) {
        if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$sender_mail)){
          echo json_encode(array(
          'response' => 'warning',
          'message' => 'The mail you entered is invalid',
          'title' => 'Oopsies',
        ));
        exit();
        }else {
          $feedback = "INSERT INTO feedbacks_tbl(SenderFname , SenderLname, SenderMail,SenderMessage)
          VALUES(?,?,?,?);";

          $stmt=mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt,$feedback)) {
                    echo "Error SQL";
              }else {
                mysqli_stmt_bind_param($stmt, "ssss", $sender_firstname, $sender_lastname,$sender_mail,$sender_msg);


                if(!mysqli_stmt_execute($stmt)){
                  echo json_encode(array(
                  'response' => 'warning',
                  'message' => 'Error sending message. Please try again',
                  'title' => 'Oopsies',
                ));
                exit();

                  exit();
                  //echo "Error inserting data: ".mysqli_error($conn);
                  }else{
                    echo json_encode(array(
                    'response' => 'success',
                    'message' => 'Your feedback is always welcome! Thank you',
                    'title' => 'Yay',
                  ));
                  exit();
                  }
        }
      }
    }else{
      echo json_encode(array(
      'response' => 'warning',
      'message' => 'Cannot leave fields empty',
      'title' => 'Oopsies',
    ));
    exit();
}

}

 ?>
