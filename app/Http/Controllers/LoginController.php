<?php

namespace App\Http\Controllers;

use App\Application\Login\MakeLoginUseCase;
use App\Http\Requests\Login\MakeLoginRequest;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __construct(
        private readonly MakeLoginUseCase $makeLogin
    )
    {
    }

    public function auth(MakeLoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $login = $this->makeLogin->execute($email, $password);

        return response()->json(
            $login,
            $login
                ? Response::HTTP_OK
                : Response::HTTP_UNAUTHORIZED
        );
    }
}
