<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 7.3.17
 * Time: 13:40
 */

if (!defined ('TYPO3_MODE')) die ('Access denied.');

/*
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'STI.' . $_EXTKEY,
    'SemantifyIt',
    'SemantifyIt'
);
*/
/*
if (TYPO3_MODE === 'BE') {


      // Registers a Backend Module

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'STI.' . $_EXTKEY,
        'web',	 // Make module a submodule of 'web'
        'SemantifyIt',	// Submodule key
        '',						// Position
        array(
            'SemantifyIt' => 'main, saveForm, listPages',
        ),
        array(
            'access' => 'user,group',
            'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.png',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf',
        )
    );

}
*/



include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/class.tx_annotation_list.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Controller/SemantifyItWrapperController.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Controller/SemantifyItController.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Domain/Model/SemantifyItWrapper.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Vendor/semantify-api-php/SemantifyIt.php');

//include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/class.tx_annotation_new.php');
