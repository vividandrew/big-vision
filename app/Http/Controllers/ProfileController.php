<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'AddressLine1',
            'AddressLine2',
            'Town',
            'PostCode'
        ]);

        $user = Auth::user();

        //sets the user to the data parsed through the webform
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->AddressLine1 = $request['AddressLine1'];
        $user->AddressLine2 = $request['AddressLine2'];
        $user->Town = $request['Town'];
        $user->PostCode = $request['PostCode'];
        $user->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
