<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    protected $fillable = ['option_name','option_value'];

    // get option
    public static function get_option( $option_name, $option_value = null ) {
		$return = self::where('option_name', $option_name)->pluck('option_value')->first();

		if( !$return )
			return $option_value;

		return $return;
		
    }

    // update option
    public static function update_option( $option_name, $option_value ) {

    	// update if already exists - create if it doesn't
    	$option = self::firstOrCreate(['option_name' => $option_name]);
    	$option->option_value = $option_value;
    	$option->save();

    	return $option;

    }

     // delete an option
    public static function delete_option( $option_name ) {
        $id = self::where('option_name', $option_name)->pluck('id')->first();

        if( $id )
            return self::destroy($id);

    }

    
}
