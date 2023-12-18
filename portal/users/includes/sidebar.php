<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <?php
          $result = $db->prepare("SELECT * FROM settings");
          $result->execute();
          for($i=1; $row = $result->fetch(); $i++){ 
           ?> 
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="../uploads/<?php echo $row['photo']; ?>" class="header-logo" /> <span
                class="logo-name"><?php // echo $row['title']; ?></span>
            </a>
          </div>
        <?php } ?>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="index" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" data-toggle="modal" data-target="#applyLoanModal" class="nav-link"><i data-feather="credit-card"></i><span>Get Loan</span></a>
            </li>
            <li class="dropdown">
              <a href="loans" class="nav-link"><i data-feather="credit-card"></i><span>Historys</span></a>
            </li>
            <li class="dropdown">
              <a href="profile" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
            </li>
            <li class="dropdown">
              <a href="logout" class="nav-link"><i data-feather="power"></i><span>Logout</span></a>
            </li>
          </ul>
        </aside>
      </div>

      <?php include 'includes/modal.php'; ?>