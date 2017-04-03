<?php

namespace STI\SemantifyIt\Controller;

use \TYPO3\CMS\Core\Utility\DebugUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * SemantifyItController
 */
class SemantifyItController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    public function __construct() {
        $this->initialize();

    }


    public function listAnnotations()
    {
        DebugUtility::debug('frontendAction reached', ':)');
        // $GLOBALS['TSFE'] could be accessed here
        $this->view->render();
    }


    private function constructAnnotation($data)
    {
        var_dump($data);
    }




    public function createAnnotation($fields, $other)
    {

        // $this->getControllerContext();

        $data = array();
        $data['id'] = $other['id'];

        $fullURL = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');

        $cObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
        $configurations['returnLast'] = 'url'; // get it as URL
        $configurations['parameter'] =  $other['id'];
         $url  = $fullURL.htmlspecialchars($cObject->typolink(NULL, $configurations));
        var_dump($url);



        $url = $cObject->getTypoLink_URL('',
                                         array(
                                             'parameter'        => $other['id'],
                                             'forceAbsoluteUrl' => true,
                                             'returnLast'       => 'url'
                                         )
        );

        echo $url."1";

        $url = $cObject->stdWrap_typolink(
            '',
            array(
                'typolink' => array(
                    'returnLast' => 'url',
                    'parameter'  => $other['id'],
                )
            ));
        echo $url."2";

        $conf = array(
            'parameter'        => $other['id'],
            'forceAbsoluteUrl' => true,
        );

        echo $cObject->typolink_URL($conf);

        //$url = $cObject->typolink('text',Array('parameter'=>$other['id']));
        $url = $cObject->getTypoLink_URL($other['id']);

        var_dump($url);

        $data["url"] = $url;
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


    private function initialize()
    {
      

    }


}