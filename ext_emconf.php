<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "semantify-plugin-typo3"
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
    'author_company' => 'STI Innsbruck',
    'author_email' => 'semantify@semantify.it',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.0',
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