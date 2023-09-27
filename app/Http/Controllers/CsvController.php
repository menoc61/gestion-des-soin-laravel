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

            // Read and extract desired columns from "products.csv"
            $desiredColumns = ['id', 'sku', 'name', 'product_category', 'status', 'updated_at', 'imageUrl'];
            $csvData = [];

            $reader = Reader::createFromPath($pathToSave.'/products.csv', 'r');
            $reader->setHeaderOffset(0);

            // Initialize the header with column names
            $header = $desiredColumns;

            foreach ($reader->getRecords() as $record) {
                $rowData = [];
                foreach ($desiredColumns as $column) {
                    $rowData[] = $record[$column];
                }
                $csvData[] = $rowData;
            }

            // Check if "product_db.csv" exists, create it if not
            $dbFilePath = public_path('uploads/product_db.csv');

            if (!file_exists($dbFilePath)) {
                // Create "product_db.csv" with the desired column headers in the specified order
                $writer = Writer::createFromPath($dbFilePath, 'w+');
                $writer->insertOne($header);
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
                $id = $row[0]; // Assuming ID is the unique identifier
                $found = false;

                foreach ($existingData as &$dbRow) {
                    // Check if 'id' key exists in the $dbRow array
                    if (array_key_exists(0, $dbRow) && $dbRow[0] === $id) {
                        // Skip this row as it already exists in the database
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

            return redirect()->back()->with('success', 'Données copiées et mises à jour avec succès.');
        }

        return redirect()->back()->with('error', "Aucun fichier n'a été téléchargé.");
    }
}
