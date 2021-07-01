<?php

namespace App\Models;

use Request;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    protected $table = 'contacts';

    public static function countNotViews(){
        return contacts::where('is_views', false)->count();
    }

    public static function addRow($first_name, $last_name, $email, $subject, $content) {
        $new = new contacts();
        $new->first_name = $first_name;
        $new->last_name = $last_name;
        $new->email = $email;
        $new->ip = Request::ip();
        $new->subject = $subject;
        $new->content = $content;
        return $new->save();
    }
}
