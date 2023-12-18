<nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          
          <?php
          $result = $db->prepare("SELECT * FROM admin WHERE id = {$_SESSION['SESS_MEMBER_ID']}");
          $result->execute();
          for($i=1; $row = $result->fetch(); $i++){ 
           ?> 
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <?php
            if (!empty($row['photo'])) {
              echo '<img src="uploads/' . $row['photo'] . '" class="user-img-radious-style">';
            } else {
              echo '<img src="default.jpg" class="user-img-radious-style">';
            }
            ?>
            <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></div>
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> 
              <a href="settings.php" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="includes/logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        <?php } ?>
        </ul>
      </nav>