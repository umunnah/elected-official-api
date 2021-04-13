<?php

namespace App\Repositories\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function __construct(User $user, Request $request)
    {
        $this->user =  $user;
        $this->user->creating(function ($user) {
            $user->id = Str::uuid();
        });
    }

    public function create(array $data): User
    {
        try {
            $data['password'] = $this->hashPassword($data['password']);
            $user = $this->user->create($data);
            return $user;
        } catch (Exception $e) {
            throw new Exception($e->getMessage);
        }
        
    }

    public function login(array $data): array 
    {
        $data =  $this->getCredentials($data);
        if (!Auth::attempt($data)) throw new Exception("Invalid Credentials",JsonResponse::HTTP_UNAUTHORIZED);
        $user = request()->user();
        if ($user->email_verified_at == null) throw new Exception("Please verify account",JsonResponse::HTTP_FORBIDDEN);
        return $this->getToken($user);
    }

    private function hashPassword($password): string
    {
        $hashPassword = Hash::make($password);
        return $hashPassword;
    }

    private function checkHashPassword($password, $oldPassword): Bool
    {
        if (Hash::check($password, $oldPassword)) {
            return true;
        } else {
            return false;
        }
    }

    private function getCredentials(array $request): array
    {
        if (!filter_var($request['username'], FILTER_VALIDATE_EMAIL))
            $credentials = [
                'username' => $request['username'],
                'password' => $request['password']
            ];
        else
            $credentials = [
                'email' => $request['username'],
                'password' => $request['password']
            ];
        return $credentials;
    }

    private function getToken(User $user): array
    {
        $tokenResult = $user->createToken('user_access_token');
        $token = $tokenResult->token;
        $token->save();
        $data = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];
        return $data;
    }
}
