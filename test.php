<?php

require_once('database.php');

$obj = new query();
$condition = ['userid'=> 1,'filename'=>'cv.txt','filedir'=>'regs/cv.txt'];
$condition1=['id','name',"lastname"];
$field = 'userid';
$value = 80;
//$result = $obj->getData('users');
// $result = $obj->getData('user_files');
// echo "<pre>";
// print_r($result);
// $result = $obj->insertData('user_files',$condition);
// echo "Query for insert: $result<br>";
// $result = $obj->deleteData('user_files',$condition);
// echo "Query for Delete: $result<br>";
$result = $obj->updateData('user_files',$condition,$field,$value);
echo "Query for Update: $result<br>";
$result = $obj->searchData('user_files','chand',$condition1);

?>