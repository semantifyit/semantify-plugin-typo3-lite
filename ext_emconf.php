<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "semantify_it"
 *
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Semantify.it',
    'description' => 'Semantify.it local deployment',
    'category' => 'plugin',
    'author' => 'Richard Dvorsky',
    'author_company' => 'Semantify.it',
    'author_email' => 'typo3@semantify.it',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.3',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
