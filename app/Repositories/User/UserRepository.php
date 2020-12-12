<?php


namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Query\Builder
     */
    private $user;

    public function __construct(User $model, Request $request)
    {
        parent::__construct($model, $request);
    }

    public function all()
    {
        $perPage = ($this->request->query('paginate')) ? $this->request->query('paginate'): 100;

        $data = DB::table('users')->latest()->paginate($perPage);

        return $data;

    }


}
