<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/setup', function () {
    $creadentials = [
        "email" => "admin@admin.com",
        "password" => "password"
    ];

    if (!Auth::attempt($creadentials)) {
        $user = new \App\Models\User();

        $user->name = 'Admin';
        $user->email = $creadentials['email'];
        $user->password = bcrypt($creadentials['password']);

        $user->save();

        if (Auth::attempt($creadentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
            $updateToken = $user->createToken('update-token', ['create', 'update']);
            $basicToke = $user->createToken('basic-toke');

            return [
                'admin' => $adminToken,
                'update' => $updateToken,
                'basic' => $basicToke
            ];
        }
    }



});