<?php

namespace app\admin\controller;

use think\Controller;


class Test extends Controller
{
    public function index()
    {
        return $this->view->fetch('index');
    }
}