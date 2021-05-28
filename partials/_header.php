<?php
session_start();
// if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
// {

// }

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum_project">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum_project">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql="SELECT cat_name , cat_id FROM `cat` LIMIT 3";
        // $noresukt=true;
        $result=mysqli_query($conne,$sql);
         while($row=mysqli_fetch_assoc($result))
         {
          echo'<li><a class="dropdown-item" href="threads.php?catid='.$row['cat_id'].'">'.$row['cat_name'].'</a></li>';
          // <li><a class="dropdown-item" href="#">Another action</a></li>
         }
       echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="contact.php" tabindex="-1" >Contact</a>
      </li>
    </ul>
    <div class="row mx-2">';
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true)
{
    echo '<form class="d-flex"action="search.php"method="get">
    <input class="form-control me-2"name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
    <p class="text-light my-0 mx-2">Welcome '.$_SESSION['useremail'].'</p>
    <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
    </form>';

}
   else{
     echo
      '<form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <div class="mx-2 my-2">
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModel">Login</button>
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModel">SignUp</button></div>';
   }
   echo'</div>
  </div>
</nav>';
include 'partials/loginModel.php';
include 'partials/signupModel.php';
if(isset($_GET['signupsuccess'])&& $_GET['signupsuccess']=="true")
{
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can Login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>