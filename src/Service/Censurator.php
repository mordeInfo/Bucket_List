<?php

namespace App\Service;

class Censurator
{


    public function purify(string $message): string


    {
        //foreach (self::)

        $motsACensurer = array('con', 'merde', 'connard');
        $message = str_ireplace($motsACensurer, '***', $message);

        return $message;

    }

}


/*

$message = str_replace($mots_a_censurer, '***', $message);
}
/*test*/
/*
$mots_a_censurer = array('con','merde');
$testmessage="grosse toto merde con tu es";
$test = str_replace($mots_a_censurer,'***',$testmessage);
*/

?>