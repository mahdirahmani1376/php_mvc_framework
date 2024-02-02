<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

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
        $registerModel = new User();

        if ($request->isPost()){
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->save()){
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