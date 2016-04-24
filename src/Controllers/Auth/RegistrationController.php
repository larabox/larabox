<?php namespace Suroviy\LaraBox\Controllers\Auth;

use SEO;
use Validator;
use Sentinel;
use Request;

use Illuminate\Routing\Controller as BaseController;

class RegistrationController extends BaseController
{

    public function getRegistration(){
        SEO::setTitle('Авторизация');
        SEO::setDescription('Авторизация на сайте');

        $validator = Validator::make([],[]);

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{
            return view('auth.registration',compact('validator'));
        }

        return view('auth.registration');
    }

    public function postRegistration(){
        SEO::setTitle('Авторизация');
        SEO::setDescription('Авторизация на сайте');

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{

            $validator = Validator::make(
                Request::all(),
                [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed'
                ],
                [
                    'required' => 'требутся заполнить',
                    'email' => 'не верный формат почты',
                    'confirmed' => 'пароли не совподают',
                    'unique' => 'такой пользователь существует'
                ]
            );

            if (!$validator->fails()) {

                $credentials = [
                    'email' => Request::get('email'),
                    'first_name' => Request::get('first_name'),
                    'last_name' => Request::get('last_name'),
                    'password' => Request::get('password'),
                ];

                if ($user = Sentinel::register($credentials)) {
                    Sentinel::authenticateAndRemember($credentials);
                    return redirect(route('profile'));
                }

                $validator->messages()->add('status', 'Что то пошло не так');
            }
        }
        return view('auth.registration',compact('validator'));
    }
}
