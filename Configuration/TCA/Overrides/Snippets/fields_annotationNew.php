<?php

$fields[] = array(
    'stepone' => array(
        'label' => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationNew',
        'exclude' => 1,
        'config' => array(
            'type' => 'select',
            'itemsProcFunc' => 'tx_annotation_new->step_one',
            'items' => array(
            ),
        ),
    )
);