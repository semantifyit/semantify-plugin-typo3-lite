<?php

$fields[] = array(
    'semantify_it_annotationNew_StepOne' => array(
        'label'   => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepOne',
        'exclude' => 1,
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepOneChoose",
                    ""
                );
array('Article', 'article'),
                array('Blog Posting', 'blogPosting'),
            ),
        ),
    )
);

$fields[] = array(
    'semantify_it_annotationNew_StepTwo' => array(
        'label'   => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepTwo',
        'exclude' => 1,
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepTwoChoose",
                    ""
                );
                array('Event', 'article'),
                array('Place', 'place'),
                array('Thing', 'thing'),
            ),
        ),
    )
);




$fields[] = array(
    'semantify_it_annotationNew_Name' => array(
        'l10n_mode' => 'mergeIfNotBlank',
        'exclude'   => 1,
        'label'   => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_Name',
        'config'    => array(
            'type'        => 'input',
            'size'        => '20',
            'eval'        => 'trim',
            'placeholder' => '__row|LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_NameChoose',
            'mode'        => 'useOrOverridePlaceholder',
        )
    ),
);


$fields[] = array(
    'semantify_it_annotationNew_URL' => array(
        'l10n_mode' => 'mergeIfNotBlank',
        'exclude'   => 1,
        'label'   => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_URL',
        'config'    => array(
            'type'        => 'input',
            'size'        => '20',
            'eval'        => 'trim',
            'placeholder' => '__row|LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_URLChoose',
            'mode'        => 'useOrOverridePlaceholder',
        )
    ),
);
