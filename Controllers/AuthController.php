<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\RegisterModel;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->setLayout('auth');
    }

    public function login()
    {
        return $this->render('login');
	}

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();

        if ($request->isPost()){
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register()){
                return $this->render('register',[
                   'model' => $registerModel
                ]);
            }
        }

        return $this->render('register',[
            'model' => $registerModel
        ]);
    }
}