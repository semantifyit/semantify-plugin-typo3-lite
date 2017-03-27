<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// Configure new fields for annotation id
include_once("Snippets/fields_annotationID.php");

include_once("Snippets/fields_annotationNew.php");




// Add new fields to pages:
foreach ($fields as $field){
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $field);

}

// Make fields visible in the TCEforms with title:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages', // Table name
    '--palette--;LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.palette_title;semantify_it', // Field list to add
    '1', // List of specific types to add the field list to. (If empty, all type entries are affected)
    'after:nav_title' // Insert fields before (default) or after one, or replace a field
);

// Add the new palette:
$GLOBALS['TCA']['pages']['palettes']['semantify_it'] = array(
    'showitem' => 'semantify_it_annotationID, stepone'
);