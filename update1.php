<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
    header("location:login.php");
  }
  require_once('class/file.php');
  require_once('class/operation.php');
  function phnvalidate($phn){
    if(preg_match('/^[0-9]{10}+$/', $phn)) {
        return true;
        } else {
            return false;
        }
}

$id = filter_var($_SESSION['id'],FILTER_SANITIZE_NUMBER_INT);

$file_err = $email_err = $phn_err = $firstname_err=$lastname_err=$password_err="";
$firstname = $lastname = $email = $phnNumber =$password=$cv= $filename= $tempname= $ext="";

if($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST['create'])){
    if(!empty($_POST['firstName'])){
         $firstname    = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    }else{
        $firstname_err = true;
    }
    if(!empty($_POST['lastName'])){
        $lastname  = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    }else{
        $lastname_err ="Required";
    }
    if(!empty($_POST['email'])){
        $email     =   filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
            $email_err = "Invalid email address.";
        }
    }else{
       $email_err = "email is required";
    }
    if(!empty($_POST['phnNumber'])){
        $phnNumber     = filter_var($_POST['phnNumber'], FILTER_SANITIZE_NUMBER_INT);
        if(!phnvalidate($phnNumber)){
            $phn_err ="Invalid phone number.";
        }
    }else{
       $phn_err = true;
    }
    if(!empty($_POST['password'])){
        $password     = md5($_POST['password']);
    }else{
        $password_err = true;
    }
    if(!empty($_FILES['file']['name'])){
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
    }else{
        $file_err = true;
    }
        
    //echo$firstname;
    
   // $filesize =  $_FILES['file']['size'];
   // echo "$lastname<br>";
        if(empty($firstname) || empty($lastname) || empty($email) || empty($phnNumber) || empty($filename) || empty($password)){
            $_SESSION['newid']=$id;
            $_SESSION['firstname_err']=$firstname_err;
            $_SESSION['lastname_err']=$lastname_err; 
            $_SESSION['password_err']=$password_err;
            $_SESSION['file_err']=$file_err;
            $_SESSION['email_err']=$email_err; 
            $_SESSION['phone_err']=$phn_err;
           // $_SESSION['msg']= "Please fill the required fields.";
            header("location:update.php");
            exit;
        }
            
    
            // saving file in regs directory
           // echo"$filename<br>";
           
            if($valid &&   filter_var($email, FILTER_SANITIZE_EMAIL) && phnvalidate($phnNumber)){
                $dir = $fileobj->file_upload($filename, $tempname, $dirname,$email);
                $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
               // $dirname = 'regs';
                $obj = new operation();
               $result= $obj->update('users',$data,'id',$id); 
               if($result!=0){
                    unset($_SESSION['newid']);
                    unset( $_SESSION['file_err']);
                    unset( $_SESSION['email_err']);
                    unset( $_SESSION['phone_err']);
                    unset( $_SESSION['firstname_err']);
                    unset($_SESSION['lastname_err']);
                    unset( $_SESSION['password_err']);
                    header("location:home.php");
                }   
                else{
                    unlink($dir); //delete file from directory if not updated in table
                    $_SESSION['newid']=$id;
                    header("location:update.php");
                }   
            }else{
                     // $_SESSION['msg']= "Invalid info"; 
                      $_SESSION['newid']=$id;
                      $_SESSION['firstname_err']=$firstname_err;
                      echo( $_SESSION['firstname_err']);
                      $_SESSION['lastname_err']=$lastname_err; 
                      $_SESSION['password_err']=$password_err;
                      $_SESSION['file_err']=$file_err;
                      $_SESSION['email_err']=$email_err; 
                      $_SESSION['phone_err']=$phn_err;
                     // header( "refresh:1;url=update.php" );//waits for 1 sec before header is sent
                    // header('location:update.php');
                     exit;
            }
           
              
}
?>