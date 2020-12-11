<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ApiController;
use App\Models\User;
use App\Models\UserToken;

use Closure;

class ApiAuth extends ApiController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {   
        $user= Auth::user('api');

        if (!$user) {
            return response()->json(['message' => 'You are not authorized'], 401);
        }

        $request->attributes->add(['auth' => $user]);

        return $next($request);

        /*$token = $request->header("token");
        if (!empty($token)) {
            $res = UserToken::query()->where("token","=",$token)->whereRaw("expired_time > NOW()")->first();
            if ($res){
                $user = User::query()->where("id","=",$res->user_id)->first();
                if ($user) {
                    foreach ($roles as $role) {
                        if ($user->hasRole($role)) {
                            $request->attributes->add(['auth' => to_object(["user"=>$user,"role"=>$role])]);
                            return $next($request);
                        }
                    }
                }
            }
        }
        return self::error_responses(null, "Your request not allowed");*/
    }
}
