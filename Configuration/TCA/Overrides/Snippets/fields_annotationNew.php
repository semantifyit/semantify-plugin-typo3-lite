<?php

$fields[] = array(
    'semantify_it_annotationNew_StepOne' => array(
        'label' => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepOne',
        'exclude' => 1,
        'config' => array(
            'type' => 'select',
            'items' => array(
                array("LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepOneChoose", "");
                array('Article', 'article'),
                array('Blog Posting', 'blogPosting'),
            ),
        ),
    )
);

$fields[] = array(
    'semantify_it_annotationNew_StepTwo' => array(
        'label' => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepTwo',
        'exclude' => 1,
        'config' => array(
            'type' => 'select',
            'items' => array(
                array("LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepTwoChoose", "");
                array('Event', 'article'),
                array('Place', 'place'),
                array('Thing', 'thing'),
            ),
        ),
    )
);

