<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Hash;

class testController extends Controller
{
    public function addDefaultUser() {
        $user = new User;
        $user->nik = '33241424124';
        $user->name = 'Ahmad Barkah';
        $user->username = 'ahmad';
        $user->password = Hash::make('admin');
        $user->jabatan = 1;
        $user->status = 1;
        $user->save();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function testMiddleware() {
        return true;
    }
}
