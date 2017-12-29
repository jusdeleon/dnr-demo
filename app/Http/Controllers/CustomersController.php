<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customers.index', [
            'customers' => User::all(),
        ]);
    }
}
