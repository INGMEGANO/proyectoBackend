<div class="nav">
    <div class="sb-sidenav-menu-heading">Core</div>
   <?php
     if($_SESSION['role']=='employee'){
   ?>

    <a class="nav-link" href="submitHours.php">
        <div class="sb-nav-link-icon"><i class="fas fa-keyboard"></i></div>
        Submit Hours
    </a>
    <a class="nav-link" href="listSubmittedHours.php">
        <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
        View Hours Submitted
    </a>
   <?php
     }
   ?>

   <?php
   if($_SESSION['role']=='admin'){
   ?>
    <a class="nav-link" href="createEmployees.php">
        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></i></div>
        Create Employee
    </a>
    <a class="nav-link" href="listEmployees.php">
        <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
        List Employees
    </a>
    <?php 
     }
    ?>

  <?php
   if($_SESSION['role']=='manager'){
   ?>
  
    <a class="nav-link" href="listEmployees.php">
        <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
        List Employees
    </a>
    <?php 
     }
    ?>

</div>
