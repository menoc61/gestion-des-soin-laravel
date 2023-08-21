<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use Redirect;

class HistoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function store(Request $request){

        //return $request;

         $this->validate($request, [
            'title' => 'required',
            'patient_id' => ['required','exists:users,id'],
        ]);

        $history = new History;

        $history->title = $request->title;
        $history->note = $request->note;
        $history->user_id = $request->patient_id;

        $history->save() ;
         
        return Redirect::back()->with('success','Medical History added successfully');

    }

    public function destroy($id){

        History::destroy($id);

        return Redirect::back()->with('success', 'Medical History Deleted Successfully!');

    }
}
