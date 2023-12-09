<?php
  session_start();  
  if (!isset($_SESSION['userid'])) {
    header("location:../login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html >
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/album-style.css">
    <title>Yourspace - Albums</title>
  </head>
  <body>
    <div class="nav-wrapper"> 

      <div class="name">
        <a href="../main.php"><h1>YourSpace</h1></a>
      </div>
      <div class="search-bar">
        <form action="search.php" method="get"> 
          <input type="text"  name="search"  value="Submit" placeholder="Search...">
        </form>
      </div>
      <div class="far-right">

        <div class="upload-btn">

          <form action="main-process.php" method="post" enctype="multipart/form-data">

            <input type="file" name="file" id="realUploadFile" hidden="hidden">
            
            <input type="submit" name="upload" value="Submit" id="uploadSub" hidden="hidden">

          </form>

          <button id="uploadClone">upload</button>
          <button id="subClone"><p>></p></button>

        </div> 

        <div class="username">
          <a href="profile.php"> 
            <h3>
              <?php
                echo $_SESSION['userid'];
              ?>
            </h3>
          </a> 
        </div>
        <a href="logout.php" class="log-out">
          <img src="../styles/pics/logout-24.ico" >
          <p>logout</p>
        </a>
      </div>

    </div>
    <div class="main" >
      <nav class="side-bar">
      <img src="../styles/pics/arrow-31-16.ico " class="side-arw">
        <ul class="sidebar-cont">
              <li class="list-item">
                <a href="fav.php" class="item-link">
                  <div class="item-icon">
                    <img src="../styles/pics/favorite-2-24.ico">
                  </div>

                    
                  <div class="text">
                   
                    <p>favorites</p>
                  </div>

                </a>
              </li>
              <li class="list-item">
                <a href="album.php" class="item-link">
                  <div class="item-icon">
                    <img src="../styles/pics/book-2-24.ico">
                  </div>

                   <div class="text">
                    <p>album</p>
                  </div>

                </a>
              </li>
              <li class="list-item">
                <a href="trash.php" class="item-link">
                  <div class="item-icon">
                    <img src="../styles/pics/delete-24.ico">
                  </div>

                   <div class="text">
                    <p>trash</p>
                  </div>

                </a>
              </li>
              
        </ul>
      </nav>
      <div class="mid-sec">

         
        
        <div class="pics"> 
        <?php        
          $userName = $_SESSION['userid'];

           $conx = mysqli_connect("localhost", "root", "", "gallery");
          if (!$conx) {
              die("connection faild:".mysqli_connect_error());
          }
          else {
                
                $sql = "SELECT * FROM albums WHERE AlbumUser='".$userName."';";
                $stmt = mysqli_stmt_init($conx);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                  echo "sql error1";            
                }
                else{
                  //GETTING THE BACKGROUND IMG FOR EACH ALBUM
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)){
                        $sql = "SELECT * FROM usersgallery WHERE AlbumName ='".$row['AlbumName']."' AND USERgallery='".$userName."' LIMIT 1;";
                        $stmt = mysqli_stmt_init($conx);
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                          echo "sql error2";            
                        }
                        else{
                          mysqli_stmt_execute($stmt);
                          $result2 = mysqli_stmt_get_result($stmt);
                            while($row2 = mysqli_fetch_assoc($result2)){
                              echo "<div class='albumslist'>
                                        <form action='album-content.php' method=post>
                                          <button type='submit' name='albm' value='".$row2['AlbumName']."'><img src ='../gallery/".$row2['FULLNAMEgallery']."' ></button>
                                        </from>
                                        <div class='albumname'><p>".$row2['AlbumName']."</p></div>
                                    </div>";

                                      
                          }
                        
                        
                      }
                   
                  }
                }
              }
          ?>
          
          <div class="album-form">
            
          </div>
      </div>
        
        </div>  

        
      </div>
      
