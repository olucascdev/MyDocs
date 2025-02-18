<?php

class UserController
{
  public function index() {}

  public function show($id)
  {
    echo "User" . $id[0];
  }
}