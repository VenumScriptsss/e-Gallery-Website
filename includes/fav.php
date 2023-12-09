<?php
  session_start();  
  if (!isset($_SESSION['userid'])) {
    header("location:login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html >
  <head>

    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/mainstyle.css">
    <title>Yourspace - Favorites</title>
  </head>
  <body>
    <div class="nav-wrapper"> 

      <div class="name">
        <a href="../main.php"><h1>YourSpace</h1></a>
      </div>
      <div class="search-bar">
        <form action="search.php" method="get"> 
          <input type="text"  name="search"   placeholder="Search...">
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
        <ul class="sidebar-cont">
        <img src="../styles/pics/arrow-31-16.ico " class="side-arw">
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
        <div class="preview">
                <img class="preview-img" src="">
                <p class="caption"></p>
                <div class="right-keys">
                  <ul>
                    
                    <li class="icon-cont" style="display:flex;">
                      <form  action="album-process.php" method="post">
                        <button type="submit" name="favdel" value="" style="background-color:transparent;border:none;"><img src="../styles/pics/delete-24.ico">
                        </button>
                      </form>
                        
                      <div><p class="imgcp" >delete</p></div>
                    </li>
                    <li class="icon-cont">
                      <div class="addalbum-img">
                        <img  src="../styles/pics/add-24.ico">
                        <p class="imgcp" >add</p>
                      </div>
                      <div class="albumform"><form  action="album-process.php" method="post">
                        <input class="albminpt" type="text" name="albumname">
                        <button class="albmadd-btn" type="submit" name="add" value="">add</button>
                      </form></div>
                      
                    </li>
                  </ul>
                </div>
          </div>
         
        
        <div class="pics"> 
    <?php        
      $userName = $_SESSION['userid'];

      $conx = mysqli_connect("localhost", "root", "", "gallery");
      if (!$conx) {
          die("connection faild:".mysqli_connect_error());
      }
      else{

        $sql = "SELECT * FROM usersgallery WHERE USERgallery='".$userName."' AND FAVgallery;";
        $stmt = mysqli_stmt_init($conx);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            echo " sql error";
        }
        else{
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {
            
                echo '<div ><img src="../gallery/'.$row["FULLNAMEgallery"].'" data-original="'.$row["NAMEgallery"].'"></div>';
          }
        } 
      }
      ?>
      </div>
        
      </div>  

        
      </div>
      
    <script src="../jsApp.js"></script>
  </body>