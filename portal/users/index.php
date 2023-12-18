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
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-cyan">
                    <i class="fas fa-hiking"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4 class="pull-right">Borrowed Loan</h4>
                    </div>
                    <div class="card-body pull-right">
                      200,490
                    </div>
                  </div>
                  <div class="card-chart">
                    <canvas id="chart-1" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-purple">
                    <i class="fas fa-drafting-compass"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4 class="pull-right">Paid Loans</h4>
                    </div>
                    <div class="card-body pull-right">
                      27,7730
                    </div>
                  </div>
                  <div class="card-chart">
                    <canvas id="chart-2" height="80"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-green">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4 class="pull-right">Wallet</h4>
                    </div>
                    <div class="card-body pull-right">
                      $17,458
                    </div>
                  </div>
                  <div class="card-chart">
                    <canvas id="chart-3" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>

           
          </div>
        </section>
         
      </div>
      <?php include 'includes/footer.php'; ?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script> 
  <!-- JS Libraies -->
  <script src="assets/bundles/chartjs/chart.min.js"></script>
  <script src="assets/bundles/jquery.sparkline.min.js"></script>
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <script src="assets/bundles/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="assets/bundles/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="assets/bundles/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>
   <script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/sweetalert/sweetalert.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/sweetalert.js"></script>
  <script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/form-wizard.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/widget-chart.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  
</body>


<!-- widget-chart.html  21 Nov 2019 03:50:03 GMT -->
</html>