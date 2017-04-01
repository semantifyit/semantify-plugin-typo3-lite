<?php
namespace STI\SemantifyIt\Controller;

use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Core\Utility\DebugUtility;
use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;

/**
 * SchemantifyItController
 */
class SemantifyItWrapperController extends ActionController
{

    private $Sem;

    /**
     * displaying warnings
     *
     * @var bool
     */
    private $warnings = false;


    function __construct()
    {
        $this->Sem = new SemantifyItWrapper();
    }


    /**
     * registering warning message
     *
     * @param $message
     */
    private function registerWarning($message)
    {
        if ($this->warnings) {
            $this->displayMessage($message);
        }

    }

    /**
     * displayin message
     *
     * @param $message
     */
    private function displayMessage($message)
    {
        echo "<br/><br/><div style='position:absolute;top:65px; margin:24px;padding: 5px;'>" . $message . "</div>";
    }


    /**
     *
     * sorting array
     *
     * @param $a
     * @param $b
     * @return int
     */
    private static function type_sort($a, $b)
    {
        sort($a->type);
        sort($b->type);

        $typeA = implode(" ", $a->type);
        $typeB = implode(" ", $b->type);

        if ($typeA > $typeB) {
            return -1;
        } else {
            if ($typeA < $typeB) {
                return 1;
            } else {
                return 0;
            }
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
        $annotationList[] = array(
            "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationList",
            ""
        );
        $annotationList[] = array(
            "LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationListNone",
            "0"
        );
        //$annotationList[] = array("LLL:EXT:semantify_it/Resources/Private/Language/locallang_db.xlf:pages.semantify_it_annotationListNew", "1");

        $json = $this->Sem->getAnnotationList();

        //if no data received
        if (!$json) {
            $this->registerWarning("Could not load stuff from the URL");

            return $annotationList;
        }
        $annotationListFromAPI = json_decode($json);

        //echo is_array($annotationListFromAPI);
        //var_dump($annotationListFromAPI);

        //if there is no error
        if (($annotationListFromAPI->error == "") && ($json != false)) {
            //var_dump($annotationListFromAPI);

            $last = "";
            /* if we have a more types, then we sort them */
            usort($annotationListFromAPI, array($this, 'type_sort'));

            foreach ($annotationListFromAPI as $item) {

                if ($item->UID == "") {
                    break;
                }

                /* make an identifier wit them */
                //var_dump($item->Type);
                $type = implode(" ",$item->type);
                /* add selection break */
                if ($last != $type) {
                    $annotationList[] = array($type, '--div--');
                    $last = $type;
                }

                $annotationList[] = array($item->name, $item->UID);
            }
        } else {
            $this->registerWarning($annotationListFromAPI->error);
        }

        //var_dump($annotationList);

        return $annotationList;
    }


}