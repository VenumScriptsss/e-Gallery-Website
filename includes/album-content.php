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
    <title>Yourspace</title>
  </head>
  <body>
    <div class="nav-wrapper"> 

      <div class="name">
        <a href="../main.php"><h1>YourSpace</h1></a>
      </div>
      <div class="search-bar">
        <form action="search.php" method="get"> 
          <input type="text"  name="search" placeholder="Search...">
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
          
            <h3>
              <?php
                echo $_SESSION['userid'];
              ?>
            </h3>
           
        </div>
        <a href="includes/logout.php" class="log-out">
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
        <div class="preview">
          <img class="preview-img" src="">
          <p class="caption"></p>
          <div class="right-keys">
            <ul>
              <li class="icon-cont" style="display:flex;">
                <form  action="album-process.php" method="post">
                  <button type="submit" name="fav" value="" style="background-color:transparent;border:none;"><img src="../styles/pics/favorite-3-24.ico" class="favimg">
                  </button>
                </form>
                <div><p class="imgcp" >favorite</p></div>
                

              </li>
              <li class="icon-cont" style="display:flex;">
                <form  action="album-process.php" method="post">
                  <button type="submit" name="albdel" value="" style="background-color:transparent;border:none;"><img src="../styles/pics/delete-24.ico">
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
        <div class="albumheader" style="display: flex; justify-content: space-between;padding:10px 5px;">
          <p style="font-size: 1.5rem;font-weight: bolder;padding:0;">
          <?php 
            echo $_POST['albm'];
           ?>
           </p>
           <form  action="album-process.php" method="post">
            <button type="submit" name="delalb" value="<?php echo $_POST['albm'];?>" style="background-color: red; color: black;border: none;border-radius: 5px;height:30px;cursor: pointer;">Delete Album</button>
          </form>
        </div>
        <div class="pics"> 
          <?php 
            $conx = mysqli_connect("localhost", "root", "", "gallery");
            if (!$conx) {
              die("connection faild:".mysqli_connect_error());
             }else{
              $sql="SELECT * FROM usersgallery WHERE USERgallery='".$_SESSION['userid']."' AND AlbumName='".$_POST['albm']."' AND DELETEDgallery='FALSE';";
              $stmt = mysqli_stmt_init($conx);
              if (!mysqli_stmt_prepare($stmt,$sql)) {
                echo "SQL stmt error";
              }else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while($row = mysqli_fetch_assoc($result)){
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

</html>
