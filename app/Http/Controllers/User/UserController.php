<?php

namespace App\Http\Controllers\User;

use \App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $usuarios = User::all();

        return response()->json(['data' => $usuarios], 200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Reglas de validación
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        //Validación reglas
        $this->validate($request, $rules);

        // Carga datos de la petición
        $campos = $request->all();
        $campos['password'] = bcrypt($request->password);
        $campos['verified'] = User::USER_NO_VERIFICADO;
        $campos['verification_token'] = User::generarVerificationToken();
        $campos['admin'] = User::USER_REGULAR;


        $usuario = User::create($campos);

        return response()->json(['data' => $usuario], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json(['data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**@var \App\Models\User $user */
        $user = User::findOrFail($id);

        //Reglas de validación
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => sprintf("in:%s,%s", User::USER_ADMIN, User::USER_REGULAR),
        ];

        //Validación reglas
        $this->validate($request, $rules);


        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::USER_NO_VERIFICADO;
            $user->verification_token = User::generarVerificationToken();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->esVerificado()) {
                return response()->json(['error' => 'Unicamente los usuarios verifciados pueden actualizar a administradores', 'code' => 409], 409);
            }

            $user->admin = $request->admin;
        }

        //Si ha cambiado algun dato de actualización
        if ($user->isDirty()) {
            $user->save();
        }

        return response()->json(['data' => $user, 'code' => 200], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
