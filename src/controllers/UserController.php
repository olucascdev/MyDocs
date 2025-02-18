<?php

class UserController extends RenderView
{
  public function index()
  {
    $users = new UserModel();
    $userData = $users->fetch();

    $this->loadView('TelaUsers', [
      'users' => $userData
    ]);
  }
}