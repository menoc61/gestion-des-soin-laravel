<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\Test;

class TestController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function create(){
    	return view('test.create');
    }

    public function store(Request $request){

    		$validatedData = $request->validate([
	        	'test_name' => 'required',
                //skin diagnostic
                'signes_particuliers_peau' => ['required','array', Rule::in(["Points noirs",'Rosacée','Rousseurs',"Télangiectasie","Pustules","Hypertrichose","Pigmentations","Vitiligo", "Cicatrice","Chéloïdes","Comédons"])],
                //hand diagnostic

                //foot diagnostic
	    	]);

    	$test = new Test;

        $test->test_name = $request->test_name;
        $test->comment = $request->comment;
                //skin diagnostic
        $test->signes_particuliers_peau = implode(',',$request->signes_particuliers_peau);
                //hand diagnostic

                //foot diagnostic

        $test->save();

        return Redirect::route('test.all')->with('success', __('sentence.Test Created Successfully'));

    }

    public function all(){
    	$tests = Test::all();
    	return view('test.all', ['tests' => $tests]);
    }

    public function edit($id){
        $test = Test::find($id);
        return view('test.edit',['test' => $test]);
    }

    public function store_edit(Request $request){

            $validatedData = $request->validate([
                'test_name' => 'required',
                //skin diagnostic
                'signes_particuliers_peau' => ['required','array', Rule::in(["Points noirs","Rosacée","Rousseurs","Télangiectasie","Pustules","Hypertrichose","Pigmentations","Vitiligo", "Cicatrice","Chéloïdes","Comédons"])],
                //hand diagnostic

                //foot diagnostic
            ]);

        $test = Test::find($request->test_id);

        $test->test_name = $request->test_name;
        $test->comment = $request->comment;
                //skin diagnostic
                $test->signes_particuliers_peau = implode(',',$request->signes_particuliers_peau);
                //hand diagnostic

                //foot diagnostic
        $test->save();

        return Redirect::route('test.all')->with('success', __('sentence.Test Edited Successfully'));

    }

    public function destroy($id){

    	Test::destroy($id);
        return Redirect::route('test.all')->with('success', __('sentence.Test Deleted Successfully'));

    }
}
