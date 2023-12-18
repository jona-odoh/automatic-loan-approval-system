<!-- Apply Loan Modal -->
<div class="modal fade " id="applyLoanModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
  aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModal">Add Loan Type</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="save_application" enctype="multipart/form-data" >
					<h3>Personal Information</h3>
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">Full Name*</label>
							<input type="text" class="form-control" name="fullname" value="<?php echo $_SESSION['SESS_FIRST_NAME'];?> <?php echo $_SESSION['SESS_LAST_NAME'];?>"  >
						</div>
					</div>
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">Date of Birth*</label>
							<input type="date" class="form-control" name="dob" id="dob"  >
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputLoanType">Email*</label>
							<input type="email" class="form-control" name="email" value=" <?php echo $_SESSION['SESS_EMAIL'];?>" >
						</div>
						<div class="form-group col-md-6">
							<label for="inputLoanPlans">Phone Number</label> 
							<input type="text" class="form-control" name="contact_no" value=" <?php echo $_SESSION['SESS_PHONE_NUMBER'];?>" >
						</div>
					</div> 
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">National ID*</label>
							<input type="text" class="form-control" name="national_id" >
						</div>
					</div>
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">Tax Number*</label>
							<input type="text" class="form-control" name="tax_id" >
						</div>
					</div>
					
					<h3>Employment Information</h3>
					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputLoanType">Employment Status*</label>
							<select class="form-control" name="job_status">
								<option value="employed">Employed</option>
								<option value="unemployed">Unemployed</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label class="form-label">Current Employer</label>
							<input type="text" name="employer" class="form-control" >
						</div>
					</div> 
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">Job Title</label>
							<input type="text" name="job" class="form-control" >
						</div>
					</div>
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">Net income per month</label>
							<input type="text" name="income" class="form-control" >
						</div>
					</div>
					<div class="form-group form-float">
						<div class="form-line">
							<label class="form-label">Employment Duration</label>
							<input type="text" name="e_duration" class="form-control" >
						</div>
					</div>
					
					<h3>Loan Information</h3>
					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputLoanType">Monthly Expenses*</label>
							<input type="text" class="form-control" name="expenses">
						</div>
						<div class="form-group col-md-6">
							<label for="inputLoanType">Loan Type</label>
							<select class="form-control" name="loan_type" id="loan_type">
								<option value="">--Select--</option>
								<?php
								// 'includes/connect.php';
								$result = $db->prepare("SELECT * FROM loan_type");
								$result->execute();
								for ($i = 1; $row = $result->fetch(); $i++) {
									?>
									<option value="<?php echo $row['ltype_name']; ?>"><?php echo $row['ltype_name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputLoanPlans">Interest</label> 
							<?php
								// 'includes/connect.php';
								$result = $db->prepare("SELECT * FROM loan_plan WHERE id = 10  ");
								$result->execute();
								for ($i = 1; $row = $result->fetch(); $i++) {
									?>
							<input type="text" class="form-control" name="interest" value="<?php echo $row['lplan_interest']; ?>" readonly >
							<?php } ?>
						</div>
						<div class="form-group col-md-6">
							<label for="inputLoanPlans">Existing loan commitments*</label> 
							<input type="text" class="form-control" name="exLoan" >
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputLoanPlans">Loan Tenure</label> 
							<input type="text" class="form-control" name="loan_tenure" >
						</div>
						<div class="form-group col-md-6">
								<label for="inputLoanPlans">Desired Loan Amount*</label> 
								<input type="text" class="form-control" name="desired_amount" >
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
								<label for="inputLoanType">Guarantor Name*</label>
								<input type="text" class="form-control" name="guarantor_name" >
							</div>
							<div class="form-group col-md-6">
								<label for="inputLoanPlans">Guarantor Phone Number</label> 
								<input type="text" class="form-control" name="guarantor_no" >
							</div>
						</div> 
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="form-label">Guarantor National ID*</label>
								<input type="text" name="guarantor_national_id" class="form-control" >
							</div>
							<div class="form-group col-md-6">
								<label for="inputLoanType">Purpose of Loan*</label>
								<textarea class="form-control" name="purpose" rows="100px" ></textarea>
							</div>
						</div> 
						

						<h3>Documents</h3>
						
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputLoanType">National ID*</label>
								<input type="file" class="form-control" name="up_national_id" >
							</div>
							<div class="form-group col-md-6">
								<label for="inputLoanType">Bank Statement*</label>
								<input type="file" class="form-control" name="bank_statement" >
							</div>
						</div> 
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputLoanType">Guarantor Photo*</label>
								<input type="file" class="form-control" name="gurantor_pic" >
							</div>
							<div class="form-group col-md-6">
								
							</div>
						</div>


						<h3>Account Information</h3>
						
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputLoanType">Account Number*</label>
								<input type="text" class="form-control" name="acct_no" >
							</div>
							<div class="form-group col-md-6">
								<label for="inputLoanType">Bank Name*</label>
								<input type="text" class="form-control" name="bank" >
							</div>
						</div> 
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputLoanType">BVN (Bank Verification Number)*</label>
								<input type="text" class="form-control" name="bvn" >
							</div>
							<div class="form-group col-md-6">
								<label for="inputLoanPlans">Credit Card Number*</label> 
								<input type="text" class="form-control" name="acct_name" >
							</div>
						</div>
						
						
						
					<h3>Terms &amp; Conditions - Finish</h3>
					<p>By submitting your loan application, you acknowledge that you have read, comprehended, and unequivocally agree to these Terms and Conditions. These Terms are subject to periodic updates, and as such, we encourage you to periodically review them.</p>
						<input id="acceptTerms-2" name="acceptTerms" type="checkbox" >
						<label for="acceptTerms-2">I agree with the Terms and Conditions.</label><br>
					
					<button class="btn btn-primary m-t-15 waves-effect">Apply</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function () {
        // On change of loan type, fetch and set the interest rate
        $('#loan_type').change(function () {
            var selectedLoanType = $(this).val();

            // Make an AJAX request to fetch the interest rate based on the selected loan type
            $.ajax({
                type: 'POST',
                url: 'get_interest_rate.php',
                data: {'loan_type': selectedLoanType},
                dataType: 'json',
                success: function (data) {
                    // Update the interest input field with the fetched interest rate
                    $('#interest').val(data.interest);
                },
                error: function () {
                    console.log('Error fetching interest rate');
                }
            });
        });
    });
</script>

