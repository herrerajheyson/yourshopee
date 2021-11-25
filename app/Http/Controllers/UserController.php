<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getRulesValidation());

        $request->merge([
            'password' => Hash::make($request->password),
        ]);

        User::create($request->all());

        return back()->withStatus(__('Usuario creado correctamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate($this->getRulesValidation('unique:users,email,' . $user->id, false));

        $request->merge([
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
        ]);

        $user->fill($request->all())->save();

        return back()->withStatus(__('Usuario actualizado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $message = 'El usuario ' .  $user->name . ' ha sido eliminado correctamente.';
        $user->delete();
        return back()->withStatus(__($message));
    }

    /**
     * Obtener las reglas de validación para el model
     * @param string $unique_validation
     * @param bool $password_validation
     * @return array
     */
    private function getRulesValidation(
        string $unique_validation = 'unique:users',
        bool $password_validation = true
    ): array
    {
        $rule_password = $password_validation ? ['required', 'string', 'min:8'] : ['nullable'];
        $data = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $unique_validation],
            'password' => $rule_password,
            'gender' => ['required', 'string', 'in:F,M,NA'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'in:guest,admin'],
        ];

        return $data;
    }
}
