<?php

namespace STI\SemantifyIt\Controller;

use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Core\Utility\DebugUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;

/**
 * SchemantifyItController
 */
class SemantifyItWrapperController extends ActionController
{

    public $model;


    /**
     * displaying warnings
     *
     * @var bool
     */
    private $warnings = true;


    function __construct()
    {
        $this->model = new SemantifyItWrapper();
        $this->initialize();
    }

    /**
     * @return \STI\SemantifyIt\Domain\Model\SemantifyItWrapper
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param \STI\SemantifyIt\Domain\Model\SemantifyItWrapper $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }


    /**
     * registering warning message
     *
     * @param $message
     */
    private function registerWarning($message)
    {
        if ($this->warnings) {
            $this->displayMessage($message, "warning");
        }

    }

    /**
     * displayin message
     *
     * @param $message
     */
    private function displayMessage($message, $type)
    {
        //echo "<br/><br/><div style='position:absolute;top:65px; margin:24px;padding: 5px;'>" . $message . "</div>";
        switch ($type) {

            case "warning":
                $t3type = \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING;
                $header = "Warning";
                break;

            default:
                $t3type = \TYPO3\CMS\Core\Messaging\FlashMessage::NOTICE;
                $header = "Notice";
                break;

        }

        $mes = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\FlashMessage::class,
            $message,
            $header, // [optional] the header
            $t3type, // [optional] the severity defaults to \TYPO3\CMS\Core\Messaging\FlashMessage::OK
            true // [optional] whether the message should be stored in the session or only in the \TYPO3\CMS\Core\Messaging\FlashMessageQueue object (default is false)
        );

    }


    /**
     *
     * sorting array
     *
     * @param $a
     * @param $b
     * @return int
     */
    private static function type_sort($a, $b)
    {
        sort($a->type);
        sort($b->type);

        $typeA = implode(" ", $a->type);
        $typeB = implode(" ", $b->type);

        if ($typeA > $typeB) {
            return -1;
        } else {
            if ($typeA < $typeB) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    /**
     *
     * get list of annotations based on key
     *
     * @return mixed
     */
    public function getAnnotationList()
    {
        $annotationList[] = array(
            "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationList",
            ""
        );
        $annotationList[] = array(
            "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationListNone",
            "0"
        );

        $annotationList[] = array(
            "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationListNew",
            "1"
        );

        $json = $this->model->getAnnotationList();

        //if no data received
        if (!$json) {
            $this->registerWarning("Could not load stuff from the URL");

            return $annotationList;
        }
        $annotationListFromAPI = json_decode($json);

        //echo is_array($annotationListFromAPI);
        //var_dump($annotationListFromAPI);

        //if there is no error
        if (($annotationListFromAPI->error == "") && ($json != false)) {
            //var_dump($annotationListFromAPI);

            $last = "";
            /* if we have a more types, then we sort them */
            usort($annotationListFromAPI, array($this, 'type_sort'));

            foreach ($annotationListFromAPI as $item) {

                if ($item->UID == "") {
                    break;
                }

                /* make an identifier wit them */
                //var_dump($item->Type);
                $type = implode(" ",$item->type);
                /* add selection break */
                if ($last != $type) {
                    $annotationList[] = array($type, '--div--');
                    $last = $type;
                }

                $annotationList[] = array($item->name, $item->UID);
            }
        } else {
            $this->registerWarning($annotationListFromAPI->error);
        }

        //var_dump($annotationList);

        return $annotationList;
    }

    /**
     *
     * function which construct an annotation
     *
     * @param $data
     */
    private function constructAnnotation($data)
    {
        //class choosen by type
        $class = '\\STI\\SemantifyIt\\Domain\\Repository\\'.$data['@type'];
        $method = 'getAnnotation';
        //call the class method
        return call_user_func_array(array($class, $method), array($data));
    }


    /**
     * @param $annotation
     * @param $uid
     * @return mixed
     */
    public function updateAnnotation($annotation, $uid){
        $response =  $this->model->updateAnnotation($annotation, $uid);
        $id = $this->extractID($response);
        return $id;
    }

    /**
     * function for posting annotation
     *
     * @param $annotation
     * @return mixed
     */
    public function postAnnotation($annotation){
        $response =  $this->model->postAnnotation($annotation);
        $id = $this->extractID($response);
        return $id;
    }

    /**
     * @param $response
     * @return mixed
     */
    private function extractID($response){
        $fields = json_decode($response);
        if(!isset($fields->UID)){
            return false;
        }
        return $fields->UID;
    }


    /**
     *
     * function which is called to create and handle anotations
     *
     *
     * @param $fields
     * @param $other
     */
    public function createAnnotation($fields, $other)
    {

        $data = $this->createData($fields, $other);
        $jsonld = $this->constructAnnotation($data);

        return $jsonld;
    }


    /**
     *
     * function which makes a mapping to data array which is after that send to construct annotation
     *
     * @param $fields
     * @param $other
     * @return array
     */
    private function createData($fields, $other){
        $data = array();
        $data['dateModified'] = $other['dateModified'];
        $data['dateCreated'] = $other['dateCreated'];
        $data['@type'] = $fields['semantify_it_annotationNew_StepOne'];
        $data['@about'] = $fields['semantify_it_annotationNew_StepTwo'];
        $data['@aboutName'] = $fields['semantify_it_annotationNew_Name'];
        $data['@aboutURL'] = $fields['semantify_it_annotationNew_URL'];
        $data['id'] = $other['id'];
        $data["url"] = $this->createURLfromID($data['id']);
        $data['headline'] = $fields['title'];
        $data['nav_title'] = $fields['nav_title'];
        $data['subtitle'] = $fields['subtitle'];
        $data['tstamp'] = $other['tstamp'];
        $data['name'] = $other['name'];
        $data['email'] = $other['email'];
        return $data;
    }


    /**
     *
     * function which take a care of getting url from the string
     *
     * @param $id
     * @return string
     */
    private function createURLfromID($id)
    {
        $fullURL = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
        $cObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
        $configurations['returnLast'] = 'url'; // get it as URL
        $configurations['parameter'] = $id;
        $url = $fullURL . htmlspecialchars($cObject->typolink(null, $configurations));

        return $url;
    }

    /**
     *
     * function which initializes global variables of typo3
     *
     */
    private function initialize()
    {
        if (!isset($GLOBALS['TSFE'])) {

            $pid = (int)GeneralUtility::_POST('pid');
            $rootline =
                \TYPO3\CMS\Backend\Utility\BackendUtility::BEgetRootLine($pid);

            foreach ($rootline as $page) {
                if ($page['is_siteroot']) {
                    $id = (int)$page['uid'];
                    break;
                }
            }

            $type = 0;

            if (!is_object($GLOBALS['TT'])) {
                $GLOBALS['TT'] = new \TYPO3\CMS\Core\TimeTracker\NullTimeTracker;
                $GLOBALS['TT']->start();
            }

            $GLOBALS['TSFE'] =
                GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController',
                                             $GLOBALS['TYPO3_CONF_VARS'], $id, $type);
            $GLOBALS['TSFE']->connectToDB();
            $GLOBALS['TSFE']->initFEuser();
            $GLOBALS['TSFE']->determineId();
            $GLOBALS['TSFE']->initTemplate();
            $GLOBALS['TSFE']->getConfigArray();

            if
            (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl')
            ) {
                $host =
                    \TYPO3\CMS\Backend\Utility\BackendUtility::firstDomainRecord($rootline);
                $_SERVER['HTTP_HOST'] = $host;
            }
        }

    }



}