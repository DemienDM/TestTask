<?php

class Helper
{
    public static function calculateDiscount($price, $percent) {
        return round($price / 100 * $percent, 2);
    }
}