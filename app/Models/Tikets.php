<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tikets extends Model
{
    use HasFactory;

    protected $table = 'tiket';
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class);
    }
};
