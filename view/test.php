





<?php
$mood = "Ricardo is hungry"; /* global scope */ 
$food = "hamburguer";

function test()
{ 
    global $mood, $food;
    echo $mood . " and wants to eat a " . $food; /* reference to local scope variable */ 
} 

test();
?>








































































<?php
    // $mood = "Ricardo is hungry"; /* global scope */ 
    // $food = "hamburguer";
    
    // function test()
    // { 
    //     echo $GLOBALS['mood'] . " and wants to eat a " . $GLOBALS['food']; /* reference to local scope variable */ 
    // } 
    
    // test();
?>