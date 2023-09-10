<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ZipcodeTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{

    
    
    use ZipcodeTrait;


    public function find($id) {

        $user = User::with('student')->where('phone_wpp', $id)->first();

        if(!$user) {
            return false;
        }

        return $user->toArray();
    }
}
