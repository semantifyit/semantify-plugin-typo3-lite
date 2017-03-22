<?php

$fields[] = array(
    'semantify_plugin_typo3_annotationID' => array(
        'label' => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationID',
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