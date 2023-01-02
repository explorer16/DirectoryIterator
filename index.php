<?php

require 'vendor/autoload.php';

$object=new Classs\MyIterator('tables.csv');
foreach ($object as $key=>$value){
    echo $key.'.';
    echo "Это было днём $value[0] числа $value[1] месяца $value[2] года\n";
}
