<?php
namespace App\service;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class uti
{
    public static function getSlug($table, $text, $id = null, $column = 'slug'){
        $slug = Str::slug($text, '-');
        $dem = 0;
        $exist = false;
        do
        {
            if(is_null($id)) $exist =  DB::table($table)->where($column, $slug)->exists();
            else $exist =  DB::table($table)->where($column, $slug)->where('id', '<>', $id)->exists();
            if($exist) {
                $dem++;
                $slug .= '-'.$dem;
            }
        }
        while($exist);

        return $slug;
    }
}