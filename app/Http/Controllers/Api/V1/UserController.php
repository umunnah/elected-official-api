<?php


namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\JsonResponse;
use App\Http\Response\ApiResponse;
use App\Http\Controllers\Controller;
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
    public function index(): JsonResponse
    {
        return ApiResponse::sendResponse($this->userRepository->all(), trans('successful'));
    }


    /**
     * To get a single User
     */
    public function show($id): JsonResponse
    {
        $user =  $this->userRepository->find($id);
        return ApiResponse::sendResponse($user, trans('successful'));
    }
}
