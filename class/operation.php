<?php
require_once('query.php');
class operation{
 
    function fetch($table,$field,$condition=""){
    $obj = new query();
    $result = $obj->getData($table,$field,$condition);
    return $result;

  }
  
  function update($table,$data,$condition1,$condition2){
   // $data =['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'phn'=>$phnNumber,'password'=>$password,'cv'=>$dir];
     //deleting existing file           
    $obj = new query();
    $dir = $obj->getData('users','*',[$condition1=>$condition2]);
    $row = $dir->fetch_assoc();
    $cv =$row['cv'];
    unlink($cv);

    $result = $obj->updateData($table,$data,$condition1,$condition2);

    if($result!=0){
        header("location:home.php");
    }   
    else{
    header("location:update.php");
    }
  }
 
  function delete($table,$id){
    if($table =='users'){
    $obj = new query();
    $data = $obj->getData('users','*',['id'=>$id]);
    $row = $data->fetch_assoc();
    $userid =$row['id'];
    $obj1 = new query();
    $userdata = $obj->getData('user_files','*',['userid'=>$userid]);
    
    //deleting user files from directory
    if($userdata->num_rows>0){ 
      while($rows = $userdata->fetch_assoc()){
        $userfile = $rows['filedir'];
        unlink($userfile);
      }}
 
    $fildir = $row['cv'];
    unlink($fildir);
   
  $result =  $obj->deleteData('users',['id'=>$id]);
  return $result;
}elseif($table=='user_files'){
  $obj = new query();
  $data = $obj->getData('user_files','*',['id'=>$id]);
  $row = $data->fetch_assoc();
  $fildir = $row['filedir'];
  unlink($fildir);
$result =  $obj->deleteData('user_files',['id'=>$id]);

  if($result!=0){
      header("location:fetch.php");
  }
 
}

  }
 
  function search($table,$search,$parameter){
    $obj = new query();
    $result = $obj->searchData($table,$search,$parameter);
    return $result;
  }
}


?>