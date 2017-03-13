<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// Configure new field:
$fields = array(
    'semantify_plugin_typo3_annotationID' => array(
        'label' => 'LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationID',
        'exclude' => 1,
        'config' => array(
            'type' => 'select',
            'items' => array(
                array('Nichts', ''),
                array('Rohre')
            ),
        ),
    )
    // In this example, we assume that the custom checkbox is only used in the original language. So, no need to configure it here.
);

// Add new field to translated pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $fields);

// Make field visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages_language_overlay', // Table name
    '--palette--;LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.palette_title;semantify_plugin_typo3', // Field list to add
    '', // List of specific types to add the field list to. (If empty, all type entries are affected)
    'after:nav_title' // Insert fields before (default) or after one, or replace a field
);

// Add the new palette:
$GLOBALS['TCA']['pages_language_overlay']['palettes']['semantify_plugin_typo3'] = array(
    'showitem' => 'semantify_plugin_typo3_annotationID'
);