<?php
namespace App\Utilitys;
use DateTime;
class utilitys
{
    public function rangeMonthv2() {
        return ['202005','202006','202007'];
    }
    public function rangeMonth()
    {
        $range_month = [];

        $start = $month = strtotime(date('Y-m-d', strtotime('-13 month', strtotime(date("Y-m-d")))));
        $end = strtotime(date('Y-m-d', strtotime('-1 month', strtotime(date("Y-m-d")))));
        while ($month <= $end) {
            $exists = false;
            for ($i = 0; $i < count($range_month); $i++) {
                if (strcmp(date('Y', $month) . date('m', $month), $range_month[$i]) === 0) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                array_push($range_month, date('Y', $month) . date('m', $month));
            }

            $month = strtotime("+1 day", $month);
        }
        if (count($range_month) > 12) {
            \array_splice($range_month, 0, 1);
        }
        return $range_month;
    }

    public function _group_by($array, $keys = array())
    {
        $return = array();
        foreach ($array as $val) {
            $final_key = "";
            foreach ($keys as $theKey) {
                $final_key .= $val[$theKey] . "_";
            }
            $return[$final_key][] = $val;
        }
        return $return;
    }

    public static function dateRange($first, $last, $step = '+1 day', $format = 'Y-m-d')
    {
        $dates = [];
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    public function vn_to_str($str)
    {

        $unicode = array(

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd' => 'đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i' => 'í|ì|ỉ|ĩ|ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D' => 'Đ',

            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach ($unicode as $nonUnicode => $uni) {

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }

        return strtolower($str);

    }

    function acronym($string = '') { 
        $words = explode(' ', $string); 
        if (! $words) { 
         return false; 
        } 
        $result = ''; 
        foreach ($words as $word) $result .= $word[0]; 
        return strtoupper($result); 
    } 

    public static function formatNumber($number) {
        if (is_numeric($number)) {
            $number = intval($number);
            if ($number >= 1000000) return (round($number / 100000) / 10)."M";
    
            if ($number >= 1000) return (round($number / 100) / 10)."K";
    
            return $number;
        }
    
        return "-";
    }

    public static function durationParseToTime($duration) {
        $day = 0;
        $hour = 0;
        $minute = 0;
        $seconds = 0;
        $duration = strtolower($duration);

        $surplus = 1;

        if (strrpos($duration, "d")>=0){
            for($i = strrpos($duration, "d") - 1; $i>=0; $i--){
                if(!is_numeric($duration[$i])) break;
                $temp = intval($duration[$i]);
                $day = ($temp * $surplus) + $day;
                $surplus *= 10;
            }
        }

        if (strrpos($duration, "h")>=0){
            $surplus = 1;
            for($i=strrpos($duration, "h") - 1; $i>=0; $i--) {
                if(!is_numeric($duration[$i])) break;
                $temp = intval($duration[$i]);
                $hour = ($temp * $surplus) + $hour;
                $surplus *= 10;
            }
        }
            
        if (strrpos($duration, "m")>=0) {
            $surplus = 1;
            for($i=strrpos($duration, "m") - 1; $i>=0; $i--){
                if(!is_numeric($duration[$i])) break;
                $temp = intval($duration[$i]);
                $minute = ($temp * $surplus) + $minute;
                $surplus *= 10;
            }
        }
        
        if (strrpos($duration, "s")>=0) {
            $surplus = 1;
            for($i=strrpos($duration, "s") - 1; $i>=0; $i--) {
                if(!is_numeric($duration[$i])) break;
                $temp = intval($duration[$i]);
                $seconds = ($temp * $surplus) + $seconds;
                $surplus *= 10;
            }
        }
        
        return ($day>0?$day.'d ':'').($hour>0?($hour>9?$hour:'0'.$hour).':':'00:').($minute>0?($minute>9?$minute:'0'.$minute).':':'00:').($seconds>0?($seconds>9?$seconds:'0'.$seconds):'00');
    }

    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public static function percentCalculation($current_input, $old_input) {
        $current = intval($current_input);
        $old = intval($old_input);
        $per = 0;
        if($old === 0) {
            if($current > 0) $per = 100;
        }
        else $per = (($current / $old) * 100) - 100;
        return array(
            'current' => intval($current),
            'old' => intval($old),
            'per' => round($per, 2)
        );
    }

    public function convertNumberToWords($number) {
            $hyphen      = ' ';
            $conjunction = '  ';
            $separator   = ' ';
            $negative    = 'âm ';
            $decimal     = ' phẩy ';
            $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười năm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
            );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
            if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
        break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
        break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convertNumberToWords($remainder);
            }
        break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convertNumberToWords($remainder);
            }
            break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
            return $string;
    }
}