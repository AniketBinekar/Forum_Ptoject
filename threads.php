<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  
  <style>
  #col
  {
    background-color: black;
  }
  #ques
  {
    min-height: 100%;
  }
  </style>
    <title>Idiscuss-Coding Forum</title>
  </head>
  <body>
    <!-- <h1>Hello, world!</h1> -->
   <?php include 'partials/_dbconnect.php';?>
   <?php include 'partials/_header.php';?>
   <?php
        $id=$_GET['catid'];
         $sql="SELECT * FROM `cat` WHERE cat_id=$id";
         $result=mysqli_query($conne,$sql);
         while($row=mysqli_fetch_assoc($result))
         {
            $catname=$row['cat_name'];
            $desc=$row['cat_desc'];
         }
        
   ?>
    <?php
    $showalert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST')
        {
          $th_title=$_POST['title'];
          $th_desc=$_POST['desc'];

         $th_title=str_replace("<","&lt;",$th_title);
         $th_title=str_replace(">","&gt;",$th_title);

         $th_desc=str_replace("<","&lt;",$th_desc);
         $th_desc=str_replace(">","&gt;",$th_desc);

          $sno=$_POST['sno'];
          $sql="INSERT INTO `threads` (`thread_cat`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
          $result=mysqli_query($conne,$sql);
          $showalert=true;
          if($showalert)
          {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Thread has been added!Wait for Community to response.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
        }
    ?>

<div class="container my-4"style="background-color: wheat">
         <div class="jumbotron">
                    <h1 class="display-4">welcome to <?php echo $catname;?> forums</h1>
                    <p class="lead"><?php echo $desc;?></p>
                    <hr class="my-4">
<p>this is forum to sharing knowlede to each other.No Spam / AdvertisingSelf-promote in the forums.Do not post.copyright-infringing material.Do not post “offensive” posts, links or images.Do not cross post questions. ...
        Remain respectful of other members at all times.</p>
                    <a class="btn btn-success btn-lg mt-2" href="#" role="button">Learn more</a>
            </div>
</div>
<?php
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
{
echo'<div class="container">
    <h1 class="py-2">Start Discussion</h1>
      <form action="'.$_SERVER["REQUEST_URI"].'" method="post" >
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Problem Title</label>
          <input type="text" class="form-control" id="title"name="title" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Keep Your Title as Short and crisp as possible</div>
        </div>
        <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Elaborate your concern</label>
          <textarea class="form-control" id="desc"name="desc" rows="3"></textarea>
        </div>
        <button  type="submit" class="btn btn-success mt-3">Submit</button>
      </form>
</div>';
}
else
{
  echo '<div class="container">
  <h1 class="py-2">Start Discussion</h1>
  <p class="lead">You Are Not Logged In! Please Login to able Start Discussion</p>
</div>';
}
?>


<div class="container mb-5"id="ques">
        <h1 class="py-2">Browse Question</h1>

        <?php
        $id=$_GET['catid'];
        $noresukt=true;
         $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
         $result=mysqli_query($conne,$sql);
         while($row=mysqli_fetch_assoc($result))
         {
          $noresukt=false;
            $id=$row['thread_id'];
            $title=$row['thread_cat'];
            $desc=$row['thread_desc'];
            $thread_time=$row['time'];
            $thread_user_id=$row['thread_user_id'];

             $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
             $result2=mysqli_query($conne,$sql2);
             $row2=mysqli_fetch_assoc($result2);
             
            // $sk=$row2['user_email'];
               echo 
               '<div class="media my-3">
                       <img src="img/user.jpg"width="54px" class="mr-3" alt="...">
                    <div class="media-body">'.
                          '<h5 class="mt-0"><a class="text-dark" href="threads1.php ? threadid='. $id .'">'. $title .'</a></h5>
                          '. $desc .'
                      </div>'.'<p class="font-weight-bold my-0">'. $row2['user_email'].' at '.$thread_time.'</p>
              </div>';
}
// echo var_dump($noresukt);
if($noresukt)
{
  echo '<div class="jumbotron jumbotron-fluid"style="background-color: lavender">
  <div class="container">
    <p class="display-4">No Thread Found</p>
    <p class="lead">Be The First Person To Ask The Question</p>
  </div>
</div>';
 
}
        
?>



               <!-- <div class="media my-3">
  <img src="img/user.jpg"width="54px" class="mr-3" alt="...">
        <div class="media-body">
            <h5 class="mt-0">Unable To Install Pyaudio Error In Window</h5>
            <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
        </div>
    </div>
</div> -->

   
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