<?php
require_once("dbconnect.php");//requires once to establish connection with DB
session_start();
if(isset($_POST['auth_id']))
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $status = $dbconnection->approvepost($_POST['auth_id'], 0);//approval of new issue
  if($status == 1)
  {
    $_SESSION['approved'] = true;
    header("Location:review.php");
  }
  else
  {
    echo 'Post unavailable or already approved';
  }
}
elseif(isset($_POST['post_id']) && $_SESSION['role_type'] == 'superadmin')
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $status = $dbconnection->approvepost($_POST['post_id'], 1);//approval of new issue
  if($status == 1)
  {
    $_SESSION['approved'] = true;
    header('Location:post.php?post_id='.$_POST['post_id']);
  }
  else
  {
    echo 'Post unavailable or already approved';
  }
}
else
{
  echo "Invalid Request";
}
