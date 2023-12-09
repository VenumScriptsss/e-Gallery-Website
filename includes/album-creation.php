<?php 
  
  $conx = mysqli_connect("localhost", "root", "", "album");
      if (!$conx) {
          die("connection faild:".mysqli_connect_error());
      }
      else {
            if (isset($_POST['add'])){
                $albumName=$_POST['albumname'];  //album name
                $imgpath=$_POST['add'];
                $imgnameexpld = explode('/',$imgpath);
                $imgfname = end($imgnameexpld);  //img full name
                
              }
            else{
              echo "not working";
            }

 
            $sql = "SHOW TABLES FROM gallery;";
            $stmt = mysqli_stmt_init($conx);
            if (!mysqli_stmt_prepare($stmt,$sql)) {
              echo "sql error";            
            }
            
            else{
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              if (!$result){
                echo "result error";
              }
              else{
                while($row = mysqli_fetch_row($result)){
                  echo $row[0];
                  $tables[] =$row[0];
                }
              }
              /*
            if (!in_array($albumName, $tables) ) {
                echo " new album";
                  $sql = "CREATE TABLE ".$albumName." (
                          ImgName VARCHAR(20) NOT NULL UNIQUE ,
                          userName VARCHAR(20) NOT NULL UNIQUE,
                          ImgFullName VARCHAR(60) NOT NULL
                  );";

                if(!mysqli_stmt_prepare($stmt,$sql)){
                  echo "sql error in creating table";
                }
                else{
                  mysqli_stmt_execute($stmt);
                }  
            }

          $sql = "INSERT INTO ".$albumName." VALUES('".$imgName."', '".$userName."', '".$imgFullName."');";

          if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "still iserting sql error";
          }
          else{
            mysqli_stmt_execute($stmt);
            echo "album and img added sucessfully";
          }  
      */} 


}