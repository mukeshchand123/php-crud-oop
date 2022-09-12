<?php
require_once('query.php');
require_once('file.php');
class operation extends query{
 
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
    $row = $dir->fetch_assoc();
    $cv =$row['cv'];
    unlink($cv);

    $result = $this->updateData($table,$data,$condition1,$condition2);

    if($result!=0){
        header("location:home.php");
    }   
    else{
    header("location:update.php");
    }
  }
 
  function delete($table,$id){
    if($table =='users'){
   // $obj = new query();
    $data = $this->getData('users','*',['id'=>$id]);
    $row = $data->fetch_assoc();
    $userid =$row['id'];
    $obj1 = new filehandling();
    $obj1-> filedelete($table,'id',$id);

    // $userdata = $this->getData('user_files','*',['userid'=>$userid]);
    
    // //deleting user files from directory
    // if($userdata->num_rows>0){ 
    //   while($rows = $userdata->fetch_assoc()){
    //     $userfile = $rows['filedir'];
    //     unlink($userfile);
    //   }}
 
    // $fildir = $row['cv'];
    // unlink($fildir);
   
  $result =  $this->deleteData('users',['id'=>$id]);
  return $result;
}elseif($table=='user_files'){
  //$obj = new query();
  $obj1 = new filehandling();
    $obj1-> filedelete('user_files','id',$id);
$result =  $this->deleteData('user_files',['id'=>$id]);

  if($result!=0){
      header("location:fetch.php");
  }
 
}

  }
 
  function search($table,$search,$parameter){
  //  $obj = new query();
    $result = $this->searchData($table,$search,$parameter);
    return $result;
  }
}


?>