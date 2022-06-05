<?php
include '../header.php';
include '../db_config.php';
if(isset($_GET['error']))
            {
$errors=$_GET['error'];
}else{
  $errors='';
}
if(isset($_GET['msg']))
            {
$success=$_GET['msg'];
}else{
  $success='';
}
?>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        
      <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="navbar-brand brand-logo"><h3 class="text-center">CODA PROJECT</h3></div>
               <?php
            if(isset($errors) && $errors !='')
            {
               
                {
                    echo '<div class="alert alert-danger">'.$errors.'</div>';
                }
            }

            if(isset($success) && $success !='')
            {

                echo '<div class="alert alert-success">'.$success.'</div>';
            }
            ?>
              <h4>New Here?</h4>
              <h6 class="font-weight-light">Signing up is very easy.</h6>
              
              <form class="pt-3" method="POST" action="../services/register.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="coda-username"  name="coda-username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="coda-emailid" name="coda-emailid" placeholder="Email id">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="coda-password" name="coda-password" placeholder="Password">
                </div>
                
                <div class="mt-3">
                 <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
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

