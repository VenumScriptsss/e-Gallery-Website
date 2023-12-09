<?php
  if (isset($_POST['signin-submit'])) {

    $conx = mysqli_connect("localhost", "root", "", "loginsys");
    if (!$conx) {
      die("connection faild:".mysqli_connect_error());
    }
    $username = $_POST['username'];
    $usermail = $_POST['usermail'];
    $userpwd = $_POST['userpass'];

    if(empty($username)||empty($usermail)||empty($userpwd)){
      header("location:../signin.php?error=emptyfields&uname=".$username."&mail=".$usermail);
      exit();
    }
    else if (!filter_var($usermail,FILTER_VALIDATE_EMAIL)&& !perg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("location:../signin.php?error=invalidmailUname");
      exit();
    }
    elseif (!filter_var($usermail,FILTER_VALIDATE_EMAIL)) {
      header("location:../signin.php?error=invalidmail&Uname=".$username);
      exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("location:../signin.php?error=invalidUname&mail=".$usermail);
      exit();
    }
    else {
       $sql = "SELECT username FROM Users WHERE username = ?";
       $stmt = mysqli_stmt_init($conx);
       if (!mysqli_stmt_prepare($stmt,$sql)) {
         header("location:../signin.php?error=sqlerror");
         exit();
       }
       else {
         mysqli_stmt_bind_param($stmt, "s", $username);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
         $resaultCheck = mysqli_stmt_num_rows($stmt);
         if ($resaultCheck > 0) {
           header("location:../signin.php?usernametaken&mail=".$username);
           exit();
         }
         else {
           $sql = "INSERT INTO Users (username, usermail, userpwd) VALUES(?, ?, ?)";
           $stmt = mysqli_stmt_init($conx);
           if (!mysqli_stmt_prepare($stmt,$sql)) {
             header("location:../signin.php?error=sqlerror");
             exit();
           }
           else {
             $hashedpwd = password_hash($userpwd, PASSWORD_DEFAULT);
             mysqli_stmt_bind_param($stmt , "sss", $username,$usermail,$hashedpwd);
             mysqli_stmt_execute($stmt);
             session_start();
			       $_SESSION['userid'] = $username;
             header("location:../main.php?signup=success");
             exit();
           }
         }
       }
     }
       mysqli_stmt_close($stmt);
       mysqli_close($conx);


  }
    else {
      header("location:../index.php");
      exit();
    }
  ?>
