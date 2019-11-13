<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Session;
use Mail;

class ImportController extends Controller
{
    public function index(){
        return view('import');
      }
    
      public function sendemail(){
      $to_name = 'Vini';
      $to_email = 'vinimaia.prof@gmail.com';
      $data = array('name'=>"Ogbonna Vitalis(sender_name)", 'body' => "A test mail");
      Mail::send('email', $data, function($message) use ($to_name, $to_email) {
      $message->to($to_email, $to_name)
      ->subject('Laravel Test Mail');
      $message->from('ritogomes88@gmail.com','Test Mail');
      });
    }

      public function uploadFile(Request $request){
    
        if ($request->input('submit') != null ){
    
          $file = $request->file('file');
    
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
    
          // Valid File Extensions
          $valid_extension = array("csv");
    
          // 2MB in Bytes
          $maxFileSize = 2097152; 
    
          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
            
            // Check file size
            if($fileSize <= $maxFileSize){
    
               // File upload location
               $location = dirname(__DIR__,3).'\private';

               // Upload file
               $file->move($location,$filename);
    
              // Import CSV to Database
              // $filepath = public_path($location."/".$filename);
    
              // Reading file
              // $file = fopen($filepath,"r");
    
              // $importData_arr = array();
              // $i = 0;
    
              // while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
              //    $num = count($filedata );
                 
              //    // Skip first row (Remove below comment if you want to skip the first row)
              //    /*if($i == 0){
              //       $i++;
              //       continue; 
              //    }*/
              //    for ($c=0; $c < $num; $c++) {
              //       $importData_arr[$i][] = $filedata [$c];
              //    }
              //    $i++;
              // }
            //  fclose($file);
    
              // Insert to MySQL database
              // foreach($importData_arr as $importData){

              //   $insertData = array(
              //      "name"=>$importData[0],
              //      "category"=>$importData[1],
              //      "price"=>$importData[2],
              //      "imageUrl"=>$importData[3],);
              //   Product::insertData($insertData);
    
              // }
    
              Session::flash('message','Import Successful.');
            }else{
              Session::flash('message','File too large. File must be less than 2MB.');
            }
    
          }else{
             Session::flash('message','Invalid File Extension.');
          }
    
        }
    
        // Redirect to index
        return redirect()->action('ImportController@index');
      }
}
