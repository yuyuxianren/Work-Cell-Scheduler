<?php
require_once 'Work-Cell-Scheduler/Web/tdd.php';

$worker=array();
$cell=array();
$product=array();

$numworker=5;
$numcell=4;
$numpro=6;


for($i=0;$i<$numworker;$i++){	
	$worker[]="worker-$i";	
}
for($i=0;$i<$numcell;$i++){
	$cell[]="cell-$i";
}
for($i=0;$i<$numpro;$i++){
	$product[]="product-$i";
	
	
}

print_r($worker);
print_r($cell);
print_r($product);


class Demand{
	
	public $product=NULL;
	public $cell=NULL;
	public $hours=NULL;
	
	function __construct($product,$cell){
		$this->hours=rand(1,3);
		$this->product=$product;
		$this->cell=$cell;
		
	    return $product; 
		
		
		
	}
	
	
}

class TrainingMatrix{
	
	public $worker=NULL;
	public $cell=NULL;
	
	
	
	
}
$a=new Demand;



print_r($worker[array_rand($worker)]);
//echo $a->cell;
//for(i=10,)
//$a->cell=$cell[1];
//$a->prodect=$product[3];





?>