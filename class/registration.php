<?php 
require_once('Query1.php');

class registration extends query1 {

    function register($data,$email){

             
       // $obj = new query();
        $result = $this->getData('users',"email",['email'=>$email]);
        $num_rows = $result->rowCount();
        if($num_rows > 0){
           // echo "email already exists.Please enter a new email.";
           return false;
        }else{
        $this->insertData('users',$data);
        return true;
        }


    }
}

  


?>