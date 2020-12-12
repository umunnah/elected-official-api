<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
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
}
