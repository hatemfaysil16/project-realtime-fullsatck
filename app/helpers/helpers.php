<?php
use App\Models\Settings;

if(!function_exists('settings')) {
    function settings($key,$value=null)
    {
        $s = Settings::where('key', $key)->first();
        if($s) {
            return $s->value;
        }
        Settings::create([
            'key'=>$key,
            'value'=>$value,
        ]);
        return ($value);
    }
}