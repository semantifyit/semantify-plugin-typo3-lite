<?php
require_once(__DIR__ . "/../../Vendor/semantify-api-php/SemantifyIt.php");


class SemantifyItWrapper extends SemantifyIt
{

    public function __construct($key="")
    {
        if($key!=""){
            $this->setWebsiteApiKey($key);
            return;
        }
        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify_it']);
        $websiteApiKey = $confArray['smtf.']['WebsiteApiKey'];
        $this->setWebsiteApiKey($websiteApiKey);

    }

    private static function type_sort($a, $b)
    {
        sort($a->Type);
        sort($b->Type);

        $typeA = implode(" ",$a->Type);
        $typeB = implode(" ",$b->Type);

        if ($typeA > $typeB) {
            return -1;
        } else if ($typeA < $typeB) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     *
     * get list of annotations based on key
     *
     * @return mixed
     */
    public function getAnnotationList()
    {
        $annotationList[] = array("LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationList", "");
        $annotationList[] = array("LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationListNone", "0");
        //$annotationList[] = array("LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_plugin_typo3_annotationListNew", "1");

        $json = parent::getAnnotationList();

        $annotationListFromAPI = json_decode($json);

        //var_dump($annotationListFromAPI);

        $last = "";
        /* if we have a more types, then we sort them */
        usort($annotationListFromAPI, array($this,'type_sort'));

        foreach ($annotationListFromAPI as $item) {

            if ($item->UID == "") {
                break;
            }

            /* make an identifier wit them */
            //var_dump($item->Type);
            $type = implode(" ", $item->Type);
            /* add selection break */
            if ($last != $type) {
                $annotationList[] = array($type, '--div--');
                $last = $type;
            }

            $annotationList[] = array($item->name, $item->UID);
        }

        //var_dump($annotationList);

        return $annotationList;
    }


}