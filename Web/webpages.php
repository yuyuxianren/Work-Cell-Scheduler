<!DOCTYPE html>
<html>
<head>
<!-- Person Edit Copyright 2014 by WebIS Spring 2014 class License Apache 2.0 -->
<meta charset="UTF-8">
<title>Optimization</title>
</head>
<body>
<?php require_once 'Work-Cell-Scheduler/Web/structure.php';?>
<strong>
<font style="font-family:Cursive;color:green" size="5">Productivity</font>
</strong>
<table border = 1>


<?php 
   foreach ($worker as $w){
   	echo "<tr>";
   	echo "<td>$w</td>";
   	  foreach ($cell as $c){
           $tmp = $producti["{$w}_{$c}"];
   	       echo "<td>$tmp</td>";}
   
    	echo "</tr>";
      }
?>
</table>

<strong><font style = "font-family:Cursive;color:Coral" size="5">Demandlist</font></strong>
<table border = 1>
<tr>
<td></td>

<?php 
   foreach ($cell as $c){  	
     echo "<td>$c</td>";
   }
?>

</tr>

<?php 
   foreach ($product as $p){
   	echo "<tr>";
   	echo "<td>$p</td>";
   	  foreach ($cell as $c){
           if ( ($demandlist["{$p}_{$c}"]->hours)==NULL)
            $tmp =0;
           else
           $tmp = $demandlist["{$p}_{$c}"]->hours;
           
   	       echo "<td>$tmp</td>";}
   
    	echo "</tr>";
      }
?>

</table>
<strong><font style = "font-family:Cursive;color:CornflowerBlue" size="5">Optimization</font></strong>
<table border = 1>
<tr>
<td>solution</td>
<?php 
$tmp=$OF->getSolution();
echo "<td>$tmp</td>";


?>

</tr>
<tr>
<td></td>


<?php 
   foreach ($cell as $c){  	
     echo "<td>$c</td>";
   }
?>

</tr>

<?php 
   foreach ($worker as $w){
   	echo "<tr>";
   	echo "<td>$w</td>";
   	  foreach ($cell as $c){
           $tmp = $OF->getVariable("{$w}_{$c}");
   	       echo "<td>$tmp</td>";}
   
    	echo "</tr>";
      }
?>

</table>

</body>
</html>