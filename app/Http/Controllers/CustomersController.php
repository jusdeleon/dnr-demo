<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customers.index', [
            'customers' => User::role('customer')->get(),
        ]);
    }
}
