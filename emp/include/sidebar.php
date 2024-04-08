<aside class="app-sidebar">
  <ul class="app-menu">
    <li><a class="app-menu__item" href="dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item" href="my-profile.php"><i class="app-menu__icon fa fa-key"></i><span class="app-menu__label">My Profile</span></a></li>
    
    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Leave</span><i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="apply-leave.php"><i class="icon fa fa-circle-o"></i>Apply Leave</a></li>
        <li><a class="treeview-item" href="leave-history.php"><i class="icon fa fa-circle-o"></i>Leave History</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-comments"></i><span class="app-menu__label">Feedback</span><i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="give-feedback.php"><i class="icon fa fa-circle-o"></i>Give Feedback</a></li>
        <li><a class="treeview-item" href="feedback-history.php"><i class="icon fa fa-circle-o"></i>Feedback History</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a class="app-menu__item" href="#" data-toggle="treeview">
        <i class="app-menu__icon fa fa-suitcase"></i><span class="app-menu__label">Shifts</span><i class="treeview-indicator fa fa-angle-right"></i>
      </a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="shifts.php"><i class="icon fa fa-circle-o"></i>Shifts</a></li>
        <li><a class="treeview-item" href="upcoming-shifts.php"><i class="icon fa fa-circle-o"></i>View your Schedule</a></li>
      </ul>
    </li>

    <li><a class="app-menu__item" href="salary-history.php"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Salary History</span></a></li>
    <li><a class="app-menu__item" href="logout.php"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Sign Out</span></a></li>
       
  </ul>
</aside>

<style>
/* Sidebar Styles */
.app-sidebar {
  background-color: #fff; /* White background color */
  width: 250px; /* Set the width */
  height: 100%; /* Make it full height */
  position: fixed;
  top: 0;
  left: 0;
  overflow-y: auto; /* Add scrollbar if content overflows */
  box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Add shadow */
  transition: all 0.3s ease; /* Add transition for smooth animation */
}

.app-menu {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.app-menu__item {
  text-decoration: none;
  color: #333; /* Dark text color */
  display: block;
  padding: 15px 20px;
  transition: all 0.3s ease; /* Add transition */
}

.app-menu__item:hover {
  background-color: black; /* Light background color on hover */
}

.app-menu__icon {
  margin-right: 10px;
}

.app-menu__label {
  vertical-align: middle;
}

.treeview-indicator {
  float: right;
  margin-top: 2px;
}

.treeview-menu {
  padding-left: 20px;
  overflow: hidden; /* Hide submenu items */
  max-height: 0; /* Initially hide submenu */
  transition: all 0.3s ease; /* Add transition for smooth animation */
}

.treeview-item.active .treeview-menu {
  max-height: 200px; /* Set max-height to show submenu items */
}

</style>