<?php

namespace STI\SemantifyIt\Controller;

use \TYPO3\CMS\Core\Utility\DebugUtility;


/**
 * SemantifyItController
 */
class SemantifyItController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

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
       //not yet working url
        // $data["url"] = $this->getControllerContext()->getUriBuilder()->reset()->setTargetPageUid($data['id'])->buildFrontendUri();
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


}