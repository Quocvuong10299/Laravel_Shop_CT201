<?php

namespace App\Helper\Helper;

use Carbon\Carbon;

function getDiscount($dt)
{
    $now = date('Y-m-d');
    $price_sale = ($dt->unit_price) * ((100 - ($dt->percent_value)) / 100);
    $from = Carbon::parse($dt->date_start);
    $to = Carbon::parse($dt->date_end);
    if ($dt->date_start != '' && $dt->date_end != '') {
        for ($i = $from; $i->lte($to); $i->addDay()) {
            $dates[] = $i->format('Y-m-d');
        }
        foreach ($dates as $value) {
            ($now === $value) ? $dt->promotion_price = $price_sale : '';
        }
    }
}