<?php

use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;

include_once "SemantifyItWrapper.php";


$sem = new SemantifyItWrapper("rkvpGNrix");


//echo $sem->getAnnotation("rJL4cNBsg");
echo "<pre>";
var_dump($sem->getAnnotationList());
