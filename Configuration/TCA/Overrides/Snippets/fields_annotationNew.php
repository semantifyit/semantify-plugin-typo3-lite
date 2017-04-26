<?php

$ids[] = 'mayrhofen_annotator_annotationNew_ID';
$ids[] = 'mayrhofen_annotator_annotationNew_StepOne';
$ids[] = 'mayrhofen_annotator_annotationNew_StepTwo';
$ids[] = 'mayrhofen_annotator_annotationNew_URL';
$ids[] = 'mayrhofen_annotator_annotationNew_Name';
$ids[] = 'mayrhofen_annotator_annotationNew_RAW';

$fields[] = array(
    'mayrhofen_annotator_annotationNew_ID' => array(
        'label' => "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.mayrhofen_annotator_annotationNew_ID",
        'exclude'   => 1,
        'config'    => array(
            'type' => 'passthrough'
        )
    ),
);


$fields[] = array(
    'mayrhofen_annotator_annotationNew_StepOne' => array(
        'label'   => 'LLL:EXT:mayrhofen_annotator/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_lite_annotationNew_StepOne',
        'exclude' => 1,
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:mayrhofen_annotator/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_lite_annotationNew_StepOneChoose",
                    ""
                ),
                array('Article', 'Article'),
                array('Blog Posting', 'BlogPosting'),
            ),

        ),
    )
);

$fields[] = array(
    'mayrhofen_annotator_annotationNew_StepTwo' => array(
        'label'   => 'LLL:EXT:mayrhofen_annotator/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_lite_annotationNew_StepTwo',
        'exclude' => 1,
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:mayrhofen_annotator/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_lite_annotationNew_StepTwoChoose",
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
    'mayrhofen_annotator_annotationNew_Name' => array(
        'exclude'   => 1,
        'label'     => 'LLL:EXT:mayrhofen_annotator/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_lite_annotationNew_Name',
        'config'    => array(
            'type' => 'input',
            'size' => '255',
        )
    ),
);


$fields[] = array(
    'mayrhofen_annotator_annotationNew_URL' => array(
        'exclude'   => 1,
        'label'     => 'LLL:EXT:mayrhofen_annotator/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_lite_annotationNew_URL',
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

