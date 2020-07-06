<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/forum">iDiscuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
      $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3"; 
      $result = mysqli_query($con,$sql);
      $noResult = true;
     
      while($row = mysqli_fetch_assoc($result)){
        $cat = $row['category_name'];
        echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$cat.'</a>';
        
      }  
     echo ' </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
    </li>
  </ul>
  <div class="row mx-2">';
  
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
     <p class="text-light my-0 mx-2">Welcome '.$_SESSION['useremail'].'</p>
     <a href="partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
    </form>';
  }
  else{
  echo' <form class="form-inline my-2 my-lg-0"  action="search.php" method="get">
          <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-outline-success mx-2"  data-toggle="modal" data-target="#signupModal" >Signup</button>';
  }
  echo   '</div>
        </div>
        </nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>Success!</strong> You can know login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}
elseif(isset($_GET['error'])){
  $showError = $_GET['error'];
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>wrong!</strong> '.$showError.'.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}elseif(isset($_SESSION['loggedin'])){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You are Login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}else{
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
        <strong>wrong!</strong> You are not Login please login now.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}
?>