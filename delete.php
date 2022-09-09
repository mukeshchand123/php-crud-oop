<?php
    session_start();
   
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
    require_once('database.php');
   
    $id = $_GET['i'];
    if($id == $_SESSION['id']){ 
//for data deletion from database
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
 
    $fildir = $row['filedir'];
    unlink($filedir);
   
  $result =  $obj->deleteData('users',['id'=>$id]);

    if($result!=0){
        header("location:login.php");
    }
  }else {
    $obj = new query();
    $data = $obj->getData('users','*',['id'=>$id]);
    $row = $data->fetch_assoc();
    $userid =$row['id'];
    $obj1 = new query();
    $userdata = $obj->getData('user_files','*',['userid'=>$userid]);
   
    //deleting user files from directory
    if($userdata->num_rows>0){ 
    while($rows = $userdata->fetch_assoc()){
      $userfile = $row['filedir'];
      unlink($userfile);
    }}
 
    $fildir = $row['filedir'];
    unlink($filedir);
   
  $result =  $obj->deleteData('users',['id'=>$id]);

    if($result!=0){
        header("location:home.php");
    }
  } 
   
   
//  "DELETE FROM users WHERE `users`.`id` = 22"?
?>