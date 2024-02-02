<?php

namespace App\Controllers;

use App\Core\Application;
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
                return Application::$app->response->redirect('/');
            }
        }

        return $this->render('register',[
            'model' => $registerModel
        ]);
    }
}