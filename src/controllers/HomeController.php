<?php

class HomeController extends RenderView
{
  public function index()
  {
    $users = new UserModel();


    $this->loadView('TelaHome', [
      'title' => 'MyDocs',
      'users' => $users->fetch()
    ]);
  }
}