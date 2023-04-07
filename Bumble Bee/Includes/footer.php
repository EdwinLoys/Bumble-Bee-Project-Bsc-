<?php
include '../Includes/connection.php';




  echo '<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify">Bumble Bee  was founded in 1994 and began as just a mere 300 square feet clothing shop in the town of Bandarawela operating with 7 members of staff. The founders of the company, Mr.Rizal Subian,  and Mr.A.C.M. Tharick have driven Fashion Boys to evolve from an ordinary clothing store to an established fashion and household brand which has reached the pinnacle of fashion retail in Sri Lanka!</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Brands</h6>
            <ul class="footer-links">
            ';
            $sql ="SELECT * FROM product_brands LIMIT 6";
            if ($res = mysqli_query($conn,$sql)) {
              while ($row= mysqli_fetch_array($res)) {
            echo  '<li><a href="#">'.$row['BrandName'].'</a></li>';
            }
          }
            echo '</ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="../FRONTEND/index.php">Home</a></li>
              <li><a href="../FRONTEND/products_page.php">Products</a></li>
             
              <li><a href="../FRONTEND/Contactpage.php">Contact Us</a></li>
              <li><a href="../FRONTEND/LoginandRegister.php">Login or Register</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by
         <a href="#">Bumble Bee</a>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i>  </a></li>
              <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
</footer>';

 ?>
