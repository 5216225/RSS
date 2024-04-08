<header class="app-header">
  <a class="app-header__logo" href="dashboard.php">RSS</a>
  <!-- Sidebar toggle button-->
  <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar">
    <span></span>
    <span></span>
    <span></span>
  </a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    <!-- User Menu-->
    <li class="dropdown">
      <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
        <i class="fa fa-user fa-lg"></i>
        <strong>Welcome Back : </strong>Admin
      </a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="change-password.php"><i class="fa fa-cog fa-lg"></i> Change Password</a></li>
        <li><a class="dropdown-item" href="../emp/my-profile.php"><i class="fa fa-user fa-lg"></i> Profile</a></li>
        <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</header>

<style>
/* Header Styles */
.app-header {
  background: linear-gradient(to right, #6A11CB, #2575FC); /* Gradient background */
  color: #fff; /* White text color */
  padding: 10px 20px; /* Add padding */
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Add shadow */
}

.app-header__logo {
  text-decoration: none;
  background: linear-gradient(to right, #6A11CB, #2575FC); /* Gradient background */
  font-weight: bold;
  font-size: 24px;
  transition: all 0.3s ease; /* Add transition */
}

.app-nav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
}

.app-nav__item {
  text-decoration: none;
  color: #fff;
  padding: 10px;
  transition: all 0.3s ease; /* Add transition */
}

.dropdown-menu {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  z-index: 1;
  border-radius: 4px; /* Add border radius */
  box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Add shadow */
}

.dropdown-menu-right {
  right: 0;
}

.dropdown:hover .dropdown-menu {
  display: block;
}

/* Animation */
.app-header__logo:hover, .app-nav__item:hover {
  transform: translateY(-3px); /* Add translateY */
  box-shadow: 0 6px 12px rgba(0,0,0,0.1); /* Add shadow */
}


</style>