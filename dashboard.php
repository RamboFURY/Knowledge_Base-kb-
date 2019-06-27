<?php

// Start session user login

session_start();
if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Dashboard - Knowledge Center</title>
    <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images\favicon.png"><!--Favicon image at the top with title of browser tab-->
</head>

<body>
  <header>
    <div class="logo">
        <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
    </div>
    <!-- Nav bar -->
            <nav>
                <ul class="nav-list">
                  <?php
                    if($_SESSION['role_type'] == 'superadmin')
                    {
                      echo '<li><a class = "nav-darklnk" href="superadmin.php"><button type="submit" class="nav-btn">Admin Dashboard</button></a></li>';
                    }
                    ?>
                    <li><a class = "nav-darklnk" href="addissue.php"><button type="submit" class="nav-btn">Add Issue</button></a></li>
                    <li>
                      <div class="dropdown">
                        <button type="submit" class="nav-btn"><?php echo $_SESSION['name']; ?></button>
                        <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                        </div>
                      </div>
                    </li>
                </ul>
            </nav>
  </header>

<!-- Display searchbox  -->

<main>
<div class="dashboard-container">
  <form class="searchform" action="search.php" method="get">
      <div class="form-group">
          <input type="text" name="query" class="searchbox" id="username" placeholder="Search...">
          <button type="submit" class="btn btn-secondary searchbtn">Search</button>
      </div>
  </form>
</div>
</main>
</body>
</html>
