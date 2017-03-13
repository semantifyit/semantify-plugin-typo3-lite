<?php

namespace \semantify-plugin-typo3\Classes\Domain\Model;


class SematifyItWrapper extends SematifyIt {

    public function __construct()
    {
        $confArray = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['semantify-plugin-typo3']);
        $DomainKey = $confArray['smtf']['DomainApiKey'];

        $this->setDomainKey($DomainKey);

    }

}