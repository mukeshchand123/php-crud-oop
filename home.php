<?php
require_once('query.php');
//require_once('registration.php')
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}
$obj = new query();
// $sql = "SELECT * FROM `useraccounts`.`users`";
$result = $obj->getData('users','*');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<!-- nav bar -->
<div>
<?php
   require_once('navbar2.php');
 ?>
</div>
 

    <table align="center" border="1px" width="800px">
        <tr>
           <tr> <th colspan="8"><h2>Users table</h2></th></tr>
            <th ><h2>id</h2></th>
            <th><h2>firstName</h2></th>
            <th><h2>lastname</h2></th>
            <th><h2>email</h2></th>
            <th><h2>phnNumber</h2></th>
            <th><h2>cv</h2></th>
            <th><h2>Action</h2></th>

            
        </tr>
        <?php
            while($row=$result->fetch_assoc()){
                echo"
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['firstname']."</td>
                    <td>".$row['lastname']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phn']."</td>
                    <td>".$row['cv']."</td>
                    <td><a href='delete.php ? i=$row[id]'>Delete <a href='update.php ? j=$row[id]
                   '>Update</td>
                </tr> ";         
                    

             }
             ?>
    </tablw>



      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
