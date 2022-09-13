<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
    header("location:login.php");
  }
  require_once('class/file.php');
  require_once('class/operation.php');
$id = $_SESSION['id'];

if(isset($_POST['create'])){
    $firstname    = $_POST['firstName'];
    $lastname     = $_POST['lastName'];
    $email        = $_POST['email'];
    $phnNumber    = $_POST['phnNumber'];
    $password     = md5($_POST['password']);
    //echo$firstname;
    $filename = $_FILES['file']['name'];
    $tempname =  $_FILES['file']['tmp_name'];
    $filesize =  $_FILES['file']['size'];
   // echo "$lastname<br>";
   $dirname = 'regs';
    $validext =  ['application/pdf'];
    $ext = $_FILES['file']['type'];
            // saving file in regs directory
           // echo"$filename<br>";
            $fileobj = new filehandling();
            $valid = $fileobj->filevalidation($ext,$validext);
            if($valid){
                $dir = $fileobj->file_upload($filename, $tempname, $dirname,$email);
                $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
               // $dirname = 'regs';
                $obj = new operation();
               $result= $obj->update('users',$data,'id',$id); 
               if($result!=0){
                    header("location:home.php");
                }   
                else{
                header("location:update.php");
                }   
            }else{
                echo '<script type="text/javascript">

                      window.onload = function () { alert("Only pdf files are valid."); }
     
                      </script>';
                      $_SESSION['newid']=$id;
                     // header( "refresh:1;url=update.php" );//waits for 1 sec before header is sent
                     header('location:update.php?only pdf files');
            }
           
                // else{
                //     echo "Only pdf files are valid.";
                // }
            // if(in_array($ext,$validext)==true){
            //     echo "valid<br>";
              
            //     $rand = rand('111111','999999');
             
            //     $newname=$email.'_'.$rand.'_'.$filename;
                
            //     move_uploaded_file($tempname,'regs/'.$newname);
            //     $dir = 'regs/'.$newname;
            //     $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
                
            //     $obj = new query();
            //     $result = $obj->updateData('users',$data,'id',$id);
              
}
?>