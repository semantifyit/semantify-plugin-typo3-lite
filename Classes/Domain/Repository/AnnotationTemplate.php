<?php
namespace STI\SemantifyIt\Domain\Repository;


/**
 * Class AnnotationTemplate
 *
 * @package STI\SemantifyIt\Domain\Repository
 */
abstract class AnnotationTemplate
{

    /**
     * @param $fields
     * @return mixed
     */
    abstract static function getAnnotation($fields);

    /**
     * @param $fields
     * @param $special
     * @return string
     */
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

/**
 * Class Article
 *
 * @package STI\SemantifyIt\Domain\Repository
 */
class Article extends AnnotationTemplate
{
    /**
     * @param $fields
     * @return string
     */
    static function getAnnotation($fields)
    {

        $special = '';

        return parent::createAnnotation($fields, $special);
    }

}

class BlogPosting extends AnnotationTemplate
{
    /**
     * @param $fields
     * @return string
     */
    static function getAnnotation($fields)
    {

        $special = '';

        return parent::createAnnotation($fields, $special);
    }

}


