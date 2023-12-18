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
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="dollar-sign"></i><span>Loans</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="pending_loans">Pending Loans</a></li>
                <li><a class="nav-link" href="approve_loan">Aprroves Loans</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="payment" class="nav-link"><i data-feather="credit-card"></i><span>Payments</span></a>
            </li>
            <li class="dropdown">
              <a href="borrower" class="nav-link"><i data-feather="users"></i><span>Borrowers</span></a>
            </li>
            <li class="dropdown">
              <a href="loan_plan" class="nav-link"><i data-feather="briefcase"></i><span>Loan Interest</span></a>
            </li>
            <li class="dropdown">
              <a href="loan_type" class="nav-link"><i data-feather="folder"></i><span>Loan Type</span></a>
            </li>
            <li class="dropdown">
              <a href="profile" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
            </li>
            <li class="dropdown">
              <a href="users" class="nav-link"><i data-feather="user-plus"></i><span>Manage Users</span></a>
            </li>
            <li class="dropdown">
              <a href="settings" class="nav-link"><i data-feather="settings"></i><span>Settings</span></a>
            </li>
            <li class="dropdown">
              <a href="logout" class="nav-link"><i data-feather="log-out"></i><span>Logout</span></a>
            </li>
          </ul>
        </aside>
      </div>