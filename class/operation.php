<?php
require_once('Query1.php');
require_once('file.php');
class operation extends query1{
 
    function fetch($table,$field,$condition=""){
    //$obj = new query();
    $result = $this->getData($table,$field,$condition);
    return $result;

  }
  
  function update($table,$data,$condition1,$condition2){
   // $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
     //deleting existing file           
    //$obj = new query();
    $dir = $this->getData('users','*',[$condition1=>$condition2]);
    $row = $dir->fetch(PDO::FETCH_ASSOC);
    $cv =$row['cv'];
    unlink($cv);

    $result = $this->updateData($table,$data,$condition1,$condition2);
    return $result;
    // if($result!=0){
    //     header("location:home.php");
    // }   
    // else{
    // header("location:update.php");
    // }
  }
 
  function delete($table,$id){
    if($table =='users'){
   // $obj = new query();
    $data = $this->getData('users','*',['id'=>$id]);
    $row = $data->fetch(PDO::FETCH_ASSOC);
    $file = $row['cv'];
    unlink($file);
    $userid =$row['id'];
    $obj1 = new filehandling();
    $obj1-> filedelete('user_files','userid',$id);
    if($obj1 == true){
      $result =  $this->deleteData('users',['id'=>$id]);
      return $result;
    }else{
      echo"file not found.";
    }

 
}elseif($table=='user_files'){
 
  $obj1 = new filehandling();
    $obj1-> filedelete('user_files','id',$id);
 $result =  $this->deleteData('user_files',['id'=>$id]);
 return $result;
  // if($result!=0){
  //     header("location:fetch.php");
  // }
 
}

  }
 
  function search($table,$search,$parameter){
  //  $obj = new query();
    $result = $this->searchData($table,$search,$parameter);
    return $result;
  }
}


?>