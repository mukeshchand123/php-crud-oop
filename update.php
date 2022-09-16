<?php 
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
require_once('class/Query1.php');
$email_err=$phn_err=$file_err=$firstname_err=$lastname_err=$password_err="";
if (isset( $_SESSION['newid'])) {
    echo '<script type="text/javascript">

    window.onload = function () { alert("Please enter valid info."); }

    </script>';
   $id =filter_var($_SESSION['newid'],FILTER_SANITIZE_NUMBER_INT);
   //echo $id;
   $email_err       =  $_SESSION['email_err'];
   $phn_err         =  $_SESSION['phone_err'];
   $file_err        =  $_SESSION['file_err'];
   $firstname_err   =  $_SESSION['firstname_err'];
   $lastname_err    =  $_SESSION['lastname_err'];
   $password_err    =  $_SESSION['password_err'];
   var_dump($_SESSION);
  
  }else{
 $id = filter_var($_GET['j'],FILTER_SANITIZE_NUMBER_INT);

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
        <?php require_once('navbar2.php');?>
    </div>
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
                    <span class="error"> <?php echo $firstname_err;?></span><br>

                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="lastName" name="lastName" value=<?php echo"$lastname"?> required>
                    <span class="error"> <?php echo $lastname_err;?></span><br>

                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  value=<?php echo"$email"?> required>
                    <span class="error"> <?php echo $email_err;?></span><br>
 
                    <label for="phnNumber">Phone Number</label>
                    <input class="form-control" type="phnNumber" name="phnNumber"  value=<?php echo"$phnNumber"?> required>
                    <span class="error"> <?php echo $phn_err;?></span><br>

                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                    <span class="error"> <?php echo $password_err;?></span><br>
                   
                     
                    <!-- <label for="cv">CV</label> -->
                    <input type="file" name="file" accept="application/pdf" value=<?php echo"$cv"?> required>
                    <span class="error"> <?php echo $file_err;?></span><br>
                  

                    <hr class="mb-3">
                    
                    <input class="btn btn-primary" type="submit" name="create" value="Update">
                </div>
            </div>
        </div>

    </form>

</div>
</body>
</html>
<?php
 unset($_SESSION['newid']);
 unset( $_SESSION['file_err']);
 unset( $_SESSION['email_err']);
 unset( $_SESSION['phone_err']);
 unset( $_SESSION['firstname_err']);
 unset($_SESSION['lastname_err']);
 unset( $_SESSION['password_err']);
?>