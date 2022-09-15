<?php
    session_start();
   
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
   
    require_once('class/operation.php');
   
    $id = $_GET['i'];
    
    $obj = new operation();
   $result= $obj->delete('user_files',$id);
   if($result==true){
        header("location:fetch.php");
    }else{
      echo"file not found";
    }
   

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