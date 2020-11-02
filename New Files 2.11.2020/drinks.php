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
$servername = "127.0.0.1:51111";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "recipebook";
  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   echo " ";

   //select all rows from recipe table, order the recipes in alphabetical order
   $sql = "SELECT * FROM recipe ORDER BY RecipeName;"; 
   $result = mysqli_query($conn, $sql);
   
    
$conn->close();
  
?>

    

<!-- Navigation -->
<nav class="navbar navbar-custom p-3">
   <a class="navbar-brand">RecipeBook</a>
   <a href="drinks.php">Drinks</a>
   <a class="btn btn-primary" href="addnewrecipe.php" role="button">&#43; Add a recipe</a>
</nav>


<!-- Cards -->
<div class="container">
   <div class="row">
      <div class="card-columns">
         <?php while ($row = mysqli_fetch_array($result)){ ?> <!-- for printing all rows from the table -->
            <div class="card">
                  <img class="card-img-top" src="images/chocolate.jpg" alt="Card image cap">
               <div class="card-body">
                  <h5 class="card-title"><?php echo $row['RecipeName']; ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  </svg> <?php echo $row['Servings']; ?> 
                
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">       <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/><path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                  </svg> <?php echo $row['PreparationTime']; ?> min
                
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                     <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg> <?php echo $row['Ratings']; ?>
                  </h6>  
                  <ul class="list-group list-group-flush">
                     <h5>Ingredients</h5>
                     <li class="list-group-item"><?php echo $row ['Ingredients']; ?></li>
                     <!-- <li class="list-group-item"></li>
                     <li class="list-group-item"></li> -->
                  </ul>
                  <h5>Instructions</h5>
                  <p class="card-text"> <?php echo $row ['Instructions']; ?></p> 
                  
               </div>
               <div class="card-footer text-muted">
               <!-- displays the date when the recipe was added -->
                  Added <?php echo $row ['DateAdded']; ?>
               </div>
            </div>
         <?php } ?>
      </div>
   </div>
</div>



<footer class="footer-copyright text-center py-3">
    <div class="container number-center">
      <small>Copyright &copy; Laura Pelkonen &amp; Aleksandra Postola 
         <?php
            echo date ('Y');
            ?>
         RecipeBook</small>
    </div>
</footer>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>