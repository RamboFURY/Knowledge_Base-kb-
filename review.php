<?php
session_start();
require_once("dbconnect.php");

if(isset($_GET['auth_id']))
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $result = $dbconnection->getunapproved($_GET['auth_id']);
  $rows = $result->fetch_array(MYSQLI_ASSOC);
  $num_rows = $result->num_rows;
}
else
{
  $num_rows = 0;
}
?>

 <!Doctype html>
 <html>
 <head>
   <title>Review Issue - AIS Knowledge Base</title>
   <link rel="stylesheet" href="css\style.css">
   <link rel="icon" type="image/png" href="images\favicon.png">
 </head>
 <body>
   <header>
     <div class="logo">
         <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
     </div>
             <nav class="searchres-bar">
                 <ul class="nav-list">
                   <li>
                     <form class="searchform searchform-nav" action="search.php" method="get">
                         <div class="form-group">
                             <input type="text" name="query" class="searchbox searchbox-nav" id="username" placeholder="Search..." <?php if(isset($_GET['query'])) {echo 'value="'.$_GET['query'].'"';}?>>
                             <button type="submit" class="btn btn-secondary searchbtn searchbtn-nav">Search</button>
                         </div>
                     </form>
                   </li>
                     <li><a class = "nav-darklnk" href="addissue.php"><button type="submit" class="nav-btn">Add Issue</a></li>
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


 <main class="post-main">
   <?php
   if(isset($_SESSION['approved']) && $_SESSION['approved'] == true)
   {
     echo '<div class="postcontainer">
           <p class="success">Issue approved successfully.</p>
           </div>';
     unset($_SESSION['approved']);
   }
   elseif($num_rows > 0)
   {
     echo '<div class="postcontainer">
            <p class="titlelabel"><b>Title</b></p>
            <p class="title">'.htmlentities($rows['title']).'</p>
            <p class="descriptionlabel"><b>Description</b></p>
            <p class="description">'.htmlentities($rows['description']).'</p>
            <p class="resolutionlabel"><b>Resolution</b></p>
            <p class="resolution">'.htmlentities($rows['resolution']).'</p>
          </div>
          <div class="postpanel">
            <form action="approve.php" method="post">
              <input type="hidden" name="auth_id" value="'.htmlentities($_GET['auth_id']).'">
              <button type="submit" class="nav-btn btn2">Approve</button>
            </form>
            </div>';
    }
    else
    {
      echo '<div class="postcontainer">
            <p class="error">Issue already approved or does not exist.</p>
            </div>';
    }
    ?>
 </main>
 </body>
 </html>
