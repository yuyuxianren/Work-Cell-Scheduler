<?php
require_once "Work-Cell-Scheduler/WCS/os.php";

Class Problemdata{
	
    private $supplierNum=3;
    private $departmentNum=3;
    private $of=NULL;
	
	//build the array
	

	function loadProblem($supplierNum,$departmentNum){
		
		$this->supplierNum=$supplierNum;
		$this->departmentNum=$departmentNum;
		
		$department= array();
		for($i=1;$i<=$departmentNum;$i++){
		
			$department[]="department-$i";
		}
		$this->department=$department;
		
	    $supplier=array();
	    for($i=1;$i<=$supplierNum;$i++){    
	    	$supplier[]="supplier-$i";
	    }
	    $this->supplier=$supplier;
	    
	    $capacity = array();
	    foreach($supplier as $S){
	    	$capacity["$S"]=rand(300,600);
	    }
	    $this->capacity=$capacity;
	    
	    $demand = array();
	    foreach ($department as $D){
	    	$demand["$D"]=rand(200,500);
	    }
	    $this->demand=$demand;
	    
	    $profit = array();
	    foreach($department as $D){
	    	$profit["$D"]=rand(20,50);
	    }
	    $this->profit=$profit;
		
		
	}

	//echo "department:\n";
	//print_r($department);
	
  function loadCost(){
  	
  	$distance=array();
  	foreach ($this->supplier as $S){
  		foreach ($this->department as $D){
  			$distance["{$S}_{$D}"]= new Cost($S,$D,rand(2,8));
  	
  		}
  	}
  	$this->distance=$distance;
  }
  	
  	// profit - distance (cost)
  	
  function Calculate(){
  	$profit = $this->profit;
  	$distance=$this->distance;
  	$paralist=array();
  	
  	/*foreach ($department as $D){
  		foreach ($supplier as $S){
  			$paralist["{$S}_{$D}"] = $profit["$D"] - $distance["{$S}_{$D}"]->distance;
  			 
  		}
  	}
  	*/
  	
  	foreach ($distance as $key => $d){	
  		$paralist[$key]=$profit[$d->department] - $d->distance;	
  	}
  	  $this->paralist=$paralist;
  }



	// build the objective function
	
  function Solve(){
  	
  	    $paralist = $this->paralist;
  		$OF = new WebIS\OS;
  		foreach ($this->supplier as $S){
  			foreach ($this->department as $D){
  				$OF->addVariable("{$S}_{$D}");
  				$OF->addObjCoef("{$S}_{$D}", $paralist["{$S}_{$D}"]);
  			}
  		}
  		//add constrains
  		foreach ($this->capacity as $key => $C){
  			$OF->addConstraint(NULL,$C);
  			foreach ($this->department as $D){
  				$OF->addConstraintCoef("{$key}_{$D}",1);
  		
  			}
  		}
  		
  		foreach ($this->demand as $key => $D){
  			$OF->addConstraint($D,NULL);
  			foreach ($this->supplier as $S){
  				$OF->addConstraintCoef("{$S}_{$key}",1);
  		
  			}
  		}
  	
  	 $this->of=$OF;
  	 return $OF->solve();
  	 	
  }
  
  function displayProblem(){
  	    

  	    $capacity=$this->capacity;
  	    echo "Supplier Capacity:\n";
  		echo "<table border='1'>\n";
  		foreach($this->supplier as $S){
  			echo "<tr><th>$S</th>";
  			echo "<td>$capacity[$S]</td>";
  		}
  		echo "</table>\n";
  		echo "\n";
  		
  		echo "Department Demand:\n";
  		$demand=$this->demand;
  		echo "<table border='1'>\n";
  		foreach($this->department as $D){
  			echo "<tr><th>$D</th>";
  			echo"<td>$demand[$D]</td>";	
  		}
  		echo "</table>\n";
  		
  		echo "Department Profit:\n";
  		$profit=$this->profit;
  		echo "<table border='1'>\n";
  		foreach($this->department as $D){
  			echo "<tr><th>$D</th>";
  			echo"<td>$profit[$D]</td>";
  		}
  			echo "</table>\n";
        
  	   echo "Distance:\n";
  		$distance=$this->distance;
  		echo "<table border='1'><tr><td>\n";
  		foreach($this->supplier as $S){
  			echo "<th>$S</th>";
  			}
  	    foreach($this->department as $D){
  	    	echo "<tr><th>$D</th>";
  	    	foreach($this->supplier as $S){
  	    		$var = $distance["{$S}_{$D}"]->distance;
  	    		echo "<td>$var</td>";
  	    		
  	    	}
  	    	
  	    }
  	    echo "</table>\n";
  
  	}
  	 
  
  function displaySolution(){
  	
  	if(($this->of->getSolution()==NULL))
  		echo "this total number of demand larger than capacity total, you cannot get the solution.";
  	else
  	{echo "The solution:\n";
  	print_r($this->of->getSolution());
  	
  	echo "<table border='1'><tr><td>\n";
  	foreach($this->supplier as $S){
  		echo "<th>$S</th>";
  	}
  	foreach($this->department as $D){
  	echo "<tr><th>{$D}: ";
  	foreach($this->supplier as $S){
  	$var="${S}_${D}";
  	$var=$this->of->getVariable($var);
  	echo "<td>$var</td>";
  	}
  	echo "<tr>\n";
  	}
  	/*echo "<tr><th>Total</th>";
  	foreach($supplier as $S){
  	foreach ($department as $D){
  	$tmp += $OF->getVariable("{$S}_{$D}");
  	}
  	echo "<td>$tmp</td>";
  	}
  	echo "</tr>";
  	*/
  	
  	echo "\n</table>";
  	
  	echo "\n</body></html>\n";

  	
  }
  
  
}
  
}
  
	
Class Cost{
	
	public $department = NULL;
	public $supplier = NULL;
	public $distance = NULL;
	
	function __construct($supplier,$department,$distance){
		$this->department=$department;
		$this->supplier=$supplier;
		$this->distance=$distance;				
	}

}


$test = new Problemdata();

$test->loadProblem(3,3);

$test->loadCost();

$test->Calculate();
	
$test->Solve();

$test->displayProblem();
	
$test->displaySolution();

?>