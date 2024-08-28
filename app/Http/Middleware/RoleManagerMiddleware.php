<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManagerMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string $scope
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $scope = ''): Response
    {
        $scopes = json_decode(Auth::user()->role->scope);

        if (!in_array($scope, $scopes))
            abort(403);

        return $next($request);
    }
}
