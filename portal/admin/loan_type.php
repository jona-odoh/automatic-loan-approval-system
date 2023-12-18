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
                    <h4>Loan types</h4>
                    <div class="card-header-form">
                      <div class="input-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loanTypeModal">Add</button>
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
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>

                          <?php
                          // Include your database connection here
                          //include 'includes/connect.php';
                          
                          $result = $db->prepare("SELECT * FROM loan_type");
                          $result->execute();
                          $i = 1;
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)) { 
                          ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['ltype_name']; ?></td>
                            <td><?php echo $row['ltype_desc']; ?></td>
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
                            <td>
                              <div class="card-header-action">
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                                  <div class="dropdown-menu">
                                    <a href="#" data-toggle="modal" data-target="#editLoanType" data-id="<?php echo $row['id']; ?>" class="dropdown-item has-icon edit-loan-type"><i class="far fa-edit"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#"  data-id="<?php echo $row['id']; ?>" class="dropdown-item has-icon text-danger delete-loan-type"><i class="far fa-trash-alt"></i> Delete</a>
                                             
                                  </div>
                                </div>
                              </div>
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
        <!-- Edit loan type Modal -->
        <div class="modal fade" id="editLoanType" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Edit Loan Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="update_loan_type.php" enctype="multipart/form-data">
                  <input type="hidden" name="id" id="id" value="">
                  <div class="form-group">
                    <label>Loan Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend"></div>
                      <input type="text" class="form-control" name="ltype_name" id="ltype_name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <div class="input-group">
                      <div class="input-group-prepend"></div>
                      <select class="form-control" name="status" id="status">
                        <option value="Active">Active</option>
                        <option value="Not Active">Not Active</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <div class="input-group">
                      <div class="input-group-prepend"></div>
                      <textarea class="form-control" name="ltype_desc" id="ltype_desc"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php include 'includes/modal.php'; ?>
        <?php include '../setting.php'; ?>
      </div>
      <?php include '../footer.php'; ?>
    </div>
  </div>
  <?php include 'script.php'; ?>


  <!-- Script to handle the edit button click -->
  <script>
    $(document).on("click", ".edit-loan-type", function () {
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

<!-- Add this script to handle the delete button click -->
<script>
  $(document).on("click", ".delete-loan-type", function () {
    var id = $(this).data("id");

    swal({
      title: 'Are you sure?',
      text: 'Once deleted, you will not be able to recover this loan type!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // If the user confirms the deletion, you can use AJAX to delete the loan type and refresh the table.

        $.ajax({
          url: 'delete_loan_type.php', //Delete script URL
          type: 'POST',
          data: { id: id },
          success: function(response) {
            if (response === 'success') {
              swal('Poof! The loan type has been deleted!', {
                icon: 'success',
              });
              
              location.reload(); // Reload the page
            } else {
              swal('Error!', 'Failed to delete the loan type.', 'error');
            }
          },
          error: function() {
            swal('Error!', 'An error occurred while deleting the loan type.', 'error');
          }
        });
      } else {
        swal('Cancelled', 'The loan type was not deleted.', 'info');
      }
    });
  });
</script>


</body>
</html>
