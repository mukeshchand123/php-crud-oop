<?php 
session_start();

//check if user is logged in
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
require_once('class/Query1.php');
require_once('class/file.php');
require_once('class/operation.php');
require_once('validate.php');
$_SESSION['count'] =0;
if($_SESSION['count']!=1){
    $file_err = $email_err = $phn_err = $firstname_err=$lastname_err=$password_err="";
  //  $firstname = $lastname = $email = $phnNumber =$password=$cv= $filename= $tempname= $ext="";
    }
    // if updated value is invalid
if($_SERVER ['REQUEST_METHOD'] == 'GET'){
   
    $id = filter_var($_GET['j'],FILTER_SANITIZE_NUMBER_INT);
    echo $id;
   $obj = new query1();
   $result = $obj->getData('users','*',['id'=>$id]);
   $row = $result->fetch(PDO::FETCH_ASSOC);
   $firstname  = $row['firstname'];
   $lastname   = $row['lastname'];
   $email      = $row['email'];
   $phnNumber  = $row['phn'];
   $password   = $row['password'];
   $cv         = $row['cv'];
   $_SESSION['newid']=$id;
 }elseif ( isset($_POST['create'])) {
    $_SESSION['count'] =1;
    $id = $_SESSION['newid'];
   
    # code...
    
    $firstname    = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $lastname  = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    $email     =   filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phnNumber     = filter_var($_POST['phnNumber'], FILTER_SANITIZE_NUMBER_INT);
    $password     = md5($_POST['password']);

    if(!phnvalidate($phnNumber)){
        $phn_err = "Phone number is invalid.";
    }
   if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_err = "Email is invalid.";
   }

    $filename = $_FILES['file']['name'];
          $tempname = $_FILES['file']['tmp_name'];
          $ext = $_FILES['file']['type'];
          $dirname = 'regs';
          $validext =  ['application/pdf'];

          $fileobj = new filehandling();

          $valid = $fileobj->filevalidation($ext,$validext);
                if(!$valid){
                    $file_err ="Only pdf files are valid.";
                  }
          //update in case data is valid
          if($valid &&   filter_var($email, FILTER_VALIDATE_EMAIL) && phnvalidate($phnNumber)){
                          $dir = $fileobj->file_upload($filename, $tempname, $dirname,$email);
                          $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
                         // $dirname = 'regs';
                          $obj = new operation();
                         $result= $obj->update('users',$data,'id',$id); 
                         if($result== true){
                            header("location:home.php");
                          }   
                          elseif($result==false){
                              unlink($dir); //delete file from directory if not updated in table
                              $_SESSION['newid']=$id;
                              header("location:update.php");
                          }   
                      }else{
                        echo '<script type="text/javascript">

                           window.onload = function () { alert("Please enter valid information."); }

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
        <?php require_once('navbar2.php');?>
    </div>
<div>
    <form action="update.php" method="post" enctype="multipart/form-data" >
   
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
                    <input type="file" name="file" accept="application/pdf"  required>
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
//  unset($_SESSION['newid']);
//  unset( $_SESSION['file_err']);
//  unset( $_SESSION['email_err']);
//  unset( $_SESSION['phone_err']);
//  unset( $_SESSION['firstname_err']);
//  unset($_SESSION['lastname_err']);
//  unset( $_SESSION['password_err']);
?>