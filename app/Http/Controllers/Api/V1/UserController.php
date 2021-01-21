<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Request\User\StoreUserRequest;
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

    public function index()
    {
        return response()->json($this->userRepository->all(),'200');
    }

    public function store(StoreUserRequest $request)
    {
        $user =  $this->userRepository->create($request->all());
        return ApiResponse::sendResponse($user, trans('successful'),true, 201);
    }

    public function show($id)
    {
        $user =  $this->userRepository->find($id);
        return response()->json($user,200);
    }
}
