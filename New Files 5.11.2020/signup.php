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

    
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userID FROM user WHERE Username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO user (Username, Password, JoiningDate) VALUES (?, ?,CURDATE())";
         
        if($stmt = mysqli_prepare($conn, $sql)){
        
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); //to hash the password user has input
                    // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
    
   
    
$conn->close();
  
?>


<!-- Navigation -->
<nav class="navbar navbar-custom p-3">
   <a class="navbar-brand">RecipeBook</a>
   <a class="btn btn-primary" href="login.php" role="button">Login</a>
</nav>


<!-- Login Form -->
<div class="container-fluid">
   <div class="row justify-content-around">
      <div class="col-lg-4">
         <h4>Sign up</h4>
         <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="form-group">
               <label>Username</label><input type="text" class="form-control" name="username" id="username" value="<?php echo $username;?>">
               <span class="error"><?php echo $username_err;?></span>
            </div>
            <div class="form-group">
               <label>Password</label><input type="password" class="form-control" name="password" id="password" value="<?php echo $password;?>">
               <span class="error"><?php echo $password_err;?></span>
            </div>
            <div class="form-group">
               <label>Repeat password</label><input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo $confirm_password;?>">
               <span class="error"><?php echo $confirm_password_err;?></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
         </form>
      </div>
   </div>
</div>



<footer class="footer fixed-bottom text-center py-3">
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