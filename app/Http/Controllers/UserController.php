<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function buyHistory(Request $request) {
        return $request->user()->soldProducts()->with(['product']);
    }
}
