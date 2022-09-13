<?php 
require_once('query.php');

class registration extends query {

    function register($data,$email){

             
       // $obj = new query();
        $result = $this->getData('users',"email",['email'=>$email]);
        if($result->num_rows > 0){
           // echo "email already exists.Please enter a new email.";
           return false;
        }else{
        $this->insertData('users',$data);
        return true;
        }


    }
}

  


?>