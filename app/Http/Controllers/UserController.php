<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
public function myNotifications()
{
    return Auth::user()->notifications;
}}
