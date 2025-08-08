<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
   protected $fillable = [
    'mac_address',
    'model',
    'display_name',
    'registered_by',
    'registration_date',
    'printer_type_id', // ✅ ही fillable मध्ये असणं आवश्यक आहे
];
public function printerType()
{
    return $this->belongsTo(PrinterType::class, 'printer_type_id');
}

 public function registeredUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'registered_by');
    }


}
