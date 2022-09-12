<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header("location:login.php");
}

require_once('class/query.php');

if(isset($_POST['create'])){

    foreach($_FILES['file']['name'] as $key => $val ){
        $rand = rand('11111','99999');
        $file = $rand.'_'.$val;
        move_uploaded_file($_FILES['file']['tmp_name'][$key],'files/'.$file);
       // $dir = pathinfo($file);
        $path = 'files/'.$file;
       // echo $path."<br>";
       $id = $_SESSION['id'];
    //    $sql = "INSERT INTO `user_files` (`userid`, `filename`, `filedir`) VALUES ('$id','$file','$path');";
    //    mysqli_query($con,$sql);
        $obj = new query();
        $obj->insertData('user_files',['userid'=>$id,'filename'=>$file,'filedir'=>$path]);

        header('location:fetch.php');


    }

}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP|CRUD</title>
  </head>
  <body>
   

    <!-- Nav Bar -->
    <div>
        <?php
            require_once('navbar2.php');
        ?>
    </div>
   
    
    </div>


<!-- form for file upload -->
    <form action="multiple_files.php" method="post" enctype="multipart/form-data" >
   
   <div class="container">
       <div class="row">
           <div class="col-sm-3">
               <h1>Registration</h1>
               <p>Please Enter Valid Information:</p>
               
               <!-- <label for="cv">CV</label> -->
               <input type="file" name="file[]" id="file" accept="application/pdf" multiple required>
             

               <hr class="mb-3">
               
               <input class="btn btn-primary" type="submit" name="create" value="Upload">
           </div>
       </div>
   </div>

</form>
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>