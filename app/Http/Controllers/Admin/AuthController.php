<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::user()){
            if(Auth::user()->user_role->role_id == 1){
                return redirect()->route('admin.products.list');
            }else{
                Auth::logout();
                return redirect()->back();
            }
            
        }else{
            return view('vendor.adminlte.auth.login');
        }
    }

    public function postLogin(Request $request)
    {
        $this-> Validate($request,[
            'email'=> 'required|email|exists:users,email',
            'password' => 'required'
        ],
        [
            'email.required'=>'The email field is required',
            'password.required'=>'The password field is required',
            
        ]);

        $admin = User::where('email', $request->get('email'))->first();
        $email = $request->get('email');
        $pwd = $request->get('password');

        if (Auth::attempt(['email' => $email, 'password' => $pwd], (bool)$request->get('remember_me'))){
            return redirect()->route('admin.products.list');
        }
        return redirect()->back()->with('errorLoginAdmin','Email or password is incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLoginAdmin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    public function postRegister()
    {
        return 'postRegister';
    }
    public function getRegister()
    {
        return 'getRegister';
    }
}
