<?php
namespace STI\SemantifyIt\Domain\Repository;

use DateTime;

//waldhart
//waldhartpw

//

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
        $dateCreated = new DateTime($fields['dateCreated']);
        $dateModified = new DateTime($fields['dateModified']);

        $author = '';
        if($fields["name"]!=""){
            $author ='
             "author": {
                "@type": "Person",
                "name": "'.$fields["name"].'",
                '.( $fields["email"]!="" ? '"email": "'.$fields["email"].'"' : '').'
              },';
        }

        $about = '';
        if($fields["@about"]!=""){
            $author ='
             "about": {
                "@type": "'.$fields["@about"].'",
                "name": "'.$fields["@aboutName"].'",
                '.( $fields["@aboutURL"]!="" ? '"url": "'.$fields["@aboutURL"].'"' : '').'
              },';
        }

        $jsonld = '{
            "@context": "http://schema.org",    
            "@type": "' . @$fields['@type'] . '",
            "headline": "' . @$fields['headline'] . '",
            "dateCreated": "'.$dateCreated->format(DateTime::ATOM).'",
            "datePublished": "'.$dateCreated->format(DateTime::ATOM).'",
            "dateModified": "'.$dateModified->format(DateTime::ATOM).'",
            "url": "'.@$fields['url'].'",
            "description": "' . @$fields['headline'] . '"
            '.$author.'
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


