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

    public function create()
    {
        return view('customers.create');
    }

    public function store()
    {
        $data = request()->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|msisdn', // Accept PH formats only for simplicity
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        tap(User::create($data))->assignRole('customer');

        return redirect()->route('customers.index')->with('success', 'Successfully added customer.');
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Successfully deleted customer.');
    }
}
