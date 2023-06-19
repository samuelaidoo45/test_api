<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    //
    public function generateToken()
{
    $user = new User;
    $user->name = 'Frontend Developer';
    $user->email = 'frontend@example.com';
    $user->password = Hash::make('password'); // Set a secure password here
    $user->save();

    $token = $user->createToken('frontend-token')->plainTextToken;

    return response()->json([
        'token' => $token,
    ]);
}

}
