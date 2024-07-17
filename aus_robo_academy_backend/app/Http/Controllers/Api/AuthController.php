<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Http\Requests\Api\StudentVerificationRequest;


class AuthController extends Controller
{
    public function login(LoginRequest $request) {

        if($user = $request->apiAuthenticate()) {
            return response()->json([
                "success" => true,
                "user"  => $user
            ], 200);
        }

        return response()->json([
            "success" => false,
            "message"  => 'Invalid Credentials.'
        ], 422);
    }

    public function studentVerification(studentVerificationRequest $request) {
        $user = User::where('organisation_id', request()->organisation_id)->first();

        if (!$user)
            return response()->json(['message' => 'Invalid organization ID'], 400);

        return response()->json([
            "success" => true,
            "message" => 'Organistaion ID is Verified.',
        ], 200);
    }
}
