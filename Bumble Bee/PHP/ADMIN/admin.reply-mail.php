 <?php
// require '../../Includes/connection.php';
if (isset($_POST['send-reply'])) {
//
// $reply=mysqli_real_escape_string($conn,$_POST['reply-text']);
//
//   if (isset($_GET['action'])) {
//     if ($_GET['action']=="reply") {
//       $id=$_GET['qid'];
//       $sql= "SELECT * FROM feedbacks_tbl WHERE QID=".$id;
//       $records= mysqli_query($conn, $sql);
//       while($row= mysqli_fetch_array($records))
//       {
//         $query = array(
//           'fname' => $row['SenderFname'],
//           'lname' => $row['SenderLname'],
//           'senderMail' => $row['SenderMail'],
//           'senderMsg' => $row['SenderMessage']
//         );
//       }
//
//       if (empty($reply)) {
//
//       //  header("Location:../../FRONTEND/ADMIN/feedbacks.php?message=empty");
//         exit();
//       }else {
//         $mymail="nilanithaya123@gmail.com";
//
//         $to=$query['senderMail'];
//         $subject="Test email";
//
//         $message="heys";
//         $headers= "From: projectcircle7@gmail.com"."\r\n" ;
//
//         $headers.=" Content-type: text/html\r\n";
//         $headers.=" X-Mailer:PHP/".phpversion();
//
//         if(mail($to,$subject,$message,$headers)){
//
//           $sql= "UPDATE feedbacks_tbl SET status='replied' , replyMsg='".$message."' WHERE QID=".$id;
//           mysqli_query($conn,$sql);
//           header("Location:../../FRONTEND/ADMIN/feedbacks.php?message=replied");
//
//         }else {
//
//          header("Location:../../FRONTEND/ADMIN/feedbacks.php?message=error");
//         // echo $to."<br>";
//         // echo $subject."<br>";
//         // echo $message."<br>";
//         // echo $headers."<br>";
//           exit();
//
//         }
//
//       }
//
//
//
//     }
//
//   }
// }else {
//   header("Location:../../FRONTEND/ADMIN/feedbacks.php");
//   exit();
// }

$to = "nilanithaya123@email.com";
$subject = 	"Testing sendmail.exe";
$message = 	"Hello!";
$headers = 	"From: projectcircle7@gmail.com"."\r\n".
  "Reply-to: from@gmail.com"."\r\n".
  "Mime-Version: 1.0"."\r\n".
  "Content-type: text/html; charset=iso-8859-1"."\r\n".
  "X-Mailer: PHP/".phpversion();
  ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","465");
if(mail($to,$subject,$message,$headers))
echo "Email sent";
else
echo "Email sending failed";
}
 ?>
