<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Response\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use App\Http\Request\User\StoreUserRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller 
{

  public function __construct(AuthRepository $authRepository) 
  {
      $this->authRepository = $authRepository;
  }


  public function login() 
  {}

  /**
   * create a user
   */
  public function store(StoreUserRequest $request): JsonResponse
  {
      $user =  $this->authRepository->create($request->all());
      return ApiResponse::sendResponse($user, trans('successful'), true, 201);
  }
}