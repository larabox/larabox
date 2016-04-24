<?php

if (!function_exists('image_thumb_fit')) {
    /**
     * Adds one or more messages to the MessagesCollector
     *
     * @param  mixed ...$value
     * @return string
     */
    function image_thumb_fit($nameFile,$w,$h = null)
    {

        if ( !is_file( public_path($nameFile) ) ) return null;
        if (!is_dir(public_path('thumb'))) {
            mkdir(public_path('thumb'));
        }

        $pathFile = 'thumb/t'.md5($nameFile).'('.$h.'-'.$w.').png';
        if (!file_exists(public_path($pathFile))){
            Image::make(public_path($nameFile))
                ->fit($w,$h)
                ->encode('png', 95)
                ->save(public_path($pathFile),100);
        }
        return '/'.$pathFile;

    }
}
if (!function_exists('image_thumb_resize_canvas')) {

    /**
     * @param $nameFile
     * @param $w
     * @param null $h
     * @param string $position
     * @param string $color
     * @return null|string
     */
    function image_thumb_resize_canvas($nameFile, $w, $h = null, $position = 'center', $color = 'fff')
    {
        if (!is_file(public_path($nameFile))) return config('jetcms.core.not_image',null);
        if (!is_dir(public_path('thumb'))) {
            mkdir(public_path('thumb'));
        }

        $pathFile = 'thumb/t' . md5($nameFile) . '(' . $h . '-' . $w . '-' . $position . '-' . $color . ').png';
        if (!file_exists(public_path($pathFile))) {
            Image::make(public_path($nameFile))->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas($w, $h, $position, false, $color)->encode('png', 95)->save(public_path($pathFile), 100);
        }

        return '/'.$pathFile;
    }
}

if (!function_exists('words_limit')) {

    /**
     * @param $input_text
     * @param int $limit
     * @return string
     */
    function words_limit($input_text, $limit = 50)
    {
        $input_text = strip_tags($input_text);
        $words = explode(' ', $input_text);
        if ($limit < 1 || sizeof($words) <= $limit) {
            return $input_text;
        }
        $words = array_slice($words, 0, $limit);
        $out = implode(' ', $words);
        return $out;
    }
}

if (!function_exists('parse_snippet')){

    /**
     * @param $value
     * @return mixed
     */
    function parse_snippet($value){
        return preg_replace_callback('|\[\[(.+)\]\]|iU', function($matches){
            if (isset($matches[1])){

                $arr = explode('|',$matches[1]);

                $action = 'snippet';
                $config = null;

                $value = $arr[0];
                if (isset($arr[1])){
                    $action = $arr[0];
                    $value = $arr[1];
                    $config = (isset($arr[2])) ? $arr[2] : null ;
                }

                if ($action == 'snippet') {
                    if (view()->exists('snippet.' . $value)) {
                        return view('snippet.' . $value,compact('config'));
                    } else {
                        return $matches[0];
                    }
                }

                if ($action == 'config') {
                    return config('snippet.',$value,$value);
                }

            }else{
                return '';
            }

        },$value);
    }
}



if (!function_exists('files_move')){

    /**
     * @param $value
     * @return mixed
     */
    function files_move($value,$new){
        $value = str_replace('files//','files/',$value);
        $nameFile = str_replace('files/','',$value);
        $newPath = $new.'/'.$nameFile;
        $disk = Storage::disk('public');
        if ($disk->exists($value)){
            if ($disk->exists($newPath)){
                $newPath = $new.time().$nameFile;
            }

            $disk->move($value, $newPath);
        }
        return '/'.$newPath;
    }
}

if (!function_exists('url_add_attr')){

    /**
     * @param $value
     * @return mixed
     */
    function url_add_attr($arr1,$arr2 = []) {
        $arr = array_merge($arr1,$arr2);
        $v = [];
        foreach($arr as $key=>$val){
            if ($val !== null) {
                $v[] = $key . '=' . $val;
            }
        }
        $attr = implode('&',$v);
        $str = (!empty($attr)) ? '?'.$attr : '';
        return Request::path().$str;
    }
}

if (!function_exists('getIP')){

    function getIP(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}