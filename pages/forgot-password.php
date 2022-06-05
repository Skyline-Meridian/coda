<?php
include '../header.php';
include '../db_config.php';
if (isset($_GET['error'])) {
  $errors = $_GET['error'];
} else {
  $errors = '';
}
if (isset($_GET['msg'])) {
  $success = $_GET['msg'];
} else {
  $success = '';
}
?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">

        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="navbar-brand brand-logo">
                <h3 class="text-center">CODA PROJECT</h3>
              </div>
              <h4>Forgot your password?</h4>
              <?php
              if (isset($msg)) {
                echo $msg;
              } else {
              ?>
                <!-- <div class="alert alert-danger">
                  Please enter your email address. You will receive a link to create a new password via email.!
                </div> -->
              <?php
              }
              ?>
              <h6 class="font-weight-light">We can send a reset link to your registered email id.</h6>

              <form class="pt-3" method="POST" action="../services/forgotpassword.php">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="coda-emailid" name="coda-emailid" placeholder="Registered email">
                </div>
                <div class="mt-3">
                  <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">RESET PASSWORD</button>
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