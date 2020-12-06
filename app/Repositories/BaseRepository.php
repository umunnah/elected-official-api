<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract  class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model, Request $request)
    {
        $this->model = $model;
        $this->request =$request;

    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findAndGetRelationships($id, $association = null)
    {
        // TODO: Implement findAndGetRelationships() method.
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }


    public function findOneBy(array $attributes)
    {
        return $this->model->where($attributes)->first();
    }

    public function findBy(array $attributes)
    {
        return $this->model->where($attributes)->get();
    }

    public function getModel(): Model
    {
        return $this->model;
    }
}
