<?php
require_once(__DIR__."/../../Vendor/semantify-api-php/SemantifyIt.php");




class SemantifyItWrapper extends SemantifyIt {

    public function __construct()
    {
        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify-plugin-typo3']);
        $websiteApiKey = $confArray['smtf.']['WebsiteApiKey'];
        $this->setWebsiteApiKey($websiteApiKey);

    }


    /**
     *
     * get list of annotations based on key
     *
     * @return array
     */
    public function getAnnotationList()
    {
        $annotationList[]=array("LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationList","");
        $annotationList[]=array("LLL:EXT:semantify-plugin-typo3/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationListNone","0");

        $annotationListFromAPI = parent::getAnnotationList();

        foreach ($annotationListFromAPI as $item){
            $annotationList[] = array($item->name, $item->UID);
        }

        //var_dump($annotationList);



        return $annotationList;
    }


}