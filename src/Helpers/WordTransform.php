<?php

namespace App\Helpers;

class WordTransform
{
    /**
     * @param int $year
     * @return string
     */
    public static function ageToString(int $year): string
    {
        if(preg_match("/[02-9]?(1)+$/", $year) && !preg_match("|(11)$|", $year))
        {
            $comment = 'год';
        } elseif(preg_match("/[\d]?(2|3|4)+$/",$year))
        {
            $comment = 'года';
        } else {
            $comment = 'лет';
        }
       return "$year $comment";
    }
}