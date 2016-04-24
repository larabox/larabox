<?php namespace Suroviy\LaraBox\Controllers\Auth;

use SEO;
use Validator;
use Sentinel;
use Request;
use Reminder;
use Mail;

use DB;

use App\User;

use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    protected $redirect = null;

    public function __construct(){
        if (!$this->redirect) {
            $this->redirect = route('home');
        }
    }

    public function getLogin(){
        SEO::setTitle('Авторизация');
        SEO::setDescription('Авторизация на сайте');

        $validator = Validator::make([],[]);

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{
            return view('auth.login',compact('validator'));
        }

        return view('auth.login');
    }

    public function postLogin(){
        SEO::setTitle('Авторизация');
        SEO::setDescription('Авторизация на сайте');

        if (Sentinel::check()) {
            return redirect($this->redirect);
        }else{

            $validator = Validator::make(
                Request::all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ],
                [
                    'required' => 'требутся заполнить',
                    'email' => 'не верный формат почты',
                ]
            );

            if (!$validator->fails()) {

                $credentials = [
                    'email' => Request::get('email'),
                    'password' => Request::get('password'),
                ];

                if (Request::get('remembor')){
                    Sentinel::authenticateAndRemember($credentials);
                }else{
                    Sentinel::authenticate($credentials);
                }

                if (Sentinel::check()) {
                    return redirect($this->redirect);
                }
                $validator->messages()->add('status', 'такой почты не найдено');
            }
        }
        return view('auth.login',compact('validator'));
    }

    public function getReset(){
        $validator = Validator::make([],[]);
        return view('auth.password.reset',compact('validator'));
    }

    public function postReset(){
        $validator = Validator::make(
            Request::all(),
            [
                'email' => 'required|email',
            ],
            [
                'required' => 'требутся заполнить',
                'email' => 'не верный формат почты',
            ]
        );

        if (!$validator->fails()) {

            if ($user = User::where('email',Request::get('email'))->first()){
                $code = Reminder::create($user)->code;

                $link = url(route('password.reset.complete')).'?'.implode('&',[
                    'code='.$code,
                    'user_id='.$user->id
                ]);


                Mail::send('emails.password_reset', compact('code','user','link'), function($message) use ($user)
                {
                    $message->to($user->email, $user->first_name.' '. $user->last_name)->subject('Сброс пароля');
                });
                return redirect(route('password.reset.complete'));
            }

            $validator->messages()->add('status', 'Не верные данные');
        }
        return view('auth.password.reset',compact('validator'));
    }

    public function getResetComplete(){
        $validator = Validator::make(
            Request::all(),
            [
                'code' => 'required'
            ],
            [
                'code.required' => 'Вам на почту выслан код, вставьте его сюда',
            ]
        );

        return view('auth.password.reset_complete',compact('validator'));
    }

    public function postResetComplete(){
        $validator = Validator::make(
            Request::all(),
            [
                'code' => 'required',
                'password' => 'required|confirmed',

            ],
            [
                'code.required' => 'Вам на почту выслан код, вставьте его сюда',
                'required' => 'требутся заполнить',
                'confirmed' => 'пароли не совподают'
            ]
        );

        if ($validator->fails()) {
            return view('auth.password.reset_complete',compact('validator'));
        }

        $reminder = DB::select('select * from reminders where code = ?', [Request::get('code')]);

        if (isset($reminder[0])){

            $user = Sentinel::findById($reminder[0]->user_id);

            if ($reminder = Reminder::complete($user, Request::get('code'), Request::get('password')))
            {
                Sentinel::login($user);
                return redirect(route('profile'));
            }
            else
            {
                $validator->messages()->add('status', 'Код не прошел проверку, повторите попытку');
            }
        }

        $validator->messages()->add('status', 'Что то пошло не так обратитесь к администрации');

        return view('auth.password.reset_complete',compact('validator'));
    }
}
