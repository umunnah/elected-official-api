<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * get all users with pagination
     */
    public function index(): ApiResponse
    {
        return ApiResponse::sendResponse($this->userRepository->all(), trans('successful'));
    }


    /**
     * To get a single User
     */
    public function show($id): ApiResponse
    {
        $user =  $this->userRepository->find($id);
        return ApiResponse::sendResponse($user, trans('successful'));
    }
}
