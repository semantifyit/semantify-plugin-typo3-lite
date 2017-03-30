<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',semantify_it_annotationID';
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',semantify_it_annotationNew_StepOne';
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',semantify_it_annotationNew_StepTwo';
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',semantify_it_annotationNew_Name';
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',semantify_it_annotationNew_URL';



//$GLOBALS['TSFE']->set_no_cache();

    // HOOK is called after caching
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'EXT:' . $_EXTKEY . '/Classes/class.tx_annotation_input.php:&tx_annotation_input->performNotCached';

    // HOOK is called before caching
    $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = 'EXT:'. $_EXTKEY .'/Classes/class.tx_annotation_input.php:&tx_annotation_input->performCached';

    //hook is called after change of page settings
/*
    $TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['proc‌​essDatamapClass'][] = 'EXT:'.$_EXTKEY.'/Classes/class.tx_annotation_new.php:&tx_annotation_new->save';
    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][]='EXT:'.$_EXTKEY.'/Classes/class.tx_annotation_new.php:&tx_annotation_new->save';

    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['extkey'] = 'EXT:'.$_EXTKEY.'/Classes/class.tx_annotation_new.php:&tx_annotation_new->save';
    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass']['extkey'] = 'EXT:'.$_EXTKEY.'/Classes/class.tx_annotation_new.php:&tx_annotation_new->save';
    $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][$_EXTKEY] = 'EXT:'.$_EXTKEY.'/Classes/class.tx_annotation_new.php:&tx_annotation_new->save';

    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][] = 'STI\SemantifyIt\Hooks\ProcessCmdmap';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/tslib/class.tslib_menu.php']['filterMenuPages']['STI\SemantifyIt\Hooks\ProcessCmdmap'] = 'EXT:'.$_EXTKEY.'/Classes/Hooks/ProcessCmdmap.php:STI\SemantifyIt\Hooks\ProcessCmdmap';
*/

$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][''] = 'STI\SemantifyIt\Hooks\ProcessCmdmap';
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][''] = 'STI\SemantifyIt\Hooks\ProcessCmdmap';

