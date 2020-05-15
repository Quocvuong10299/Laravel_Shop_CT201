<?php

namespace App\Helper\Helper;

use Carbon\Carbon;
use App\Price;
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
        foreach ($dates as $key => $value) {
            ($now === $value) ? $dt->promotion_price = $price_sale : '';
        }
    }
};

function toSlug(string $str )
{
    if( is_string( $str ) ){
        $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            '-'	=> '\+|\*|\/|\&|\!| |\^|\%|\$|\#|\@',
        ];
        foreach ( $unicode as $key => $value )
            {
                $str = preg_replace("/($value)/", $key, $str);
            }
        return $str;
    }
    return null;
};