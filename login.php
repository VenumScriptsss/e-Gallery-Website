<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>YourSpace - Login</title>
    <link rel="stylesheet" href="styles/loginstyle.css">
  </head>
  <body >
    <div class="main-sec">
      <div class="back-sign">
        <a href="index.php"><img src="styles/pics/back.ico"></a>
      </div>
	  <div class="form-container">
		  <div class="left-sec" >
			<div class="subtitles">
				<p>We Missed You !</p>
			</div>

		  </div>
		  <div class="right-sec">
			<div class="right-header"> <p>Login</p></div>
			<div >
				<form class="info" action="includes/login-process.php" method="post">
				  <div class="bar">
					<input type="text" name="usermail" placeholder="Email">
				  </div>
				  <div class="bar">
					<input type="password" name="userpass" placeholder="Password">
				  </div>
				  <div class="submit">
					<input type="submit" name="login-submit" value="Submit" style="background-color:#21D0B2;cursor: pointer;">
				  </div>
			  </form>
			</div>
			<div class="sign-in">
			  <button onclick="window.location.href='signin.php';" >Sign In!</button>
			</div>
		  </div>
	  </div>
  </body>
</html>
