      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseurl;?>index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Tableau de bord</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#members" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Members</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="members">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl;?>add_members.php">Add Member</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl;?>all_members.php">All Members</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $baseurl;?>pages/add_transaction.php">
              <i class="icon-layers menu-icon"></i>
              <span class="menu-title">Add Transaction</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Reports</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reports">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl;?>pages/reports/yearly_reports.php">Yearly Reports</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl;?>pages/reports/custom_reports.php">Custom Reports</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl;?>pages/reports/saved_queries.php">Saved Queries</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>