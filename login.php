<?php
require_once('class/login.php');
  session_start();
  if(isset($_SESSION['login'])){
        
     header("location:welcom.php");
     exit;
 }else{
     session_destroy();
 }

 

 if(isset($_POST['create'])){
    
     if(isset($_SESSION['username'])){
            header("locatiom:welcom.php");
         }
     $email = $_POST['email'];
     $password = $_POST['password'];
     
     $result = new login($email,$password);
    
    }
     
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login | PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div>
    <?php
        require_once('navbar1.php');
    ?>
</div>

<div>
    <form action="login.php" method="post" enctype="multipart/form-data" >
   
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Login</h1>
                   
                    
                    <hr class="mb-3">

                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  placeholder="something@other.com" required>

                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password"  placeholder="Password" required>
                  

                    <hr class="mb-3">
                    
                    <!-- <input class="btn btn-primary" type="submit" name="create" value="Log In"> -->
                    <button type="submit" name="create">login</button>
                </div>
            </div>
        </div>

    </form>

</div>
    
</body>
</html>