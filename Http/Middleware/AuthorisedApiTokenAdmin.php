<?php

namespace Modules\User\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Repositories\UserTokenRepository;

class AuthorisedApiTokenAdmin
{
    /**
     * @var UserTokenRepository
     */
    private $userToken;

    public function __construct(UserTokenRepository $userToken)
    {
        $this->userToken = $userToken;
    }

    public function handle(Request $request, \Closure $next)
    {
        if ($request->header('Authorization') === null) {
            return response()->json([
                'errors' => true,
                'message' => _ths('unauthorized')
            ], 403);
        }

        if ($this->isValidToken($request->header('Authorization')) === false) {
            return response()->json([
                'errors' => true,
                'message' => _ths('unauthorized')
            ], 403);
        }

        return $next($request);
    }

    private function isValidToken($token)
    {
        $found = $this->userToken->findByAttributes(['access_token' => $this->parseToken($token)]);

        if ($found === null) {
            return false;
        }

        if ($found->user->hasRoleName('admin') === false) {
            return false;
        }

        return true;
    }

    private function parseToken($token)
    {
        return str_replace('Bearer ', '', $token);
    }
}
