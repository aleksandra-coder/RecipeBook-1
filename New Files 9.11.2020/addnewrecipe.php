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

<!-- php code here -->

<?php
    
// define variables and set to empty values
$dishNameErr = $ServingsErr = $CookingTimeErr = $categoryErr = $ingredientsErr = $instructionsErr = "";
$dishName = $Servings = $CookingTime = $rating = $category = $ingredients = $instructions = $addPhoto = "";

// checking if fields are left empty and if required to fill out, the message is displayed
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["dishName"])) {
      $dishNameErr = "Dish name is required";
    } else {
      $dishName = test_input($_POST["dishName"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$dishName)) {
        $dishNameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["Servings"])) {
        $Servings = "";
    } else {
        $Servings = test_input($_POST["Servings"]);
      //   check if servings is a number or a numeric string
        if(!is_numeric($Servings)) {
            $ServingsErr = "Only numbers are allowed";
        }
      }
    
    if (empty($_POST["CookingTime"])) {
        $CookingTime = "";
    } else {
        $CookingTime = test_input($_POST["CookingTime"]);
        //   check if CookingTime is a number or a numeric string
        if(!is_numeric($CookingTime)) {
          $CookingTimeErr = "Only numbers are allowed";
          }
      }

    if (empty($_POST["rating"])) {
         $rating = "";
     } else {
         $rating = test_input($_POST["rating"]);
         }
     
    
    if (empty($_POST["ingredients"])) {
        $ingredientsErr = "Ingredients are required";
    } else {
        $ingredients = test_input($_POST["ingredients"]);
        }
        
        
    if (empty($_POST["instructions"])) {
        $instructionsErr = "Instructions are required";
    } else {
        $instructions = test_input($_POST["instructions"]);
        }
      
      //   adding photos, first setting variables
        $addPhoto = $_FILES['addPhoto'];

        $fileName = $_FILES['addPhoto']['name'];
        $fileTmpName = $_FILES['addPhoto']['tmp_name'];
        $fileSize = $_FILES['addPhoto']['size'];
        $fileError = $_FILES['addPhoto']['error'];
        $fileType = $_FILES['addPhoto']['type'];

      //   defining files extensions
        $fileExt = explode( '.', $fileName );
        $fileActualExt = strtolower(end($fileExt));
// which extensions are allowed
        $allowed = array('jpg', 'jpeg', 'gif', 'png');

      // defining what criteria must be met, file size, name
      if (!empty($_POST["addPhoto"])) {
         if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
               if ($fileSize <= MAX_FILE_SIZE) {
                  // creating unique file name and path
                  $fileDestination = RECIPE_UPLOAD_PATH . time() . $addPhoto; 
                  // moving the the images folder
                  move_uploaded_file($fileTmpName, $fileDestination);
                  $conn = new mysqli($servername, $username, $password, $dbname);
                  header("Location: addnewrecipe.php?uploadsuccess");
               } else {
                  echo "Your file is too big.";
               }
            } else {
               echo "There was an error uploading your file.";
            }
        } else {
           echo "You cannot upload files of this type.";
        }
      } else {
         echo "You didn't upload any file";
      }
 }
    

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // connecting to the server
require_once "config.php";
    
//  refering to application constants
require_once "appvars.php";
    
//Next query is to count the recipeID of a new recipe according to the amount of existing recipes
$query = "SELECT recipeID FROM recipe"; // to fetch recipeIDs from the table

$result = mysqli_query($conn, $query); // execute the query and store the result set 
      

// Initialize the session
session_start();
    
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
    
$userAdding = $_SESSION['userID']; //variable for saving which user saved the recipe

// insert values into the table (user input)
$sql = "INSERT INTO recipe (userID, RecipeName, Servings, PreparationTime, Ratings, Ingredients, Instructions, Images, DateAdded, TimeAdded)
        VALUES ('$userAdding', '$dishName', '$Servings', '$CookingTime', '$rating', '$ingredients', '$instructions', '$addPhoto', CURDATE(), CURTIME())";  




  if ($conn->query($sql) === TRUE) {
   echo "";
 } else {
   echo "";
 }
 
 $conn->close(); //close the connection
  
?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <a class="navbar-brand">RecipeBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
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


<!-- Form -->
<div class="container-fluid">
   <div class="row justify-content-around">
      <div class="col-lg-6">
         <h4>Add a new recipe</h4>
      </div>
   </div>
   <div class="row justify-content-around">
      <div class="col-lg-6">
         <!-- This enctype attribute tells that we will be adding files like images -->
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="form-group">
               <div class="row">
               <div class="col">
                      <label for="addPhoto">Add a photo</label> 
                      <input type="hidden" name="max_file_size" value="MAX_FILE_SIZE">
                  </div>
                  <div class="col">
                     <input type="file" class="form-control-file" id="addPhoto" name="addPhoto">
                  </div>
                </div>
            </div>
            <div class="form-group">
               <label>Name of the dish</label><input type="text" class="form-control" name="dishName" id="dishName" value="<?php echo $dishName;?>">
               <span class="error">* <?php echo $dishNameErr;?></span>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col">
                  <label>Number of servings</label><input type="text" class="form-control" name="Servings" value="<?php echo $Servings;?>">
                  <span class="error">* <?php echo $ServingsErr;?></span>
                  </div>
                  <div class="col">
                  <label>Cooking time (min)</label><input type="text" class="form-control" name="CookingTime" value="<?php echo $CookingTime;?>">
                  <span class="error">* <?php echo $CookingTimeErr;?></span>
                  </div>
                  <div class="col">
                  <label>Rating</label><select class="form-control"  id="rating" name="rating" value="<?php echo $rating;?>"><option selected>Rating</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Ingredients</label>
               <textarea class="form-control" name="ingredients" id="ingredients" rows="3" value="<?php echo $ingredients;?>"></textarea>
               <span class="error">* <?php echo $ingredientsErr;?></span>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Instructions</label>
               <textarea class="form-control" name="instructions" id="instructions" rows="3" value="<?php echo $instructions;?>"></textarea>
               <span class="error">* <?php echo $instructionsErr;?></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="Submit">Add recipe</button>
         </form>
         <br>
         
         <!-- The code below is displayed after the user types data into the fields -->
         
         <?php
            echo "<h4>Your Input:</h4>";
            echo $dishName;
            echo "<br>";
            echo $Servings;
            echo "<br>";
            echo $CookingTime;
            echo "<br>";
            echo $category;
            echo "<br>";
            echo $rating;
            echo "<br>";
            echo $ingredients;
            echo "<br>";
            echo $instructions;
         ?>
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