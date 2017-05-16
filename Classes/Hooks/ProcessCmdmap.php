<?php

namespace STI\SemantifyIt\Hooks;

use STI\SemantifyIt\Controller\SemantifyItWrapperController;

class ProcessCmdmap
{
    //unused hooks
    //public function processCmdmap_preProcess($command, $table, $id, $value, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) { }
    //public function processDatamap_afterDatabaseOperations($status, $table, $id, array $fieldArray, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj) {echo 7;}


    public function processDatamap_postProcessFieldArray(
        $status,
        $table,
        $id,
        array &$fieldArray,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {

        //$this->hookDebug($status, $table, $id, $fieldArray, $pObj);

        //var_dump($pObj->datamap[$table][$id]);
        //$fieldArray["mayrhofen_annotator_annotationNew_ID"] = @$pObj->datamap[$table][$id]["mayrhofen_annotator_annotationNew_ID"];
        //$this->hookDebug($status, $table, $id, $fieldArray, $pObj);

        if (($status == 'update' || $status == 'new') && (($table == 'pages') || ($table == 'pages_language_overlay') || ($table == 'tx_news_domain_model_news') )) {

            //echo "PRE";
            //$this->hookDebug($status, $table, $id, $fieldArray, $pObj);
            //var_dump($pObj->datamap[$table][$id]);

            //get next id from mysql
            //if($status == 'new'){
            //$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
            //SELECT column_name FROM information_schema.columns WHERE table_name =
            //$result    = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid',$table, '' ,'','uid DESC', '1');
                //echo"<br><br><br><br>";
              //  var_dump($result);
            //echo $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery;
            //}


            //if we dont have our fields
            if (!$pObj->datamap[$table][$id]['mayrhofen_annotator_continue']) {
                return;
            }

            //value of the new annotation
            $newID = $pObj->checkValue_currentRecord["mayrhofen_annotator_annotationNew_ID"];

            /*
            //value of the current annotation, if not current then value will be from checkValue_currentRecord
            $annotationID = $pObj->checkValue_currentRecord["mayrhofen_annotator_annotationID"];
            if (isset($fieldArray['mayrhofen_annotator_annotationID'])) {
                $annotationID = $fieldArray['mayrhofen_annotator_annotationID'];
            }

            //if no annotation just quit
            if ($annotationID == 0) {
                return;
            }
            */

            //echo "compare: " . $newID . "=" . $annotationID;

            $other = $this->dataMapping($id, $fieldArray, $pObj, $table);

            $semantify = new SemantifyItWrapperController();
            $newAnnotation = $semantify->createAnnotation($pObj->datamap[$table][$id], $other);

            //var_dump($newAnnotation);
            //if annotation was not created due missing fields
            if($newAnnotation==false){
                return false;
            }

            //var_dump($newAnnotation);
            //var_dump($newID);

            //if it is a new annotation
            if (($annotationID == "") && (($newID == "") || ($newID == "0"))) {
                //echo "Post new Annotation";
                $uid = $semantify->postAnnotation($newAnnotation);
                //echo $uid;
                $fieldArray["mayrhofen_annotator_annotationNew_ID"] = $uid;
                $fieldArray["mayrhofen_annotator_annotationID"] = $uid;
                $fieldArray["mayrhofen_annotator_annotationNew_RAW"] = $newAnnotation;

                $pObj->datamap[$table][$id]["mayrhofen_annotator_annotationNew_ID"] = $uid;

            } //check if there is a new annotation id and it is a same as current annotation choosen one
            elseif ((isset($newID)) && ($newID != "") && ($newID != "0")) {

                //echo "Updating Annotation with id: " . $newID;
                $uid = $semantify->updateAnnotation($newAnnotation, $newID);

                //echo "#" . $uid;

                $fieldArray["mayrhofen_annotator_annotationNew_ID"] = $uid;
                $fieldArray["mayrhofen_annotator_annotationID"] = $uid;
                $fieldArray["mayrhofen_annotator_annotationNew_RAW"] = $newAnnotation;
                $pObj->datamap[$table][$id]["mayrhofen_annotator_annotationNew_ID"] = $uid;
            } else {

                //echo 'nothing choosed';

            }


            //}

            //var_dump($fieldArray);
        }

    }


    /**
     * @param                                          $status
     * @param                                          $table
     * @param                                          $id
     * @param array                                    $fieldArray
     * @param \TYPO3\CMS\Core\DataHandling\DataHandler $pObj
     */
    public function processDatamap_preProcessFieldArray(
        array &$fieldArray,
        $table,
        $id,
        \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj
    ) {

         //var_dump($fieldArray);

        //echo $fieldArray['mayrhofen_annotator_annotationID'] . "ID";

        $pObj->datamap[$table][$id]['mayrhofen_annotator_continue'] = false;
        //check fields if there is an ID
        if (
            isset($fieldArray['mayrhofen_annotator_annotationNew_Name'])
            && isset($fieldArray['mayrhofen_annotator_annotationNew_URL'])
            && isset($fieldArray['mayrhofen_annotator_annotationNew_StepOne'])
            && isset($fieldArray['mayrhofen_annotator_annotationNew_StepTwo'])
            && ($fieldArray['mayrhofen_annotator_annotationNew_StepOne']!='')
            && ($fieldArray['mayrhofen_annotator_annotationNew_StepTwo']!='')
            && ($fieldArray['mayrhofen_annotator_annotationNew_Name']!='')

        ) {
            //set to continue true
            $pObj->datamap[$table][$id]['mayrhofen_annotator_continue'] = true;
        }
        //$this->hookDebug($status, $table, $id, $fieldArray, $pObj);
    }

    /**
     * @param $id
     * @param $fieldArray
     * @param $pObj
     * @return array
     */
    private function dataMapping(&$id, &$fieldArray, &$pObj,&$table )
    {


        $other = array();
        $other['id'] = $id;
        $other['table'] = $table;
        $other['dateModified'] = $fieldArray['tstamp'];
        $other['dateCreated'] = $pObj->checkValue_currentRecord['crdate'];
        $other['name'] = $pObj->BE_USER->user['realName'];
        $other['email'] = $pObj->BE_USER->user['email'];

        return $other;
    }

    private function hookDebug(&$status, &$table, &$id, &$fieldArray, &$pObj)
    {
        echo "<br><br><br>";
        echo "**************ID**************" . "<br>";
        var_dump($id);
        echo "**************TABLE**************" . "<br>";
        var_dump($table);
        echo "**************STATUS**************" . "<br>";
        var_dump($status);
        echo "**************FIELDARRAY**************" . "<br>";
        var_dump($fieldArray);
        echo "**************POBJ**************" . "<br>";
        var_dump($pObj);

    }


}
