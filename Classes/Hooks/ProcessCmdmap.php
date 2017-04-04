<?php
namespace STI\SemantifyIt\Hooks;

use STI\SemantifyIt\Controller\SemantifyItWrapperController;

class ProcessCmdmap
{
    //unused hooks
    //public function processCmdmap_preProcess($command, $table, $id, $value, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) { }
    public function processDatamap_postProcessFieldArray(
        $status,
        $table,
        $id,
        array &$fieldArray,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ){
        echo "POST";
        $this->hookDebug($status, $table, $id, $fieldArray, $pObj);

    }
    //public function processDatamap_afterDatabaseOperations($status, $table, $id, array $fieldArray, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {echo 7;}


    /**
     * @param                                          $status
     * @param                                          $table
     * @param                                          $id
     * @param array                                    $fieldArray
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj
     */
    public function processDatamap_preProcessFieldArray(array &$fieldArray, $table, $id, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {
        echo "PRE";
        //$this->hookDebug($status, $table, $id, $fieldArray, $pObj);

        ////value of the new annotation
        $newID = $pObj->datamap['pages'][$id]["semantify_it_annotationNew_ID"];
        //value of the current annotation
        $annotationID = $fieldArray["semantify_it_annotationID"];

        $name = $fieldArray["semantify_it_annotationNew_Name"];

        //we make a new annotation if we have table pages and field stepone is not empty
        if(($table=="pages") && ($name!="")){
            //if it is a new annotation
            $other=$this->dataMapping($id, $fieldArray, $pObj);

            $semantify = new SemantifyItWrapperController();
            $newAnnotation =  $semantify->createAnnotation($pObj->datamap['pages'][$id], $other);

            //if it is a new annotation
            if($annotationID=="1"){
                echo "Post";
                $id =  $semantify->postAnnotation($newAnnotation);
                $fieldArray["semantify_it_annotationNew_ID"] = $id;
                $fieldArray["semantify_it_annotationID"] = $id;
            }

            //check if there is a new annotation id and it is a same as current annotation choosen one
            if((isset($newID)) && ($newID!="") && ($newID == $annotationID)){
                echo "Update";
                $id =  $semantify->updateAnnotation($updateAnnotation, $newID);
                $fieldArray["semantify_it_annotationNew_ID"] = $id;
                $fieldArray["semantify_it_annotationID"] = $id;
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