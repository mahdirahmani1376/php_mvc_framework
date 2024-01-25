<?php

namespace App\Controllers;
use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
          'name' => 'Mahdi'
        ];

        return $this->render('home',$params);
    }

    public function contact()
    {

    }

    public function handleContact(Request $request)
    {
        return $this->render('contact');
    }

}