<?php
$a_bool = true;   // a bool
$a_bool2 = false;
$a_str  = "foo";  // a string
$a_str2 = 'foo2';  // a string
$an_int = 12;     // an int
echo get_debug_type($a_bool), "\n";
echo get_debug_type($a_str), "\n";

if (is_int($an_int)) {
    $an_int += 4;
}
var_dump($an_int);

if (is_string($a_str)) {
    echo "String: $a_bool"."\n";
    echo "String: $a_bool2"."\n";
    echo "String: $an_int";
}



