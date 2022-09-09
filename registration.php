<?php 
require_once('query.php');

session_start();
if(isset($_SESSION['login'])){
      
   header("location:welcom.php");
   exit;
}else{
   session_destroy();
}
if(isset($_POST['create'])){
    $firstname    = $_POST['firstName'];
    $lastname     = $_POST['lastName'];
    $email        = $_POST['email'];
    $phnNumber    = $_POST['phnNumber'];
    $password     = md5($_POST['password']);

    $filename = $_FILES['file']['name'];
    $tempname =  $_FILES['file']['tmp_name'];
    $filesize =  $_FILES['file']['size'];
   // echo "$lastname<br>";
    
    $validext =  ['application/pdf'];
    $ext = $_FILES['file']['type'];
            // saving file in regs directory
            echo"$filename<br>";
            if(in_array($ext,$validext)==true){
                echo "valid<br>";
              
                $rand = rand('111111','999999');
             
                $newname=$email.'_'.$rand.'_'.$filename;
                
                move_uploaded_file($tempname,'regs/'.$newname);
                $dir = 'regs/'.$newname;
                $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
                
                $obj = new query();
                $result = $obj->getData('users',"email",['email'=>$email]);
                if($result->num_rows > 0){
                    echo "email already exists.Please enter a new email.";
                }else{
                $obj->insertData('users',$data);
                }

   
            }
}
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
    <?php
        require_once('navbar1.php');
    ?>
</div>

<div>
    <form action="registration.php" method="post" enctype="multipart/form-data" >
   
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Registration</h1>
                    <p>Please Enter Valid Information:</p>
                    
                    <hr class="mb-3">
                   
                    <label for="firstName">First Name</label>
                    <input class="form-control" type="firstName" name="firstName" placeholder="First Name" required>

                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="lastName" name="lastName"  placeholder="Last Name" required>

                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  placeholder="something@other.com" required>
 
                    <label for="phnNumber">Phone Number</label>
                    <input class="form-control" type="phnNumber" name="phnNumber"  placeholder="Phone Number" required>

                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password"  placeholder="Password" required>

                   
                     
                    <!-- <label for="cv">CV</label> -->
                    <input type="file" name="file" id="file" accept="application/pdf" required>
                  

                    <hr class="mb-3">
                    
                    <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                </div>
            </div>
        </div>

    </form>

</div>
    
</body>
</html>