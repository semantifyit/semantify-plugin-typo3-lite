<?php

$ids[] = 'semantify_it_separate_annotationNew_ID';
$ids[] = 'semantify_it_separate_annotationNew_StepOne';
$ids[] = 'semantify_it_separate_annotationNew_StepTwo';
$ids[] = 'semantify_it_separate_annotationNew_URL';
$ids[] = 'semantify_it_separate_annotationNew_Name';
$ids[] = 'semantify_it_separate_annotationNew_RAW';

$fields[] = array(
    'semantify_it_separate_annotationNew_ID' => array(
        'label' => "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_ID",
        'exclude'   => 1,
        'config'    => array(
            'type' => 'passthrough'
        )
    ),
);


$fields[] = array(
    'semantify_it_separate_annotationNew_StepOne' => array(
        'label'   => 'LLL:EXT:semantify_it_separate/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_StepOne',
        'exclude' => 1,
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:semantify_it_separate/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_StepOneChoose",
                    ""
                ),
                array('Article', 'Article'),
                array('Blog Posting', 'BlogPosting'),
            ),

        ),
    )
);

$fields[] = array(
    'semantify_it_separate_annotationNew_StepTwo' => array(
        'label'   => 'LLL:EXT:semantify_it_separate/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_StepTwo',
        'exclude' => 1,
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:semantify_it_separate/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_StepTwoChoose",
                    ""
                ),
                array('Event', 'Event'),
                array('Place', 'Place'),
                array('Thing', 'Thing'),
            ),
        ),
    )
);


$fields[] = array(
    'semantify_it_separate_annotationNew_Name' => array(
        'exclude'   => 1,
        'label'     => 'LLL:EXT:semantify_it_separate/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_Name',
        'config'    => array(
            'type' => 'input',
            'size' => '255',
        )
    ),
);


$fields[] = array(
    'semantify_it_separate_annotationNew_URL' => array(
        'exclude'   => 1,
        'label'     => 'LLL:EXT:semantify_it_separate/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_separate_annotationNew_URL',
        'config'    => array(
            'type'    => 'input',
            'size'    => '255',
            'softref' => 'typolink',
            'wizards' => array(
                '_PADDING' => 2,
                'link'     => array(
                    'type'         => 'popup',
                    'title'        => 'Link',
                    'icon'         => 'EXT:example/Resources/Public/Images/FormFieldWizard/wizard_link.gif',
                    'module'       => array(
                        'name'          => 'wizard_element_browser',
                        'urlParameters' => array(
                            'mode' => 'wizard'
                        ),
                    ),
                    'JSopenParams' => 'height=600,width=500,status=0,menubar=0,scrollbars=1'
                )
            )
        )
    ),
);

