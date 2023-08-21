<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use Redirect;
use Illuminate\Support\Str;


class DocumentController extends Controller
{
    
	public function __construct(){
        $this->middleware('auth');
    }

    public function all(){
        $documents = Document::all();
        return view('document.all', ['documents' => $documents]);
    }


    public function store(Request $request){

    	//return $request;

    	 $this->validate($request, [
            'title' => 'required',
        	'patient_id' => ['required','exists:users,id'],
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,docx|max:5048',
        ]);

        $document = new Document;
     
         if($file = $request->hasFile('file')) {
            
            $file = $request->file('file') ;
            
            $fileName = Str::random(30).'-'.$file->getClientOriginalName();
            $destinationPath = public_path().'/uploads/';
            $file->move($destinationPath,$fileName);
            $document->file = $fileName;
            $document->document_type = $request->file('file')->getClientOriginalExtension();
            $document->user_id = $request->patient_id;
            $document->title = $request->title;
            $document->note = $request->note;
        }

        $document->save() ;
         
        return Redirect::back()->with('success','You have successfully uploaded your files');

    }

    public function destroy($id){

        $document = Document::find($id);
        $fullpath = public_path().'/uploads/'.$document->file;
        unlink($fullpath);

        Document::destroy($id);

        return Redirect::back()->with('success', 'Document Deleted Successfully!');

    }
}
