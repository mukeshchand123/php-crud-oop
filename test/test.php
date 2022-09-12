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

    class Line extends Triangle{

    }

    $tri = new Line();
?>