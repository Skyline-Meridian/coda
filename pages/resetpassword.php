<?php
include '../header.php';
include '../db_config.php';
if (empty($_GET['id']) && empty($_GET['mdcode'])) {
  header('location:login.php');
}

if (isset($_GET['id']) && isset($_GET['mdcode'])) {
  $id = base64_decode($_GET['id']);
  $code = $_GET['mdcode'];
  //$fetchqry="SELECT * FROM users WHERE id=:id AND mdCode=:code";
  //$fetchid = $pdo->prepare($fetchqry);
  //$params = ['id'=>$id, 'code'=>$code];
  // $fetchid->execute($params);
  // $rows = $fetchid->fetch(PDO::FETCH_ASSOC);

  $fetchqry = "SELECT id from users WHERE id=:id";
  $fetchid = $pdo->prepare($fetchqry);

  $params = ['id' => $id];
  $fetchid->execute($params);
  if ($fetchid->rowCount() > 0) {
    $row = $fetchid->fetch(PDO::FETCH_ASSOC);
  }

  if ($fetchid->rowCount() == 1) {
    if (isset($_POST['resetpass'])) {
      $pass = $_POST['pass'];
      $cpass = $_POST['confirm-pass'];

      if ($cpass !== $pass) {
        $msg = " <strong>Sorry!</strong>  Password Mismatch. ";
      } else {
        $options = array("cost" => 4);
        $hashPassword = password_hash($cpass, PASSWORD_BCRYPT, $options);
        $sql = "UPDATE users SET upass='$hashPassword' WHERE id='$id'";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        print_r($statement);
        $msg = "Password Changed.";
        header("refresh:5;url=login.php");
      }
    }
  } else {
    exit;
  }
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
              <h4>Reset password?</h4>
              <div>
                <strong>Hello !</strong> <?php echo $row['email'] ?> you are here to reset your forgetton password.
              </div>
              <?php
              if (isset($msg)) {
                echo $msg;
              }
              ?>
              <form method="post" class="pt-3">

                <div class="form-group">
                  <input type="password" placeholder="New Password" name="pass" class="form-control" required />
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Confirm New Password" class="form-control" name="confirm-pass" required />
                </div>
                <div class="mt-3">
                  <button type="submit" name="resetpass" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">RESET PASSWORD</button>
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