<?php
include 'header.php';
include 'db_config.php';
?>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        
      <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="navbar-brand brand-logo"><h3 class="text-center">CODA PROJECT</h3></div>
              <h4>Forgot your password?</h4>
              <h6 class="font-weight-light">We can send a reset link to your registered email id.</h6>
              
              <form class="pt-3" method="POST" action="">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="coda-emailid" placeholder="Registered email">
                </div>
                <div class="mt-3">
                  <btn type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">RESET PASSWORD</btn>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Wrong page? Go to <a href="login.php" class="text-primary">Login</a>
                </div>
              </form>
              
            </div>
          </div>
        </div>
        
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

