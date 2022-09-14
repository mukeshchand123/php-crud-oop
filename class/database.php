<?php

//class for database connection.

class database{
    //variables for db connection.

    private  $host;
    private  $username;
    private  $password;
    private  $db;
    protected $con;

    // function for database connection.

        function __construct(){
        $this->host      = 'localhost';
        $this->username  = 'root';
        $this->password   = "";
        $this->db        = 'testdb';
       
        //connecting to the database.
       $this->con = new mysqli($this->host, $this->username, $this->password, $this->db);

      
        
        //return $con;
    }
    function con(){
        return $this->con;
    }

}





?>
