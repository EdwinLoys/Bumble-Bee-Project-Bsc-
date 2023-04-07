

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>


  </head>
  <body>

		<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
		    <div class="container-fluid">
		      <!-- Toggler -->
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="navbar-toggler-icon"></span>
		      </button>

		      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
		        <!-- Collapse header -->
		        <div class="navbar-collapse-header d-md-none">
		          <div class="row">
		            <div class="col-6 collapse-brand">

		            </div>
		            <div class="col-6 collapse-close">
		              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
		                <span></span>
		                <span></span>
		              </button>
		            </div>
		          </div>
		        </div>

		        <!-- Navigation -->
		        <ul class="navbar-nav">
		          
		          <li class="nav-item">
		            <a class="nav-link" href="manage-products.php">
					   Manage Shirts
		            </a>
		          </li>
				  <li class="nav-item">
		            <a class="nav-link" href="manage-trouser.php">
		               Manage Trouser
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="ManageOrders.php">
		              </i> Manage orders
		            </a>
		          </li>
		          <li class="nav-item">
		            <a class="nav-link" href="adminfeedback.php">
		               View Feedback
		            </a>
		          </li>
		         <?php
						 if (isset($_SESSION['admin_'])) {
							 echo '<li class="nav-item">
							 <form class="nav-link" action="../../Includes/Logout.php" method="post">
								<button type="submit" name="admin-logout" style="border:none; background-color:transparent; cursor:pointer">Logout</button>
							 </form>
							</li>';
						 }


						  ?>

		        </ul>


		      </div>
		    </div>
		  </nav>
  </body>
</html>
