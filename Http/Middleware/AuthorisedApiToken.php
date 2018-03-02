<?php

namespace Modules\User\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserTokenRepository;

class AuthorisedApiToken
{
    /**
     * @var UserTokenRepository
     */
    private $userToken;
    /**
     * @var Authentication
     */
    private $auth;

    public function __construct(UserTokenRepository $userToken, Authentication $auth)
    {
        $this->userToken = $userToken;
        $this->auth = $auth;
    }

    public function handle(Request $request, \Closure $next)
    {
        $token = $request->header('Authorization') ? $request->header('Authorization') : $request->get('token');

        if ($this->isValidToken($token) === false) {
            return response()->json([
                'errors' => true,
                'message' => trans('core::core.unauthorized')
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

        $this->auth->logUserIn($found->user);

        return true;
    }

    private function parseToken($token)
    {
        return str_replace('Bearer ', '', $token);
    }
}
