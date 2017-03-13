<?php
require_once(__DIR__."/../../Vendor/semantify-it-api/SemantifyIt.php");




class SemantifyItWrapper extends SemantifyIt {

    public function __construct()
    {
        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify-plugin-typo3']);
        $DomainKey = $confArray['smtf']['DomainApiKey'];

        $this->setDomainKey($DomainKey);

    }


}