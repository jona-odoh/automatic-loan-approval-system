<?php
session_start();

if (isset($_SESSION['SESS_ROLE'])) {
    // User is already logged in, redirect to their respective dashboard
    if ($_SESSION['SESS_ROLE'] == 'administrator') {
        header("location: admin/");
    } elseif ($_SESSION['SESS_ROLE'] == 'lender') {
        header("location: lender/");
    } elseif ($_SESSION['SESS_ROLE'] == 'user') {
        header("location: users/");
    }
    exit; 
}

?>
<?php include "connect.php" ?>

<?php
              $result = $db->prepare("SELECT * FROM settings");
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
               ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sign Up </title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='uploads/<?php echo $row['photo']; ?>' />
</head>
<?php } ?>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <?php
          if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            ' . $_SESSION['message'] . '
            </div>
            </div>';
            unset($_SESSION['message']);
          }

          if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-warning alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
            ' . $_SESSION['error'] . '
            </div>
            </div>';
            unset($_SESSION['error']);
          }
          ?>
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="post" action="process_login.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Email</label>
                    <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <!-- <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div> -->
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                
                
              </div>
            </div>
            
            <div class="mt-5 text-muted text-center">
            <a href="../">Go homepage</a><br>
              Don't have an account? <a href="register">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/page/sweetalert.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>