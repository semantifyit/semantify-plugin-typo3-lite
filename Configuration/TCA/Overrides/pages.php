<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}


$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('semantify-plugin-typo3');
echo $extensionClassesPath;
include_once($extensionClassesPath.'/Classes/Domain/Model/SemantifyItWrapper.php');


// Configure new fields:
$fields = array(
    'semantify_plugin_typo3_annotationID' => array(
            'label' => 'LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationID',
            'exclude' => 1,
            'config' => array(
                'type' => 'select',
                'itemsProcFunc' => 'tx_annotation_list->getList',
                'items' => array(

                ),
            ),
    )
);

//$Semantify = new SemantifyItWrapper($GLOBALS);
//$annotations = $Semantify->getDomainAnnotations();

//debug($annotations, 'Variable name/description', __LINE__, __FILE__);


//$fields['semantify_plugin_typo3_annotationID']['config']["items"] = $annotations;
//$TCA['tt_content']['columns']['section_frame']['config']['itemsProcFunc'] = 'SemantifyItWrapper->main';


// Add new fields to pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $fields);

// Make fields visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages', // Table name
    '--palette--;LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.palette_title;semantify_plugin_typo3', // Field list to add
    '1', // List of specific types to add the field list to. (If empty, all type entries are affected)
    'after:nav_title' // Insert fields before (default) or after one, or replace a field
);

// Add the new palette:
$GLOBALS['TCA']['pages']['palettes']['semantify_plugin_typo3'] = array(
    'showitem' => 'semantify_plugin_typo3_annotationID'
);