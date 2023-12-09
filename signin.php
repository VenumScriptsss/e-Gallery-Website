<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>YourSpace - Signin</title>
    <link rel="stylesheet" href="styles/signinstyle.css">
  </head>
  <body >
    <div class="main-sec">
		
	  <div class="back-sign">
		<a href="index.php"><img src="styles/pics/back.ico"></a>
	  </div>
	  <div class="form-container">
		  <div class="left-sec" >
			<div class="subtitles">
				<p>NEW MEMBER ALEERT!</p>
				<div><h4 style="width:95px">Your Welcome</h4></div>
			</div>

		  </div>
		  <div class="right-sec">
			<div class="right-header"> <p>Singin</p></div>
			<div >
				<form class="info" action="includes/signin-process.php" method="post">
				  <div class="bar">
					<input type="text" name="username" placeholder="Username">
				  </div>
				  <div class="bar">
					<input type="text" name="usermail" placeholder="E-mail">
				  </div>
				  <div class="bar">
					<input type="password" name="userpass" placeholder="Password">
				  </div>
				  <div class="submit">
					<input type="submit" name="signin-submit" value="Submit" style="background-color:#21D0B2;cursor:pointer;">
				  </div>
			  </form>
			</div>
			<div class="log-in">
			  <p>you already have an account?</p>
			  <button onclick="window.location.href='login.php';" >Log In!</button>
			</div>
		  </div>
		</div>
	</div>
  </body>
</html>
