<?php

$ids[] = 'semantify_it_annotationNew_StepOne';
$ids[] = 'semantify_it_annotationNew_StepTwo';
$ids[] = 'semantify_it_annotationNew_URL';
$ids[] = 'semantify_it_annotationNew_Name';


$fields[] = array(
    'semantify_it_annotationNew_StepOne' => array(
        'label'   => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepOne',
        'exclude' => 1,
        'displayCond' => 'FIELD:semantify_it_annotationID:=:1',
        'config'  => array(
            'type'  => 'select',
            'items' => array(
                array(
                    "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_StepOneChoose",
                    ""
                ),
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
                ),
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
        'label'     => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_Name',
        'config'    => array(
            'type' => 'input',
            'size' => '255',
            'eval' => 'trim',
        )
    ),
);


$fields[] = array(
    'semantify_it_annotationNew_URL' => array(
        'l10n_mode' => 'mergeIfNotBlank',
        'exclude'   => 1,
        'label'     => 'LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationNew_URL',
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

