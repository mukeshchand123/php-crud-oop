<?php
require_once('Database1.php');
class query1 extends database1{

//function for fetching data.

public function getData($table,$field='*',$condition="",$order1 ="",$order2 ="desc",$limit=""){

    $sql = "SELECT $field FROM `$table`";

    if($condition!=""){
        $sql = $sql." WHERE  ";
        $c = count($condition);
        $i=1;
       foreach($condition as $key=>$val){
            if($i==$c){
                $sql = $sql." `$key`='$val' ";
            }else{
                $sql = $sql."  `$key`='$val' AND ";
            }
            $i++;
       }
    }
    if($order1!=""){
        $sql = $sql." ORDER BY '$order1' '$order2' ";
    }
    if($limit!=""){
        $sql = $sql." LIMIT '$limit' ";
    }
   // echo"$sql<br>";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
  // $stmt= $this->pdo->query($sql);
   return $stmt;
    
   // print_r($result);
   
    // if($result->num_rows > 0){
    //     $arr = [];
    //     while($row = $result->fetch_assoc()){
    //         $arr[] = $row;
    //     }
    //     return $arr;
    // }else{
    //     return 0;
    // }

}

//function for Inserting data 

public function insertData($table,$condition){


    if($condition!=""){
      
       foreach($condition as $key=>$val){
           $fieldarr[] = $key;
           $valuesarr[] = $val; 
       }
       $field = implode("`,`", $fieldarr);
       $field = '`'.$field.'`';
       $value = implode("','", $valuesarr);
       $value = "'".$value."'";
       $sql = "INSERT INTO $table ($field) VALUES ($value)";
       $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
   //return $stmt;
    
       //echo$sql;
       if($stmt){
        // echo"Data inserted successfully.<br>"; display a message box.
        return true;
       }else {
        return false;
       }
    

    }    
}

//Function for delete
public function deleteData($table,$condition=""){

    $sql = "DELETE FROM `$table`";

    if($condition!=""){
        $sql = $sql." WHERE ";
        $c = count($condition);
        $i=1;
       foreach($condition as $key=>$val){
            if($i==$c){
                $sql = $sql." `$key`='$val' ";
            }else{
                $sql = $sql."  `$key`='$val' AND ";
            }
            $i++;
       }
       $stmt = $this->pdo->prepare($sql);
       $stmt->execute();
       return $stmt;
    
    }else{
        return 0;
    }
  
    

}

//fUNCTION FOR UPDATEDATA.
public function updateData($table,$condition="",$field,$value){

    $sql = "UPDATE `$table`";

    if($condition!=""){
        $sql = $sql." SET ";
        $c = count($condition);
        $i=1;
       foreach($condition as $key=>$val){
            if($i==$c){
                $sql = $sql." `$key`='$val' ";
            }else{
                $sql = $sql."  `$key`='$val', ";
            }
            $i++;
       }
       $sql = $sql." WHERE `$field` = '$value'";
       $stmt = $this->pdo->prepare($sql);
       $stmt->execute();
       return $stmt;
    
    
    }else{
        return 0;
    }
}
  
    //funnction for search
    public function searchData($table,$search,$key){
        $sql = "SELECT * FROM `$table` WHERE";
        $c = count($key);
        $i=0;
        foreach($key as $val){
            if($i<$c-1){
                $sql = $sql." `$key[$i]` LIKE '%$search%' OR ";
            }else{
                $sql = $sql." `$key[$i]` LIKE '%$search%' ";
            }
            $i++;
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
         
        //echo" $sql";
       


    }

}
?>