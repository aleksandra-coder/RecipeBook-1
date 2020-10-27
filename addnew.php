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

<!-- Navigation -->
<nav class="navbar navbar-light bg-light">
   <a class="navbar-brand">RecipeBook</a>
   <a href="drinks.php">Drinks</a>
   <a class="btn btn-primary" href="addnew.php" role="button">&#43; Add a recipe</a>
</nav>


<!-- Form -->
<div class="container-fluid">
   <div class="row justify-content-around">
      <div class="col-lg-6">
         <h4>Add a new recipe</h4>
         <form>
            <div class="form-group">
               <div class="row">
                  <div class="col">
                     <input type="file" class="form-control-file" id="addPhoto">
                  </div>
                  <div class="col">
                     <label for="addPhoto">Add a photo</label>
                  </div>
                </div>
            </div>
            <div class="form-group">
               <input type="email" class="form-control" id="dishName" placeholder="Name of the dish">
            </div>
            <div class="form-group">
               <select class="form-control" id="category">
                  <option selected>Category</option>
                  <option>Drinks</option>
                  <option disabled>Starters/Snacks</option>
                  <option disabled>Salads</option>
                  <option disabled>Main Courses</option>
                  <option disabled>Desserts</option>
               </select>
            </div>
            <div class="form-group">
               <div class="row">
                  <div class="col">
                     <input type="text" class="form-control" placeholder="Servings">
                  </div>
                  <div class="col">
                     <input type="text" class="form-control" placeholder="Cooking time">
                  </div>
                  <div class="col">
                     <select class="form-control" id="category">
                        <option selected>Rating</option>
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
               <textarea class="form-control" id="ingredients" rows="3"></textarea>
            </div>
            <div class="form-group">
               <label for="exampleFormControlTextarea1">Instructions</label>
               <textarea class="form-control" id="instructions" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add recipe</button>
         </form>
      </div>
   </div>
</div>
    



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>