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
                    <h4>All Pending Loans</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Data Applied</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Loan Plan</th>
                            <th>Amount</th>
                            <th>Tenure</th>
                            <th>View</th>
                            <!-- <th>Status</th> -->
                            
                            
                          </tr>
                        </thead>
                        
                        <tbody>
                          <?php
                            // 'includes/connect.php';
                            $result = $db->prepare("SELECT b.*, u.photo FROM borrower b INNER JOIN admin u ON b.user_id = u.id WHERE b.approval_status = 'paid' ");
                            $result->execute();
                            for($i=1; $row = $result->fetch(); $i++){ 

                            ?> 
                          <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['date_applied']; ?></td>
                            <td class="gallery">
                            <img alt="image" src="../uploads/<?php echo $row['photo']; ?>" class="gallery-item rounded-circle" data-image="../uploads/<?php echo $row['photo']; ?>" data-title="<?php echo $row['fullname']; ?>" width="35"
                              data-toggle="tooltip" title="<?php echo $row['fullname']; ?>"></a>
                            
                            </td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['loan_plan']; ?> </td>
                            <td><?php echo $row['desired_amount']; ?> </td>
                            <td><?php echo $row['loan_tenure']; ?> Year</td>
                            <!-- <td>
                              <div><?php
                              if($row['status'] == "Approved"){
                                echo "<p class='badge badge-success'>Approved</p>";   
                              } else {
                                echo "<p class='badge badge-danger'>Not Approved</p>";
                              }     
                            ?>   </div>
                            </td> -->
                            <td>
                            <a href="pending_loans.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#viewLoan" data-id="<?php echo $row['id']; ?>" class="btn btn-info view-loan-information">
                            <i class="fa fa-info-circle"></i> View
                            </td>
                            
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

        <!-- View loan information Modal -->
        <div class="modal fade" id="viewLoan" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="formModal">Loan Applicant Information</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <br>
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-6">
                    <!-- Personal Information -->
                    <h5>Personal Information</h5>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="fullname" readonly >
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" readonly >
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputLoanType">Date of Birth</label>
                        <input type="text" class="form-control" id="dob" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputLoanPlans">Phone Number</label> 
                        <input type="text" class="form-control" id="contact_no" readonly>
                      </div>
                    </div> 
                    <div class="form-row">
                      <div class="form-group col-md-6">
                      <label class="form-label">Tax Number</label>
                        <input type="text" class="form-control" id="tax_id" readonly>
                      </div>
                      <div class="form-group col-md-6">
                      <label class="form-label">National ID</label>
                        <input type="text" class="form-control" id="national_id" readonly >
                      </div>
                    </div>
                    

                    <h5>Account Information</h5>
                      
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputLoanType">Account Number</label>
                          <input type="text" class="form-control" id="acct_no" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputLoanType">Bank Name</label>
                          <input type="text" class="form-control" id="bank" readonly>
                        </div>
                      </div> 
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputLoanType">Account Name</label>
                          <input type="text" class="form-control" id="acct_name" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputLoanPlans">BVN</label> 
                          <input type="text" class="form-control" id="bvn" readonly>
                        </div>
                      </div>
                    
                    
                    <h5>Employment Information</h5>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label class="form-label">Current Employer</label>
                        <input type="text" id="employer" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="form-line">
                          <label class="form-label">Job Title</label>
                          <input type="text" id="job" class="form-control" readonly>
                        </div>
                      </div>
                    </div> 
                    <div class="form-row">
                      <div class="form-group col-md-6">
                      <label class="form-label">Net income per month</label>
                        <input type="text" id="income" class="form-control" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="form-line">
                        <label class="form-label">Employment Duration</label>
                        <input type="text" id="e_duration" class="form-control" readonly>
                        </div>
                      </div>
                    </div> 
                  </div>

                  <div class="col-lg-6">

                    <h5>Loan Information</h5>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputLoanType">Monthly Expenses</label>
                        <input type="text" class="form-control" id="expenses" readonly >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputLoanType">Loan Type</label>
                        <input type="text" class="form-control" id="loan_type" readonly >
                      </div>
                    </div> 
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputLoanPlans">Interest</label> 
                        <input type="text" class="form-control" id="interest" readonly>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputLoanPlans">Existing loan commitments</label> 
                        <input type="text" class="form-control" id="exLoan" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputLoanPlans">Loan Tenure</label> 
                        <input type="text" class="form-control" id="loan_tenure" readonly>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputLoanPlans">Desired Loan Amount</label> 
                          <input type="text" class="form-control" id="desired_amount" readonly>
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line">
                        <label for="inputLoanType">Guarantor Name</label>
                        <input type="text" class="form-control" id="guarantor_name" readonly>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                          <label class="form-label">Guarantor National ID</label>
                          <input type="text" id="guarantor_national_id" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputLoanPlans">Guarantor Phone Number</label> 
                          <input type="text" class="form-control" id="guarantor_no" readonly>
                        </div>
                      </div> 
                      <div class="form-group form-float">
                      <div class="form-line">
                          <label for="inputLoanType">Purpose of Loan</label>
                          <textarea class="form-control" id="purpose" rows="100px" readonly></textarea>
                      </div>
                    </div>
                      
                    <h4> Documents</h4>
                    <ul  id="loanDocumentsList">
                      
                    </ul>
                  </div>

                  
                </div>
              </div>
            </div>
          </div>
        </div>


        <?php include '../setting.php'; ?>
      </div>
      <?php include '../footer.php'; ?>
    </div>
  </div>
  <?php include 'script.php'; ?>
  <!-- view loan information -->
 <script>
   // JavaScript to populate the modal when the "View" button is clicked
$(document).on('click', '.view-loan-information', function () {
  var id = $(this).data('id'); 

  // Perform an AJAX request to get the applicant's information
  $.ajax({
    url: 'get_loan_applicant_info.php', 
    type: 'POST',
    data: { id: id },
    dataType: 'json',
    success: function (data) {

      // Update the modal fields with the applicant's information 
      $('#id').val(data.id);
      $('#fullname').val(data.fullname);
      $('#email').val(data.email);
      $('#dob').val(data.dob);
      $('#contact_no').val(data.contact_no);
      $('#tax_id').val(data.tax_id);
      $('#national_id').val(data.national_id);
      $('#acct_no').val(data.acct_no);
      $('#bank').val(data.bank);
      $('#acct_name').val(data.acct_name);
      $('#bvn').val(data.bvn);
      $('#employer').val(data.employer);
      $('#job').val(data.job);
      $('#income').val(data.income);
      $('#e_duration').val(data.e_duration);
      $('#expenses').val(data.expenses);
      $('#loan_type').val(data.loan_type);
      $('#interest').val(data.interest);
      $('#exLoan').val(data.exLoan);
      $('#loan_tenure').val(data.loan_tenure);
      $('#desired_amount').val(data.desired_amount);
      $('#guarantor_name').val(data.guarantor_name);
      $('#guarantor_national_id').val(data.guarantor_national_id);
      $('#guarantor_no').val(data.guarantor_no);
      $('#purpose').val(data.purpose);
      

      // Populate the loan documents list
      var documentList = $('#loanDocumentsList');
      documentList.empty(); // Clear the list

      var documentUrls = data.documents; // Assuming it contains the full URLs

      for (var key in documentUrls) {
        if (documentUrls.hasOwnProperty(key)) {
          var documentUrl = documentUrls[key];
          var listItem = $('<li><a href="' + documentUrl + '" target="_blank">' + key + '</a></li>');
          documentList.append(listItem);
        }
      }

    }
  });
});

 </script>

</body>
</html>