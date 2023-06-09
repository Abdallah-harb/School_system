<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    protected $table = 'processing_fees';
    protected $guarded = [];
    public $timestamps = true;

    public function student(){

        return $this->belongsTo(Students::class,'student_id');

    }
}
