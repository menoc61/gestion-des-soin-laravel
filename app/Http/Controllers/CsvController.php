<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Writer;

class CsvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function processCsv(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|file|mimes:csv',
        ]);

        // Check if "products.csv" file was uploaded
        if ($request->hasFile('csvFile')) {
            $uploadedFile = $request->file('csvFile');

            // Check if the uploaded file is named "products.csv"
            if ($uploadedFile->getClientOriginalName() !== 'products.csv') {
                return redirect()->back()->with('error', 'Nom de fichier incorrect. Veuillez télécharger un fichier nommé "products.csv".');
            }

            // Store the uploaded "products.csv" file in the public/uploads directory
            $pathToSave = public_path('uploads');
            $uploadedFile->move($pathToSave, 'products.csv');

            // Delete the old "product_db.csv" if it exists
            $dbFilePath = public_path('uploads/product_db.csv');
            if (file_exists($dbFilePath)) {
                unlink($dbFilePath);
            }

            // Read and extract desired columns from "products.csv"
            $desiredColumns = ['id', 'sku', 'name', 'product_category', 'status', 'updated_at', 'imageUrl'];
            $csvData = [];

            $reader = Reader::createFromPath($pathToSave.'/products.csv', 'r');
            $reader->setHeaderOffset(0);

            // Initialize the header with column names
            $header = $desiredColumns;

            // Create "product_db.csv" with the desired column headers
            $writer = Writer::createFromPath($dbFilePath, 'w+');
            $writer->insertOne($header);

            foreach ($reader->getRecords() as $record) {
                $rowData = [];
                foreach ($desiredColumns as $column) {
                    $rowData[] = $record[$column];
                }
                $csvData[] = $rowData;
            }

            // Save the extracted data to "product_db.csv"
            $writerDb = Writer::createFromPath($dbFilePath, 'a+'); // Append mode to avoid overwriting
            $writerDb->insertAll($csvData);

            return redirect()->back()->with('success', 'Données copiées avec succès.');
        }

        return redirect()->back()->with('error', "Aucun fichier n'a été téléchargé.");
    }

    public function displayProducts()
    {
        // Define the path to the CSV file
        $csvFilePath = public_path('uploads/product_db.csv');

        // Check if the file exists
        if (!file_exists($csvFilePath)) {
            // If the file doesn't exist, set an empty array to $products
            $products = [];
        } else {
            // Read the product_db.csv file
            $csv = Reader::createFromPath($csvFilePath, 'r');
            $csv->setHeaderOffset(0); // Assuming the first row contains headers

            $products = $csv->getRecords(); // Get all records from the CSV file
        }

        return view('drug.create', compact('products'));
    }
}
