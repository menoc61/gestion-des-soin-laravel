<?php

namespace App\Http\Controllers;

use App\Drug;
use Illuminate\Http\Request;
use League\Csv\Reader;

class DrugController extends Controller
{
    protected $products = [];

    public function __construct()
    {
        $this->middleware('auth');
        $this->loadProducts();
    }

    protected function loadProducts()
    {
        // Define the path to the CSV file
        $csvFilePath = public_path('uploads/product_db.csv');

        // Check if the file exists
        if (file_exists($csvFilePath)) {
            // Read the product_db.csv file
            $csv = Reader::createFromPath($csvFilePath, 'r');
            $csv->setHeaderOffset(0); // Assuming the first row contains headers

            $this->products = iterator_to_array($csv->getRecords()); // Convert MapIterator to an array
        }
    }

    public function create()
    {
        // Access products from the protected variable
        $products = $this->products;

        return view('drug.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trade_name' => 'required',
            'generic_name' => ['required', 'array'],
        ]);

        $drug = Drug::updateOrCreate(
            ['trade_name' => $request->trade_name, 'generic_name' => json_encode($request->generic_name)],
            ['note' => $request->note]
        );

        return \Redirect::route('drug.all')->with('success', __('sentence.Drug added Successfully'));
    }

    public function all()
    {
        $products = $this->products;
        $sortColumn = request()->get('sort');
        $sortOrder = request()->get('order', 'asc');
        if (!empty($sortColumn)) {
            $drugs = Drug::orderby($sortColumn, $sortOrder)->paginate(25);
        } else {
            $drugs = Drug::all();
        }
        return view('drug.all', ['drugs' => $drugs, 'products' => $products]);
    }

    public function edit($id)
    {
        $products = $this->products;
        $drug = Drug::find($id);

        return view('drug.edit', ['drug' => $drug, 'products' => $products]);
    }

    public function store_edit(Request $request)
    {
        $validatedData = $request->validate([
            'trade_name' => 'required',
            'generic_name' => 'required',
        ]);

        $drug = Drug::find($request->drug_id);

        $drug->trade_name = $request->trade_name;
        $drug->generic_name = json_encode($request->generic_name);

        $drug->save();

        return \Redirect::route('drug.all')->with('success', __('sentence.Drug Edited Successfully'));
    }

    public function destroy($id)
    {
        Drug::destroy($id);

        return \Redirect::route('drug.all')->with('success', __('sentence.Drug Deleted Successfully'));
    }
}
