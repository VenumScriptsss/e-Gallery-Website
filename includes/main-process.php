<?php 
session_start();
 if (isset($_POST['upsubmit'])) {
 	$conx = mysqli_connect("localhost", "root", "", "gallery");
	if (!$conx) {
  		die("connection faild:".mysqli_connect_error());
	}
 	$userName = $_SESSION['userid'];
 	$file = $_FILES['file'];
 	$fileName = $file['name'];
 	$fileSize = $file['size'];
 	$fileType = $file['type'];
 	$fileTmpName = $file['tmp_name'];
 	$fileError = $file['error'];

 	$fileExpld = explode(".",$fileName);
 	$fileExt = strtolower(end($fileExpld));

 	$allowed = array("jpg", "jpeg", "png", "pdf", "mp4");

 	

 	if (in_array($fileExt, $allowed)) {
 		if ($fileError === 0) {
 			if ($fileSize < 10000000) {
 				$filename = reset($fileExpld);
 				$fileNewname = reset($fileExpld) . "." . uniqid("",true) . "." . $fileExt;
 				$fileDestination = "../gallery/" . $fileNewname;

 				$sql = "SELECT * FROM usersgallery;";
 				$stmt = mysqli_stmt_init($conx);
 					if (!mysqli_stmt_prepare($stmt,$sql)) {
 					echo "SQL error!";
 				}
 				else{
 					mysqli_stmt_execute($stmt);
 					$result = mysqli_stmt_get_result($stmt);
 					$numrows = mysqli_num_rows($result);
 					$order = $numrows + 1;
 					$sql = "INSERT INTO usersgallery (NAMEgallery,TYPEgallery,ORDERgallery,USERgallery,FULLNAMEgallery) VALUES (?,?,?,?,?);";
 					if (!mysqli_stmt_prepare($stmt,$sql)) {
 					echo "SQL error!";
 					}
 					mysqli_stmt_bind_param($stmt,"sssss",$filename,$fileExt,$order,$userName,$fileNewname);
 					mysqli_stmt_execute($stmt); 

 					move_uploaded_file($fileTmpName,$fileDestination);
 					header("location:../main.php?upload=success");
 				}

 			}
 			else{
 				echo "File size is too big";
 				exit();
 			}
 		}
 		else{
 			echo "upload error!";
 			exit();
 		}

 	}
 	else{
 		echo "File type is not allowed!";
 		exit();
 	}

 }

