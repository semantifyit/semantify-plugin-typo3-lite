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


    public function addEntryToDatabase($file, $pagesToInsert) {
        foreach($pagesToInsert as $page) {
            $pagesFromDB = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                "*",
                "pages",
                "title like '$page'"
            );

            foreach($pagesFromDB as $actualPage) {
                // only insert if no entry exists!
                if($this->noEntryExists($actualPage, $file)) {
                    $GLOBALS['TYPO3_DB']->exec_INSERTquery(
                        'tx_schemainjector_domain_model_injector',
                        array(pid => $actualPage[pid],
                            inject_page_id => $actualPage[uid],
                            inject_page_name => $actualPage[title],
                            inject_file_name => $file)
                    );
                }
            }
        }

        /*
        $pages = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            '*',         // SELECT ...
            'pages',     // FROM ...
            ''           // WHERE
        );

        $i = 0;
        foreach($pages as $page) {
            $pageArray[$i][0] = $page[uid];
            $pageArray[$i][1] = $page[title];
            $i += 1;
        }
        foreach($pageArray as $page) {
            if(in_array($page[1],$pagesToInsert) AND $this->noEntryExists($page[1], $file)) {
                $GLOBALS['TYPO3_DB']->exec_INSERTquery(
                    'tx_schemainjector_domain_model_injector',
                    array(pid => 1,
                          inject_page_id => $page[0],
                          inject_page_name => $page[1],
                          inject_file_name => $file)
                );
            }
        }*/
    }


    public function listAnnotations() {
        DebugUtility::debug('frontendAction reached', ':)');
        // $GLOBALS['TSFE'] could be accessed here
        $this->view->render();
    }


}