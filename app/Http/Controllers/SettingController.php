<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Setting;
use Str;

class SettingController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    // Set Env function
    private function setEnv($name, $value){
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)));
        }
    }

    
    public function doctorino_settings(Request $request){
    	$settings = Setting::all();
        $language = ['fr' => 'French', 'en' => 'English', 'es' => 'Spanish', 'it' => 'Italian', 'de' => 'German', 'bn' => 'Bengali', 'tr' => 'Turkish', 'ru' => 'Russian', 'in' => 'Hindi', 'pt' => 'Portuguese', 'id' => 'Indonesian', 'ar' => 'Arabic'];
    	return view('settings.doctorino_settings', ['settings' => $settings, 'language' => $language]);
    }

    public function doctorino_settings_store(Request $request){

    	 $validatedData = $request->validate([
        	'system_name' => 'required',
        	'title' => 'required',
        	'address' => 'required',
        	'phone' => 'required',
        	'hospital_email' => 'required|email',
            'currency' => 'required',
            'appointment_interval' => 'required',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5048|dimensions:max_width=300,max_height=100',

    	]);

	    	Setting::update_option('system_name', $request->system_name);
	    	Setting::update_option('title', $request->title);
	    	Setting::update_option('address', $request->address);
	    	Setting::update_option('phone', $request->phone);
	    	Setting::update_option('hospital_email', $request->hospital_email);
            Setting::update_option('currency', $request->currency);
            Setting::update_option('vat', $request->vat);
            Setting::update_option('language', $request->language);

        if($request->hasFile('logo')){

            // We Get the image
            $file = $request->file('logo'); 
            // We Add String to Image name 
            $fileName = Str::random(15).'-'.$file->getClientOriginalName();
            // We Tell him the uploads path 
            $destinationPath = public_path().'/uploads/';
            // We move the image to the destination path
            $file->move($destinationPath,$fileName);
            // Add fileName to database 
            
            Setting::update_option('logo', $fileName);
        }

        Setting::update_option('appointment_interval', $request->appointment_interval);

        Setting::update_option('saturday_from', $request->saturday_from);
        Setting::update_option('saturday_to', $request->saturday_to);

        Setting::update_option('sunday_from', $request->sunday_from);
        Setting::update_option('sunday_to', $request->sunday_to);

        Setting::update_option('monday_from', $request->monday_from);
        Setting::update_option('monday_to', $request->monday_to);

        Setting::update_option('tuesday_from', $request->tuesday_from);
        Setting::update_option('tuesday_to', $request->tuesday_to);

        Setting::update_option('wednesday_from', $request->wednesday_from);
        Setting::update_option('wednesday_to', $request->wednesday_to);

        Setting::update_option('thursday_from', $request->thursday_from);
        Setting::update_option('thursday_to', $request->thursday_to);

        Setting::update_option('friday_from', $request->friday_from);
        Setting::update_option('friday_to', $request->friday_to);



    	return Redirect::route('doctorino_settings.edit')->with('success', __("sentence.Settings edited Successfully") );
    }

    public function prescription_settings(Request $request){

    	return view('settings.prescription_settings');
    }

    public function prescription_settings_store(Request $request){

	    	Setting::update_option('header_right', $request->header_right);
	    	Setting::update_option('header_left', $request->header_left);
	    	Setting::update_option('footer_right', $request->footer_right);
	    	Setting::update_option('footer_left', $request->footer_left);

    	return Redirect::route('prescription_settings.edit')->with('success', __("sentence.Settings edited Successfully"));

	}

    public function sms_settings(){
        return view('settings.sms_settings');
    }

    public function sms_settings_store(Request $request){

            Setting::update_option('NEXMO_KEY', $request->NEXMO_KEY);
            Setting::update_option('NEXMO_SECRET', $request->NEXMO_SECRET);

            
            $this->setEnv('NEXMO_KEY', $request->NEXMO_KEY);
            $this->setEnv('NEXMO_SECRET', $request->NEXMO_SECRET);

        return Redirect::route('sms_settings.edit')->with('success', __("sentence.Settings edited Successfully"));

    }


}
