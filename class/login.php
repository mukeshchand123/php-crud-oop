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
            return $row;
         } else {
          //wrong password
        return false;
         }
     }else{
      //email not found.
     return NULL;
       }

    
}}
?>