<?php


namespace App\Repositories\Auth;



interface AuthRepositoryInterface
{

  public function create(array $data);
  
  public function login(array $data);
}
