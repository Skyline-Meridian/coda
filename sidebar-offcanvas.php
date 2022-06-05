<style>
  .sidebar .nav.sub-menu {
    padding: 0.75rem 0 0 1.87rem;
  }
</style>
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo $baseurl; ?>index.php">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Tableau de bord</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#members" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Membres</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="members">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl; ?>pages/add_members.php">Ajouter un membre</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl; ?>pages/all_members.php">Tous les membres</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo $baseurl; ?>pages/add_transaction.php">
        <i class="icon-layers menu-icon"></i>
        <span class="menu-title">Ajout de transaction</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Rapports</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="reports">
        <ul class="nav flex-column sub-menu">
          <!-- <li class="nav-item"> <a class="nav-link" href="<? php // echo $baseurl;
                                                                ?>pages/reports/yearly_reports.php">Rapports annuels</a></li> -->
          <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl; ?>pages/reports/custom_reports.php">Rapports personnalisés</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl; ?>pages/reports/tr_reports.php">Transactions rapport</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl; ?>pages/reports/saved_queries.php">Requêtes enregistrées</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo $baseurl; ?>pages/reports/donateurs_par_remarque.php">Liste Donateurs</a></li>
        </ul>
      </div>
    </li>
    <!-- <li class="nav-item">
            <a class="nav-link" href="<?php //echo $baseurl;
                                      ?>pages/logout.php">
              <i class="icon-layers menu-icon"></i>
              <span class="menu-title">logout</span>
            </a>
          </li> -->
  </ul>
</nav>