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