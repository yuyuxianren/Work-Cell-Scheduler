<?php
require_once 'Work-Cell-Scheduler/Web/tdd.php';

$worker = array ();
$cell = array ();
$product = array ();

$numworker = 5;
$numcell = 4;
$numpro = 6;

for($i = 0; $i < $numworker; $i ++) {
	$worker [] = "worker-$i";
}
for($i = 0; $i < $numcell; $i ++) {
	$cell [] = "cell-$i";
}
for($i = 0; $i < $numpro; $i ++) {
	$product [] = "product-$i";
}

print_r ( $worker );
print_r ( $cell );
print_r ( $product );

// test

$testworker = $worker [array_rand ( $worker )];
assertContains ( $testworker, array (
		"worker-1",
		"worker-2",
		"worker-3",
		"worker-4",
		"worker-0" 
) );

//
class Demand {
	public $product = NULL;
	public $cell = NULL;
	public $hours = NULL;
	function __construct($product, $cell) {
		$this->hours = rand ( 1, 3 );
		$this->product = $product;
		$this->cell = $cell;
		
		// return $product;
	}
}
class TrainingMatrix {
	public $worker = NULL;
	public $cell = NULL;
	public $productivity = NULL;
	function set($w, $c, $proty) {
		$this->worker = $w;
		$this->cell = $c;
		$this->productivity = $proty;
		return true;
	}
	function getworker() {
		return $this->worker;
	}
	function getcell() {
		return $this->cell;
	}
	function getproductivity() {		
		return $this->productivity;
	}
}

//$a = new Demand ();

$producti=array();
for ($i=0;$i<20;$i++){
	
	$b= new TrainingMatrix();
	$b->set($worker[array_rand($worker)],$cell[array_rand($cell)],rand(0,100)/100);
	$producti["{$b->getworker()}_{$b->getcell()}"] = $b ;
}
print_r($producti);



// echo $a->cell;
// for(i=10,)
// $a->cell=$cell[1];
// $a->prodect=$product[3];

/*foreach($worker as $w ){
	foreach($cell as $c){
		$abc["{$w}_{$c}"]=rand(0,100)/100;
		
	}
	}
  print_r($abc);      
  */ 
$test=new WebIS/OS;
$test






                                                  
?>