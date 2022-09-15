<?php 
require_once('Query1.php');

class login {

    function login($email,$password){

     $obj = new query1();
  
     $result = $obj->getData('users','*',['email'=>$email]);
  
    
     $num_rows = $result->rowCount();
   //  var_dump($num_rows); 
     if($num_rows > 0){
      $row = $result->fetch(PDO::FETCH_ASSOC); 
     // var_dump($row);
    
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

     }
    

    }
?>