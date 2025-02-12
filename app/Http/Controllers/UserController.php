<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
      $fullName = User::all()->first()->getFullName();
      return $fullName;
    }
}
