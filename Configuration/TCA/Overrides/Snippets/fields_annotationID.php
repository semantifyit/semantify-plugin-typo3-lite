<?php

$field[] = array(
    'semantify_it_annotationID' => array(
        'label' => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationID',
        'exclude' => 1,
        'config' => array(
            'type' => 'select',
            'enableMultiSelectFilterTextfield' => TRUE,
            'itemsProcFunc' => 'tx_annotation_list->getList',
            'items' => array(

            ),
        ),
    )
);