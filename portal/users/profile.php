<?php include 'includes/head.php'; ?>


<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include 'includes/navbar.php'; ?>
      <?php include 'includes/sidebar.php'; ?>
      <!-- Main Content -->
      <div class="main-content">
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
          <div class="section-body">
            <div class="row mt-sm-4">
              <?php
                          //include 'includes/connect.php';
              $result = $db->prepare("SELECT * FROM admin WHERE id = {$_SESSION['SESS_MEMBER_ID']}");
              $result->execute();
              for($i=1; $row = $result->fetch(); $i++){ 

               ?> 
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <?php
                      if (!empty($row['photo'])) {
                        echo '<img src="../uploads/' . $row['photo'] . '" class="rounded-circle author-box-picture">';
                      } else {
                        echo '<img src="../uploads/default.jpg" class="rounded-circle author-box-picture">';
                      }
                      ?>
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></a>
                      </div>
                      <div class="author-box-job"><?php echo $row['role']; ?> </div>
                    </div>
                    <div class="text-center">
                      <div class="card-body">
                          <div class="card-header float-left">
                            <h4>Personal Details</h4>
                          </div>
                          <p class="clearfix">
                            <span class="float-left">
                              State: 
                            </span>
                            <span class="text-muted">
                              <br>
                              <?php echo $row['state']; ?>
                            </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left">
                              Phone: 
                            </span>
                            <span class="text-muted">
                              <?php echo $row['phone']; ?>
                            </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left">
                              Mail:  
                            </span>
                            <span class="text-muted">
                              <?php echo $row['email']; ?>
                            </span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left">
                              Address: 
                            </span>
                            <span class="text-muted">
                              <?php echo $row['address']; ?>
                            </span>
                          </p>
                          
                        </div>
                     
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                        aria-selected="true"> Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                        aria-selected="false"> Password</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <form method="post" action="update_profile.php?id=<?php echo $row['id'];?>" enctype="multipart/form-data" class="needs-validation">
                          <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body"> 
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>">
                                <div class="invalid-feedback">
                                  Please fill in the first name
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>">
                                <div class="invalid-feedback">
                                  Please fill in the last name
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                                <div class="invalid-feedback">
                                  Please fill in the email
                                </div>
                              </div>
                              <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input type="tel" class="form-control" name="phone" value="<?php echo $row['phone']; ?>">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-12">
                                <label>State</label>
                                <input type="text" class="form-control" name="state" value="<?php echo $row['state']; ?>">
                                <div class="invalid-feedback">
                                  Please fill in the state
                                </div>
                              </div>
                              <div class="form-group col-md-5 col-12">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control" >
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <label>Address</label>
                                <textarea name="address" class="form-control"><?php echo $row['address']; ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>

                      <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                        <form method="post" action="change_password.php?id=<?php echo $row['id'];?>" class="needs-validation">
                          <div class="card-header">
                            <h4>Change Password</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                                <label>Current Password</label>
                                <input type="password" name="password" class="form-control" required>
                                <div class="invalid-feedback">
                                  Please fill in the your current password
                                </div>
                            </div>
                            <div class="row">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                                <div class="invalid-feedback">
                                  Please fill in the your new password
                                </div>
                            </div>
                            <div class="row">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                                <div class="invalid-feedback">
                                  Please confirm the your new password
                                </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
      </div>
    </section>
    <?php include 'includes/modal.php'; ?>
    
      </div>
      <?php include '../footer.php'; ?>
    </div>
  </div>
  <?php include '../script.php'; ?>
</body>
</html>