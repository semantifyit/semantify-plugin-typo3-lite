<?php



/**
 * Class tx_annotation_new
 */
class tx_annotation_new {

        /**
         * @param $config
         * @param $annotations
         * @return mixed
         */
       public function step_one($config)
        {
            $annotations = array('qwddas','d');
            $config['items'] = array_merge($config['items'], $annotations);
        }

        /**
         *
         */
       public function save($status, $table, $id, &$fieldArray, &$pObj)
        {

            /** @var $logger \TYPO3\CMS\Core\Log\Logger */
            $logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
            $logger->info('Everything went fine.');
            //if($table == 'pages')
            //{
                var_dump($id);
                var_dump($table);
                var_dump($status);
                var_dump($fieldArray);
                var_dump($pObj);
            //}
        }



    }