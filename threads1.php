<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
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
        $id=$_GET['threadid'];
         $sql="SELECT * FROM `threads` WHERE thread_id=$id";
         $result=mysqli_query($conne,$sql);
         while($row=mysqli_fetch_assoc($result))
         {
            $catname=$row['thread_cat'];
            $desc=$row['thread_desc'];
            $thread_user=$row['thread_user_id'];

            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user'";
            $result2=mysqli_query($conne,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            $posted_by=$row2['user_email'];
         }
        
   ?>

<?php
    $showalert=false;
        $method=$_SERVER['REQUEST_METHOD'];
        if($method=='POST')
        {
          $comment=$_POST['comment'];
          $comment=str_replace("<","&lt;",$comment);
          $comment=str_replace(">","&gt;",$comment);
          $sno=$_POST['sno'];
          
          $sql="INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_buy`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
          $result=mysqli_query($conne,$sql);
          $showalert=true;
          if($showalert)
          {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Comment has been added!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          }
        }
    ?>

<div class="container my-4"style="background-color: lavender">
         <div class="jumbotron">
                    <h1 class="display-4">welcome to <?php echo $catname;?> forums</h1>
                    <p class="lead"><?php echo $desc;?></p>
                    <hr class="my-4">
                  <p>this is forum to sharing knowlede to each other.No Spam / AdvertisingSelf-promote in the forums.Do not post.copyright-infringing material.Do not post “offensive” posts, links or images.Do not cross post questions. ...
                 Remain respectful of other members at all times.</p>
                   <p>Posted by- <em><?php echo $posted_by; ?></em></p>
            </div>
</div>

<?php
if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
{
echo'<div class="container">
    <h1 class="py-2">Post a Comment</h1>
    <form action="'. $_SERVER['REQUEST_URI'].'" method="post" >
        <div class="form-group">
                  <label for="exampleFormControlTextarea1">Type Your Comment</label>
                  <textarea class="form-control" id="comment"name="comment" rows="3"></textarea>
                  <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
          </div>
      <button  type="submit" class="btn btn-success mt-3">Post Comment</button>
    </form>
</div>';
}
else
{
  
    echo '<div class="container">
    <h1 class="py-2">Post Comment</h1>
    <p class="lead">You Are Not Logged In! Please Login to able Post Comment</p>
  </div>';
  
}
?>

<div class="container mb-5"id="ques">
        <h1 class="py-2">Discussion</h1>

        <?php
        $id=$_GET['threadid'];
         $sql="SELECT * FROM `comment` WHERE thread_id=$id";
         $result=mysqli_query($conne,$sql);
         $noresukt=true;
         while($row=mysqli_fetch_assoc($result))
         {
          $noresukt=false;
            $id=$row['comment_id'];
            $content=$row['comment_content'];
            $comment_time=$row['comment_time'];
            $thread_user_id=$row['comment_buy'];

            $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conne,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            
    

     echo '<div class="media my-3">
               <img src="img/user.jpg"width="54px" class="mr-3" alt="...">
             <div class="media-body">
            <p class="font-weight-bold my-0">'. $row2['user_email'].'at '.$comment_time.'</p>
           '. $content .'
        </div>
    </div>';
}

if($noresukt)
{
  echo '<div class="jumbotron jumbotron-fluid"style="background-color: lavender">
  <div class="container">
    <p class="display-4">No Comment Found</p>
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