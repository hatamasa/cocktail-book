<?php
namespace App\Controller;

class HelloController extends AppController
{
    public function index(){
        $data = 'Hello world!';
        $this->set('data', $data);
    }

}