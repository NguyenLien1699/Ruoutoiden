<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class categorys extends Model
{
    const NAME_TALBE = 'categorys';
    protected $table = self::NAME_TALBE;

    public function musics(){
        return $this->hasMany(musics::class, 'id_category', 'id');
    }

    public function deleteRow($id) {
        DB::table(musics::NAME_TABLE)
            ->where('id_category', $id)
            ->update(['id_category' => null]);

        return musicsStructure::where('id', $id)->delete();
    }
}
