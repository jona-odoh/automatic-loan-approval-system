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
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Loans Information</h4>
                    <div class="card-header-form">
                    </div>
                  </div>

                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Date</th>
                            <th>Reference no</th>
                            <th>Loan Type</th>
                            <th>Period</th>
                            <th>Amount</th>
                            <th>Expire</th>
                            <!-- <th>Balance</th> -->
                            <!-- <th>Payment Detail</th> -->
                            <th>Staus</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $result = $db->prepare("SELECT * FROM borrower WHERE {$_SESSION['SESS_MEMBER_ID']} = user_id");
                          $result->execute();
                          for($i=1; $row = $result->fetch(); $i++){ 
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['date_applied']; ?></td>
                              <td><?php echo $row['ref_no']; ?></td>
                              <td><?php echo $row['loan_type']; ?></td>
                              <td><?php echo $row['loan_tenure']; ?></td>
                              <td><?php echo $row['desired_amount']; ?></td>
                              <td><?php echo $row['loan_expiry_date']; ?></td>
                              <!-- <td><?php echo $row['balance']; ?></td> -->
                              <!-- <td>
                                <div>
                                  <?php
                                  if ($row['payment_status'] == "cleared") {
                                    echo "<p class='badge badge-success'>Cleared</p>";
                                  } else {
                                    echo "<p class='badge badge-danger'>Not Cleared</p>";
                                  }
                                  ?>
                                </div>
                              </td> -->
                              <td>
                                <div>
                                  <?php
                                  if ($row['status'] == "Approved") {
                                    echo "<p class='badge badge-success'>Waiting</p>";
                                  } else {
                                    echo "<p class='badge badge-danger'>Not Approved</p>";
                                  }
                                  ?>
                                </div>
                              </td>
                              <!-- <td>
                                <div>
                                    <?php
                                    if ($row['status'] == "Not Approved") {
                                      echo "";
                                    } else {
                                      echo "<a href=\"#\" data-id=\"" . $row['id'] . "\" data-toggle=\"modal\" data-target=\"#makepayment\" class=\"btn btn-icon btn-success make-payment\"><i class=\"fas fa-dollar-sign\"></i> Make Payment</a>";
                                    }
                                    ?>
                                  </div>
                              </td> -->
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
      <!-- Make loan payment -->
      <div class="modal fade" id="makepayment" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="formModal">Make Payment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="process_payment.php" method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputRefNo">Reference Number</label>
                    <input type="text" class="form-control" id="ref_no" name="ref_no" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputLoanType">Loan Type</label>
                    <input type="text" class="form-control" id="loan_type" name="loan_type" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputRefNo">Amount</label>
                    <input type="text" class="form-control" id="desired_amount" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputLoanType">Balance</label>
                    <input type="text" class="form-control" id="balance" name="loan_type" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAmount">Payment Amount</label>
                  <input type="number" class="form-control" id="inputAmount" name="payment_amount" required>
                </div>
                <div class="form-group">
                  <label for="inputPaymentMethod">Payment Method</label>
                  <select class="form-control" id="inputPaymentMethod" name="payment_method" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="cash">Cash</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Make Payment</button>
              </form>
            </div>
          </div>
        </div>
      </div>

            
    </div>
  </section>
  <?php include 'includes/modal.php'; ?>
   
</div>
<?php include 'includes/footer.php'; ?>
</div>
</div>
<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="assets/bundles/datatables/datatables.min.js"></script>
<script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/sweetalert.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/datatables.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>



</body>


<!-- datatables.html  21 Nov 2019 03:55:25 GMT -->
</html>