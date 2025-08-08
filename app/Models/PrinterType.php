<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PrinterType extends Model
{
   protected $fillable = [
    'printer_type_id',
    'name',
    'protocol',
    'status',
    'description',
];

}
