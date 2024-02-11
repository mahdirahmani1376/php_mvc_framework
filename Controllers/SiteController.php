<?php

namespace App\Controllers;
use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
          'name' => 'Mahdi'
        ];

        return $this->render('home',$params);
    }

    public function contact(Request $request,Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() and $contact->send()){
                Application::$app->session->setFlash('success','Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }

        return $this->render('contact',[
            'model' => $contact
        ]);
    }

    public function handleContact(Request $request)
    {
        return $this->render('contact');
    }

}