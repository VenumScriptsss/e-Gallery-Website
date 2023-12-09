<?php
	if (isset($_POST['login-submit'])) {
		
		$conx = mysqli_connect("sql102.epizy.com", "epiz_29202558", "aeUKS1W2Jo", "loginsys");
    	if (!$conx) {
      		die("connection faild:".mysqli_connect_error());
    	}

		$usermail = $_POST['usermail'];
		$userpwd = $_POST['userpass'];

		if (empty(usermail) || empty(userpwd)) {

			header("location:../login.php?error=emptyfields");
			exit();
		}
		else{
			$sql = "SELECT * FROM users WHERE usermail=? OR username=?;";
			$stmt = mysqli_stmt_init($conx);
			if(!mysqli_stmt_prepare($stmt,$sql)){
				header("location:../login.php?error=sqlerror");
				exit();	
			}
			else{
				mysqli_stmt_bind_param($stmt,"ss",$usermail,$usermail);
				mysqli_stmt_execute($stmt);
				$resault = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($resault)){
					$pwdcheck = password_verify($userpwd,$row['userpwd']);
					if(pwdcheck == true ){
						session_start();
						$_SESSION['userid'] = $row['username'];
						header("location:../main.php?login=success");
						exit();
					}
					else{
						header("location:../login.php?error=wrongpwd");
						exit();
					}
				}
				else{
					header("location:../login.php?error=usernotfound");
					exit();
				}
			}
			}
		}


	
	else{
		header("location:../header.php");
		exit();
	}
?>