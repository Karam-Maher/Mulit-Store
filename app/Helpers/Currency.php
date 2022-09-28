<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class Currency
{
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }

    public static function format($amount, $currency = null)
    {
        $baseCurrency = config('app.locale');
        $formatter = new NumberFormatter(Session::get('currency_code', $baseCurrency), NumberFormatter::CURRENCY);
        if ($currency === null) {
            $currency = config('app.currency', 'USD');
        }
        if ($currency != $baseCurrency) {
            $rate = Cache::get('currency_rate' . $currency, 1);
            $amount = $amount * $rate;
        }
        return $formatter->formatCurrency($amount, $currency);
    }
}
