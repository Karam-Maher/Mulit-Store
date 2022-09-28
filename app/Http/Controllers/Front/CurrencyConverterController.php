<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'currency_converter' => 'required|string|size:3'
        ]);
        $baseCurrencyCode = config('app.currency');
        $currencyCode = $request->input('currency_converter');
        $cacheKey = 'currency_rate_' . $currencyCode;
        $rate = Cache::get($cacheKey, 0);

        if (!$rate) {
            $converter = App::make('currency_converter');
            $rate =  $converter->convert($baseCurrencyCode, $currencyCode);
            
            Cache::put($cacheKey, $rate, now()->addMinute(60));
        }

        Session::put('currency_converter', $currencyCode);

        // Session::put('currency_rate', $rate);
        return redirect()->back();
    }
}
