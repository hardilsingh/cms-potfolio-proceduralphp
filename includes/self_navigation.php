
<nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="../main.php" class="navbar-brand">Blogen</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item px-2">
            <a href="../main.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item px-2">
            <a href="./posts.php" class="nav-link">Posts</a>
          </li>
          <li class="nav-item px-2">
            <a href="../categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item px-2">
            <a href="../users.php" class="nav-link">Users</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown mr-3">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-user"></i> <?php echo $_SESSION['username']?>
            </a>
            <div class="dropdown-menu">
              <a href='../profile.php?profile=<?php echo $_SESSION["user_id"]?>' class="dropdown-item">
                <i class="fas fa-user-circle"></i> Profile
              </a>
              <a href="../settings.php" class="dropdown-item">
                <i class="fas fa-cog"></i> Settings
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="fas fa-user-times"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
