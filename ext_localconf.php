<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',semantify_it_annotationID';

//$GLOBALS['TSFE']->set_no_cache();

    // HOOK is called after caching
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'EXT:' . $_EXTKEY . '/Classes/class.tx_annotation_input.php:&tx_annotation_input->performNotCached';

    // HOOK is called before caching
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = 'EXT:'. $_EXTKEY .'/Classes/class.tx_annotation_input.php:&tx_annotation_input->performCached';

