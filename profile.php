<?php 
require_once('class/Database1.php');
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
    header("location:login.php");
    exit;
}
// db connection
$databse = new database1();
$con = $databse->con();
$id = $_SESSION['id'];

 
$sql = "SELECT `users`.`firstname`, `users`.`lastname`, `user_files`.`filename`, `user_files`.`filedir`,`user_files`.`id` FROM `users` LEFT JOIN `user_files` ON `user_files`.`userid` = `users`.`id` 
        WHERE `users`.`id` = '$id'";

 $result = $con->prepare($sql);
$result->execute();
//  while($row = mysqli_fetch_assoc($result)){
//     echo " ".$row['firstname']." ";
//     echo " ".$row['lastname']." ";
//     echo " ".$row['filename']." ";
//     echo " ".$row['filedir']."<br>";

//  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
        require_once('searchnav.php');
    ?>
<div>
   
    <table align="center" border="1px" width="800px">
<tr>
   <tr> <th colspan="8" ><h2>User_files table</h2></th></tr>
   <th ><h2>fileid</h2></th>
    <th ><h2>firstname</h2></th>
    <th ><h2>lastname</h2></th>
    <th ><h2>userid</h2></th>
    <th><h2>fileName</h2></th>
    <th><h2>filedir</h2></th>
    

    
</tr>
<?php
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        echo"
        <tr>
           <td>".$row['id']."</td>
            <td>".$row['firstname']."</td>
            <td>".$row['lastname']."</td>
            <td>".$id."</td>
            <td>".$row['filename']."</td>
            <td>".$row['filedir']."</td>
            
           
        </tr> ";         
            

     }
     ?>
</tablw>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>



