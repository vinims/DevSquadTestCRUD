<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use Mail;

class runFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        // File upload location
        $location = 'uploads';

        // Import CSV to Database
        $filepath = public_path($location . "/" . 'productssheet.csv');

        // Reading file
        $file = fopen($filepath, "r");

        $importData_arr = array();
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata);

            // Skip first row (Remove below comment if you want to skip the first row)
            /*if($i == 0){
              $i++;
              continue; 
           }*/
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);

        // $filedata = fgetcsv($file, 1000, ",");

        // Insert to MySQL database

            foreach ($importData_arr as $importData) {
                $insertData = array(
                    "name" => $importData[0],
                    "category" => $importData[1],
                    "price" => $importData[2],
                    "imageUrl" => $importData[0],
                );
                Product::insertData($insertData);
            }

            $to_name = 'Vini';
            $to_email = 'vinimaia.prof@gmail.com';
            $arraylenght = count($importData_arr);
            $data = array('productslength' => $arraylenght);
            Mail::send('email', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
            $message->from('ritogomes88@gmail.com','Test Mail');
            });

        $arraylenght = count($importData_arr);
        dd($arraylenght);
    }
}
