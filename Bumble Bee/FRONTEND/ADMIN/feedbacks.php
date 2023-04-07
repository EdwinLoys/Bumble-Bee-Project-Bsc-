<!-- includes -->
<?php
session_start();

require '../../Includes/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Arimo|Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat|Kaushan+Script" rel="stylesheet">

</head>
<!--    <link rel="stylesheet" href="../CSS/NavBar.css" type="text/css">-->
<link rel="stylesheet" href="../../CSS/ADMIN/feedback.admin.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<!-- Icons -->
<link href="../../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
<link href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Argon CSS -->
<link type="text/css" href="../../assets/css/argon.css" rel="stylesheet">
<body>


<?php if (isset($_SESSION['admin_'])) {
  require '../../Includes/admin.navbar.php';

if (isset($_GET['message'])) {
  if ($_GET['message']=="error") {
    echo '<div class="main"><br>
    <h1>error mail not sent</h1></div>';
  }
  if ($_GET['message']=="empty") {
    echo '<div class="main"><br>
    <h1>please type a reply</h1></div>';
  }
  if ($_GET['message']=="sent") {
    echo '<div class="main"><br>
    <h1>your rely has been sent</h1></div>';
  }
}

$sql= "SELECT * FROM feedbacks_tbl WHERE status='pending'";
$records= mysqli_query($conn, $sql);
$row= mysqli_fetch_array($records)
?>
    <div class="cont">
      <div class="main"><br>
      <h1>Here are the feedbacks given by the users:</h1></div>

  <div class="main">
            <?php
             while($row= mysqli_fetch_array($records))
             {
                echo '  <form  action="../../PHP/ADMIN/admin.reply-mail.php?action=reply&qid='.$row['QID'].'" method="post"><div class="container">
                 <div class="sender">
                  <p><span>'.$row['SenderFname'].' '.$row['SenderLname'].'</span><br>'.$row['SenderMail'].'</p>
                  <label for="reply-feedbacks">Reply</label>
                  </div>
                  <p><b>'.ucfirst($row['SenderFname']).'</b> says '.$row['SenderMessage'].'</p>
                  <input type="text" name="reply-text"  value="'.$row['replyMsg'].'">
                <button type="submit" name="send-reply">Send</button>
                  <input type="hidden" name="qid_" value="'.$row['QID'].'">

                  </div>
                  </form>';
               }

             ?>
</div>

            <div class="main"><br>
            <h1>Replied messages:</h1>

            <?php
          $sql= "SELECT * FROM feedbacks_tbl WHERE status='replied'";
          if($records= mysqli_query($conn, $sql)){
            if (mysqli_num_rows($records)<1) {
              ?>
              <div class="main"><br>
              <h1>No messsages replied </h1>
            </div>
              <?php
            }else {
              while($row= mysqli_fetch_array($records))
              {
                 echo '<div class="container">
                  <div class="sender">
                   <p><span>'.$row['SenderFname'].' '.$row['SenderLname'].'</span><br>'.$row['SenderMail'].'</p>
                   </div>
                   <p><b>'.ucfirst($row['SenderFname']).'</b> says '.$row['SenderMessage'].'</p><br>
                   <p> '.$row['replyMsg'].'</p>
                   <input type="hidden" name="qid_" value="'.$row['QID'].'">

                   </div>';
                }
            }

          }
               mysqli_close($conn);
           ?>
    </div>
    </div>
  <?php }
  elseif (!isset($_SESSION['admin_'])) {

    header("location:index.php");
  }

     ?>
</body>
</html>
