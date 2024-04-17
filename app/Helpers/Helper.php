<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

if(!function_exists('get_option')){

    function get_option( $option_name, $option_value = null ) {

        $return = Setting::where('option_name', $option_name)->pluck('option_value')->first();

        if( !$return )
            return $option_value;

        return $return;

    }
}

if(!function_exists('update_option')){

    function update_option($option_name, $option_value ) {
        // update if already exists - create if it doesn't
        $option = Setting::firstOrCreate(['option_name' => $option_name]);
        $option->option_value = $option_value;
        $option->save();

        return $option;

    }
}

if(!function_exists('get_visitor_status')){
    function get_visitor_status( $type) {

        $types = ['1' => __('Sentence.Pending'), '2' => __('Sentence.Ongoing'), '3' => __('Sentence.Archived')];

        return $types[$type];

    }
}

if(!function_exists('yes_or_no')){
    function yes_or_no( $value) {

        $types = ['1' => __('Sentence.Yes'), '0' => __('Sentence.No')];

        return $types[$value];

    }
}
