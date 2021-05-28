<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


  <style>
      #maincontainer
      {
        min-height: 100vh;
      }

  </style>
    <title>Idiscuss-Coding Forum</title>
  </head>
  <body>
    <!-- <h1>Hello, world!</h1> -->
   <?php include 'partials/_dbconnect.php';?>
   <?php include 'partials/_header.php';?>

   

      <div class="container my-3"id="maincontainer">

        <h1>Search Results For <?php echo $_GET['search']?></h1>

              <?php
              $noresult=true;
                   $query=$_GET["search"];
                 $sql="select * from threads where match (thread_cat , thread_desc) against('$query')";
                    $result=mysqli_query($conne,$sql);
                 while($row=mysqli_fetch_assoc($result))
                      {
                          $catname=$row['thread_cat'];
                          $desc=$row['thread_desc'];
                          $thread_id=$row['thread_id'];
                          $url="threads1.php?threadid=".$thread_id;
                          $noresult=false;

                          echo '<div class="result">
                                <h3> <a href="'.$url.'"class="text-dark">'.$catname.'</a></h3>
                                <p>'.$desc.'</p>
                          </div>';
                      
                      }
                      if($noresult)
                      {
                        echo'<div class="jumbotron jumbotron-fluid style="background-color: lavender">
                        <div class="container style="background-color: lavender">
                        <p class="display-4">No Result Found</p>
                        <p class="lead">Be The First Person To Ask The Question</p>
                      </div>
                      </div>';
                      }

            ?>

            
      </div>

   
   <?php include 'partials/_footer.php';?>
   

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>