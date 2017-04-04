<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 7.3.17
 * Time: 13:40
 */

if (!defined ('TYPO3_MODE')) die ('Access denied.');


include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/class.tx_annotation_list.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Controller/SemantifyItWrapperController.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Domain/Model/SemantifyItWrapper.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Domain/Repository/AnnotationTemplate.php');
include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Vendor/semantify-api-php/SemantifyIt.php');
//include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/class.tx_annotation_new.php');
