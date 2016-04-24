<?php namespace Suroviy\LaraBox\Controllers;

use Validator;
use Mail;
use Request;
use Illuminate\Routing\Controller as BaseController;

class FormController extends BaseController
{
    protected $template = 'tpl.form.message';
    protected $mail_template = 'emails.form.message';
    protected $redirect = '/';
    protected $subject = 'Заявка с сайта';

    public function getIndex(){
        return view($this->template);
    }

    public function postIndex(){
        $validator = $this->validator();
        if ($validator->fails()){
            return view($this->template,compact('validator'));
        }
        $this->send();
        return redirect($this->redirect);
    }

    protected function send(){
        Mail::send($this->mail_template, ['input'=>Request::all(),'name_tpl'=>$this->mail_template], function($message)
        {
            foreach(config('suroviy.lara_box.send_mail',[config('mail.from')]) as $val){
                $message->to($val['address'], $val['name'])->subject($this->subject);
            }
        });
    }

    protected function validator(){
        return Validator::make(
            Request::all(),
            [
                'email' => 'required|email',
                'telefon' => 'required|min:7',
                'name' => 'required'
            ],[
                'email.required' => 'Требуется заполнить почту',
                'telefon.required' => 'Требуется заполнить телефон',
                'name.required' => 'Требуется заполнить имя',
                'min' => 'Слишком короткий номер',
                'email' => 'Неверный формат почты',
            ]
        );
    }
}