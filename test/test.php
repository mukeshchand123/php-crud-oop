<?php
    class Shape {
            public $a = "mukesg";
            protected $c;
        function __construct() { 
           $this->c = "chand";
        }
    }

    class Triangle extends Shape {
        function a(){    
        $b = this->$a;
        echo "this is". $b;
        
    }
    }

    class Line extends Triangle{

    }

    $shape = new Shape();

    echo"$shape->$c";
?>