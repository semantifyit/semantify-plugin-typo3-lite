<?php

require_once(__DIR__."/Domain/Model/SemantifyItWrapper.php");


    class tx_annotation_list {

        /**
         * @param $config
         * @param $annotations
         * @return mixed
         */
        function getList($config, $annotations){

            $Semantify = new SemantifyItWrapper();
            $annotations = $Semantify->getAnnotationList();

            // return config
            $config['items'] = array_merge($config['items'], $annotations);
            return $config;
        }
    }