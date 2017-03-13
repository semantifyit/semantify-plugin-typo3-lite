<?php

namespace \semantify-plugin-typo3\Domain\Model;

class SematifyIt {

    /**
    *  @param string $domainKey;
    */
    private $domainKey;

    /**
     * @return string
     */
    public function getDomainKey()
    {
        return $this->domainKey;
    }

    /**
     * @param string $domainKey
     */
    public function setDomainKey($domainKey)
    {
        $this->domainKey = $domainKey;
    }

    /**
     * @return array
     */
    public function getDomainAnnotations(){

        $test[]=array("test anno 1", "j8a6sds");
        $test[]=array("test anno 2", "jx0asdj");

        return $test;

    }


}