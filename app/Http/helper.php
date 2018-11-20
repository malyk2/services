<?php
if (! function_exists('formErrors')) {
    function formErrors($name)
    {
        $errors = session('errors');
        $result = '';
        if($errors && $errors->has($name)) {
            $result .= '<ul class="parsley-errors-list filled">';
            foreach($errors->get($name) as $error) {
                $result .= '<li class="parsley-required">'.$error.'</li>';
            }
            $result .= '</ul>';
        }
        return $result;
    }
}

if (! function_exists('timeToSeconds')) {

    function timeToSeconds($time)
    {
        $parsed = date_parse($time);
        $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
        return $seconds;
    }
}

if (! function_exists('stringToCarbon')) {

    function stringToCarbon($string)
    {
        if (is_string($string)) {
            try{
                return \Carbon\Carbon::parse($string);
            } catch(\Exception $e) {
                return null;
            }
        } else {
            return $value;
        }
    }
}