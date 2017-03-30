<?php

namespace STI\SemantifyIt\Hooks;

use \STI\SemantifyIt\Controller\SemantifyItController;

class ProcessCmdmap
{


    //public function processCmdmap_preProcess($command, $table, $id, $value, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) { }

    //public function processDatamap_preProcessFieldArray(array &$fieldArray, $table, $id, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {}

    //public function processDatamap_afterDatabaseOperations($status, $table, $id, array $fieldArray, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {echo 7;}


    public function processDatamap_postProcessFieldArray(
        $status,
        $table,
        $id,
        array &$fieldArray,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {

        /*
        echo "**************ID**************"."<br>";
        var_dump($id);
        echo "**************TABLE**************"."<br>";
        var_dump($table);
        echo "**************STATUS**************"."<br>";
        var_dump($status);
        echo "**************FIELDARRAY**************"."<br>";
        var_dump($fieldArray);
        echo "**************POBJ**************"."<br>";
        var_dump($pObj);
        */

        $other = array();
        $other['id'] = $id;
        $other['tstamp'] = $fieldArray['tstamp'];


        $semantify = new SemantifyItController();
        $semantify->createAnnotation($pObj->datamap['pages'][$id], $other);


    }

}