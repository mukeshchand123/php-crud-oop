<?php 
require_once('query.php');

class login extends {

    function __construct($email,$password){

     $obj = new query();
  
     $result = $obj->getData('users','*',['email'=>$email]);
    
     if($result->num_rows > 0){
        echo "email verified<br>";
        //verify password
       
        $row = $result->fetch_assoc();
        echo $row['email'];
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
        echo "Wrong password";
      }
     }else{
                 echo"user not registered.Please register before loging in.";
                // header("location:login.php");
             }

    }
}

  


?>