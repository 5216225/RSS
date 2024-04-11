<aside class="app-sidebar">
  <ul class="app-menu">
    <li><a class="app-menu__item" href="dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-building-o"></i><span class="app-menu__label">Department</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="add-department.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Add Department</a></li>
        <li><a class="treeview-item" href="manage-department.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Manage Department</a></li>
      </ul>
    </li>

    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Leave Type</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="add-leave.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Add Leave</a></li>
        <li><a class="treeview-item" href="manage-leave.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Manage Leave</a></li>
      </ul>
    </li>

    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar"></i><span class="app-menu__label">Shifts</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="add-shift.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Add Shift</a></li>
        <li><a class="treeview-item" href="manage-shifts.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Manage Shifts</a></li>
      </ul>
    </li>

    <li class="treeview"><a class="app-menu__item" href="manage-feedback.php"><i class="app-menu__icon fa fa-comments"></i><span class="app-menu__label">Manage Feedback</span></a></li>
       
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Employee</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="add-employee.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i>Add Employee</a></li>
        <li><a class="treeview-item" href="manage-employee.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Manage Employee</a></li>
      </ul>
    </li>
        
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Salary</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="add-salary.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i>Add Salary</a></li>
        <li><a class="treeview-item" href="manage-salary.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Manage Salary</a></li>
      </ul>
    </li>

    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-files-o"></i><span class="app-menu__label">Leave Requests</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="new-leave-request.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i>New Requests</a></li>
        <li><a class="treeview-item" href="approved-leave-request.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Approved Requests</a></li>
        <li><a class="treeview-item" href="reject-leave-request.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> Rejected Requests</a></li>
        <li><a class="treeview-item" href="leave-history.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i> All Requests</a></li>
      </ul>
    </li>
    
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="emp-report.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i>Employee Report</a></li>
        <li><a class="treeview-item" href="leave-report.php" style="font-size: 16px;"><i class="icon fa fa-circle-o"></i>Leave Report</a></li>
      </ul>
    </li>
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