<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Order;
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
        $purchases_made = 0;
        $items_purchased = 0;
        $orders = Order::where('customer_email', auth()->user()->email)->where('status', 'PAYED')->get();

        foreach ($orders as $key => $value) {
            $purchases_made += 1;
            $items_purchased += count($value->details);
        }

        return view('profile.edit', compact('purchases_made', 'items_purchased'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
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
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('No se le permite cambiar la contraseña de un usuario predeterminado.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Contraseña actualizada correctamente.'));
    }
}
