<?php 
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
require_once('class/Query1.php');
if (isset( $_SESSION['newid'])) {
    echo '<script type="text/javascript">

    window.onload = function () { alert("Only pdf files are valid."); }

    </script>';
   $id = $_SESSION['newid'];
  
  }else{
$id = $_GET['j'];
}

 //fetching data to be edited
 $obj = new query1();
 $result = $obj->getData('users','*',['id'=>$id]);
 $row = $result->fetch(PDO::FETCH_ASSOC);
 $firstname  = $row['firstname'];
 $lastname   = $row['lastname'];
 $email      = $row['email'];
 $phnNumber  = $row['phn'];
 $password   = $row['password'];
 $cv         = $row['cv'];
 $_SESSION['id']=$id;

//  $sql = "SELECT * FROM `useraccounts`.`users` WHERE `id`='$id';";
//  $result     = mysqli_query($con,$sql);
//  $row        = mysqli_fetch_assoc($result);
//  $firstname  = $row['firstname'];
//  $lastname   = $row['lastname'];
//  $email      = $row['email'];
//  $phnNumber  = $row['phnNumber'];
//  $password   = $row['password'];
//  $cv         = $row['CV'];


//Updating data




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>User Registration | PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
<div>
    <form action="update1.php" method="post" enctype="multipart/form-data" >
   
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Update</h1>
                    <p>Please Edit  Information:</p>
                    
                    <hr class="mb-3">
                    

                    <label for="firstName">First Name</label>
                    <input class="form-control" type="firstName" name="firstName" value=<?php echo"$firstname"?> required>

                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="lastName" name="lastName" value=<?php echo"$lastname"?> required>

                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  value=<?php echo"$email"?> required>
 
                    <label for="phnNumber">Phone Number</label>
                    <input class="form-control" type="phnNumber" name="phnNumber"  value=<?php echo"$phnNumber"?> required>

                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" value=<?php echo"$password"?> required>

                   
                     
                    <!-- <label for="cv">CV</label> -->
                    <input type="file" name="file" accept="application/pdf" value=<?php echo"$cv"?> required>
                  

                    <hr class="mb-3">
                    
                    <input class="btn btn-primary" type="submit" name="create" value="Update">
                </div>
            </div>
        </div>

    </form>

</div>
</body>
</html>