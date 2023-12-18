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
                    <h4>Loan Interest</h4>
                    <div class="card-header-form">
                      <div class="input-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loanPlanModal">Add</button>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <div class="card-body p-0">
                        <table class="table table-striped table-md">
                          <tr>
                            <th>#</th>
                            <!-- <th>Plan(Month)</th>
                            <th>Monthly Overdue Penalty %</th> -->
                            <th>Interest %</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>

                          <?php
                          // 'includes/connect.php';
                          $result = $db->prepare("SELECT * FROM loan_plan");
                          $result->execute();
                          for($i=1; $row = $result->fetch(); $i++){ 

                           ?> 
                           <tr>
                            <td><?php echo $i;?></td>
                            <!-- <td><?php echo $row['lplan_month']; ?></td>
                            <td><?php echo $row['lplan_penalty']; ?> %</td> -->
                            <td><?php echo $row['lplan_interest']; ?> </td>
                            <td>
                              <div><?php
                              if($row['status'] == "Active"){
                                echo "<p class='badge badge-success'>Active</p>";   
                              } else {
                                echo "<p class='badge badge-danger'>Not Active</p>";
                              }     
                            ?>   </div>
                          </td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#editLoanPlanModal" data-id="<?php echo $row['id']; ?>" class="btn btn-warning has-icon edit-loan-plan"><i class="far fa-edit"></i> Edit</a>
                          </td>
                          <!-- <td>
                              <div class="card-header-action">
                                <div class="dropdown">
                                  <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                                  <div class="dropdown-menu">
                                    <a href="#" data-toggle="modal" data-target="#editLoanPlanModal" data-id="<?php echo $row['id']; ?>" class="dropdown-item has-icon edit-loan-plan"><i class="far fa-edit"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#"  data-id="<?php echo $row['id']; ?>" class="dropdown-item has-icon text-danger delete-loan-plan"><i class="far fa-trash-alt"></i> Delete</a>
                                             
                                  </div>
                                </div>
                              </div>
                            </td> -->
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
    <!-- Edit loan plan Modal -->
    <div class="modal fade" id="editLoanPlanModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="formModal">Edit Loan Plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="editLoanPlanForm" action="update_loan_plan.php">
            <div class="form-group">
                <label>Interest</label>
                <div class="input-group">
                  <div class="input-group-prepend"></div>
                  <input type="text" class="form-control" name="lplan_interest" id="lplan_interest">
                  <div class="input-group-append">
                    <div class="input-group-text">%</div>
                  </div>
                </div>
              </div>
              <!-- <div class="form-group">
                <label>Plan(Month)</label>
                <div class="input-group">
                  <div class="input-group-prepend"></div>
                  <input type="text" class="form-control" name="lplan_month" id="lplan_month">
                </div>
              </div> -->
              
              <!-- <div class="form-group">
                <label>Monthly Overdue Penalty</label>
                <div class="input-group">
                  <div class="input-group-prepend"></div>
                  <input type="text" class="form-control" name="lplan_penalty" id="lplan_penalty">
                  <div class="input-group-append">
                    <div class="input-group-text">%</div>
                  </div>
                </div>
              </div> -->
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
              <input type="hidden" name="id" id="id">
              <button class="btn btn-primary m-t-15 waves-effect" id="editLoanPlanButton">SAVE</button>
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

<!-- edit loan plan -->
<script>
  $(document).on("click", ".edit-loan-plan", function () {
    var id = $(this).data("id");
    var month = $(this).closest("tr").find("td:eq(2)").text();
    var interest = $(this).closest("tr").find("td:eq(1)").text();
    var penalty = $(this).closest("tr").find("td:eq(3)").text();
    var status = $(this).closest("tr").find("td:eq(4)").text().trim() === "Active" ? "Active" : "Not Active";

    $("#id").val(id);
    $("#lplan_month").val(month);
    $("#lplan_interest").val(interest);
    $("#lplan_penalty").val(penalty);
    $("#status").val(status);
  });
</script>

<!--  script to handle the delete button click -->
<script>
  $(document).on("click", ".delete-loan-plan", function () {
    var id = $(this).data("id");

    swal({
      title: 'Are you sure?',
      text: 'Once deleted, you will not be able to recover this loan plan!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // If the user confirms the deletion, you can use AJAX to delete the loan plan and refresh the table.

        $.ajax({
          url: 'delete_loan_plan.php', //Delete script URL
          type: 'POST',
          data: { id: id }, 
          success: function(response) {
            if (response === 'success') {
              swal('Poof! The loan plan has been deleted!', {
                icon: 'success',
              });
              
              location.reload(); // Reload the page
            } else {
              swal('Error!', 'Failed to delete the loan plan.', 'error');
            }
          },
          error: function() {
            swal('Error!', 'An error occurred while deleting the loan plan.', 'error');
          }
        });
      } else {
        swal('Cancelled', 'The loan plan was not deleted.', 'info');
      }
    });
  });
</script>
</body>
<!-- datatables.html  21 Nov 2019 03:55:25 GMT -->
</html>