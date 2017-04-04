<?php
namespace STI\SemantifyIt\Controller;

use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Core\Utility\DebugUtility;


/**
 * SchemantifyItController
 */
class SchemantifyItController extends ActionController
{

    /**
     * action main
     * @return void
     */
    public function mainAction()
    {
        $Semantify = new SemantifyItWrapper();
        $annotations = $Semantify->getDomainAnnotations();
        $this->view->assign('annotation_list', $annotations);
    }





    public function listAnnotations() {
        DebugUtility::debug('frontendAction reached', ':)');
        // $GLOBALS['TSFE'] could be accessed here
        $this->view->render();
    }


}