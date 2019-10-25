<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function insertData($data){

        $value=DB::table('products')->where('name', $data['name'])->get();
        if($value->count() == 0){
           DB::table('products')->insert($data);
        }
     }
}
