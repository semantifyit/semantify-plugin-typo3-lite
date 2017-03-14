<?php
require_once(__DIR__."/../../Vendor/semantify-it-api/SemantifyIt.php");




class SemantifyItWrapper extends SemantifyIt {

    public function __construct()
    {
        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify-plugin-typo3']);
        $DomainKey = $confArray['smtf.']['DomainApiKey'];
        $this->setDomainKey($DomainKey);

    }


    public function getDomainAnnotations()
    {
        $test[]=array("LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationList","");
        $test[]=array("annotation 1","j8a6sds");
        $test[]=array("annotation 2","jx0asdj");
        $test[]=array("Domainkey:".$this->getDomainKey(),"23423423");

        return $test;
    }

    public function getAnnotations($id)
    {
        $test = file_get_contents("http://104zbor.skauting.sk/hotel.jsonld");
        return $test;
    }


}