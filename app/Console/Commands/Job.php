<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Payments;
use Carbon\Carbon;

class Job extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:getdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        
        $response = Http::get('https://ckan.publishing.service.gov.uk/api/action/package_show?id=all-payments-to-suppliers');

        $resources = $response->json()['result']['resources'];
        
        foreach($resources as $resource){
        
            if($resource['name'] == 'Payments to Suppliers - 2011/2012'){
        
                $resourceUrl = $resource['url'];
        
                $filename = assignFilename();
        
                $myFile = fopen($filename, 'w') or die('There\'s an error creating the file');
        
                $resourceResponse = Http::get($resourceUrl)->getBody()->getContents();
        
                fwrite($myFile, $resourceResponse);
        
                fclose($myFile);
        
                $this->parseCSV($filename);

            }
        }
        return 0;
    }

    public function parseCSV($filename){
        $csvArray = readCSV($filename, ',');
        foreach($csvArray as $line){
            if(is_array($line)){

                if(preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $line[4])){
                    $parseDate = Carbon::createFromFormat('d/m/Y', $line[4]);
                } else {
                    $parseDate = NULL;
                }
                
                

                
                $payment = Payments::create([
                    'body_name'         =>  $line[0],
                    'organisation_unit' =>  $line[1],
                    'expense_category'  =>  $line[2],
                    'expenditure_code'  =>  $line[3],
                    'date'              =>  $parseDate,
                    'transaction_number'=>  $line[5],
                    'amount'            =>  $line[6],
                    'supplier_name'     =>  $line[7],
                ]);
            }
        }
    }


}