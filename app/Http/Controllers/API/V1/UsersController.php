<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        return User::select('id','name')->where('id','!=',auth()->user()->id)->get();
    }
}
