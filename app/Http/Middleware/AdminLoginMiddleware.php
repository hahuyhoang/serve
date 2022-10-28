<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)
    {
    	if(Auth::check()){
            $check = Auth::user()-> deleted_at;
            if($check != null){
                Auth::logout();
                return redirect()-> route('getLoginAdmin')->with('error', 'Account does not exist');
            }else{
                $user = Auth::user();
                if($user->user_role->role_id != 1){
                    Auth::logout();
                    return redirect()->route('getLoginAdmin')->with('error', 'Account does not exist');
                }else{
                    return $next($request);
                }
            }
            
        }else{
            return redirect()-> route('getLoginAdmin')->with('error', 'Your username or account is incorrect');
        }
    }
}
