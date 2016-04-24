<?php namespace App\Http\Controllers;

use SEO;
use Validator;
use Sentinel;
use Request;

use Illuminate\Routing\Controller as BaseController;

class ProfileController extends BaseController
{
    public function getIndex(){
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет');
        $validator = Validator::make([],[]);
        $user = Sentinel::getUser();
        return view('auth.profile',compact('user','validator'));
    }

    public function postIndex(){
        SEO::setTitle('Личный кабинет');
        SEO::setDescription('Личный кабинет');
        $validator = $this->validator();
        if (!$validator->failed()){
            if(!$this->update()){
                return 'error';
            }
        }
        $user = Sentinel::getUser();
        return view('auth.profile',compact('user','validator'));
    }

    protected function validator(){
        return Validator::make(Request::all(),[
            'first_name' => 'required',
            'password'=> 'confirmed'
        ],[
            'first_name.required' => 'Требуется указать Ваше имя',
            'confirmed'=> 'Пароли не совподают'
        ]);
    }

    protected function update(){

        $user = Sentinel::getUser();
        $credentials = [
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'avatar'=> Request::get('avatar')
        ];

        if (Request::has('password') and Request::has('password_confirmation')){
            $credentials['password'] = Request::get('password');
        }

        return Sentinel::update($user, $credentials);

    }

}
