<?php 
	session_start();

	if (isset($_POST['add'])){
		$conx = mysqli_connect("localhost", "root", "", "gallery");
	    if (!$conx) {
	         die("connection faild:".mysqli_connect_error());
	     }
	    else {
		$albumname=$_POST['albumname'];
		$imgpath=$_POST['add'];
		$imgnameexpld = explode('/',$imgpath);
		$imgfname = end($imgnameexpld);
		
		$sql = "SELECT * FROM usersgallery WHERE FULLNAMEgallery = '".$imgfname."' AND USERgallery='".$_SESSION['userid']."';";
		$stmt = mysqli_stmt_init($conx);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "sql error";
		}
		else{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($result)){
					if($row['AlbumName']==$albumname){
					echo " image is already in this Album ".$row['AlbumName'];
					exit();
				}
					else if($row['AlbumName']!=$albumname && !empty($row['AlbumName'])){
						echo " image is already in an other Album ".$row['AlbumName'];
						exit();
					}
					else if(empty($row['AlbumName'])){

						$sql = "UPDATE  usersgallery SET AlbumName='".$albumname."' WHERE FULLNAMEgallery='".$imgfname."';";
						if(!mysqli_stmt_prepare($stmt,$sql)){
							echo "updating error";
						}
						else{
							mysqli_stmt_execute($stmt);
							$sql = "SELECT * FROM albums WHERE AlbumName='".$albumname."' AND AlbumUser='".$_SESSION['userid']."';";
							$stmt = mysqli_stmt_init($conx);
							if (!mysqli_stmt_prepare($stmt,$sql)) {
								echo "sql error";
							}
							else{
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);

								$resultCheck = mysqli_stmt_num_rows($stmt);
								if ($resultCheck == 0){
									$sql = "INSERT INTO albums(AlbumName,AlbumUser) VALUES('".$albumname."','".$_SESSION['userid']."');";
									$stmt = mysqli_stmt_init($conx);

									if(!mysqli_stmt_prepare($stmt,$sql)){
										echo "creating error";
									}
									else{
										mysqli_stmt_execute($stmt);
										header("location:../main.php?addtoalbum=done");	
									}
								}

								else{header("location:../main.php?addtoalbum=done");	}

							}/*
							$sql = "INSERT INTO albums(AlbumName,AlbumUser) VALUES('".$albumname."','".$_SESSION['userid']."');";
							if(!mysqli_stmt_prepare($stmt,$sql)){
								echo "creating error";
							}
							else{
								mysqli_stmt_execute($stmt);
								header("location:../main.php?addtoalbum=done");	
							}
						*/}
						
								}
							}
						} 
					}
				
			}
			
		
	
	
		if (isset($_POST['fav'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$imgpath=$_POST['fav'];
				$imgnameexpld = explode('/',$imgpath);
				$imgfname = end($imgnameexpld); 

				$sql = "UPDATE usersgallery SET FAVgallery=TRUE WHERE FULLNAMEgallery='".$imgfname."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					echo "done";
					header("location:../main.php?imgfaved");
										
				}
			}

		}
		if (isset($_POST['del'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$imgpath=$_POST['del'];
				$imgnameexpld = explode('/',$imgpath);
				$imgfname = end($imgnameexpld); 

				$sql = "UPDATE usersgallery SET DELETEDgallery= TRUE WHERE FULLNAMEgallery='".$imgfname."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					header("location:../main.php?imgdeleted");
										
				}
			}
		}
		if (isset($_POST['favdel'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$imgpath=$_POST['favdel'];
				$imgnameexpld = explode('/',$imgpath);
				$imgfname = end($imgnameexpld); 

				$sql = "UPDATE usersgallery SET FAVgallery= FALSE WHERE FULLNAMEgallery='".$imgfname."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					header("location:fav.php?imgUNfav");
										
				}
			}
		}
		if (isset($_POST['restore'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$imgpath=$_POST['restore'];
				$imgnameexpld = explode('/',$imgpath);
				$imgfname = end($imgnameexpld); 

				$sql = "UPDATE usersgallery SET DELETEDgallery= FALSE WHERE FULLNAMEgallery='".$imgfname."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					header("location:trash.php?imgrestored");
										
				}
			}
		}
		if (isset($_POST['trashdel'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$imgpath=$_POST['trashdel'];
				$imgnameexpld = explode('/',$imgpath);
				$imgfname = end($imgnameexpld); 

				$sql = "DELETE FROM usersgallery WHERE FULLNAMEgallery='".$imgfname."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					header("location:trash.php?imgfullyDeleted");
										
				}
			}
		}
		if (isset($_POST['albdel'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$imgpath=$_POST['albdel'];
				$imgnameexpld = explode('/',$imgpath);
				$imgfname = end($imgnameexpld); 

				$sql = "UPDATE usersgallery SET AlbumName= NULL WHERE FULLNAMEgallery='".$imgfname."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					header("location:fav.php?imgRmovedfromAlbum");
										
				}
			}
		}
	
		if (isset($_POST['delalb'])) {
			$conx = mysqli_connect("localhost", "root", "", "gallery");
		    if (!$conx) {
		         die("connection faild:".mysqli_connect_error());
		     }
		    else {
				$sql = "DELETE FROM albums WHERE AlbumName='".$_POST['delalb']."' AND AlbumUser= '".$_SESSION['userid']."';";
				$stmt = mysqli_stmt_init($conx);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "sql error";
				}
				else{
					mysqli_stmt_execute($stmt);
					$sql = "UPDATE usersgallery SET AlbumName= NULL WHERE USERgallery='".$_SESSION['userid']."' AND AlbumName= '".$_POST['delalb']."';";
					$stmt = mysqli_stmt_init($conx);
					if(!mysqli_stmt_prepare($stmt,$sql)){
						echo "sql error";
					}
					else{
						mysqli_stmt_execute($stmt);
						header("location:trash.php?albumDeleted");
										
				}
										
				}
			}
		}
		
 ?>