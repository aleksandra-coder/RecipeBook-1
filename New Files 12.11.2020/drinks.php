<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
        
    <title>RecipeBook</title>
     
</head>
<body>

<?php
    
// connecting to the server
require_once "config.php";

//  refering to application constants
require_once "appvars.php";
    
// Initialize the session
session_start();
    
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
    
//getting all the data from recipe table and joining recipe and user tables together for getting the username from user table
$sql = "SELECT recipe.*, user.Username
 FROM recipe 
 left JOIN user ON recipe.userID=user.userID 
 ORDER BY RecipeName";
$result = mysqli_query($conn, $sql); // execute the query and store the result set 

    
$conn->close(); //close the connection
  
?>

    
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand">RecipeBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarToggle">
    <ul class="navbar-nav">
       <li class="nav-item">
        <a class="nav-link" href="drinks.php">Drinks</a>
       </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Recipes
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="addnewrecipe.php">Add</a>
          <a class="dropdown-item" href="updaterecipe.php">Update</a>
          <a class="dropdown-item" href="deleterecipe.php">Delete</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="ownrecipes.php">Own Recipes</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
         </svg> 
         <?php  if (isset($_SESSION['Username'])) : ?><?php echo $_SESSION['Username']; ?><?php endif ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
    

<!-- Cards -->
<div class="container">
   <div class="row">
      <div class="col-lg-6">
          <h4>All Drinks</h4>
      </div>
   </div>
   <div class="row">
      <div class="card-deck">
         <?php while ($row = mysqli_fetch_array($result)){ ?> <!-- for printing all rows from the table -->
          <div class="cardcol col-sm-6 col-lg-4">
            <div class="card">
                <!-- Fetch the image of a recipe -->
               <?php  
                  if ( is_file (RECIPE_UPLOAD_PATH . $row['Images']) && filesize (RECIPE_UPLOAD_PATH . $row['Images']) > 0 ) {
                     echo '<img class="card-img-top" src=" ' . RECIPE_UPLOAD_PATH . $row['Images'] . '" alt="recipe image" />';
                  } else {
                     echo '<img class="card-img-top" src=" ' . RECIPE_UPLOAD_PATH . 'noimage.jpg' . '" alt="unverified image" />';
                  } 
               ?>
               <div class="card-body">
                  <h5 class="card-title"><?php echo $row['RecipeName']; ?></h5> <!-- Print the RecipeName from the table -->
                  <h6 class="card-subtitle mb-2 text-muted">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  </svg> <?php echo $row['Servings']; ?> <!-- Print the Servings from the table -->
                
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">       <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/><path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                  </svg> <?php echo $row['PreparationTime']; ?> min <!-- Print the preparation time from the table -->
                
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg> <?php echo $row['Ratings']; ?> <!-- Print the rating from the table -->
                  </h6>  
                  <ul class="list-group list-group-flush">
                     <h5>Ingredients</h5>
                     <li class="list-group-item"><?php echo $row ['Ingredients']; ?></li> <!-- Print the ingredients from the table -->
                  </ul>
                  <h5>Instructions</h5>
                  <p class="card-text"> <?php echo $row ['Instructions']; ?></p> <!-- Print the instructions from the table -->
                  
               </div>
               <div class="card-footer text-muted">
               <!-- displays the date when the recipe was added -->
                  Added <?php echo $row ['DateAdded']; ?> <?php echo $row ['Username']; ?> <!-- Print the date added and username of the user who created the recipe from the table -->
               </div>
            </div>
          </div>
         <?php } ?> <!-- close the php while -->
      </div>
   </div>
</div>


<!-- Footer -->
<footer class="footer text-center">
    <div class="container">
          <small>Copyright &copy; Laura Pelkonen &amp; Aleksandra Postola 
         <?php  
            echo date ('Y');  // Get the current year
            ?>
         RecipeBook</small>
    </div>
</footer>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>