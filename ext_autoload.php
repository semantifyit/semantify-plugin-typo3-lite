<?php

$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('semantify_it') . 'Classes/';

$default = array(
    'SemantifyItWrapper' => $extensionClassesPath . 'Domain/Model/SemantifyItWrapper.php',
    'SemantifyItWrapperController' => $extensionClassesPath . 'Controller/SemantifyItWrapperController.php',
    'SemantifyItController' => $extensionClassesPath . 'Controller/SemantifyItController.php',
    'SemantifyIt' => $extensionClassesPath . 'Vendor/semantify-api-php/SemantifyIt.php',

);
return $default;