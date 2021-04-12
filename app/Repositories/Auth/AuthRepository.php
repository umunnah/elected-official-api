<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

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

    private function hashPassword($password)
    {
        $hashPassword = Hash::make($password);
        return $hashPassword;
    }

    private function checkHashPassword($password, $oldPassword)
    {
        if (Hash::check($password, $oldPassword)) {
            return true;
        } else {
            return false;
        }
    }
}
