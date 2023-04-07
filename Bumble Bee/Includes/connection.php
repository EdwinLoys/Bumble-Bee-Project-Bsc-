<?php
      $servername= "localhost";
      $username= "root";
      $password= "";
      $dbname ="fashionboys";

      $conn= mysqli_connect($servername,$username);
      if(!$conn)
      {
      die("Connection failed".mysqli_connect_error());
      }
      else {
        // echo "Connection successfull\n";
        // echo "<br>";
      }
         if(!mysqli_select_db($conn, $dbname)){
      	    echo "DATABASE NOT PRESENT";
      	}



 ?>
