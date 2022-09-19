<?php 

function phnvalidate($phn){
    if(preg_match('/^[0-9]{10}+$/', $phn)) {
        return true;
        } else {
            return false;
        }
}

?>