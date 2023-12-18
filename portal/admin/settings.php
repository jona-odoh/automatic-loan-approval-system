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
              $result = $db->prepare("SELECT * FROM settings");
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
               ?> 
               <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="../uploads/<?php echo $row['photo']; ?>" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?php echo $row['name']; ?> </a>
                      </div>
                    </div>
                    <div class="text-center">
                      <div class="card-body">
                        <div class="card-header float-left">
                          <h4>Company Details</h4>
                        </div>
                        <p class="clearfix">
                          <span class="float-left">
                            Site Title: 
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $row['title']; ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Contact Number: 
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $row['contact_no']; ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Mail: 
                          </span>
                          <span class="float-right text-muted">
                            <?php echo $row['email']; ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Address: 
                          </span>
                          <span class="float-right text-muted">
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
                  <form method="post" action="save_settings.php?id=<?php echo $row['id'];?>" enctype="multipart/form-data" class="needs-validation">
                    <div class="card-header">
                      <h4>Edit Settings</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Company Name</label>
                          <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
                          <div class="invalid-feedback">
                            Please fill in the Company Name
                          </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Site Title</label>
                          <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
                          <div class="invalid-feedback">
                            Please fill in the Site Title
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-7 col-12">
                          <label>Company Email</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                          <div class="invalid-feedback">
                            Please fill in the email
                          </div>
                        </div>
                        <div class="form-group col-md-5 col-12">
                          <label>Contact Number</label>
                          <input type="tel" class="form-control" name="contact_no" value="<?php echo $row['contact_no']; ?>">
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
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
  <?php include 'includes/modal.php'; ?>
  <?php include '../setting.php'; ?>
</div>
<?php include '../footer.php'; ?>
</div>
</div>
<?php include 'script.php'; ?>
</body>
</html>