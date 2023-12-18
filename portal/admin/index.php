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
          <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon l-bg-purple">
                    <i class="fas fa-exclamation"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="padding-20">
                      <div class="text-right">
                        <h3 class="font-light mb-0">
                        <?php
                        // include('../connect.php');
                        $result = $db->prepare("SELECT count(*) as total FROM borrower WHERE approval_status = '' ");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>
                          <i class="ti-arrow-up text-success"></i> <?php echo $row['total']; ?>
                          <?php } ?>
                        </h3>
                        <span class="text-muted">Pending Loans</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon l-bg-green">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="padding-20">
                      <div class="text-right">
                      <?php
                        // include('../connect.php');
                        $result = $db->prepare("SELECT count(*) as total FROM borrower WHERE approval_status = 'paid'");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>
                        <h3 class="font-light mb-0">
                          <i class="ti-arrow-up text-success"></i> <?php echo $row['total']; ?>
                        </h3>
                        <?php } ?>
                        <span class="text-muted">Approved Loans</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon l-bg-cyan">
                    <i class="fas fa-chart-line"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="padding-20">
                      <div class="text-right">
                        <h3 class="font-light mb-0">
                        <?php
                        // include('../connect.php');
                        $result = $db->prepare("SELECT count(*) as total FROM borrower WHERE approval_status = 'paid'");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                        ?>
                          <i class="ti-arrow-up text-success"></i> <?php echo $row['total']; ?>
                        </h3>
                        <?php } ?>
                        <span class="text-muted">Active Loans</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon l-bg-orange">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="padding-20">
                      <div class="text-right">
                        <h3 class="font-light mb-0">
                          <i class="ti-arrow-up text-success"></i> $5,263
                        </h3>
                        <span class="text-muted">All Loans</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!-- <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
              <div class="card ">
                <div class="card-header">
                  <h4>Revenue chart</h4>
                  <div class="card-header-action">
                    <div class="dropdown">
                      <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                      <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                        <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                          Delete</a>
                      </div>
                    </div>
                    <a href="#" class="btn btn-primary">View All</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-9">
                      <div id="chart1"></div>
                      <div class="row mb-0">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                class="col-green"></i>
                              <h5 class="m-b-0">$675</h5>
                              <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                                class="col-orange"></i>
                              <h5 class="m-b-0">$1,587</h5>
                              <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <div class="list-inline text-center">
                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                class="col-green"></i>
                              <h5 class="mb-0 m-b-0">$45,965</h5>
                              <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="row mt-5">
                        <div class="col-7 col-xl-7 mb-3">Total customers</div>
                        <div class="col-5 col-xl-5 mb-3">
                          <span class="text-big">8,257</span>
                          <sup class="col-green">+09%</sup>
                        </div>
                        <div class="col-7 col-xl-7 mb-3">Total Income</div>
                        <div class="col-5 col-xl-5 mb-3">
                          <span class="text-big">$9,857</span>
                          <sup class="text-danger">-18%</sup>
                        </div>
                        <div class="col-7 col-xl-7 mb-3">Project completed</div>
                        <div class="col-5 col-xl-5 mb-3">
                          <span class="text-big">28</span>
                          <sup class="col-green">+16%</sup>
                        </div>
                        <div class="col-7 col-xl-7 mb-3">Total expense</div>
                        <div class="col-5 col-xl-5 mb-3">
                          <span class="text-big">$6,287</span>
                          <sup class="col-green">+09%</sup>
                        </div>
                        <div class="col-7 col-xl-7 mb-3">New Customers</div>
                        <div class="col-5 col-xl-5 mb-3">
                          <span class="text-big">684</span>
                          <sup class="col-green">+22%</sup>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </section>
        <?php include '../setting.php'; ?>
      </div>
      <?php include '../footer.php'; ?>
    </div>
  </div>
  <?php include 'script.php'; ?>
</body>
</html>