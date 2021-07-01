<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    protected $table = 'page_contents';

    public static function addRow($title, $owner, $content) {
        $new = new pages();
        $new->title = $title;
        $new->slug = Str::slug($title, '-');
        $new->owner = $owner;
        $new->content = $content;
        if($new->save()) return $new;
        return null;
    }
}