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

        $json = parent::getAnnotationList();
        $annotationListFromAPI = json_decode($json);


        $last = "";
        foreach ($annotationListFromAPI as $item){

            /* if we have a more types, then we sort them */
            sort($item->Type);
            /* make an identifier wit them */
            //var_dump($item->Type);
            $type = implode(" ",$item->Type);
            /* add selection break */
            if($last!=$type){
                $annotationList[] = array($type,'--div--');
                $last = $type;
            }

            $annotationList[] = array($item->name, $item->UID);
        }

        //var_dump($annotationList);

        return $annotationList;
    }


}