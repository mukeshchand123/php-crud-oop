<?php
    session_start();
    require_once('class/operation.php');
   
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
   
   
    $id = $_GET['i'];
    if($id == $_SESSION['id']){ 

    $obj = new operation();
    $result = $obj->delete('users',$id);

    if($result!=0){
      $_SESSION = array();
      session_destroy();
        header("location:login.php");
    }
  }else {

  $obj = new operation();
  $result = $obj->delete('users',$id);
    if($result!=0){
        header("location:home.php");
    }
  } 
   
   
//  "DELETE FROM users WHERE `users`.`id` = 22"?
?>