<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\User;
use App\Patient;
use App\Prescription;
use App\Prescription_drug;
use App\Prescription_test;
use App\Test;
use Redirect;
use Arr;


class PrescriptionController extends Controller{
    

    public function __construct(){
        $this->middleware('auth');
    }


    public function create(){
        
    	$drugs = Drug::all();
        $patients = User::where('role','patient')->get();
        $tests = Test::all();

    	return view('prescription.create',['drugs' => $drugs, 'patients' => $patients, 'tests' => $tests]);
    }

    public function store(Request $request){

	     $validatedData = $request->validate([
	        	'patient_id' => ['required','exists:users,id'],
	        	'trade_name.*' => 'required',
	    	]);

        
            

    	$prescription = new Prescription;

        $prescription->user_id = $request->patient_id;
        $prescription->reference = 'p'.rand(10000,99999);

        $prescription->save();

     
    if(isset($request->trade_name)):

  	   	$i = count($request->trade_name);

  	   	for ($x = 0; $x < $i; $x++) {
		  
		  if($request->trade_name[$x] != null){

            $add_drug = new Prescription_drug;

            $add_drug->type = $request->type[$x];
            $add_drug->strength = $request->strength[$x];
            $add_drug->dose = $request->dose[$x];
            $add_drug->duration = $request->duration[$x];
            $add_drug->drug_advice = $request->drug_advice[$x];
            $add_drug->prescription_id = $prescription->id;
            $add_drug->drug_id = $request->trade_name[$x];

            $add_drug->save();

          }

        }
    endif;

    if(isset($request->test_name)):

        $y = count($request->test_name);

        for ($x = 0; $x < $y; $x++) {

            $add_test = new Prescription_test;

            $add_test->test_id = $request->test_name[$x];
            $add_test->prescription_id = $prescription->id;
            $add_test->description = $request->description[$x];

            $add_test->save();

		}

    endif;

		return Redirect::route('prescription.all')->with('success', 'Prescription Created Successfully!');;



    }

    public function all(){
        
    	$prescriptions = Prescription::orderBy('id','DESC')->paginate(10);

    	return view('prescription.all',['prescriptions' => $prescriptions]);
    }

    public function view($id){

    	$prescription = Prescription::findOrfail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id' ,$id)->get();
        $prescription_tests = Prescription_test::where('prescription_id' ,$id)->get();
    	
    	return view('prescription.view',['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs, 'prescription_tests' => $prescription_tests]);
    }

    public function pdf($id){

    	$prescription = Prescription::findOrfail($id);
    	$prescription_drugs = Prescription_drug::where('prescription_id' ,$id)->get();
    	
    	view()->share(['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs]);

        

        $pdf = PDF::loadView('prescription.pdf_view', ['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs]);
        $pdf->setOption('viewport-size', '1024x768');
      // download PDF file with download method
      return $pdf->download($prescription->User->name.'_pdf.pdf');
    }


    public function edit($id){

        $prescription = Prescription::findOrfail($id);
        $prescription_drugs = Prescription_drug::where('prescription_id' ,$id)->get();
        $prescription_tests = Prescription_test::where('prescription_id' ,$id)->get();

        $drugs = Drug::all();
        $tests = Test::all();

        return view('prescription.edit',['prescription' => $prescription, 'prescription_drugs' => $prescription_drugs, 'prescription_tests' => $prescription_tests,'drugs' => $drugs, 'tests' => $tests]);
    }


    public function update(Request $request){

         $validatedData = $request->validate([
                'patient_id' => ['required','exists:users,id'],
                'trade_name.*' => 'required',
        ]);

        $prescription_drugs = Prescription_drug::where('prescription_id' , $request->prescription_id)->pluck('id')->toArray();

        if($request->has('prescription_drug_id')){
            $filtered = $request->prescription_drug_id;
        }else{
            $filtered = [];
        }

        foreach($prescription_drugs as $key => $dz){
            $filtered[] = "$dz";            
        }


        $filtered_unique = array_unique($filtered);


        $deleted_drugs = array_count_values($filtered);

        foreach($deleted_drugs as $key => $value)
            if($value < 2){
                $new_array[] = $key;

                Prescription_drug::destroy($key);

            }


        if(isset($request->trade_name)):

            $i = count($request->trade_name);


            for ($x = 0; $x < $i; $x++) {
              

               
               if(isset($request->prescription_drug_id[$x])){

                  Prescription_drug::where('id', $request->prescription_drug_id[$x])
                            ->update(['type' => $request->type[$x],
                                        'strength' => $request->strength[$x],
                                        'dose' => $request->dose[$x],
                                        'duration' => $request->duration[$x],
                                        'drug_advice' => $request->drug_advice[$x],
                                        'drug_id' => $request->trade_name[$x]
                                    ]); 


               }else{
                    $add_drug = new Prescription_drug;

                    $add_drug->type = $request->type[$x];
                    $add_drug->strength = $request->strength[$x];
                    $add_drug->dose = $request->dose[$x];
                    $add_drug->duration = $request->duration[$x];
                    $add_drug->drug_advice = $request->drug_advice[$x];
                    $add_drug->prescription_id = $request->prescription_id;
                    $add_drug->drug_id = $request->trade_name[$x];

                    $add_drug->save();
               }


            }
        endif;

        // Test 

        $prescription_tests = Prescription_test::where('prescription_id' , $request->prescription_id)->pluck('id')->toArray();

        if($request->has('prescription_test_id')){
            $filtered_test = $request->prescription_test_id;
        }else{
            $filtered_test = [];
        }

        foreach($prescription_tests as $key => $fr){
            $filtered_test[] = "$fr";            
        }


        $filtered_test_unique = array_unique($filtered_test);


        $deleted_tests = array_count_values($filtered_test);

        foreach($deleted_tests as $key => $value)
            if($value < 2){
                //$new_array[] = $key;
                Prescription_test::destroy($key);
            }


        if(isset($request->test_name)):

            $i = count($request->test_name);


            for ($x = 0; $x < $i; $x++) {
              

               
               if(isset($request->prescription_test_id[$x])){

                  Prescription_test::where('id', $request->prescription_test_id[$x])
                            ->update(['description' => $request->description[$x],
                                        'test_id' => $request->test_name[$x]
                                    ]); 


               }else{
                    $add_test = new Prescription_test;
                    $add_test->description = $request->description[$x];
                    $add_test->prescription_id = $request->prescription_id;
                    $add_test->test_id = $request->test_name[$x];

                    $add_test->save();
               }


            }
        endif;

        return Redirect::route('prescription.view',['id' => $request->prescription_id])->with('success', 'Prescription Edited Successfully!');;

        //return $request;

    }


    public function destroy($id){

        Prescription::destroy($id);
        return Redirect::route('prescription.all')->with('success', 'Prescription Deleted Successfully!');;

    }


    public function view_for_user(Request $request,$id){

        $User = User::findOrfail($id);

        $prescriptions = Prescription::where('user_id',$id)->paginate(10);
        return view('prescription.view_for_user', ['prescriptions' => $prescriptions]);
    }
}
