<?php

class HomeController extends RenderView
{
  public function index()
  {
    $users = new UserModel();


    $this->loadView('Home', [
      'title' => 'MyDocs',
      'users' => $users->fetch()
    ]);
  }
}