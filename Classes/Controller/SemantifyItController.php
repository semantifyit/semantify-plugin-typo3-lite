<?php

namespace STI\SemantifyIt\Controller;

use \TYPO3\CMS\Core\Utility\DebugUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SemantifyItController
 */
class SemantifyItController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * SemantifyItController constructor.
     *
     * We have to call an fucntion which initialize some classes which are important for getting url
     */
    public function __construct()
    {
        $this->initialize();
        parent::__construct();
    }


    /**
     *
     * function which construct an annotation
     *
     * @param $data
     */
    private function constructAnnotation($data)
    {
        var_dump($data);
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

        $data = array();
        $data['id'] = $other['id'];
        $data["url"] = $this->createURLfromID($data['id']);
        $data['title'] = $fields['title'];
        $data['nav_title'] = $fields['nav_title'];
        $data['subtitle'] = $fields['subtitle'];
        $data['tstamp'] = $other['tstamp'];


        //we will choose only the necesarry fields for our semantifyit
        foreach ($fields as $key => $field) {
            if (strpos($key, 'semantify_it') !== false) {
                $data[$key] = $field;
            }
        }

        $jsonld = $this->constructAnnotation($data);


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