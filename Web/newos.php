<?php
require_once 'Work-Cell-Scheduler/WCS/os.php';
include 'Work-Cell-Scheduler/Config/local-linux.php';

$OS= new WebIS\OS;
$OS->addVariable('x11');
$OS->addObjCoef('x11','3');
$OS->addVariable('x12');
$OS->addObjCoef('x12','2');
$OS->addVariable('x21');
$OS->addObjCoef('x21','1');
$OS->addVariable('x22');
$OS->addObjCoef('x22','5');
$OS->addVariable('x31');
$OS->addObjCoef('x31','5');
$OS->addVariable('x32');
$OS->addObjCoef('x32','4');
$OS->addConstraint(45);
$OS->addConstraintCoef('x11',1);
$OS->addConstraintCoef('x12',1);
$OS->addConstraint(60);
$OS->addConstraintCoef('x21',1);
$OS->addConstraintCoef('x22',1);
$OS->addConstraint(35);
$OS->addConstraintCoef('x31',1);
$OS->addConstraintCoef('x32',1);
$OS->addConstraint(null,50);
$OS->addConstraintCoef('x11',1);
$OS->addConstraintCoef('x21',1);
$OS->addConstraintCoef('x31',1);
$OS->addConstraint(null,60);
$OS->addConstraintCoef('x12',1);
$OS->addConstraintCoef('x22',1);
$OS->addConstraintCoef('x32',1);
$OS->solve();
print_r($OS);




?>