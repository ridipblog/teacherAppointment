<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type = 'view'): Response
    {
        $isValidate = true;
        $message = null;
        try {
            if (!Auth::check()) {
                $isValidate = false;
                $message = "You are not authorized persion";
            }
        } catch (Exception $err) {
            $message = "Server error please try later !";
        }
        if (!$isValidate) {
            if ($type == 'view') {
                return redirect('/login');
            } else {
                return response()->json(['status' => 301, 'message' => $message]);
            }
        }
        return $next($request);
    }
}
