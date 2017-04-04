<?php
namespace STI\SemantifyIt\Hooks;

use STI\SemantifyIt\Controller\SemantifyItWrapperController;

class ProcessCmdmap
{
    //unused hooks
    //public function processCmdmap_preProcess($command, $table, $id, $value, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) { }
    //public function processDatamap_preProcessFieldArray(array &$fieldArray, $table, $id, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {}
    //public function processDatamap_afterDatabaseOperations($status, $table, $id, array $fieldArray, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {echo 7;}


    /**
     * @param                                          $status
     * @param                                          $table
     * @param                                          $id
     * @param array                                    $fieldArray
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj
     */
    public function processDatamap_postProcessFieldArray(
        $status,
        $table,
        $id,
        array &$fieldArray,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {

        //$this->hookDebug($status, $table, $id, $fieldArray, $pObj);

        //value of stepone
        $stepone = $pObj->datamap['pages'][$id]["semantify_it_annotationNew_StepOne"];
        //value of the new annotation
        $annotationID = $pObj->datamap['pages'][$id]["semantify_it_annotationID"];

        //we make a new annotation if we have table pages and field stepone is not empty
        if(($table=="pages") && ($stepone!="")){

            $other=$this->dataMapping($id, $fieldArray, $pObj);

            $semantify = new SemantifyItWrapperController();
            $newAnnotation =  $semantify->createAnnotation($pObj->datamap['pages'][$id], $other);


            //if it is a new annotation
            if($annotationID=="1"){
                $response =  $semantify->model->postAnnotation($newAnnotation);
                var_dump($response);

            }

        }

    }

    /**
     * @param $id
     * @param $fieldArray
     * @param $pObj
     * @return array
     */
    private function dataMapping(&$id, &$fieldArray, &$pObj){
        $other = array();
        $other['id'] = $id;
        $other['dateModified'] = $fieldArray['tstamp'];
        $other['dateCreated'] = $pObj->checkValue_currentRecord['crdate'];
        $other['name']        = $pObj->BE_USER->user['realName'];
        $other['email']       = $pObj->BE_USER->user['email'];

        return $other;
    }

    private function hookDebug(&$status, &$table, &$id, &$fieldArray, &$pObj){

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

    }


}