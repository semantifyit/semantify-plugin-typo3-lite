<?php

class SemantifyIt {

    /**
     * vriable for DomainApiKey
     *  @param string $domainKey;
     */
    private $domainKey;

    /**
     * getter for DomainApiKey
     * @return string
     */
    public function getDomainKey()
    {
        return $this->domainKey;
    }

    /**
     * setter for DomainApiKey
     * @param string $domainKey
     */
    public function setDomainKey($domainKey)
    {
        $this->domainKey = $domainKey;
    }

    /**
     * returns domain annotations based on DomainApiKey
     *
     * @return array
     */
    public function getDomainAnnotations(){
        $annotations = array();

        return $annotations;
    }

    /**
     *
     * returns json-ld anotations based on anotations id
     *
     * @param string $id
     * @return string $text
     */
    public function getAnnotations($id){

        $text = "";

        return $text;
    }


}