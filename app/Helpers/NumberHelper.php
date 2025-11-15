<?php

namespace App\Helpers;

use NumberToWords\NumberToWords;

class NumberHelper
{
    public static function numberToWords($amount)
    {
        $numberToWords = new NumberToWords();
        $converter = $numberToWords->getNumberTransformer('en');

        $dirhams = (int) $amount;
        $fils = round(($amount - $dirhams) * 100);

        $dirhamsText = ucfirst($converter->toWords($dirhams)) . ' Dirhams';
        $filsText = $fils > 0 ? ucfirst($converter->toWords($fils)) . ' Fils' : '';

        return $fils > 0 ? "$dirhamsText and $filsText" : $dirhamsText;
    }
}
