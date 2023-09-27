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
                return redirect()->back()->with('error', 'Incorrect file name. Please upload a file named "products.csv".');
            }

            // Store the uploaded "products.csv" file in the public/uploads directory
            $pathToSave = public_path('uploads');
            $uploadedFile->move($pathToSave, 'products.csv');

            // Read and extract desired columns from "products.csv"
            $desiredColumns = ['sku', 'name', 'product_category', 'unit_measurement', 'unit_type'];
            $csvData = [];

            $reader = Reader::createFromPath($pathToSave.'/products.csv', 'r');
            $reader->setHeaderOffset(0);

            foreach ($reader->getRecords($desiredColumns) as $record) {
                $csvData[] = $record;
            }

            // Check if "product_db.csv" exists, create it if not
            $dbFilePath = public_path('uploads/product_db.csv');

            if (!file_exists($dbFilePath)) {
                // Create "product_db.csv" with desired column headers
                $writer = Writer::createFromPath($dbFilePath, 'w+');
                $writer->insertOne($desiredColumns);
            }

            // Read existing content of "product_db.csv"
            $existingData = [];
            $readerDb = Reader::createFromPath($dbFilePath, 'r');
            $readerDb->setHeaderOffset(0);

            foreach ($readerDb->getRecords() as $record) {
                $existingData[] = $record;
            }

            // Append new data and update existing rows in "product_db.csv"
            foreach ($csvData as $row) {
                $sku = $row['sku']; // Assuming SKU is the unique identifier
                $found = false;

                foreach ($existingData as &$dbRow) {
                    if ($dbRow['sku'] === $sku) {
                        // Update existing row
                        $dbRow = $row;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    // Append new row
                    $existingData[] = $row;
                }
            }

            // Save the updated data back to "product_db.csv"
            $writerDb = Writer::createFromPath($dbFilePath, 'w+');
            $writerDb->insertAll($existingData);

            return redirect()->back()->with('success', 'Data copied and updated successfully.');
        }

        return redirect()->back()->with('error', 'No file was uploaded.');
    }
}
