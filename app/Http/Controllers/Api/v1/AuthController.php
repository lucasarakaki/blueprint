<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HttpResponse;

    /**
     * @param Request $request
     * 
     * @return HttpResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make( $request->all(), [ 
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ] );

        if ( $validator->fails() ) {
            return $this->error( 'Dados inválidos', 422, $validator->errors() );
        } 

        $user = User::create( [
            'name'     => $request->name,
            'ema il'    => $request->email,
            'password' => bcrypt( $request->password ),
        ] );

        return $this->success( 'Usuário registrado com sucesso', 201, [
            'user' => $user,
        ] );
    }

    /**
     * @param Request $request
     * 
     * @return HttpResponse
     */
    public function login( Request $request )
    {
        $validator = Validator::make( $request->all(), [ 
            'email'    => 'required|email',
            'password' => 'required',
        ] );

        if ( $validator->fails() ) {
            return $this->error( 'Dados inválidos', 422, $validator->errors() );
        } 

        if (  ! Auth::attempt( $request->only( 'email', 'password' ) ) ) {
            return $this->error( 'Credenciais inválidas', 401, [], [
                'email' => 'As credenciais fornecidas não correspondem a nenhum usuário registrado.',
            ] );
        } 

        $user = User::where( 'email', $request->email )->firstOrFail(); // Retrieve the user by email

        $token = $user->createToken( 'auth_token' )->plainTextToken; // Create a new personal access token for the user

        return $this->success( 'Login realizado com sucesso', 200, [
            'user'         => $user,
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ] );
    }

    /**
     * @param Request $request
     * 
     * @return HttpResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success( 'Logout realizado com sucesso', 200, [] );
    }

}
