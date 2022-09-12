<?php 
require_once('query.php');

class registration {

    function register($data,$email){

             
        $obj = new query();
        $result = $obj->getData('users',"email",['email'=>$email]);
        if($result->num_rows > 0){
            echo "email already exists.Please enter a new email.";
        }else{
        $obj->insertData('users',$data);
        }


    }
}

  


?>