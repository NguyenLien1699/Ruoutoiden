<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Users extends Model
{
    protected $table = 'users';

    public static function addRow($name,$username, $password) {
        if(Users::where(['username' => $username])->exists()) return true;
        $erp = new Users();
        $erp->name = $name;
        $erp->username = $username;
        $erp->password = Hash::make($password);
        if($erp->save()) return true;

        return false;
    }

    public static function login($username, $password)
    {
        $erp = new Users();
        $login = $erp->where(['username' => $username])->first();
        if (!is_null($login) && Hash::check($password, $login->password)) {
            return $login;
        }

        return null;
    }
}
