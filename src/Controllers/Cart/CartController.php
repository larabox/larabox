<? namespace Suroviy\LaraBox\Controllers\Cart;

use Request;
use Session;
use Validator;
use Mail;

use App\User;
use Cart;

use AdminForm;
use FormItem;

Use SEO;

use App\Http\Controllers\Controller;

class CartController extends  Controller
{

    /**
     * @return array
     */
    Public function generateCart(){
        $cost = Cart::cost();
        $size = Cart::sizeof();
        $item = Cart::item();

        return compact('cost','size','item');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    Public function getAdd($id){
        Cart::add($id);
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    Public function postAdd(){
        Cart::add(Request::input('id'));
        return  response()->json($this->generateCart());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    Public function getRemove($id){
        Cart::remove($id);
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    Public function postRemove(){
        Cart::remove(Request::input('id'));
        return  response()->json($this->generateCart());
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    Public function getClear($id){
        Cart::clear($id);
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    Public function postClear(){
        Cart::clear(Request::input('id'));
        return  response()->json($this->generateCart());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function getItem() {
        $val = $this->generateCart();
        $val['collection'] = Cart::getList();
        $val['cost'] = Cart::cost();
        return view('tpl.cart.cart_item',$val);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function postItem() {
        $val = $this->generateCart();
        $val['collection'] = Cart::getList();
        return view('chunk.cart.list_item',$val);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function getDrop() {
        Cart::drop();
        return redirect('/cart/item');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function getBay(){
        return view('tpl.cart.bay');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    Public function postBay(){
        Request::flash();

        $validator = Validator::make(
            Request::all(),
            [
                'name' => 'required',
                'telefon' => 'required|min:7'
            ],[
                'name.required'=> 'Требуется заполнить Ф.И.О.',
                'telefon.required'=> 'Требуется заполнить Телефон',
                'min'=> 'Слишком короткий номер',
            ]
        );

        if (!$validator->fails())
        {
            $this->baySuccess();
            Cart::drop();
            return redirect(route('cart.success.message'));
        }

        return view('tpl.cart.bay',compact('validator'));
    }

    /**
     * @return array
     */
    protected function getItemCartEmail(){
        return [
            'list' => Cart::getList(),
            'item' => Cart::item(),
            'cost'=>Cart::cost(),
            'size' => Cart::sizeof(),
            'name' => Request::get('name'),
            'telefon' => Request::get('telefon'),
            'dostavka' => Request::get('dostavka'),
            'adress' => Request::get('adress'),
            'name_site' => 'Название сайта',
            'title' => 'Оформилен заказ',
            'description' => 'Содержимое корзины'
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function baySuccess(){

        Mail::send('emails.cart.success', $this->getItemCartEmail(), function($message)
        {
            $user = User::whereIn('id',config('jetcms.cart.email'))->get();
            foreach($user as $val) {
                $message->to($val->email, $val->first_name.' '.$val->last_name)->subject('Оформления корзины!');
            }
        });
        return redirect(config('jetcms.cart.redirect_bay_success'));
    }

    public function getSuccessMessage(){
        SEO::setTitle('Спасибо за пакупку!');
        SEO::setDescription('Спасибо за пакупку!');
        return view('tpl.cart.success_message');
    }
}