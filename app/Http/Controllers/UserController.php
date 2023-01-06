<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'token' => 'required'
        ]);

        $credentials = [
            'email' => $request->user['email'],
            'password' => $request->user['password']
        ];

        $recaptchaResult = Http::asForm()->post(env('RECAPTCHA_URL'), [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->token,
        ])->json();

        if($recaptchaResult['success'] && $recaptchaResult['score'] > 0.5 && Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return json_encode(['success'],201);
        }

        return json_encode(['error'],500);
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
