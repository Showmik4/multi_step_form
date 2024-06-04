<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table ='employee';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable=[
        'name',
        'last_name',
        'email',
        'phone',
        'address'
    ];
}
