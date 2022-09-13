<?php 
require_once('query.php');

class login {

    function login($email,$password){

     $obj = new query();
  
     $result = $obj->getData('users','*',['email'=>$email]);
    
     if($result->num_rows > 0){
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
            // header("location:welcom.php");
            return true;
         } else {
        return false;
         }
     }else{
     return NULL;
       }

    
}}
?>