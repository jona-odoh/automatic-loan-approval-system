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
<!DOCTYPE html>
<html lang="en">
<?php include "connect.php" ?>

<?php
              $result = $db->prepare("SELECT * FROM settings");
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
               ?> 
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="post" action="process_registration.php" enctype="multipart/form-data">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="firstname">First Name</label>
                      <input type="text" class="form-control" name="firstname" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="lastname">Last Name</label>
                      <input type="text" class="form-control" name="lastname">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="phone">Contact Number</label>
                      <input type="number" class="form-control" name="phone">
                    </div>
                  </div>
                   <div class="row">
                    <div class="form-group col-6">
                      <label for="national_id">Nationa ID</label>
                      <input type="text" class="form-control" name="national_id" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="dob">Date of Birth</label>
                      <input type="date" class="form-control" name="dob">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="photo">Photo</label>
                      <input type="file" class="form-control" name="photo">
                    </div>
                    <div class="form-group col-6">
                      <label for="address">Address</label>
                      <textarea type="text" class="form-control" name="address" autofocus></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input type="password" class="form-control" name="confirm_password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="index">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- auth-register.html  21 Nov 2019 04:05:02 GMT -->
</html>