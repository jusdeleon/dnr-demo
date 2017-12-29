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

        $data['password'] = bcrypt($data['password']);

        tap(User::create($data))->assignRole('customer');

        return redirect()->route('customers.index')->with('success', 'Successfully added customer.');
    }

    public function edit(User $customer)
    {
        $picture = $customer->getMedia()->first();

        $pictureUrl = $picture ? $picture->getUrl('thumb') : asset('img/user.png');

        return view('customers.edit', compact('customer', 'pictureUrl'));
    }

    public function update(User $customer)
    {
        $data = request()->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|msisdn', // Accept PH formats only for simplicity
            'email' => "required|string|email|max:255|unique:users,id,$customer->id",
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Successfully updated customer.');
    }

    public function uploadPicture(User $customer)
    {
        $customer->clearMediaCollection();

        $customer->addMediaFromRequest('picture')->toMediaCollection();

        return back()->with('success', 'Successfully uploaded picture.');
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Successfully deleted customer.');
    }
}
