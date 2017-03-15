<?php
use \TYPO3\CMS\Core\Utility\GeneralUtility;

class tx_annotation_input
{
    protected $sqlFROM = 'pages';
    protected $sqlSELECT = 'semantify_plugin_typo3_annotationID';

    function performNotCached(&$params, &$that) {
        if(!$GLOBALS['TSFE']->isINTincScript()) {
            return;
        }
        $this->main($params, $that);
    }

    function performCached(&$params, &$that) {
        if($GLOBALS['TSFE']->isINTincScript()) {
            return;
        }
        $this->main($params, $that);
    }

    /**
     * performs the main injector task (reading database -> get json from semantify.it -> inject)
     * @param $params object
     * @param $that object not used at the moment
     */
    function main(&$params, &$that)
    {
        $currentPageId = $GLOBALS['TSFE']->id;

        // read from database
        $dbEntries = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
            $this->sqlSELECT,
            $this->sqlFROM,
            'uid = '.$currentPageId
        );

        if(!isset($dbEntries) || $GLOBALS['TYPO3_DB']->sql_num_rows($dbEntries) == 0) {
            // nothing to inject for this page ...
            //$this->addAnnotation($params['pObj']->content, 'no sql results!');

            return;
        } else {

            $Semantify = new SemantifyItWrapper();

            foreach ($dbEntries as $res){
                $annotation = $Semantify->getAnnotation($res[$this->sqlSELECT]);
                break;
            }
            if($annotation!==0){
                $this->addAnnotation($params['pObj']->content, $annotation);
            }
        }
    }

    /**
     * this function takes a pointer to the actual html content of the page rendered. It injects the string inside $codeToInject before the closing head tag
     * @param $content string the actual html content rendered
     * @param $codeToInject string to inject
     */
    private function addAnnotation(&$content, $annotation)
    {
        if(strlen($annotation) == 0)
            return;

        $content = str_replace('</head>','<script type="application/ld+json">'.$annotation.'</script>' . '</head>', $content);
    }
}