<?php
    session_start();
   
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
   
    require_once('class/operation.php');
   
    $id = $_GET['i'];
    
    $obj = new operation();
    $obj->delete('user_files',$id);

//for data deletion from database
  //   $obj = new query();
  //   $data = $obj->getData('user_files','*',['id'=>$id]);
  //   $row = $data->fetch_assoc();
  //   $fildir = $row['filedir'];
  //   unlink($filedir);
  // $result =  $obj->deleteData('user_files',['id'=>$id]);

  //   if($result!=0){
  //       header("location:fetch.php");
  //   }
   
   
   
//  "DELETE FROM users WHERE `users`.`id` = 22"?
?>