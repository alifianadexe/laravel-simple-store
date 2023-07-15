<?php

namespace App\Helper;

class Helper
{
    public static function formatCurrency($number, $withCurrency = true) {
        return ($withCurrency ? 'IDR ' : '') . number_format($number, 0, ',', '.');
    }
}
