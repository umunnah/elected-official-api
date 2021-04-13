<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Response\ApiResponse;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use App\Http\Request\User\LoginUserRequest;
use App\Http\Request\User\StoreUserRequest;

class AuthController extends Controller 
{

  public function __construct(AuthRepository $authRepository) 
  {
      $this->authRepository = $authRepository;
  }


  public function login(LoginUserRequest $request): JsonResponse 
  {
      $user = $this->authRepository->login($request->only(['username','password']));
      return ApiResponse::sendResponse($user, trans('successful'));
  }

  /**
   * create a user
   */
  public function store(StoreUserRequest $request): JsonResponse
  {
      $user =  $this->authRepository->create($request->all());
      return ApiResponse::sendResponse($user, trans('successful'), true, 201);
  }
}