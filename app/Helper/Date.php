<?php


namespace App\Helper;


class Date
{
    public static function getListDayInMonth(){
        $arrDay = [];
        $month = date('m');
        $year = date('y');
        for($day = 1; $day <= 31;$day++){
            $timer = mktime(12,0,0,$month,$day,$year);
            if(date('m',$timer) == $month)
                $arrDay[] = date('Y-m-d',$timer);
        }
        return $arrDay;
    }
}
