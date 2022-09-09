<?php
    class Shape {
            public $a = "mukesg";
            private $c;
        function __construct() { 
            echo 'Shape.';
        }
    }

    class Triangle extends Shape {
        function a(){    
        $b = this->$a;
        echo "this is". $b;
        
    }
    }


    $tri = new Triangle();
?>