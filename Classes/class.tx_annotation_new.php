<?php

require_once(__DIR__."/Domain/Model/SemantifyItWrapper.php");


/**
 * Class tx_annotation_new
 */
class tx_annotation_new {

        /**
         * @param $config
         * @param $annotations
         * @return mixed
         */
        function step_one($config)
        {
            $annotations = array('qwddas','d');
            $config['items'] = array_merge($config['items'], $annotations);
        }

        /**
         *
         */
        function save($status, $table, $id, &$fieldArray, &$pObj)
        {
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