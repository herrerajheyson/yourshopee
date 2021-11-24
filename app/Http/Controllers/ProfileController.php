<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id],
            'gender' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_profile' => __('No se le permite cambiar los datos de un usuario predeterminado.')]);
        }

        auth()->user()->update($request->all());

        return back()->withStatus(__('Perfil actualizado correctamente.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('No se le permite cambiar la contraseña de un usuario predeterminado.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Contraseña actualizada correctamente.'));
    }
}
