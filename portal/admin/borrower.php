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
          <div class="section-body">
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
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Borrowers</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>State</th>
                            <th>Address</th>
                            
                            
                            
                          </tr>
                        </thead>
                        
                        <tbody>
                          <?php
                            // 'includes/connect.php';
                            $result = $db->prepare("SELECT * FROM admin WHERE role = 'user' ");
                            $result->execute();
                            for($i=1; $row = $result->fetch(); $i++){ 

                            ?> 
                          <tr>
                            <td><?php echo $i;?></td>
                            <td class="gallery">
                            <img alt="image" src="../uploads/<?php echo $row['photo']; ?>" class="gallery-item rounded-circle" data-image="../uploads/<?php echo $row['photo']; ?>" data-title="<?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>" width="35"
                              data-toggle="tooltip" title="<?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>"></a>
                            </td>
                            <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone']; ?> </td>
                            <td><?php echo $row['state']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                           
                          </tr>
                          
                          <?php } ?>
                        </tbody>
                     
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        
      <?php include '../footer.php'; ?>
    </div>
  </div>
  <?php include 'script.php'; ?>
  

</body>
</html>