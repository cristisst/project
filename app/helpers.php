<?php
/**
 * Helper file with custom functions used 
 */

use Illuminate\Support\Facades\Storage; 


/**
 * Read a CSV file
 * @param $filename
 * @param $delimiter (default ',')
 * @return Array
 */
function readCSV($csvFile, $delimiter = ','){

    $file_handle = fopen($csvFile, 'r');
    
    /**
     * Read the first line containing the table header and skip it
     */
    fgetcsv($file_handle);

    /**
     * Loop to the eof and parse each line into array
     */
    while (!feof($file_handle)) {
        $line_of_text[] = fgetcsv($file_handle, 0, $delimiter);
    }
    fclose($file_handle);
    return $line_of_text;
}

/**
 * Create folder structure and generate filename
 * @return string
 */

function assignFilename(){
	//Year in YYYY format.
	$year = date("Y");

	//Month in mm format, with leading zeros.
	$month = date("m");

	//Day in dd format, with leading zeros.
	$day = date("d");

	//The folder path for our file should be YYYY/MM/DD
	$directory = "$year/$month/$day/";

	//If the directory doesn't already exists.
	if(!is_dir($directory)){
	    //Create our directory.
	    Storage::disk('local')->makeDirectory($directory);
	}
	return storage_path('app/'.$directory.time().'.csv');
}