<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <center>
      <form class="" action="array.php" method="post">

        <?php
        for ($i=0; $i < 5; $i++) {
          ?>
          <input type="text" name="number[]" placeholder="enter number" style="padding:5px 10px"><br><br>
          <?php
        }
        ?>
        <button type="submit" name="button">ENTER</button>

      </form>




  <?php
  if (isset($_POST['button'])) {
    $a=0;
    $min= $_POST['number'][0];
    $max=$min;
    foreach ($_POST['number'] as $key) {
      if ($min>$key) {
        $min=$key;
      }
      if ($max<$key) {
        $max=$key;
      }
    }
    echo "<h3>Minimum value is ".$min."</h3><br>";
    echo "<h3>Maximum value is  ".$max."</h3><br>";

  }


  ?>
    </center>
  </body>
</html>
