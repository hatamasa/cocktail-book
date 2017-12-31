<?php
namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public function index(){
        $data = 'Hello world!';
        $this->set('data', $data);
    }

}