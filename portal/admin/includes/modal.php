<!-- Add loan type Modal -->
<div class="modal fade" id="loanTypeModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Add Loan Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="save_loan_type.php" enctype="multipart/form-data">
          <div class="form-group">
            <label>Loan Name</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="text" class="form-control" name="ltype_name">
            </div>
          </div>
          <div class="form-group">
            <label>Status</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <select class="form-control" name="status">
                <option value="Active">Active</option>
                <option value="Not Active">Not Active</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <textarea class="form-control" name="ltype_desc"></textarea>
            </div>
          </div>
          <button class="btn btn-primary m-t-15 waves-effect">SAVE</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Add users Modal -->
<div class="modal fade" id="users" tabindex="-1" role="dialog" aria-labelledby="formModal"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="save_users.php" enctype="multipart/form-data" >

          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6 col-12">
                <label>First Name</label>
                <input type="text" class="form-control" name="firstname" >
                <div class="invalid-feedback">
                  Please fill in the first name
                </div>
              </div>
              <div class="form-group col-md-6 col-12">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastname">
                <div class="invalid-feedback">
                  Please fill in the last name
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-7 col-12">
                <label>Username</label>
                <input type="text" class="form-control" name="username">
                <div class="invalid-feedback">
                  Please fill in the username
                </div>
              </div>
              <div class="form-group col-md-5 col-12">
                <label>password</label>
                <input type="text" class="form-control" name="password" value="password" >
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-7 col-12">
                <label>Email</label>
                <input type="email" class="form-control" name="email">
                <div class="invalid-feedback">
                  Please fill in the email
                </div>
              </div>
              <div class="form-group col-md-5 col-12">
                <label>Phone</label>
                <input type="tel" class="form-control" name="phone" >
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-7 col-12">
                <label>State</label>
                <input type="text" class="form-control" name="state" >
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
              <div class="form-group col-md-7 col-12">
                <label>Role</label>
                <select class="form-control" name="role">
                  <option value="adminstrator">Adminstrator</option>
                  <option value="lender">Lender</option>
                </select>
                <div class="invalid-feedback">
                  Please select role
                </div>
              </div>
              <div class="form-group col-md-5 col-12">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
              </div>
            </div>
          </div>
          <div class="text-right">
            <button class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<!-- Edit Users Modal -->
<!-- <div class="modal fade" id="editusers" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="update_loan_type.php" enctype="multipart/form-data">
          <input type="hidden" name="id" value="">
          <div class="form-group">
            <label>Loan Name</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
              <input type="text" class="form-control" name="ltype_name">
            </div>
          </div>
          <div class="form-group">
            <label>Status</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
              <select class="form-control" name="status">
                <option value="Active">Active</option>
                <option value="Not Active">Not Active</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <div class="input-group">
              <div class="input-group-prepend"></div>
              <textarea class="form-control" name="ltype_desc"></textarea>
            </div>
          </div>
          <button class="btn btn-primary m-t-15 waves-effect">SAVE</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).on('click', '.edit-loan', function() {
    var Id = $(this).data('id');

  // Fetch the loan type information from the database using AJAX
    $.ajax({
    url: 'loan_type.php', // Create a PHP script to fetch loan type information
    method: 'GET',
    data: { id: Id },
    dataType: 'json',
    success: function(data) {
      // Populate the editing modal with the fetched data
      $('#editusers').modal('show');
      $('#editusers').find('input[name="ltype_name"]').val(data.ltype_name);
      $('#editusers').find('select[name="status"]').val(data.status);
      $('#editusers').find('textarea[name="ltype_desc"]').val(data.ltype_desc);
      $('#editusers').find('input[name="id"]').val(Id);
    }
  });
  });

</script>
 -->






<!-- Add loan plan Modal -->
<div class="modal fade" id="loanPlanModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Add Loan Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="save_loan_plan.php" enctype="multipart/form-data">
          <div class="form-group">
            <label>Plan(Month)</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="text" class="form-control" name="lplan_month">
            </div>
          </div>
          <div class="form-group">
            <label>Interest</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="number" class="form-control" name="lplan_interest">
              <div class="input-group-append">
                <div class="input-group-text">%</div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Monthly Overdue Penalty</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="number" class="form-control" name="lplan_penalty">
              <div class="input-group-append">
                <div class="input-group-text">%</div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Status</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <select class="form-control" name="status">
                <option value="Active">Active</option>
                <option value="Not Active">Not Active</option>
              </select>
            </div>
          </div>
          <button class="btn btn-primary m-t-15 waves-effect">SAVE</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Borrower Modal -->
<div class="modal fade" id="borrowerModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModal">Add Borrower</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
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
    </div>
  </div>
</div>

<!-- Payment modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Content goes here....
      </div>
    </div>
  </div>
</div>