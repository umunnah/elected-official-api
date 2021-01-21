<?php


namespace App\Http\Controllers\Api\V1;


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

    public function index()
    {
        return response()->json($this->userRepository->all(),'200');
    }

    public function store()
    {
        return '';
    }

    public function show($id)
    {
        $user =  $this->userRepository->find($id);
        return response()->json($user,200);
    }
}
