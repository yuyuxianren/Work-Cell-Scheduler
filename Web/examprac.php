<?php
require 'Work-Cell-Scheduler/WCS/os.php';

//build the array
$department= array();
$supplier=array();


$numberS=3;
$numberD=3;

for($i=1;$i<=$numberD;$i++){
	
	$department[]="department-$i";
	
}
print_r($department);

for($i=1;$i<=$numberS;$i++){
	
	$supplier[]="supplier-$i";
	
}
print_r($supplier);

$capacity = array();

$distance=array();
$profit=array();

foreach


