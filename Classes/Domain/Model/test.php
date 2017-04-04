<?php

use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;

include_once "SemantifyItWrapper.php";


$sem = new SemantifyItWrapper("SkRwv0M2e");


//echo $sem->getAnnotation("rJL4cNBsg");
echo "<pre>";
var_dump($sem->getAnnotationList());
