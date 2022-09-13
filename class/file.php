<?php
require_once('query.php');
class filehandling extends query{
    function file_upload($filename,$tmp_name,$dirname,$email){
                 $rand = rand('111111','999999');
             
                $newname=$email.'_'.$rand.'_'.$filename;
                
                move_uploaded_file($tmp_name,$dirname.'/'.$newname);
                  $dir = $dirname.'/'.$newname;
                  return $dir;
    }
    function fileValidation($ext, $validext){

        if(in_array($ext,$validext)==true){
            return true;
        }else{
            return false;
        }

    }
    function filedelete($table,$userid,$id){
        //$obj = new query();
        $flag = false;
        $userdata = $this->getData($table,'*',[$userid=>$id]);
        
        //deleting user files from directory
        if($userdata->num_rows>0){ 
          while($rows = $userdata->fetch_assoc()){
            $userfile = $rows['filedir'];
            unlink($userfile);
            $flag = true;
          }}

          return $flag;
    }
}


?>