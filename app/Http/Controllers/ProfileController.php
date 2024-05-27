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


        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->AddressLine1 = $request['AddressLine1'];
        $user->AddressLine2 = $request['AddressLine2'];
        $user->Town = $request['Town'];
        $user->PostCode = $request['PostCode'];
        $user->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function personalEdit(Request $request)
    {
        return view('profile.editpersonal', [
            'user' => $request->user(),
        ]);
    }

    public function personalUpdate($request) : RedirectResponse
    {
        return $request;
        return redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
