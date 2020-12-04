<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{

    public function all(); // gets all entities of the model

    public function find($id);//finds entity by id

    public function findAndGetRelationships($id, $association = null);//finds entity and gets all its relationships

    public function create(array $attributes); // creates a new entity

    public function  update($id, array $attributes);// updates an entity

    public function delete ($id); //deletes an entity

    public function findBy(array $attributes);
    public function findOneBy(array $attributes);

    public function getModel() : Model;

}
