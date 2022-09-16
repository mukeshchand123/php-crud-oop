<?php 
require_once('class/Query1.php');
require_once('class/file.php');
require_once('class/registration.php');

session_start();
if(isset($_SESSION['login'])){
      
   header("location:welcom.php");
   exit;
}else{
   session_destroy();
}
function phnvalidate($phn){
    if(preg_match('/^[0-9]{10}+$/', $phn)) {
        return true;
        } else {
            return false;
        }
}
//Errors 
$file_err = $email_err = $phn_err = "";
$firstname = $lastname = $email = $phnNumber = "";
if(isset($_POST['create'])){
        //filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $firstname    = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
        
   
        $lastname  = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
  
        
   
        $email     =   filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
            $email_err = "Invalid Email.";
        }
  
   
        $phnNumber     = filter_var($_POST['phnNumber'], FILTER_SANITIZE_NUMBER_INT);
        if(!phnvalidate($phnNumber)){
            $phn_err = "Invalid phone number.";
        }
        
   
  //  $lastname     = $_POST['lastName'];
   // $email        = $_POST['email'];
    //$phnNumber    = $_POST['phnNumber'];
    $password     = md5($_POST['password']);
   
    $dirname = 'regs';
    $filename = $_FILES['file']['name'];
    $tempname =  $_FILES['file']['tmp_name'];
  
    $fileobj = new filehandling();

    $validext =  ['application/pdf'];
    $ext = $_FILES['file']['type'];
            // saving file in regs directory
    $valid = $fileobj->filevalidation($ext,$validext);
    if(!$valid){
        $file_err = "Only pdf files are valid";
    }
            if($valid &&   filter_var($email, FILTER_SANITIZE_EMAIL) && phnvalidate($phnNumber)){
                $dir = $fileobj->file_upload($filename, $tempname, $dirname,$email);
                $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
               // $dirname = 'regs';
                $registerobj = new registration();
                $result = $registerobj->register($data,$email);
                if($result==false){
                    unlink(dir);
                    echo '<script type="text/javascript">

                           window.onload = function () { alert("email alraedy exist."); }

                          </script>';
                }elseif($result == true){
                    echo '<script type="text/javascript">

                           window.onload = function () { alert("User Registered Sucessfully."); }

                          </script>';
                }
                
               
                }else{
                    echo '<script type="text/javascript">

                      window.onload = function () { alert("Please enter valid info."); }
     
                      </script>';
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
                    <input class="form-control" type="firstName" name="firstName" placeholder="First Name" value="<?php echo $firstname;?>" required><br>
                   
                    <label for="lastName">Last Name</label>
                    <input class="form-control" type="lastName" name="lastName"  placeholder="Last Name"  value="<?php echo $lastname;?>" required><br>

                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email"  placeholder="something@other.com"  value="<?php echo $email;?>" required>
                    
                    <span class="error"> <?php echo $email_err;?></span><br>

                    <label for="phnNumber">Phone Number</label>
                    <input class="form-control" type="phnNumber" name="phnNumber"  placeholder="Phone Number"  value="<?php echo $phnNumber;?>" required>
                    <span class="error"> <?php echo $phn_err;?></span><br>

                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password"  placeholder="Password" required>

                   
                     
                    <!-- <label for="cv">CV</label> -->
                    <input type="file" name="file" id="file" accept="application/pdf" required>
                    <span class="error"> <?php echo $file_err;?></span>

                    <hr class="mb-3">
                    
                    <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                </div>
            </div>
        </div>

    </form>

</div>
    
</body>
</html>