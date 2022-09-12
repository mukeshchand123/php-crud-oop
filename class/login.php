<?php 
require_once('query.php');

class login {

    function __construct($email,$password){

     $obj = new query();
  
     $result = $obj->getData('users','*',['email'=>$email]);
    
     if($result->num_rows > 0){
       
        //verify password
       
        $row = $result->fetch_assoc();
        
      if(md5($password)==$row['password']){
        //if password matches.
            session_start();
             $_SESSION['email'] = $email;
             $_SESSION['username'] = $row['firstname'].' '.$row['lastname'];
             $_SESSION['id'] = $row['id'];
             $_SESSION['login'] = true;
             $_SESSION['phnNumber']= $row['phn'];
             $_SESSION['cv']=$row['cv'];
             header("location:welcom.php");

      }else{
       // echo "Wrong password";
        echo '<script type="text/javascript">

              window.onload = function () { alert("wrong password"); }

              </script>';
             // header("location:login.php?msg=Wrong password");

      }
     }else{
                // echo"user not registered.Please register before loging in.";
                 echo '<script type="text/javascript">

                      window.onload = function () { alert("user not registered.Please register before loging in."); }
     
                      </script>';
                     // sleep(5);
                      //header("location:registration.php");
             }

    }
}

  


?>