<?php

require_once(__DIR__."/Domain/Model/SemantifyItWrapper.php");


    class tx_annotation_new {

        /**
         * @param $config
         * @param $annotations
         * @return mixed
         */
        function step_one($config){
            $annotations = array('qwddas','d');
            $config['items'] = array_merge($config['items'], $annotations);
        }
    }