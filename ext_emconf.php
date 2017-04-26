<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "mayrhofen_annotator"
 *
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Mayrhofen Article-BlogPosting Annotator',
    'description' => 'Annotations creator for Mayrhofen',
    'category' => 'plugin',
    'author' => 'STI Innsbruck',
    'author_company' => 'STI Innsbruck',
    'author_email' => 'richard.dvorsky@sti2.at',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.0',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-8.5.99',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
