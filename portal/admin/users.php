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
                    <h4>Manage Users</h4>
                    <div class="card-header-form">
                      <div class="input-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#users">Add</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <div class="card-body p-0">
                        <table class="table table-striped table-md">
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                          <?php
                          $loggedInAdminId = $_SESSION['SESS_MEMBER_ID']; // Get the ID of the currently logged-in admin
                          $result = $db->prepare("SELECT * FROM admin WHERE id <> :loggedInAdminId");
                          $result->bindParam(':loggedInAdminId', $loggedInAdminId);
                          $result->execute();
                          $i = 1;
                          while ($row = $result->fetch()) {
                            ?>
                            <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo $row['role']; ?></td>
                              <td>
                                <div>
                                  <?php
                                  if ($row['status'] == "Active") {
                                    echo "<p class='badge badge-success'>Active</p>";
                                  } else {
                                    echo "<p class='badge badge-danger'>Not Active</p>";
                                  }
                                  ?>
                                </div>
                              </td>
                              <td><a href="#"  data-id="<?php echo $row['id']; ?>" class="btn btn-warning delete-loan-user"><i class="far fa-trash-alt"></i> Delete</a>
                                
                              </td>
                            </tr>
                          <?php } ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <?php include 'includes/modal.php'; ?>
        <?php include '../setting.php'; ?>
      </div>
      <?php include '../footer.php'; ?>
    </div>
  </div>
  <?php include 'script.php'; ?> 

  <!-- Script to handle the edit button click -->
  <script>
    $(document).on("click", ".edit-user", function () {
      var id = $(this).data("id");
      var name = $(this).closest("tr").find("td:eq(1)").text();
      var desc = $(this).closest("tr").find("td:eq(2)").text();
      var status = $(this).closest("tr").find("td:eq(3)").text().trim() === "Active" ? "Active" : "Not Active";

      $("#id").val(id);
      $("#ltype_name").val(name);
      $("#ltype_desc").val(desc);
      $("#status").val(status);
    }); 
  </script>

  <!-- Script to handle the delete button click -->
  <script>
    $(document).on("click", ".delete-loan-user", function () {
      var id = $(this).data("id");

      swal({
        title: 'Are you sure?',
        text: 'Once deleted, you will not be able to recover this user!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
        // If the user confirms the deletion, you can redirect to a delete script
        // or use AJAX to delete the user and refresh the table.

          $.ajax({
            url: 'delete_user.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
              if (response === 'success') {
                swal('Poof! The user has been deleted!', {
                  icon: 'success',
                });
              // You may also refresh the table or update it with the deleted row.
              } else {
                swal('Error!', 'Failed to delete the user.', 'error');
              }
            },
            error: function() {
              swal('Error!', 'An error occurred while deleting the user.', 'error');
            }
          });
        } else {
          swal('Cancelled', 'The user was not deleted.', 'info');
        }
      });
    });
  </script>


</body>
</html>
