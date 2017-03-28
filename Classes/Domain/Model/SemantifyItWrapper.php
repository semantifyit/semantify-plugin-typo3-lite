<?php
namespace STI\SemantifyIt\Domain\Model;

use \STI\SemantifyIt\SemantifyIt;

require_once(__DIR__ . "/../../Vendor/semantify-api-php/SemantifyIt.php");


/**
 * Class SemantifyItWrapper
 */
class SemantifyItWrapper extends SemantifyIt
{

    /**
     * SemantifyItWrapper constructor.
     *
     * @param string $key
     */
    public function __construct($key = "")
    {
        if ($key != "") {
            $this->setWebsiteApiKey($key);

            return;
        }
        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify_it']);
        $websiteApiKey = $confArray['smtf.']['WebsiteApiKey'];
        $this->setWebsiteApiKey($websiteApiKey);
    }

}