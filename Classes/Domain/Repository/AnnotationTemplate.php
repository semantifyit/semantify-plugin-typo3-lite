<?php

namespace STI\SemantifyIt\Domain\Repository;


/**
 * Class SemantifyItWrapper
 */
abstract class AnnotationTemplate
{

    abstract function getAnnotation($fields){}

    static function createAnnotation($fields, $special)
    {
        $jsonld = '{
            "@context": "http://schema.org",    
            "@type": "' . @$fields['@type'] . '",
            "headline": "' . @$fields['headline'] . '",
            "datePublished": "2015-02-05T08:00:00+08:00",
            "dateModified": "2015-02-05T09:20:00+08:00",
            "description": "' . @$fields['headline'] . '",
            ' . $special . '
        }';

        return $jsonld;

    }


}

class Article extends AnnotationTemplate
{


    static function getAnnotation($fields)
    {

        $special = '';

        $jsonld = parent::createAnnotation($fields, $special);

        return $jsonld;

    }

}


