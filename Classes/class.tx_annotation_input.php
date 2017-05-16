<?php
    use \TYPO3\CMS\Core\Utility\GeneralUtility;
    use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;


    class tx_annotation_input
    {
        protected $sqlFROM = 'pages';
        protected $sqlSELECT = 'mayrhofen_annotator_annotationID, mayrhofen_annotator_annotationNew_RAW';
        protected $sqlID = 'mayrhofen_annotator_annotationID';
        protected $sqlRAW = 'mayrhofen_annotator_annotationNew_RAW';

        function performNotCached(&$params, &$that)
        {
            if (!$GLOBALS['TSFE']->isINTincScript()) {
                return;
            }
            $this->main($params, $that);
        }

        function performCached(&$params, &$that)
        {
            if ($GLOBALS['TSFE']->isINTincScript()) {
                return;
            }
            $this->main($params, $that);
        }

        /**
         * performs the main injector task (reading database -> get json from semantify.it -> inject)
         *
         * @param $params object
         * @param $that   object not used at the moment
         */
        function main(&$params, &$that)
        {
            $currentPageId = $GLOBALS['TSFE']->id;

            $curent_url = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');

            $news_id = -1;

            //supporting for an id of the news
            $get_para = \TYPO3\CMS\Core\Utility\GeneralUtility::_GET();
            if(isset($get_para['tx_news_pi1'])){
                $news_id    =   $get_para['tx_news_pi1']['news'];

                //check the news sources
                $this->sqlFROM = "tx_news_domain_model_news";

                //read from database

                $dbEntries = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    $this->sqlSELECT,
                    $this->sqlFROM,
                    'uid = ' . $news_id
                );

            }else {

                if ($GLOBALS['TSFE']->sys_language_uid != 0) {

                        $this->sqlFROM = "pages_language_overlay";

                        //read from database
                        $dbEntries = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                            $this->sqlSELECT,
                            $this->sqlFROM,
                            'pid = ' . $currentPageId . ' AND sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid
                        );

                } else {

                        $this->sqlFROM = "pages";

                        $dbEntries = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                            $this->sqlSELECT,
                            $this->sqlFROM,
                            'uid = ' . $currentPageId
                        );


                }
            }



            //var_dump($dbEntries);

            //check entries
            if (!isset($dbEntries) || $GLOBALS['TYPO3_DB']->sql_num_rows($dbEntries) == 0) {
                return;
            } else {

                //starting wrapper
                $Semantify = new SemantifyItWrapper();
                $annotation = "";

                //get annotations from the database
                foreach ($dbEntries as $res) {


                    $anno_id = $res[$this->sqlID];
                    $anno_RAW = $res[$this->sqlRAW];


                    break;
                }

                //option for automatic annotaiton search
                $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['mayrhofen_annotator']);

                $annotationByURL = $confArray['smtf.']['annotationByURL'];
                $annotationByURL=0;


                //if it is field not empty or with 0
                if ($anno_RAW!="") {
                    //$annotation = $Semantify->getAnnotation($anno_id);
                    $annotation = $anno_RAW;
                } else if($annotationByURL==1) {
                    $url = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
                    $annotation = $Semantify->getAnnotationByURL($url);
                }




                //if it is field not empty or with 0
                if (($annotation != "0") && ($annotation !== false) && ($annotation != "")) {
                    $annotation = str_replace('%%url%%',$curent_url,$annotation);
                    $this->addAnnotation($params['pObj']->content, $annotation);
                }
            }
        }

        /**
         * this function takes a pointer to the actual html content of the page rendered. It injects the string inside $codeToInject before the closing head tag
         *
         * @param $content      string the actual html content rendered
         * @param $codeToInject string to inject
         */
        private function addAnnotation(&$content, $annotation)
        {
            if (strlen($annotation) == 0) {
                return;
            }

            $semantify_text = '<!-- Great, right? Created with Mayrhofen Annotator -->
            ';


            $content = str_replace("</head>", $semantify_text.'<script type="application/ld+json">'. $annotation . '</script>' . '</head>', $content);
        }
    }
